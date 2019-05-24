<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span>{{ selected.length ? `#${selected[0].house_no} ${selected[0].street}, ${address[0].name}, ${address[0].municipality}` : 'Households' }}</span>
      </v-toolbar-title>

      <v-spacer></v-spacer>

      <span v-if="selected.length">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="selected = []">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </template>
          <span>Clear selected</span>
        </v-tooltip>
      </span>

      <v-divider v-if="selected.length" class="ml-1" inset vertical></v-divider>

      <div class="ml-1">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="newHouseholdDialog()">
              <v-icon>mdi-home-plus</v-icon>
            </v-btn>
          </template>
          <span>Add new household</span>
        </v-tooltip>
      </div>
      <div v-if="selected.length" class="ml-1">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="editHouseholdDialog(selected[0])">
              <v-icon>mdi-pencil</v-icon>
            </v-btn>
          </template>
          <span>Edit household</span>
        </v-tooltip>
      </div>

      <div v-if="selected.length" class="ml-1">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="archive(selected[0].id)">
              <v-icon>mdi-archive</v-icon>
            </v-btn>
          </template>
          <span>Archive household</span>
        </v-tooltip>
      </div>

      <v-divider v-if="selected.length" class="ml-1" inset vertical></v-divider>

      <div v-if="selected.length" class="ml-1">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="newInhabitantDialog()">
              <v-icon>mdi-account-plus</v-icon>
            </v-btn>
          </template>
          <span>Add new inhabitant</span>
        </v-tooltip>
      </div>

      <div v-if="selected.length" class="ml-1">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="showInhabitants(selected[0].id)">
              <v-icon>mdi-account-network</v-icon>
            </v-btn>
          </template>
          <span>View inhabitants</span>
        </v-tooltip>
      </div>

      <div class="ml-1">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon to="/inhabitants">
              <v-icon>mdi-folder-account</v-icon>
            </v-btn>
          </template>
          <span>View all inhabitants</span>
        </v-tooltip>
      </div>

      <v-divider class="ml-1" inset vertical></v-divider>

      <div class="ml-1" v-if="!selected.length">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon>
              <v-icon>mdi-printer</v-icon>
            </v-btn>
          </template>
          <span>Print</span>
        </v-tooltip>
      </div>

      <div class="ml-1" v-if="!selected.length">
        <v-menu :close-on-content-click="false" offset-y max-height="400">
          <template #activator="{ on: menu }">
            <v-tooltip bottom>
              <template #activator="{ on: tooltip }">
                <v-btn icon v-on="{ ...tooltip, ...menu }">
                  <v-icon>mdi-application-export</v-icon>
                </v-btn>
              </template>
              <span>Export</span>
            </v-tooltip>
          </template>
          <v-list>
            <v-list-item>
              <v-list-item-icon class="mr-2">
                <v-icon color="red">mdi-file-pdf</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title>PDF</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-icon class="mr-2">
                <v-icon color="blue">mdi-file-word</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title>Word</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-icon class="mr-2">
                <v-icon color="green">mdi-file-excel</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title>Excel</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-menu>
      </div>

      <div class="ml-1">
        <v-menu :close-on-content-click="false" offset-y max-height="400">
          <template #activator="{ on: menu }">
            <v-tooltip bottom>
              <template #activator="{ on: tooltip }">
                <v-btn icon v-on="{ ...tooltip, ...menu }">
                  <v-icon>mdi-table-column-width</v-icon>
                </v-btn>
              </template>
              <span>Column visibility</span>
            </v-tooltip>
          </template>
          <v-list>
            <v-list-item v-for="(item, index) in headersHouseholds" :key="index">
              <v-switch
                color="green"
                v-bind:label="item.text"
                v-model="item.selected"
                :value="item.selected"
              ></v-switch>
            </v-list-item>
          </v-list>
        </v-menu>
      </div>

      <v-flex xs12 sm6 md2 ml-1>
        <v-text-field
          v-model="search"
          flat
          outlined
          single-line
          hide-details
          height="32"
          append-icon="mdi-magnify"
          label="Search"
        ></v-text-field>
      </v-flex>
    </v-app-bar>

    <v-dialog v-model="dialogHousehold" persistent scrollable max-width="800px">
      <v-form @submit.prevent="editmode ? updateHousehold() : createHousehold()">
        <v-card>
          <v-card-title>
            <span class="headline" v-show="!editmode">Add household</span>
            <span class="headline" v-show="editmode">Edit household information</span>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text>
            <v-container grid-list-md pa-0>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="householdForm.solo_parent"
                    :items="['no','Death of spouse','Imprisonment of spouse of at least 1 year','Mental/physical incapacity of spouse','Legal or de facto separation from spouse for at least 1 year','Abandonment of spouse for at least 1 year','Unmarried mother/father who preferred to keep the child instead of others carrying him/her','Any other person who solely provides parental care and support to a child provided he/she is duly licensed foster parent of DSWD','Any family member who assumes the responsibility as head of the family as a result of death, abandonment, absence for at least one year','others']"
                    label="Solo Parent"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="householdForm.solo_parent_others"
                    label="Solo Parent Others"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-menu
                    v-model="calendarSurvey"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    eager
                    transition="scale-transition"
                    offset-y
                    full-width
                    min-width="290px"
                  >
                    <template v-slot:activator="{ on }">
                      <v-text-field
                        v-model="householdForm.dateOfSurvey"
                        label="Date of Survey"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="householdForm.dateOfSurvey"
                      no-title
                      color="primary"
                      @input="calendarSurvey = false"
                    ></v-date-picker>
                  </v-menu>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="householdForm.house_no" mask="####" label="House Number"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="householdForm.email_address" label="Email Address"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="householdForm.purok" mask="###" label="Purok"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="householdForm.placeOfOrigin" label="Place of Origin"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="householdForm.mobile_no"
                    mask="###########"
                    label="Mobile Number"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="householdForm.street" label="Street"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="householdForm.ethnic_group"
                    :items="['Bicol','Bisaya','Boholano','Capizeno','Cuyunon','Ibaloi','Ilonggo','Ifugao','Ilocano','Ivatan','Kalinga','Kankanaey','Kapangpangan','Maguindanao','Maranao','Masbateno','Pangasinan','Surigaoan','Tagalog','Tausog','Waray','Yakan','Zamboagueno/Chavacano','N/A']"
                    label="Ethnic Group"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="householdForm.dialects"
                    :items="['Bicolano','Bontoc','Cebuano','English','Ibaloi','Ibanag','Ifugao','Ilocano','Itneg','Kalinga','Kankana-ey','Pampangan','Pangasinan','Tagalog','Waray-waray','Panggalatok','Visaya','Kapangpangan']"
                    label="Dialects"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="householdForm.telephone_no"
                    mask="###########"
                    label="Telephone No."
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="householdForm.status_of_ownership_house"
                    :items="['Owned','Rented','Caretaker','Others']"
                    label="Status of Ownership-House"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="householdForm.status_of_ownership_house_others"
                    label="Status of Ownership-House Others"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="householdForm.status_of_ownership_lot"
                    :items="['Owned','Rented','Caretaker','Others']"
                    label="Status of Ownership-Lot"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="householdForm.status_of_ownership_lot_others"
                    label="Status of Ownership-Lot Others"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="householdForm.type_of_dwelling_structure"
                    :items="['Permanent Concrete','Semi Permanent','Temporary']"
                    label="Type of Dwelling Structure"
                  ></v-select>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="householdForm.type_of_dwelling"
                    :items="['Permanent Concrete','Semi Permanent','Temporary']"
                    label="Type of Dwelling "
                  ></v-select>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="householdForm.lighting_source"
                    :items="['Electricity','Solar','Petromax','Kerosene']"
                    label="Lighting Source"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="householdForm.sources_of_info"
                    :items="['Television','Radio','Newspaper','Others']"
                    label="Sources of Info"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="householdForm.sources_of_info_others"
                    label="Sources of Info Others"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="householdForm.communication_services"
                    :items="['Cell sites/Net','Internet','Telephone','Postal services','others']"
                    label="Communication Services"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="householdForm.communication_services_others"
                    label="Communication Services Others"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="householdForm.means_of_transportation"
                    :items="['PU jeep',' Taxi','Tricycle','PU bus','Private car','others']"
                    label="Means of Transportation"
                  ></v-select>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="householdForm.means_of_transportation_others"
                    label="Means of Transportation Others"
                  ></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialogHousehold=false">Cancel</v-btn>
            <v-btn color="blue darken-1" text type="submit">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>

    <v-dialog v-model="dialogCreateInhabitant" persistent scrollable max-width="800px">
      <v-form @submit.prevent="editModeInhabitant ? updateInhabitant() : createInhabitant()">
        <v-card>
          <v-card-title>
            <span class="headline" v-show="!editModeInhabitant">Add inhabitant</span>
            <span class="headline" v-show="editModeInhabitant">Edit inhabitant</span>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text>
            <v-container grid-list-md pa-0>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="inhabitantForm.first_name" label="First name"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="inhabitantForm.middle_name" label="Middle name"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="inhabitantForm.last_name" label="Last name"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="inhabitantForm.relation_to_the_head"
                    :items="['THE HEAD','Aunt','Brother-in-law','Brother','Daugther-in-law','Daughter','Father','Grandfather','Grandmother','Househelper','Husband','Mother','Son','Son-in -law','Sister-in-law','Tenant','Uncle','Wife','Common law wife']"
                    label="Relation to THE HEAD"
                  ></v-select>
                </v-flex>

                <v-flex xs12 sm6>
                  <v-select
                    v-model="inhabitantForm.sex"
                    :items="['Male','Female']"
                    label="Sex"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 sm6>
                  <v-menu
                    v-model="menuBirth"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    eager
                    transition="scale-transition"
                    offset-y
                    full-width
                    min-width="290px"
                  >
                    <template v-slot:activator="{ on }">
                      <v-text-field
                        v-model="inhabitantForm.date_of_birth"
                        label="Date of Birth"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="inhabitantForm.date_of_birth"
                      no-title
                      color="primary"
                      @input="menuBirth = false"
                    ></v-date-picker>
                  </v-menu>
                </v-flex>

                <v-flex xs12 sm6>
                  <v-text-field
                    v-model="inhabitantForm.Total_family_income"
                    label="Total Family Income"
                    mask="############"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="inhabitantForm.civil_status"
                    :items="['Single','Married','Widow/er','Separated','Common-Law','complicated']"
                    label="Civil Status"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-text-field
                    v-model="inhabitantForm.Final_family_income"
                    label="Final Family Income"
                    mask="############"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-text-field
                    v-model="inhabitantForm.placeOfBirth_native"
                    label="Place of Birth/Native"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="inhabitantForm.religion"
                    :items="['Aglipayan','Anglican','Apostolic Christian','Assembly of God','Baptist','Church of Christ','Born Again Christian','Iglesia ni Cristo','Islam','Saksi ni Jehovah','Seventh Day Adventist','Methodist','Mormons','Pentecost','Protestant','Roman Catholic']"
                    label="Religion"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="inhabitantForm.status_of_residency"
                    :items="['Permanent','Live-in relative','Boarder','Buss Resident','Moved Out','Deceased']"
                    label="Status of Residency"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="inhabitantForm.schooling"
                    :items="['In school','Out of school','Not yet in school','Graduate']"
                    label="Schooling"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-text-field
                    v-model="inhabitantForm.no_of_years_in_barangay"
                    label="Number of Years in Barangay"
                    type="number"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="inhabitantForm.Highest_educational_attainment"
                    :items="['Elem. Graduate','Elementary','High school undergraduate','High school','College undergraduate','College graduate','Vocational','Post Graduate','Pre-school','Not yet attending school']"
                    label="Highest Educational Attainment"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-menu
                    v-model="menuSettled"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    eager
                    transition="scale-transition"
                    offset-y
                    full-width
                    min-width="290px"
                  >
                    <template v-slot:activator="{ on }">
                      <v-text-field
                        v-model="inhabitantForm.date_settled_in_barangay"
                        label="Date Settled in the Barangay"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="inhabitantForm.date_settled_in_barangay"
                      no-title
                      color="primary"
                      @input="menuSettled = false"
                    ></v-date-picker>
                  </v-menu>
                </v-flex>

                <v-flex xs12 sm6>
                  <v-text-field
                    v-model="inhabitantForm.weight"
                    mask="###"
                    label="Weight(kg)"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-text-field
                    v-model="inhabitantForm.height"
                    mask="###"
                    label="Height(cm)"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="inhabitantForm.citizenship"
                    :items="['Filipino']"
                    label="Citizenship"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="inhabitantForm.ethnicGroup"
                    :items="['Bago','Bicol','Bisaya','Boholano','Bontoc','Capizeno','Cuyunon','Ibaloi','Ilonggo','Ifugao','Ilocano','Ivatan','Kalinga','Kapangpangan','Maguindanao','Maranao','Masbateno','Pangasinan','Surigaoan','Tagalog','Tausog','Waray','Yakan','Zamboagueno/Chavacano']"
                    label="Ethnic Group"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 sm6>
                  <v-select
                    v-model="inhabitantForm.registeredVoterOfTheBrgy"
                    :items="['Yes','No']"
                    label="Registered Voter"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="inhabitantForm.pregnant"
                    :items="['Yes','N/A']"
                    label="Pregnant"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 sm6>
                  <v-select
                    v-model="inhabitantForm.blood_type"
                    :items="['A', 'B', 'AB', 'O', 'Do not know']"
                    label="Blood Type"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="inhabitantForm.disability"
                    :items="['None', 'Total blindness of one eye', 'Total blindness of both eye', 'Missing one or both arms', 'Mongoloid', 'Cleff Palate', 'Malabo ang paningin/poor eyesight', 'Hunchback', 'Paralyzed legs', 'Paralyzed arms', 'Speech disorder', 'Authistic', 'Fractured Vertebrate column', 'Paralyzed from neck down', 'Hydrocephalus',
                'Deaf', 'Mute and Deaf', 'Inability to walk alone', 'Deformity', 'Polio', 'Mental Impairment', 'Celebral Palsy', 'Epileptic', 'Dwarfism', 'Others']"
                    label="Disability"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-text-field
                    v-model="inhabitantForm.dissability_others"
                    label="Disability Others"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-checkbox v-model="vaccine" label="Immunized children (0-6 yrs. old)">Toggle</v-checkbox>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-checkbox v-model="employed" label="Employed">Toggle</v-checkbox>
                </v-flex>

                <v-layout wrap v-if="employed">
                  <v-flex xs12 sm6>
                    <v-text-field
                      v-model="inhabitantForm.specific_job_description"
                      label="Specific Job Description"
                      required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6>
                    <v-select
                      v-model="inhabitantForm.gen_job_description"
                      :items="[ 'n/a', 'Accountant', 'Architect', 'Barangay Official', 'Businessman', 'Doctor', 'Engineer', 'Fireman', 'Government office worker', 'IT Worker', 'Lawyer', 'Librarian', 'Manager/Supervisor', 'Missionary', 'Nurse',
                'OFW', 'Pharmacist', 'Policemen', 'Priest', 'Professor/Instructor', 'Preacher/Pastor', 'Researcher', 'Soldier', 'Seafarer', 'Teacher', 'Therapist', 'Call center agent', 'Caregiver', 'Carpenter', 'Caretaker', 'Cashier/clerk', 'Construction worker', 'Cosmetologist/Beautician',
                'Dispatcher/Barker', 'Driver', 'Electrician', 'Factory Worker', 'Farmer/Gardener', 'Helper/Aide', 'Laborer', 'Laundrywoman', 'Machinist', 'Mechanic', 'Mason', 'Mine Worker', 'Porter', 'Plumber', 'Salesperson', 'Security Guard', 'Secretary', 'Service Crew', 'Student Assistance', 'Tailor/Sewer/Dressmaker',
                'Technician', 'Vendor', 'Volunteer Woker', 'Welder']"
                      label="Gen. Job Description"
                      required
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 sm6>
                    <v-select
                      v-model="inhabitantForm.employment_status"
                      :items="['Permanent','Contractual','Temporary','Self-employed','Retired']"
                      label="Employment Status"
                      required
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 sm6>
                    <v-select
                      v-model="inhabitantForm.job_category"
                      :items="['Offical Government and Special Interest','Professional','Technicians and Assoc. Professional','Clerks','Service Workers & Market sales workers','Farmers & Forestry Workers','Trades & related workers','Machine Operators/Assemblers','Laborers & skilled workers','Special Occupations','n/a']"
                      label="Job Category"
                      required
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 sm6>
                    <v-text-field
                      v-model="inhabitantForm.estimated_monthly_income_cash"
                      label="Estimated Monthly Income-cash"
                      required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6>
                    <v-select
                      v-model="inhabitantForm.estimated_monthly_income_kind"
                      :items="['Rice','Vegetables','Free rental','City services']"
                      label="Estimated Monthly Income-kind"
                      required
                    ></v-select>
                  </v-flex>
                </v-layout>
                <v-layout wrap v-if="vaccine">
                  <v-flex xs12 sm6>
                    <v-text-field
                      v-model="inhabitantForm.child_parent"
                      label="Child's Parent/Guardian"
                      required
                    ></v-text-field>
                  </v-flex>
                </v-layout>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialogCreateInhabitant=false">Cancel</v-btn>
            <v-btn color="blue darken-1" text type="submit">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>

    <v-dialog v-model="dialogInhabitants" scrollable max-width="800px">
      <v-card>
        <v-card-title>
          <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].first_name} ${selectedInhabitant[0].middle_name} ${selectedInhabitant[0].last_name}` : 'Inhabitants' }}</span>
          <v-spacer></v-spacer>
          <span v-if="selectedInhabitant.length">
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <v-btn v-on="on" icon @click="selectedInhabitant = []">
                  <v-icon>mdi-close</v-icon>
                </v-btn>
              </template>
              <span>Clear selected</span>
            </v-tooltip>
          </span>
          <v-divider v-if="selectedInhabitant.length" class="ml-1" inset vertical></v-divider>
          <div v-if="selectedInhabitant.length" class="ml-1">
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <v-btn v-on="on" icon  @click="editInhabitantDialog(selectedInhabitant[0])">
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
              </template>
              <span>Edit inhabitant</span>
            </v-tooltip>
          </div>
          <div v-if="selectedInhabitant.length" class="ml-1">
            <v-menu :close-on-content-click="false" offset-y max-height="400">
              <template #activator="{ on: menu }">
                <v-tooltip bottom>
                  <template #activator="{ on: tooltip }">
                    <v-btn icon v-on="{ ...tooltip, ...menu }">
                      <v-icon>mdi-file-document-edit</v-icon>
                    </v-btn>
                  </template>
                  <span>Issue documents</span>
                </v-tooltip>
              </template>
              <v-list>
                <v-list-item @click="dialogBarangayClearance = true">
                  <v-list-item-icon class="mr-2">
                    <v-icon color="deep-orange">mdi-file-document-box</v-icon>
                  </v-list-item-icon>
                  <v-list-item-content>
                    <v-list-item-title>Barangay Clearance</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-icon class="mr-2">
                    <v-icon color="deep-orange">mdi-file-document-box</v-icon>
                  </v-list-item-icon>
                  <v-list-item-content>
                    <v-list-item-title>Barangay Certificate</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-icon class="mr-2">
                    <v-icon color="deep-orange">mdi-file-document-box</v-icon>
                  </v-list-item-icon>
                  <v-list-item-content>
                    <v-list-item-title>Business Clearance</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list>
            </v-menu>
          </div>
          <div v-if="selectedInhabitant.length" class="ml-1">
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <v-btn v-on="on" icon @click="archiveInhabitant(selectedInhabitant[0].id)">
                  <v-icon>mdi-archive</v-icon>
                </v-btn>
              </template>
              <span>Archive inhabitant</span>
            </v-tooltip>
          </div>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text class="pa-0">
          <v-data-table
            v-model="selectedInhabitant"
            :headers="headersInhabitants"
            :items="inhabitantsList"
            show-select
            single-select
          >
            <template v-slot:items="props">
              <td>{{ props.item.first_name }}</td>
              <td>{{ props.item.middle_name }}</td>
              <td>{{ props.item.last_name }}</td>
              <td>{{ props.item.relation_to_the_head }}</td>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-data-table
      v-model="selected"
      v-bind:headers="filteredHeaders"
      :items="households"
      :search="search"
      :loading="loading"
      show-select
      single-select
    >
      <template v-slot:items="props">
        <td v-if="showColumn('id')">{{ props.item.id }}</td>
        <td v-if="showColumn('house_no')">{{ props.item.house_no }}</td>
        <td v-if="showColumn('solo_parent')">{{ props.item.solo_parent }}</td>
        <td v-if="showColumn('solo_parent_others')">{{ props.item.solo_parent_others }}</td>
        <td v-if="showColumn('dateOfSurvey')">{{ props.item.dateOfSurvey }}</td>
        <td v-if="showColumn('placeOfOrigin')">{{ props.item.placeOfOrigin }}</td>
        <td v-if="showColumn('email_address')">{{ props.item.email_address }}</td>
        <td v-if="showColumn('mobile_no')">{{ props.item.mobile_no }}</td>
        <td v-if="showColumn('dialects')">{{ props.item.dialects }}</td>
        <td v-if="showColumn('purok')">{{ props.item.purok }}</td>
        <td v-if="showColumn('place_of_origin')">{{ props.item.place_of_origin }}</td>
        <td v-if="showColumn('mobile_number')">{{ props.item.mobile_number }}</td>
        <td v-if="showColumn('street')">{{ props.item.street }}</td>
        <td v-if="showColumn('lighting_source')">{{ props.item.lighting_source }}</td>
        <td v-if="showColumn('ethnic_group')">{{ props.item.ethnic_group }}</td>
        <td
          v-if="showColumn('means_of_transportation_others')"
        >{{ props.item.means_of_transportation_others }}</td>
        <td v-if="showColumn('sources_of_info')">{{ props.item.sources_of_info }}</td>
        <td v-if="showColumn('sources_of_info_others')">{{ props.item.sources_of_info_others }}</td>
        <td v-if="showColumn('telephone_no')">{{ props.item.telephone_no }}</td>
        <td v-if="showColumn('means_of_transportation')">{{ props.item.means_of_transportation }}</td>
        <td v-if="showColumn('communication_services')">{{ props.item.communication_services }}</td>
        <td
          v-if="showColumn('communication_services_others')"
        >{{ props.item.communication_services_others }}</td>

        <td v-if="showColumn('type_of_dwelling')">{{ props.item.type_of_dwelling }}</td>
        <td
          v-if="showColumn('status_of_ownership_house')"
        >{{ props.item.status_of_ownership_house }}</td>
        <td
          v-if="showColumn('status_of_ownership_house_others')"
        >{{ props.item.status_of_ownership_house_others }}</td>
        <td v-if="showColumn('status_of_ownership_lot')">{{ props.item.status_of_ownership_lot }}</td>
        <td
          v-if="showColumn('status_of_ownership_lot_others')"
        >{{ props.item.status_of_ownership_lot_others }}</td>
        <td
          v-if="showColumn('type_of_dwelling_structure')"
        >{{ props.item.type_of_dwelling_structure }}</td>
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      households: [],
      inhabitants: [],
      address: [],
      dialogHousehold: false,
      dialogCreateInhabitant: false,
      dialogInhabitants: false,
      inhabitantsList: [],
      editmode: false,
      editModeInhabitant: false,
      selected: [],
      selectedInhabitant: [],
      calendarSurvey: false,
      search: "",
      vaccine: false,
      employed: false,
      menuBirth: false,
      menuSettled: false,
      householdForm: new Form({
        id: "",
        solo_parent: "",
        solo_parent_others: "",
        dateOfSurvey: "",
        familysize: "",
        house_no: "",
        purok: "",
        street: "",
        type_of_dwelling_structure: "",
        placeOfOrigin: "",
        ethnic_group: "",
        email_address: "",
        mobile_no: "",
        telephone_no: "",
        dialects: "",
        status_of_ownership_house: "",
        status_of_ownership_house_others: "",
        status_of_ownership_lot: "",
        status_of_ownership_lot_others: "",
        type_of_dwelling: "",
        lighting_source: "",
        sources_of_info: "",
        sources_of_info_others: "",
        communication_services: "",
        communication_services_others: "",
        means_of_transportation: "",
        means_of_transportation_others: ""
      }),
      inhabitantForm: new Form({
        id: "",
        household_id: "",
        first_name: "",
        middle_name: "",
        last_name: "",
        relation_to_the_head: "",
        employment_category: "",
        sex: "",
        estimated_monthly_income_cash: "",
        date_of_birth: "",
        estimated_monthly_income_kind: "",
        Total_family_income: "",
        civil_status: "",
        Final_family_income: "",
        religion: "",
        status_of_residency: "",
        schooling: "",
        no_of_years_in_barangay: "",
        Highest_educational_attainment: "",
        date_settled_in_barangay: "",
        specific_job_description: "",
        citizenship: "",
        gen_job_description: "",
        employment_status: "",
        ethnicGroup: "",
        job_category: "",
        placeOfBirth_native: "",
        registeredVoterOfTheBrgy: "",
        childs_parent_guardian: "",
        weight: "",
        height: ""
      }),
      headersHouseholds: [
        {
          text: "House Number",
          value: "house_no",
          selected: true
        },
        { text: "Purok", value: "purok", selected: true },
        { text: "Street", value: "street", selected: true },
        { text: "Familysize", value: "familysize", selected: true },
        { text: "Email Address", value: "email_address" },
        { text: "Place of Origin", value: "place_of_origin" },
        { text: "Mobile Number", value: "mobile_number" },
        { text: "Ethnic Group", value: "ethnic_group" },
        { text: "Telephone No.", value: "telephone_no" },
        { text: "Solo parent", value: "solo_parent" },
        { text: "Solo parent others", value: "solo_parent_others" },
        { text: "DateOfSurvey", value: "dateOfSurvey" },
        { text: "PlaceOfOrigin", value: "placeOfOrigin" },
        { text: "Mobile no", value: "mobile_no" },
        { text: "Dialects", value: "dialects" },
        {
          text: "Status of ownership house others",
          value: "status_of_ownership_house_others"
        },
        {
          text: "Status of ownership lot others",
          value: "status_of_ownership_lot_others"
        },
        { text: "Type of dwelling", value: "type_of_dwelling" },
        { text: "Lighting source", value: "lighting_source" },
        { text: "Sources of info", value: "sources_of_info" },
        { text: "Sources of info others", value: "sources_of_info_others" },
        { text: "Communication services", value: "communication_services" },
        {
          text: "Communication services others",
          value: "communication_services_others"
        },
        { text: "Means of transportation", value: "means_of_transportation" },
        {
          text: "Means of transportation others",
          value: "means_of_transportation_others"
        },
        {
          text: "Status of Ownership-House",
          value: "status_of_ownership_house"
        },
        {
          text: "Status of Ownership-Lot",
          value: "status_of_ownership_lot"
        },
        {
          text: "Type of Dwelling Structure",
          value: "type_of_dwelling_structure"
        },
        { text: "id", value: "id" }
      ],
      headersInhabitants: [
        { text: "First name", value: "first_name" },
        { text: "Middle name", value: "middle_name" },
        { text: "Last name", value: "last_name" },
        { text: "Relation to The Head", value: "relation_to_the_head" }
      ]
    };
  },

  computed: {
    filteredHeaders() {
      return this.headersHouseholds.filter(h => h.selected);
    },

    filteredItems() {
      return this.items.map(item => {
        let filtered = Object.assign({}, item);
        this.headersHouseholds.forEach(header => {
          if (!header.selected) delete filtered[header.value];
        });
        return filtered;
      });
    }
  },

  created() {
    this.getHouseholds();
    this.getAddress();
  },

  methods: {
    getHouseholds() {
      this.loading = true;
      axios.get("api/household").then(response => {
        this.households = response.data;
        this.loading = false;
      });
    },
    getAddress() {
      axios.get("api/address").then(response => {
        this.address = response.data;
      });
    },
    showInhabitants(id) {
      axios.get("api/household/" + id).then(response => {
        this.inhabitantsList = response.data;
        this.dialogInhabitants = true;
      });
    },
    createHousehold() {
      this.householdForm
        .post("api/household")
        .then(() => {
          this.dialogHousehold = false;
          this.getHouseholds();
          toast.fire({
            type: "success",
            title: "Household has been created"
          });
        })
        .catch(() => {});
    },
    createInhabitant(id) {
      this.inhabitantForm
        .post("api/inhabitant")
        .then(() => {
          this.dialogCreateInhabitant = false;
          this.getHouseholds();
          toast.fire({
            type: "success",
            title: "Inhabitant has been created"
          });
        })
        .catch(() => {});
    },
    updateInhabitant() {
      this.inhabitantForm
        .put("api/inhabitant/" + this.inhabitantForm.id)
        .then(() => {
          this.dialogCreateInhabitant = false;
          toast.fire({
            type: "success",
            title: "Inhabitants has been edited"
          });
        })
        .catch(() => {});
    },

    updateHousehold() {
      this.householdForm
        .put("api/household/" + this.householdForm.id)
        .then(() => {
          this.dialogHousehold = false;
          this.getHouseholds();
          toast.fire({
            type: "success",
            title: "Household has been edited"
          });
        })
        .catch(() => {});
    },
    archiveInhabitant(id) {
      swal
        .fire({
          title: "Are you sure?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, archive it!"
        })
        .then(result => {
          if (result.value) {
            axios.post("api/inhabitants/archived/" + id).then(response => {
              swal.fire(
                "Archived!",
                "Inhabitant has been archived.",
                "success"
              );
              this.getHouseholds();
              this.selectedInhabitant.splice([0]);
            });
          }
        });
    },
    archive(id) {
      swal
        .fire({
          title: "Are you sure?",
          text: "Inhabitants in this household will also be archived!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, archive it!"
        })
        .then(result => {
          if (result.value) {
            axios.post("api/households/archived/" + id).then(response => {
              swal.fire("Archived!", "Household has been archived.", "success");
              this.getHouseholds();
              this.selected.splice([0]);
            });
          }
        });
    },
    newInhabitantDialog() {
      this.editModeInhabitant = false;
      this.inhabitantForm.reset();
      this.inhabitantForm.household_id = this.selected[0].id;
      this.dialogCreateInhabitant = true;
    },
    editInhabitantDialog(inhabitants) {
      this.editModeInhabitant = true;
      this.inhabitantForm.reset();
      this.dialogCreateInhabitant = true;
      this.inhabitantForm.fill(inhabitants);
    },

    newHouseholdDialog() {
      this.editmode = false;
      this.householdForm.reset();
      this.dialogHousehold = true;
    },
    editHouseholdDialog(households) {
      this.editmode = true;
      this.householdForm.reset();
      this.dialogHousehold = true;
      this.householdForm.fill(households);
    },
    showColumn(col) {
      return this.headersHouseholds.find(h => h.value === col).selected;
    }
  }
};
</script>
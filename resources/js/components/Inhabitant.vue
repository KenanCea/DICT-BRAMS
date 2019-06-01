<template>
  <div>
    <div v-if="$gate.isUser()">
      <v-app-bar id="navbar" dense flat app>
        <v-toolbar-title>
          <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].first_name} ${selectedInhabitant[0].middle_name} ${selectedInhabitant[0].last_name}` : 'Inhabitants' }}</span>
        </v-toolbar-title>
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
              <v-btn v-on="on" icon @click="editDialog(selectedInhabitant[0])">
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
              <v-btn v-on="on" icon @click="archive(selectedInhabitant[0].id)">
                <v-icon>mdi-archive</v-icon>
              </v-btn>
            </template>
            <span>Archive inhabitant</span>
          </v-tooltip>
        </div>
        <v-divider v-if="selectedInhabitant.length" class="ml-1" inset vertical></v-divider>
        <div class="ml-1">
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn v-on="on" icon to="/households">
                <v-icon>mdi-arrow-left-circle</v-icon>
              </v-btn>
            </template>
            <span>Back to households</span>
          </v-tooltip>
        </div>
        <v-divider class="ml-1" inset vertical></v-divider>
        <div class="ml-1">
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn v-on="on" icon>
                <v-icon>mdi-printer</v-icon>
              </v-btn>
            </template>
            <span>Print</span>
          </v-tooltip>
        </div>
        <div class="ml-1">
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
              <v-list-item v-for="(item, index) in headers" :key="index">
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
        <v-flex xs2 ml-1>
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

      <v-dialog v-model="dialogEditInhabitant" persistent scrollable max-width="800px">
        <v-form @submit.prevent="updateInhabitant()">
          <v-card>
            <v-card-title>
              <span class="headline">Edit Inhabitant</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <v-container grid-list-md>
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
              <v-btn color="blue darken-1" text @click="dialogEditInhabitant=false">Cancel</v-btn>
              <v-btn color="blue darken-1" text type="submit">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-dialog>

      <v-dialog v-model="dialogBarangayClearance" scrollable persistent max-width="800px">
        <v-form>
          <v-card>
            <v-card-title>
              <span class="headline">Issue barangay clearance</span>
              <v-spacer></v-spacer>

              <div class="ml-1" v-if="barangayClearance">
                <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn v-on="on" icon>
                      <v-icon>mdi-printer</v-icon>
                    </v-btn>
                  </template>
                  <span>Print</span>
                </v-tooltip>
              </div>

              <div class="ml-1" v-if="barangayClearance">
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
            </v-card-title>

            <v-divider></v-divider>
            <v-card-text>
              <v-container grid-list-md class="pa-0">
                <v-layout wrap>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-model="formBarangayClearance.ctc_no"
                      label="Community Tax Certificate Number"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-model="formBarangayClearance.purpose_of_clearance"
                      label="Purpose of clearance"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-model="formBarangayClearance.official_receipt_no"
                      label="Official Receipt Number"
                    ></v-text-field>
                  </v-flex>
                </v-layout>
              </v-container>
              <v-divider></v-divider>
              <v-container grid-list-md text-xs-center class="pa-0" id="printForm">
                <v-layout row wrap>
                  <v-flex xs3>
                    <v-img src="/img/baguio.png" alt="Logo" contain height="100"></v-img>
                  </v-flex>
                  <v-flex xs6 class="green--text title">
                    <p class="mb-0">Republic of the Philippines</p>
                    <p class="mb-0">Barangay Camp Allen Baguio City</p>
                  </v-flex>
                  <v-flex xs3>
                    <img :src="getLogo()" alt="Logo" contain height="100">
                  </v-flex>
                </v-layout>
                <v-layout row wrap>
                  <v-flex xs12 class="subtitle-1 font-weight-bold">
                    <p class="mb-0">Office of the Punong Barangay</p>
                    <p>Barangay Clearance</p>
                  </v-flex>
                </v-layout>
                <v-layout row wrap>
                  <v-flex xs4 class="form-border-right">
                    <p class="mb-0">RANDY P. GATI</p>
                    <p>Punong Barangay</p>
                    <p class="mb-0">BRIAN C. ANTON</p>
                    <p>Barangay Kagawad</p>
                    <p class="mb-0">ARTHUR T. WILLY</p>
                    <p>Barangay Kagawad</p>
                    <p class="mb-0">MARTN G. CONTIC</p>
                    <p>Barangay Kagawad</p>
                    <p class="mb-0">EMILY R. BALLARES</p>
                    <p>Barangay Kagawad</p>
                    <p class="mb-0">RUDY D. AMISTAD</p>
                    <p>Barangay Kagawad</p>
                    <p class="mb-0">VICENTE J. ZAPANTA</p>
                    <p>Barangay Kagawad</p>
                    <p class="mb-0">MODESTO P. COLUMBRES</p>
                    <p>Barangay Kagawad</p>
                    <p class="mb-0">CYNTHIA G. AMISTAD</p>
                    <p>Barangay Secretary</p>
                    <p class="mb-0">RONALD C. GOMEZ</p>
                    <p>Barangay Treasurer</p>
                  </v-flex>
                  <v-flex xs8 text-xs-left class="pl-3">
                    <p>TO WHOM IT MAY CONCERN:</p>
                    <p>
                      This is to certify that
                      <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].first_name} ${selectedInhabitant[0].middle_name}, ${selectedInhabitant[0].last_name}` : '______________________________________________' }},</span>
                      <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].age}` : '________' }}</span>years old,
                      <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].citizenship}` : '________________________' }}</span> citizen, a native of
                      <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].placeOfBirth_native}` : '________________________' }}</span>, and presently residing at
                      <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].house_no} ${selectedInhabitant[0].purok} ${selectedInhabitant[0].street} ${selectedInhabitant[0].barangay}` : '________________________________________________' }}</span>
                      and whose signature appears hereunder, has no pending adverse case and deragatory records filed
                      against per available records on file with this office as of the date of issuance thereof.
                    </p>
                    <p>
                      Issued
                      <span
                        v-if="formBarangayClearance.purpose_of_clearance"
                      >{{formBarangayClearance.purpose_of_clearance}}</span>
                      <span v-else>________________________________________</span> purposes.
                    </p>
                    <p class="mb-0">________________________</p>
                    <p class="mb-5">Signature Over Printed Name</p>
                    <p class="mb-0">
                      Community Tax Certificate Number:
                      <span
                        v-if="formBarangayClearance.ctc_no"
                      >{{formBarangayClearance.ctc_no}}</span>
                      <span v-else>____________</span>
                    </p>
                    <p class="mb-0">
                      Issued On:
                      <span
                        v-if="formBarangayClearance.ctc_issued_on"
                      >{{formBarangayClearance.ctc_no}}</span>
                      <span v-else>____________</span>
                    </p>
                    <p class="mb-0">
                      Issued At:
                      <span
                        v-if="formBarangayClearance.ctc_issued_at"
                      >{{formBarangayClearance.ctc_no}}</span>
                      <span v-else>____________</span>
                    </p>
                    <p class="mb-0">
                      Official Receipt Number:
                      <span
                        v-if="formBarangayClearance.ctc_issued_at"
                      >{{formBarangayClearance.official_receipt_no}}</span>
                      <span v-else>____________</span>
                    </p>
                    <div class="text-xs-right text-xs-center">
                      <p class="mb-5">CERTIFIED AND ISSUED BY:</p>
                      <p class="mb-0 mr-5">RANDY P. GATI</p>
                      <p class="mb-5 mr-5">Punong Barangay</p>
                    </div>
                    <p>Note: Not valid without Barangay Seal</p>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-btn
                color="red darken-1"
                text
                v-if="barangayClearance"
                @click="barangayClearance = false"
              >back</v-btn>
              <v-btn color="red darken-1" text v-if="!barangayClearance" @click="clear()">cancel</v-btn>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                v-if="!barangayClearance"
                @click="barangayClearance = true"
              >proceed</v-btn>
              <v-btn color="blue darken-1" text v-if="barangayClearance" @click="clear()">Ok</v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-dialog>

      <v-data-table
        id="printTable"
        v-model="selectedInhabitant"
        v-bind:headers="filteredHeaders"
        :items="inhabitants"
        :loading="loading"
        :search="search"
        show-select
        single-select
      >
        <template v-slot:items="props">
          <td v-if="showColumn('id')">{{ props.item.id }}</td>
          <td v-if="showColumn('first_name')">{{ props.item.first_name }}</td>
          <td v-if="showColumn('middle_name')">{{ props.item.middle_name }}</td>
          <td v-if="showColumn('last_name')">{{ props.item.last_name }}</td>
          <td v-if="showColumn('relation_to_the_head')">{{ props.item.relation_to_the_head }}</td>
          <td v-if="showColumn('age')">{{ props.item.age }}</td>
          <td v-if="showColumn('employment_category')">{{ props.item.employment_category }}</td>
          <td v-if="showColumn('sex')">{{ props.item.sex }}</td>
          <td
            v-if="showColumn('estimated_monthly_income_cash')"
          >{{ props.item.estimated_monthly_income_cash }}</td>
          <td v-if="showColumn('date_of_birth')">{{ props.item.date_of_birth }}</td>
          <td
            v-if="showColumn('estimated_monthly_income_kind')"
          >{{ props.item.estimated_monthly_income_kind }}</td>
          <td v-if="showColumn('Total_family_income')">{{ props.item.Total_family_income }}</td>
          <td v-if="showColumn('civil_status')">{{ props.item.civil_status }}</td>
          <td v-if="showColumn('Final_family_income')">{{ props.item.Final_family_income }}</td>
          <td v-if="showColumn('religion')">{{ props.item.religion }}</td>
          <td v-if="showColumn('status_of_residency')">{{ props.item.status_of_residency }}</td>
          <td v-if="showColumn('schooling')">{{ props.item.schooling }}</td>

          <td
            v-if="showColumn('Highest_educational_attainment')"
          >{{ props.item.Highest_educational_attainment }}</td>
          <td
            v-if="showColumn('date_settled_in_barangay')"
          >{{ props.item.date_settled_in_barangay }}</td>
          <td
            v-if="showColumn('specific_job_description')"
          >{{ props.item.specific_job_description }}</td>
          <td v-if="showColumn('citizenship')">{{ props.item.citizenship }}</td>
          <td v-if="showColumn('gen_job_description')">{{ props.item.gen_job_description }}</td>
          <td v-if="showColumn('employment_status')">{{ props.item.employment_status }}</td>
          <td v-if="showColumn('ethnicGroup')">{{ props.item.ethnicGroup }}</td>
          <td v-if="showColumn('job_category')">{{ props.item.job_category }}</td>
          <td v-if="showColumn('placeOfBirth_native')">{{ props.item.placeOfBirth_native }}</td>
          <td
            v-if="showColumn('registeredVoterOfTheBrgy')"
          >{{ props.item.registeredVoterOfTheBrgy }}</td>
          <td v-if="showColumn('childs_parent_guardian')">{{ props.item.childs_parent_guardian }}</td>
          <td v-if="showColumn('weight')">{{ props.item.weight }}</td>
          <td v-if="showColumn('height')">{{ props.item.height }}</td>
        </template>
      </v-data-table>
    </div>
    <div v-if="!$gate.isUser()">
      <not-found></not-found>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    Table: "Inhabitants",
    Orientation: "landscape",
    headers: [
      { text: "First name", value: "first_name", selected: true },
      { text: "Middle name", value: "middle_name", selected: true },
      { text: "Last name", value: "last_name", selected: true },
      { text: "Age", value: "age", selected: true },
      { text: "Sex", value: "sex", selected: true },
      {
        text: "Relation to The Head",
        value: "relation_to_the_head",
        selected: true
      },
      { text: "Employment Category", value: "employment_category" },
      {
        text: "Estimated Monthly Income-cash",
        value: "estimated_monthly_income_cash"
      },
      { text: "Date of Birth", value: "date_of_birth" },
      {
        text: "Estimated Monthly Income-kind",
        value: "estimated_monthly_income_kind"
      },
      { text: "Total Family Income", value: "Total_family_income" },
      { text: "Civil Status", value: "civil_status" },
      { text: "Final Family Income", value: "Final_family_income" },
      { text: "Religion", value: "religion" },
      { text: "Status of Residency", value: "status_of_residency" },
      { text: "Shooling", value: "schooling" },

      {
        text: "Highest Educ'l Attainment",
        value: "Highest_educational_attainment"
      },
      {
        text: "Date Settled in the Barangay",
        value: "date_settled_in_barangay"
      },
      { text: "Specific Job Description", value: "specific_job_description" },
      { text: "Citizenship", value: "citizenship" },
      { text: "Gen. Job Description", value: "gen_job_description" },
      { text: "Employment Status", value: "employment_status" },
      { text: "Ethnic Group", value: "ethnicGroup" },
      { text: "Job Category", value: "job_category" },
      { text: "Place of Birth/Native", value: "placeOfBirth_native" },
      { text: "Registered Voter", value: "registeredVoterOfTheBrgy" },
      { text: "Child's Parent/Guardian", value: "childs_parent_guardian" },
      { text: "Weight(kg)", value: "weight" },
      { text: "Height(cm)", value: "height" },
      { text: "ID", value: "id" }
    ],
    selectedInhabitant: [],
    inhabitants: [],
    user: {},
    dialogEditInhabitant: false,
    dialogBarangayClearance: false,
    barangayClearance: false,
    loading: false,
    vaccine: false,
    employed: false,
    isLoading: false,
    editmode: false,
    menuBirth: false,
    menuSettled: false,
    search: null,
    menuIssued: false,
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
    formBarangayClearance: new Form({
      logo: "",
      control_no: "",
      ctc_no: "",
      purpose_of_clearance: "",
      date_issued: "",
      official_receipt_no: "",
      ctc_issued_on: "",
      ctc_issued_at: "",
      inhabitant_id: ""
    })
  }),

  created() {
    if (this.$gate.isUser()) {
      this.getInhabitants();
      this.getUser();
    }
  },

  computed: {
    filteredHeaders() {
      return this.headers.filter(h => h.selected);
    },

    filteredItems() {
      return this.items.map(item => {
        let filtered = Object.assign({}, item);
        this.headers.forEach(header => {
          if (!header.selected) delete filtered[header.value];
        });
        return filtered;
      });
    }
  },

  methods: {
    getInhabitants() {
      this.loading = true;
      axios.get("api/inhabitant").then(response => {
        this.inhabitants = response.data;
        this.loading = false;
      });
    },
     getUser() {
      axios.get("api/user").then(({ data }) => this.formBarangayClearance.fill(data));
    },

    updateInhabitant() {
      this.inhabitantForm
        .put("api/inhabitant/" + this.inhabitantForm.id)
        .then(() => {
          this.dialogEditInhabitant = false;
          this.getInhabitants();
          toast.fire({
            type: "success",
            title: "Inhabitants has been edited"
          });
        })
        .catch(() => {});
    },

    archive(id) {
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
              this.getInhabitants();
              this.selectedInhabitant.splice([0]);
            });
          }
        });
    },
    editDialog(inhabitants) {
      this.inhabitantForm.reset();
      this.dialogEditInhabitant = true;
      this.inhabitantForm.fill(inhabitants);
    },

    getLogo() {
      let logo =
        this.formBarangayClearance.logo.length > 200
          ? this.formBarangayClearance.logo
          : "img/profile/" + this.formBarangayClearance.logo;
      return logo;
    },

    clear() {
      this.dialogBarangayClearance = false;
      this.formBarangayClearance = [];
      this.barangayClearance = false;
    },

    showColumn(col) {
      return this.headers.find(h => h.value === col).selected;
    }
  }
};
</script>
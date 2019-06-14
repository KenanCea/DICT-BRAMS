<template>
  <div>
    <div v-if="$gate.isUser()">
      <v-app-bar id="navbar" fixed dense flat app>
        <v-toolbar-title>
          <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].first_name} ${selectedInhabitant[0].middle_name} ${selectedInhabitant[0].last_name}` : 'Inhabitants' }}</span>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <span v-if="selectedInhabitant.length">
          <v-tooltip attach bottom>
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
          <v-tooltip attach bottom>
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
              <v-tooltip attach bottom>
                <template #activator="{ on: tooltip }">
                  <v-btn icon v-on="{ ...tooltip, ...menu }">
                    <v-icon>mdi-file-document-edit</v-icon>
                  </v-btn>
                </template>
                <span>Issue documents</span>
              </v-tooltip>
            </template>
            <v-list>
              <v-list-item @click="showBarangayClearance(selectedInhabitant[0].id)">
                <v-list-item-icon class="mr-2">
                  <v-icon color="deep-orange">mdi-file-document-box</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>Barangay Clearance</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
              <v-list-item @click="showBarangayCertificate(selectedInhabitant[0].id)">
                <v-list-item-icon class="mr-2">
                  <v-icon color="deep-orange">mdi-file-document-box</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>Barangay Certificate</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
              <v-list-item @click="showBusinessClearance(selectedInhabitant[0].id)">
                <v-list-item-icon class="mr-2">
                  <v-icon color="deep-orange">mdi-file-document-box</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>Business Clearance</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
              <v-list-item @click="showFiledCases(selectedInhabitant[0].id)">
                <v-list-item-icon class="mr-2">
                  <v-icon color="deep-orange">mdi-file-document-box</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>Filed Cases</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-menu>
        </div>
        <div v-if="selectedInhabitant.length" class="ml-1">
          <v-tooltip attach bottom>
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
          <v-tooltip attach bottom>
            <template v-slot:activator="{ on }">
              <v-btn v-on="on" icon to="/households">
                <v-icon>mdi-arrow-left-circle</v-icon>
              </v-btn>
            </template>
            <span>Back to households</span>
          </v-tooltip>
        </div>
        <v-divider class="mx-1" inset vertical></v-divider>

        <app-print :TableTitle="Table" :PageOrientation="Orientation"></app-print>

        <div class="ml-1">
          <v-menu :close-on-content-click="false" offset-y max-height="400">
            <template #activator="{ on: menu }">
              <v-tooltip attach bottom>
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
              <v-container grid-list-md pa-0>
                <v-layout wrap>
                  <v-flex xs6 md4>
                    <v-text-field
                      v-model="inhabitantForm.first_name"
                      label="First name*"
                      :rules="[v => !!v || 'First name is required']"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs6 md4>
                    <v-text-field
                      v-model="inhabitantForm.middle_name"
                      label="Middle name"
                      :rules="[v => !!v || 'Middle name is required']"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs6 md4>
                    <v-text-field
                      v-model="inhabitantForm.last_name"
                      label="Last name"
                      :rules="[v => !!v || 'Last name is required']"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs6>
                    <v-select
                      v-model="inhabitantForm.relation_to_the_head"
                      :items="['THE HEAD','Husband','Wife','Father','Mother','Brother', 'Sister','Daughter','Son','Grandfather','Grandmother','Aunt','Uncle','Househelper','Tenant','Brother-in-law','Daugther-in-law','Son-in-law','Sister-in-law','Common law wife']"
                      label="Relation to THE HEAD"
                      :rules="[v => !!v || 'Relation to THE HEAD is required']"
                    ></v-select>
                  </v-flex>

                  <v-flex xs6>
                    <v-select
                      v-model="inhabitantForm.sex"
                      :items="['Male','Female']"
                      label="Sex"
                      :rules="[v => !!v || 'Sex is required']"
                      required
                    ></v-select>
                  </v-flex>

                  <v-flex xs6>
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
                          :rules="[v => !!v || 'Date of Birth is required']"
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

                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.placeOfBirth_native"
                      label="Place of Birth"
                      :rules="[v => !!v || 'Place of Birth is required']"
                      required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs6>
                    <v-autocomplete
                      v-model="inhabitantForm.citizenship"
                      :items="['Afghan','Albanian','Algerian','American','Andorran','Angolan', 'Antiguan', 'Argentine', 'Armenian', 'Aruban', 'Australian', 'Austrian', 'Azerbaijani', 'Bahamian', 'Bahrainis', 'Bangladeshis', 'Barbadian', 'Basque', 'Belarusian', 'Belgian', 'Belizean', 'Beninese', 'Bermudian', 'Bhutanese', 'Bolivian', 'Bosniak', 'Bosnian', 'Botswana', 'Brazilian', 'Breton', 'British', 'British Virgin Islander', 'Bruneian', 'Bulgarian', 'Macedonian Bulgarian', 'Burkinabé', 'Burmese', 'Burundian', 'Cambodian', 'Cameroonian', 'Canadian', 'Catalan', 'Cape Verdean', 'Chadian', 'Chilean', 'Chinese', 'Colombian', 'Comorian', 'Congolese', 'Costa Rican', 'Croatian', 'Cuban', 'Cypriot', 'Czech', 'Dane', 'Greenlander', 'Djiboutian', 'Dominican', 'Dutch', 'East Timorese', 'Ecuadorian', 'Egyptian', 'Emirati', 'English', 'Equatoguinean', 'Eritrean', 'Estonian', 'Ethiopian', 'Falkland Islander', 'Faroese', 'Fijian', 'Finn', 'Finnish Swedish', 'Filipino', 'French citizen', 'Gabonese', 'Gambian', 'Georgian', 'German', 'Baltic German', 'Ghanaian', 'Gibraltarian', 'Greek', 'Greek Macedonian', 'Grenadian', 'Guatemalan', 'Guianese', 'Guinean', 'Guinea-Bissau national', 'Guyanese', 'Haitian', 'Honduran', 'Hong Konger', 'Hungarian', 'Icelander', 'I-Kiribati', 'Indian', 'Indonesian', 'Iranian', 'Iraqis', 'Irish', 'Israelis', 'Italian', 'Ivoirian', 'Jamaican', 'Japanese', 'Jordanian', 'Kazakh', 'Kenyan', 'Korean', 'Kosovar', 'Kuwaitis', 'Kyrgyz', 'Lao', 'Latvian', 'Lebanese', 'Liberian', 'Libyan', 'Liechtensteiner', 'Lithuanian', 'Luxembourger', 'Macao', 'Macedonian', 'Malagasy', 'Malawian', 'Malaysian', 'Maldivian', 'Malians', 'Maltese', 'Manx', 'Marshallese', 'Mauritanian', 'Mauritian', 'Mexicans', 'Micronesian', 'Moldovans', 'Monégasque', 'Mongolian', 'Montenegrin', 'Moroccan', 'Mozambican', 'Namibian', 'Nauran', 'Nepalese', 'New Zealander', 'Nicaraguan', 'Nigerien', 'Nigerian', 'Norwegian', 'Omani', 'Pakistanis', 'Palauan', 'Palestinian', 'Panamanian', 'Papua New Guinean', 'Paraguayan', 'Peruvian', 'Poles', 'Portuguese', 'Puerto Rican', 'Qatari', 'Quebecer', 'Réunionnais', 'Romanian', 'Russian', 'Baltic Russian', 'Rwandan', 'Saint Kitt', 'Saint Lucian', 'Salvadoran', 'Sammarinese', 'Samoans', 'São Tomé and Príncipe', 'Saudis', 'Scot', 'Senegalese', 'Serbs', 'Seychellois', 'Sierra Leonean', 'Singaporean', 'Slovak', 'Slovene', 'Solomon Islander', 'Somalis', 'Somalilander', 'Sotho', 'South African', 'Spaniard', 'Sri Lankan', 'Sudanese', 'Surinamese', 'Swazi', 'Swedes', 'Swiss', 'Syriac', 'Syrian', 'Taiwanese', 'Tamil', 'Tajik', 'Tanzanian', 'Thai', 'Tibetan', 'Tobagonian', 'Togolese', 'Tongan', 'Trinidadian', 'Tunisian', 'Turk', 'Tuvaluan', 'Ugandan', 'Ukrainian', 'Uruguayan', 'Uzbek', 'Vanuatuan', 'Venezuelan', 'Vietnamese', 'Vincentian', 'Welsh', 'Yemenis', 'Zambian', 'Zimbabwean']"
                      label="Citizenship"
                      :rules="[v => !!v || 'Citizenship is required']"
                      required
                    ></v-autocomplete>
                  </v-flex>
                  <v-flex xs6>
                    <v-select
                      v-model="inhabitantForm.civil_status"
                      :items="['Single', 'Married', 'Widow/er', 'Separated', 'Common-law', 'Complicated']"
                      label="Civil Status"
                      :rules="[v => !!v || 'Civil Status is required']"
                      required
                    ></v-select>
                  </v-flex>

                  <v-flex xs6>
                    <v-select
                      v-model="inhabitantForm.religion"
                      :items="['Aglipayan','Anglican','Apostolic Christian','Assembly of God','Baptist','Church of Christ','Born Again Christian','Iglesia ni Cristo','Islam','Saksi ni Jehovah','Seventh Day Adventist','Methodist','Mormons','Pentecost','Protestant','Roman Catholic']"
                      label="Religion"
                      :rules="[v => !!v || 'Religion is required']"
                      required
                    ></v-select>
                  </v-flex>
                  <v-flex xs6>
                    <v-select
                      v-model="inhabitantForm.status_of_residency"
                      :items="['Permanent', 'Live-in relative', 'Boarder', 'Buss resident', 'Moved out', 'Deceased']"
                      label="Status of Residency"
                      :rules="[v => !!v || 'Status of Residency is required']"
                      required
                    ></v-select>
                  </v-flex>
                  <v-flex xs6>
                    <v-select
                      v-model="inhabitantForm.schooling"
                      :items="['n/a', 'In School', 'Out of School', 'Not yet in school', 'Graduate']"
                      label="Schooling"
                      :rules="[v => !!v || 'Schooling is required']"
                      required
                    ></v-select>
                  </v-flex>

                  <v-flex xs6>
                    <v-select
                      v-model="inhabitantForm.Highest_educational_attainment"
                      :items="['Elem. Graduate','Elementary','High school undergraduate','High school','College undergraduate','College graduate','Vocational','Post Graduate','Pre-school','Not yet attending school']"
                      label="Highest Educational Attainment"
                      :rules="[v => !!v || 'Highest Educational Attainment is required']"
                      required
                    ></v-select>
                  </v-flex>
                  <v-flex xs6>
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
                          :rules="[v => !!v || 'Date Settled in the Barangay is required']"
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

                  <v-flex xs6>
                    <v-select
                      v-model="inhabitantForm.ethnicGroup"
                      :items="['Bago', 'Bicol', 'Bisaya', 'Boholano', 'Bontoc', 'Capizeno', 'Cuyunon', 'Ibaloi', 'Ilonggo', 'Ifugao', 'Ilocano', 'Ivatan', 'Kalinga', 'Kankana-ey', 'Kapangpangan', 'Maguindanao', 'Maranao', 'Masbateno', 'Pangasinan', 'Surigaoan', 'Tagalog', 'Tausog', 'Waray', 'Yakan', 'Zamboagueno/Chavacano']"
                      label="Ethnic Group"
                      :rules="[v => !!v || 'Ethnic Group is required']"
                      required
                    ></v-select>
                  </v-flex>

                  <v-flex xs6>
                    <v-select
                      v-model="inhabitantForm.registeredVoterOfTheBrgy"
                      :items="['Yes','No']"
                      label="Registered Voter"
                      :rules="[v => !!v || 'Registered Voter is required']"
                      required
                    ></v-select>
                  </v-flex>

                  <v-flex xs6>
                    <v-select
                      v-model="inhabitantForm.blood_type"
                      :items="['A', 'B', 'AB', 'O', 'Do not know']"
                      label="Blood Type"
                      :rules="[v => !!v || 'Blood Type is required']"
                      required
                    ></v-select>
                  </v-flex>

                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.Total_family_income"
                      label="Total Family Income"
                      type="number"
                      onkeydown="return event.keyCode !== 69"
                      :rules="[v => !!v || 'Total Family Income is required']"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.Final_family_income"
                      label="Final Family Income"
                      type="number"
                      onkeydown="return event.keyCode !== 69"
                      :rules="[v => !!v || 'Final Family Income is required']"
                      required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs6>
                    <v-select
                      v-model="inhabitantForm.disability"
                      :items="['None', 'Total blindness of one eye', 'Total blindness of both eye', 'Missing one or both arms', 'Mongoloid', 'Cleff Palate', 'Malabo ang paningin/poor eyesight', 'Hunchback', 'Paralyzed legs', 'Paralyzed arms', 'Speech disorder', 'Authistic', 'Fractured Vertebrate column', 'Paralyzed from neck down', 'Hydrocephalus',
                'Deaf', 'Mute and Deaf', 'Inability to walk alone', 'Deformity', 'Polio', 'Mental Impairment', 'Celebral Palsy', 'Epileptic', 'Dwarfism', 'Others']"
                      label="Disability"
                      :rules="[v => !!v || 'Disability is required']"
                      required
                    ></v-select>
                  </v-flex>
                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.dissability_others"
                      label="Disability Others"
                    ></v-text-field>
                  </v-flex>

                  <v-flex xs6>
                    <v-checkbox v-model="vaccine" label="For ages 0-6 years old">Toggle</v-checkbox>
                  </v-flex>

                  <v-layout row wrap v-if="vaccine">
                    <v-flex xs4>
                      <v-text-field
                        v-model="inhabitantForm.childs_parent_guardian"
                        label="Child's Parent/Guardian"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs4>
                      <v-select
                        v-model="inhabitantForm.dewormed"
                        label="Dewormed?"
                        :items="['yes', 'no']"
                      ></v-select>
                    </v-flex>
                    <v-flex xs4>
                      <v-select
                        v-model="inhabitantForm.received_vitaminA"
                        label="Recieved Vitamin A?"
                        :items="['yes', 'no']"
                      ></v-select>
                    </v-flex>

                    <v-flex xs3>
                      <v-text-field
                        v-model="inhabitantForm.weight"
                        type="number"
                        onkeydown="return event.keyCode !== 69"
                        label="Weight(kg)"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs3>
                      <v-text-field
                        v-model="inhabitantForm.height"
                        type="number"
                        onkeydown="return event.keyCode !== 69"
                        label="Height(cm)"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs6>
                      <v-menu
                        v-model="menuHeight"
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
                            v-model="inhabitantForm.date_measured_height_weight"
                            label="Date measured height and weight"
                            prepend-icon="mdi-calendar"
                            readonly
                            v-on="on"
                          ></v-text-field>
                        </template>
                        <v-date-picker
                          v-model="inhabitantForm.date_measured_height_weight"
                          no-title
                          color="primary"
                          @input="menuHeight = false"
                        ></v-date-picker>
                      </v-menu>
                    </v-flex>

                    <v-flex xs1>
                      <v-select v-model="inhabitantForm.bcg" label="bcg" :items="['y', 'n']"></v-select>
                    </v-flex>

                    <v-flex xs1>
                      <v-select v-model="inhabitantForm.dpi1" label="dpi" :items="['y', 'n']"></v-select>
                    </v-flex>
                    <v-flex xs1>
                      <v-select v-model="inhabitantForm.dpi2" label="dpi" :items="['y', 'n']"></v-select>
                    </v-flex>
                    <v-flex xs1>
                      <v-select v-model="inhabitantForm.dpi3" label="dpi" :items="['y', 'n']"></v-select>
                    </v-flex>

                    <v-flex xs1>
                      <v-select v-model="inhabitantForm.opd1" label="opd" :items="['y', 'n']"></v-select>
                    </v-flex>
                    <v-flex xs1>
                      <v-select v-model="inhabitantForm.opd2" label="opd" :items="['y', 'n']"></v-select>
                    </v-flex>
                    <v-flex xs1>
                      <v-select v-model="inhabitantForm.opd3" label="opd" :items="['y', 'n']"></v-select>
                    </v-flex>

                    <v-flex xs2>
                      <v-select
                        v-model="inhabitantForm.measles"
                        label="measles"
                        :items="['y', 'n']"
                      ></v-select>
                    </v-flex>

                    <v-flex xs1>
                      <v-select v-model="inhabitantForm.others1" label="others" :items="['y', 'n']"></v-select>
                    </v-flex>
                    <v-flex xs1>
                      <v-select v-model="inhabitantForm.others2" label="others" :items="['y', 'n']"></v-select>
                    </v-flex>
                    <v-flex xs1>
                      <v-select v-model="inhabitantForm.others3" label="others" :items="['y', 'n']"></v-select>
                    </v-flex>
                  </v-layout>

                  <v-flex xs6>
                    <v-checkbox v-model="employed" label="For employed inhabitant">Toggle</v-checkbox>
                  </v-flex>

                  <v-layout wrap v-if="employed">
                    <v-flex xs6>
                      <v-select
                        v-model="inhabitantForm.gen_job_description"
                        :items="[ 'n/a', 'Accountant', 'Architect', 'Barangay Official', 'Businessman', 'Doctor', 'Engineer', 'Fireman', 'Government office worker', 'IT Worker', 'Lawyer', 'Librarian', 'Manager/Supervisor', 'Missionary', 'Nurse',
                'OFW', 'Pharmacist', 'Policemen', 'Priest', 'Professor/Instructor', 'Preacher/Pastor', 'Researcher', 'Soldier', 'Seafarer', 'Teacher', 'Therapist', 'Call center agent', 'Caregiver', 'Carpenter', 'Caretaker', 'Cashier/clerk', 'Construction worker', 'Cosmetologist/Beautician',
                'Dispatcher/Barker', 'Driver', 'Electrician', 'Factory Worker', 'Farmer/Gardener', 'Helper/Aide', 'Laborer', 'Laundrywoman', 'Machinist', 'Mechanic', 'Mason', 'Mine Worker', 'Porter', 'Plumber', 'Salesperson', 'Security Guard', 'Secretary', 'Service Crew', 'Student Assistance', 'Tailor/Sewer/Dressmaker',
                'Technician', 'Vendor', 'Volunteer Woker', 'Welder']"
                        label="General Job Description"
                      ></v-select>
                    </v-flex>
                    <v-flex xs6>
                      <v-text-field
                        v-model="inhabitantForm.specific_job_description"
                        label="Specific Job Description"
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs6>
                      <v-select
                        v-model="inhabitantForm.employment_status"
                        :items="['Permanent', 'Contractual', 'Temporary', 'Self-employed', 'Retired', 'Unknown']"
                        label="Employment Status"
                      ></v-select>
                    </v-flex>
                    <v-flex xs6>
                      <v-select
                        v-model="inhabitantForm.job_category"
                        :items="['Offical Government and Special Interest','Professional','Technicians and Assoc. Professional','Clerks','Service Workers & Market sales workers','Farmers & Forestry Workers','Trades & related workers','Machine Operators/Assemblers','Laborers & skilled workers','Special Occupations','n/a']"
                        label="Job Category"
                      ></v-select>
                    </v-flex>
                    <v-flex xs6>
                      <v-text-field
                        v-model="inhabitantForm.estimated_monthly_income_cash"
                        label="Estimated Monthly Income-cash"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs6>
                      <v-text-field
                        v-model="inhabitantForm.estimated_monthly_income_kind"
                        label="Estimated Monthly Income-kind"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs6>
                      <v-select
                        v-model="inhabitantForm.employment_category"
                        :items="['Private', 'Government', 'Self employed', 'Overseas']"
                        label="Employment Category"
                      ></v-select>
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
      <!-- Barangay Clearance -->
      <v-dialog v-model="dialogBarangayClearanceForm" scrollable persistent max-width="800px">
        <v-form @submit.prevent="createBarangayClearance">
          <v-card>
            <v-card-title>
              <span class="headline">Issue barangay clearance</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <v-container grid-list-md class="pa-0">
                <v-layout wrap>
                  <v-flex xs12 sm6 md6>
                    <v-text-field
                      v-model="formBarangayClearance.control_no"
                      label="Control number*"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md6>
                    <v-text-field
                      v-model="formBarangayClearance.ctc_no"
                      label="Community tax certificate number*"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md6>
                    <v-text-field
                      v-model="formBarangayClearance.purpose_of_clearance"
                      label="Purpose of clearance*"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md6>
                    <v-text-field
                      v-model="formBarangayClearance.official_receipt_no"
                      label="Official receipt number*"
                    ></v-text-field>
                  </v-flex>
                </v-layout>
              </v-container>
              <v-card outlined>
                <v-data-table
                  :headers="barangayClearanceHeaders"
                  :items="barangayClearanceIssued"
                  hide-default-footer
                >
                  <template v-slot:item.action="{ item }">
                    <v-btn icon @click="printBarangayClearance(item)">
                      <v-icon>mdi-printer</v-icon>
                    </v-btn>
                  </template>
                </v-data-table>
              </v-card>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <p class="mb-0">* indicates required field</p>
              <v-spacer></v-spacer>
              <v-btn color="primary" @click="clearForm()" text>cancel</v-btn>
              <v-btn color="primary" type="submit" text>Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-dialog>
      <v-dialog v-model="dialogBarangayClearance" scrollable persistent max-width="800px">
        <v-card>
          <v-card-title>
            <span class="headline">Issue barangay clearance</span>
            <v-spacer></v-spacer>
            <form-print></form-print>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text style="color:black">
            <v-container grid-list-md text-xs-center class="pa-0" id="printForm">
              <v-layout row wrap>
                <v-flex xs3>
                  <img src="/img/baguio.png" alt="Logo" contain height="100">
                </v-flex>
                <v-flex xs6 class="green--text title">
                  <p class="mb-0">Barangay Camp Allen</p>
                  <p class="mb-0">Republic of the Philippines</p>
                  <p class="mb-0">Baguio City</p>
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
                  <p class="mb-0">{{ officials.length ? `${officials[0].name}` : 'Not registered'}}</p>
                  <p>Punong Barangay</p>
                  <p class="mb-0">{{ officials.length ? `${officials[1].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[2].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[3].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[4].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[5].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[6].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[7].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[8].name}` : 'Not registered'}}</p>
                  <p>Barangay Secretary</p>
                  <p class="mb-0">{{ officials.length ? `${officials[9].name}` : 'Not registered'}}</p>
                  <p>Barangay Treasurer</p>
                </v-flex>
                <v-flex xs8 text-xs-left class="pl-3">
                  <v-layout row wrap>
                    <v-flex>
                      <p>TO WHOM IT MAY CONCERN:</p>
                      <p>
                        This is to certify that
                        <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].first_name} ${selectedInhabitant[0].middle_name}. ${selectedInhabitant[0].last_name}` : '______________________________________________' }},</span>
                        <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].age}` : '________' }}</span> years old,
                        <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].citizenship}` : '________________________' }}</span> citizen, a native of
                        <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].placeOfBirth_native}` : '________________________' }}</span>, and presently residing at
                        <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].house_no} Purok ${selectedInhabitant[0].purok} ${selectedInhabitant[0].street}, ${address[0].name}, ${address[0].municipality}, ${address[0].province}` : '________________________________________________' }}</span>
                        and whose signature appears hereunder, has no pending adverse case and deragatory records filed
                        against per available records on file with this office as of the date of issuance thereof.
                      </p>
                    </v-flex>

                    <v-flex xs12>
                      <p>
                        Issued
                        <span
                          v-if="formBarangayClearance.purpose_of_clearance"
                        >{{formBarangayClearance.purpose_of_clearance}}</span>
                        <span v-else>________________________________________</span> purposes.
                      </p>
                    </v-flex>

                    <v-flex xs6>
                      <p class="mb-0">________________________</p>
                      <p class="mb-5">Signature over printed name</p>
                    </v-flex>

                    <v-flex xs12 class="mb-5">
                      <p class="mb-0">
                        Community tax certificate number:
                        <span
                          v-if="formBarangayClearance.ctc_no"
                        >{{formBarangayClearance.ctc_no}}</span>
                        <span v-else>____________</span>
                      </p>
                      <p class="mb-0">
                        Issued on:
                        <span
                          v-if="formBarangayClearance.created_at"
                        >{{formBarangayClearance.created_at}}</span>
                        <span v-else>____________</span>
                      </p>
                      <p class="mb-0">
                        Issued at:
                        <span>{{ selectedInhabitant.length ? `${address[0].name}, ${address[0].municipality}` : '____________' }}</span>
                      </p>
                      <p class="mb-0">
                        Official receipt number:
                        <span
                          v-if="formBarangayClearance.official_receipt_no"
                        >{{formBarangayClearance.official_receipt_no}}</span>
                        <span v-else>____________</span>
                      </p>
                    </v-flex>

                    <v-flex xs6 offset-xs6 class="text-xs-center">
                      <p>CERTIFIED AND ISSUED BY:</p>
                      <p
                        class="mb-0"
                      >{{ officials.length ? `${officials[0].name}` : 'Not registered'}}</p>
                      <p>Punong Barangay</p>
                    </v-flex>

                    <v-flex xs12>
                      <p>Note: Not valid without Barangay Seal</p>
                    </v-flex>
                  </v-layout>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" text @click="clearInput()">Done</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <!-- Barangay Certificate -->
      <v-dialog v-model="dialogBarangayCertificateForm" scrollable persistent max-width="800px">
        <v-form @submit.prevent="createBarangayCertificate">
          <v-card>
            <v-card-title>
              <span class="headline">Issue barangay certificate</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <v-container grid-list-md class="pa-0">
                <v-layout wrap>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-model="formBarangayCertificate.control_no"
                      label="Control number*"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-model="formBarangayCertificate.ctc_no"
                      label="Community tax certificate number*"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-model="formBarangayCertificate.official_receipt_no"
                      label="Official receipt number*"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md6>
                    <v-text-field
                      v-model="formBarangayCertificate.purpose_certification"
                      label="Purpose of certificate*"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md6>
                    <v-text-field
                      v-model="formBarangayCertificate.amount_paid"
                      label="Amount paid*"
                    ></v-text-field>
                  </v-flex>
                </v-layout>
              </v-container>
              <v-card outlined>
                <v-data-table
                  :headers="barangayCertificateHeaders"
                  :items="barangayCertificateIssued"
                  hide-default-footer
                >
                  <template v-slot:item.action="{ item }">
                    <v-btn icon @click="printBarangayCertificate(item)">
                      <v-icon>mdi-printer</v-icon>
                    </v-btn>
                  </template>
                </v-data-table>
              </v-card>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <p class="mb-0">* indicates required field</p>
              <v-spacer></v-spacer>
              <v-btn color="primary" @click="clearForm()" text>cancel</v-btn>
              <v-btn color="primary" type="submit" text>Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-dialog>
      <v-dialog v-model="dialogBarangayCertificate" scrollable persistent max-width="800px">
        <v-card>
          <v-card-title>
            <span class="headline">Issue barangay certificate</span>
            <v-spacer></v-spacer>
            <form-print></form-print>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text style="color:black">
            <v-container grid-list-md text-xs-center class="pa-0" id="printForm">
              <v-layout row wrap>
                <v-flex xs3>
                  <v-img src="/img/baguio.png" alt="Logo" contain height="100"></v-img>
                </v-flex>
                <v-flex xs6 class="green--text title">
                  <p class="mb-0">Barangay Camp Allen</p>
                  <p class="mb-0">Republic of the Philippines</p>
                  <p class="mb-0">Baguio City</p>
                </v-flex>
                <v-flex xs3>
                  <img :src="getLogo()" alt="Logo" contain height="100">
                </v-flex>
              </v-layout>
              <v-layout row wrap>
                <v-flex xs12 class="subtitle-1 font-weight-bold">
                  <p class="mb-0">Office of the Punong Barangay</p>
                  <p>Barangay Certification</p>
                </v-flex>
              </v-layout>
              <v-layout row wrap>
                <v-flex xs4 class="form-border-right">
                  <p class="mb-0">{{ officials.length ? `${officials[0].name}` : 'Not registered'}}</p>
                  <p>Punong Barangay</p>
                  <p class="mb-0">{{ officials.length ? `${officials[1].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[2].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[3].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[4].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[5].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[6].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[7].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[8].name}` : 'Not registered'}}</p>
                  <p>Barangay Secretary</p>
                  <p class="mb-0">{{ officials.length ? `${officials[9].name}` : 'Not registered'}}</p>
                  <p>Barangay Treasurer</p>
                </v-flex>
                <v-flex xs8 text-xs-left class="pl-3">
                  <v-layout row wrap>
                    <v-flex>
                      <p>TO WHOM IT MAY CONCERN:</p>
                      <p>
                        This is to certify that
                        <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].first_name} ${selectedInhabitant[0].middle_name}. ${selectedInhabitant[0].last_name}` : '______________________________________________' }},</span>
                        <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].age}` : '________' }}</span> years old,
                        <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].citizenship}` : '________________________' }}</span> citizen, is a resident of Barangay
                        <span>{{ selectedInhabitant.length ? `${address[0].name}` : '________________________' }}</span> with postal address at
                        <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].house_no} Purok ${selectedInhabitant[0].purok} ${selectedInhabitant[0].street}, ${address[0].name}, ${address[0].municipality}, ${address[0].province}` : '________________________________________________' }}</span>.
                      </p>
                    </v-flex>

                    <v-flex xs12>
                      <p>
                        Issued
                        <span
                          v-if="formBarangayCertificate.purpose_certification"
                        >{{formBarangayCertificate.purpose_certification}}</span>
                        <span v-else>________________________________________</span> purposes.
                      </p>
                    </v-flex>

                    <v-flex xs6>
                      <p class="mb-0">________________________</p>
                      <p class="mb-5">Signature over printed name</p>
                    </v-flex>

                    <v-flex xs12 class="mb-5">
                      <p class="mb-0">
                        Community tax certificate number:
                        <span
                          v-if="formBarangayCertificate.ctc_no"
                        >{{formBarangayCertificate.ctc_no}}</span>
                        <span v-else>____________</span>
                      </p>
                      <p class="mb-0">
                        Issued on:
                        <span
                          v-if="formBarangayCertificate.created_at"
                        >{{formBarangayCertificate.created_at}}</span>
                        <span v-else>____________</span>
                      </p>
                      <p class="mb-0">
                        Issued at:
                        <span>{{ selectedInhabitant.length ? `${address[0].name}, ${address[0].municipality}` : '____________' }}</span>
                      </p>
                      <p class="mb-0">
                        Official receipt number:
                        <span
                          v-if="formBarangayCertificate.official_receipt_no"
                        >{{formBarangayCertificate.official_receipt_no}}</span>
                        <span v-else>____________</span>
                      </p>
                    </v-flex>

                    <v-flex xs6 offset-xs6 class="text-xs-center">
                      <p>CERTIFIED AND ISSUED BY:</p>
                      <p
                        class="mb-0"
                      >{{ officials.length ? `${officials[0].name}` : 'Not registered'}}</p>
                      <p>Punong Barangay</p>
                    </v-flex>

                    <v-flex xs12>
                      <p>Note: Not valid without Barangay Seal</p>
                    </v-flex>
                  </v-layout>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" text @click="clearInput()">Done</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <!-- Business Clearance -->
      <v-dialog v-model="dialogBusinessClearanceForm" scrollable persistent max-width="800px">
        <v-form @submit.prevent="createBusinessClearance">
          <v-card>
            <v-card-title>
              <span class="headline">Issue barangay certificate</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <v-container grid-list-md class="pa-0">
                <v-layout wrap>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-model="formBusinessClearance.control_no"
                      label="Control number*"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-model="formBusinessClearance.ctc_no"
                      label="Community tax certificate number*"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-model="formBusinessClearance.official_receipt_no"
                      label="Official receipt number*"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-model="formBusinessClearance.business_address"
                      label="Business address*"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-model="formBusinessClearance.business_trade_name"
                      label="Business trade name*"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-select
                      v-model="formBusinessClearance.business_application"
                      :items="['New', 'Renewal']"
                      label="Business application*"
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-select
                      v-model="formBusinessClearance.kind_business"
                      label="Kind of business*"
                      :items="['Agriculture', 'Construction', 'Electricity/gas and water', 'Wholesale retail, and trade', 'Transport, storage communications', 'Community Social and personal services', 'Financing Insurance', 'Real States', 'Manufacturing', 'Mining']"
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-select
                      v-model="formBusinessClearance.line_of_business"
                      label="Line of business*"
                      :items="['Poultry/Livestock', 'Nurseries/Flower Growing', 'Breeding Stations', 'Fishponds/Fishpens', 'Vineyards/Mussel Farms', 'Orchards/Vineyards', 'Vegetable Farms', 'Supermarkets', 'Groceries/Dry Goods Stores', 'Sari-sari Stores', 'Banks and Financial/Lending Institutions', 'Auto Supply and Motorports', 'Distributors, Dealers of Various Products', 'Gasoline stations', 'Photo and Record Shops', 'Jewelry Stores', 'Pawnshops', 'General Services/Contractors', 'Beauty Parlors or Barber shops', 'Fitness Gyms', 'Restaurants', 'Insurance/Dealer in Securities', 'Furniture Shops', 'Livestock and Poultry Supplyes Stores', 'Hardware/Electric Supplies', 'Videoke Shops', 'Computer Shops/Internet Cafe', 'Buy and Sell Stations', 'Water Refilling Stations', 'Hotel/Inns', 'Apartment/Boarding House', 'Handicraft', 'Metalcraft', 'Garments', 'Ceramics', 'Food Processing', 'Mining and Quarrying', 'Factories', 'Rice/Corn/Flour/Saw Mills', 'Junkshops']"
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-model="formBusinessClearance.total_amt_paid"
                      label="Total amount paid*"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md6>
                    <v-select
                      v-model="formBusinessClearance.action_taken"
                      label="Action taken on application*"
                      :items="['Approval', 'Disapproval']"
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 sm6 md6>
                    <v-text-field
                      v-model="formBusinessClearance.reasons_approv_disapprove"
                      label="Reason for approval/disapproval*"
                    ></v-text-field>
                  </v-flex>
                </v-layout>
              </v-container>
              <v-card outlined>
                <v-data-table
                  :headers="businessClearanceHeaders"
                  :items="businessClearanceIssued"
                  hide-default-footer
                >
                  <template v-slot:item.action="{ item }">
                    <v-btn icon @click="printBusinessClearance(item)">
                      <v-icon>mdi-printer</v-icon>
                    </v-btn>
                  </template>
                </v-data-table>
              </v-card>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <p class="mb-0">* indicates required field</p>
              <v-spacer></v-spacer>
              <v-btn color="primary" @click="clearForm()" text>cancel</v-btn>
              <v-btn color="primary" type="submit" text>Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-dialog>
      <v-dialog v-model="dialogBusinessClearance" scrollable persistent max-width="800px">
        <v-card>
          <v-card-title>
            <span class="headline">Issue barangay certificate</span>
            <v-spacer></v-spacer>
            <div class="ml-1">
              <v-tooltip attach bottom>
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
                  <v-tooltip attach bottom>
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
                </v-list>
              </v-menu>
            </div>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text style="color:black">
            <v-container grid-list-md text-xs-center class="pa-0" id="printForm">
              <v-layout row wrap>
                <v-flex xs3>
                  <v-img src="/img/baguio.png" alt="Logo" contain height="100"></v-img>
                </v-flex>
                <v-flex xs6 class="green--text title">
                  <p class="mb-0">Barangay Camp Allen</p>
                  <p class="mb-0">Republic of the Philippines</p>
                  <p class="mb-0">Baguio City</p>
                </v-flex>
                <v-flex xs3>
                  <img :src="getLogo()" alt="Logo" contain height="100">
                </v-flex>
              </v-layout>
              <v-layout row wrap>
                <v-flex xs12 class="subtitle-1 font-weight-bold">
                  <p class="mb-0">Office of the Punong Barangay</p>
                  <p>Business Clearance</p>
                </v-flex>
              </v-layout>
              <v-layout row wrap>
                <v-flex xs4 class="form-border-right">
                  <p class="mb-0">{{ officials.length ? `${officials[0].name}` : 'Not registered'}}</p>
                  <p>Punong Barangay</p>
                  <p class="mb-0">{{ officials.length ? `${officials[1].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[2].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[3].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[4].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[5].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[6].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[7].name}` : 'Not registered'}}</p>
                  <p>Barangay Kagawad</p>
                  <p class="mb-0">{{ officials.length ? `${officials[8].name}` : 'Not registered'}}</p>
                  <p>Barangay Secretary</p>
                  <p class="mb-0">{{ officials.length ? `${officials[9].name}` : 'Not registered'}}</p>
                  <p>Barangay Treasurer</p>
                </v-flex>
                <v-flex xs8 text-xs-left class="pl-3">
                  <v-layout row wrap>
                    <v-flex>
                      <p>TO WHOM IT MAY CONCERN:</p>
                      <p>
                        This is to certify that
                        <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].first_name} ${selectedInhabitant[0].middle_name}. ${selectedInhabitant[0].last_name}` : '______________________________________________' }},</span>
                        a resident of
                        <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].house_no} Purok ${selectedInhabitant[0].purok} ${selectedInhabitant[0].street}, ${address[0].name}, ${address[0].municipality}, ${address[0].province}` : '________________________________________________' }}</span>
                        establishment at
                        <span
                          v-if="formBusinessClearance.business_address"
                        >{{formBusinessClearance.business_address}}</span>
                        is applying for
                        <span
                          v-if="formBusinessClearance.business_application"
                        >{{formBusinessClearance.business_application}}</span>
                        Business Permit for C.
                      </p>
                      <p>
                        The kind of business applied for is
                        <span
                          v-if="formBusinessClearance.kind_business"
                        >{{formBusinessClearance.kind_business}}</span>
                        under the trade name:
                        <span
                          v-if="formBusinessClearance.business_trade_name"
                        >{{formBusinessClearance.business_trade_name}}</span>
                      </p>
                      <p>
                        The line of business for is
                        <span
                          v-if="formBusinessClearance.line_of_business"
                        >{{formBusinessClearance.line_of_business}}</span>
                      </p>
                      <p>The undersigned recommends for Approval due to the following reasons</p>
                      <p>1. Complied all requirements and,</p>
                      <p>
                        2.
                        <span
                          v-if="formBusinessClearance.reasons_approv_disapprove"
                        >{{formBusinessClearance.reasons_approv_disapprove}}</span>
                      </p>
                    </v-flex>

                    <v-flex xs6>
                      <p class="mb-0">________________________</p>
                      <p class="mb-5">Signature over printed name</p>
                    </v-flex>

                    <v-flex xs12 class="mb-5">
                      <p class="mb-0">
                        Community tax certificate number:
                        <span
                          v-if="formBusinessClearance.ctc_no"
                        >{{formBusinessClearance.ctc_no}}</span>
                        <span v-else>____________</span>
                      </p>
                      <p class="mb-0">
                        Issued on:
                        <span
                          v-if="formBusinessClearance.created_at"
                        >{{formBusinessClearance.created_at}}</span>
                        <span v-else>____________</span>
                      </p>
                      <p class="mb-0">
                        Issued at:
                        <span>{{ selectedInhabitant.length ? `${address[0].name}, ${address[0].municipality}` : '____________' }}</span>
                      </p>
                      <p class="mb-0">
                        Official receipt number:
                        <span
                          v-if="formBusinessClearance.official_receipt_no"
                        >{{formBusinessClearance.official_receipt_no}}</span>
                        <span v-else>____________</span>
                      </p>
                    </v-flex>

                    <v-flex xs6 offset-xs6 class="text-xs-center">
                      <p>CERTIFIED AND ISSUED BY:</p>
                      <p
                        class="mb-0"
                      >{{ officials.length ? `${officials[0].name}` : 'Not registered'}}</p>
                      <p>Punong Barangay</p>
                    </v-flex>

                    <v-flex xs12>
                      <p>Note: Not valid without Barangay Seal</p>
                    </v-flex>
                  </v-layout>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" text @click="clearInput()">Done</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <!-- Filed Cases -->
      <v-dialog v-model="dialogFiledCasesForm" scrollable persistent max-width="800px">
        <v-form @submit.prevent="createFiledCases">
          <v-card>
            <v-card-title>
              <span class="headline">Issue filed cases</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <v-container grid-list-md class="pa-0">
                <v-layout wrap>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="formFiledCases.control_no" label="Control number*"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="formFiledCases.respondent" label="Respondent*"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-select
                      v-model="formFiledCases.case"
                      label="Case*"
                      :items="['Collecting sum of money', 'Estafa', 'Malicius Mischief', 'Physical Injury', 'Physical Injury with Robbery', 'Theft', 'Threat', 'Unjust Vexation', 'Murder', 'Rape', 'Children in Conflict of the law']"
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-select
                      v-model="formFiledCases.type_of_case"
                      label="Type of case*"
                      :items="['Criminal', 'Civil', 'Others']"
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="formFiledCases.complainant" label="Complainant*"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="formFiledCases.co_complainant" label="Co-complainant*"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-select
                      v-model="formFiledCases.action_taken_on_settled"
                      label="Action taken on settled*"
                      :items="['Arbitration', 'Conciliation', 'Mediation']"
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-select
                      v-model="formFiledCases.action_taken_on_unsettled"
                      label="Action taken on unsettled*"
                      :items="['Repudiation', 'Withdrawn', 'Pending case', 'Case dismissed', 'Case certified', 'Referred to concerned agencies']"
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="formFiledCases.remarks" label="Remarks*"></v-text-field>
                  </v-flex>
                </v-layout>
              </v-container>
              <v-card outlined>
                <v-data-table
                  :headers="filedCasesHeaders"
                  :items="filedCasesIssued"
                  hide-default-footer
                ></v-data-table>
              </v-card>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <p class="mb-0">* indicates required field</p>
              <v-spacer></v-spacer>
              <v-btn color="primary" @click="clearForm()" text>cancel</v-btn>
              <v-btn color="primary" type="submit" text>Save</v-btn>
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
import RecordsPrint from "./RecordsPrint.vue";
import FormsPrint from "./FormsPrint.vue";
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
    barangayClearanceHeaders: [
      { text: "Control no.", value: "control_no" },
      { text: "Community tax certificate no.", value: "ctc_no" },
      { text: "Purpose of clearance", value: "purpose_of_clearance" },
      { text: "Official receipt no.", value: "official_receipt_no" },
      { text: "Issued on", value: "created_at" },
      { text: "Actions", value: "action", sortable: false }
    ],
    barangayCertificateHeaders: [
      { text: "Control no.", value: "control_no" },
      { text: "Community tax certificate no.", value: "ctc_no" },
      { text: "Purpose of clearance", value: "purpose_certification" },
      { text: "Official receipt no.", value: "official_receipt_no" },
      { text: "Ammount paid", value: "amount_paid" },
      { text: "Issued on", value: "created_at" },
      { text: "Actions", value: "action", sortable: false }
    ],
    businessClearanceHeaders: [
      { text: "Control no.", value: "control_no" },
      { text: "Business address", value: "business_address" },
      { text: "Business trade name", value: "business_trade_name" },
      { text: "Community tax certificate no.", value: "ctc_no" },
      { text: "Official receipt no.", value: "official_receipt_no" },
      { text: "Issued on", value: "created_at" },
      { text: "Actions", value: "action", sortable: false }
    ],
    filedCasesHeaders: [
      { text: "Control no.", value: "control_no" },
      { text: "respondent", value: "respondent" },
      { text: "case", value: "case" },
      { text: "Complainant", value: "complainant" },
      { text: "Co_complainant", value: "co_complainant" },
      { text: "Issued on", value: "created_at" }
    ],
    selectedInhabitant: [],
    inhabitants: [],
    user: {},
    address: [],
    officials: [],
    dialogEditInhabitant: false,
    barangayClearanceIssued: [],
    dialogBarangayClearance: false,
    dialogBarangayClearanceForm: false,
    barangayCertificateIssued: [],
    dialogBarangayCertificate: false,
    dialogBarangayCertificateForm: false,
    businessClearanceIssued: [],
    dialogBusinessClearance: false,
    dialogBusinessClearanceForm: false,
    filedCasesIssued: [],
    dialogFiledCasesForm: false,
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
      disability: "",
      status_of_residency: "",
      schooling: "",
      Highest_educational_attainment: "",
      date_settled_in_barangay: "",
      specific_job_description: "",
      citizenship: "",
      gen_job_description: "",
      employment_status: "",
      ethnicGroup: "",
      dissability_others: "",
      job_category: "",
      placeOfBirth_native: "",
      registeredVoterOfTheBrgy: "",
      blood_type: "",
      childs_parent_guardian: "",
      weight: "",
      height: "",
      bcg: "",
      dpi1: "",
      dpi2: "",
      dpi3: "",
      opd1: "",
      opd2: "",
      opd3: "",
      measles: "",
      others1: "",
      others2: "",
      others3: "",
      date_measured_height_weight: "",
      date_measured_height_weight: "",
      received_vitaminA: "",
      dewormed: ""
    }),
    formBarangayClearance: new Form({
      control_no: "",
      ctc_no: "",
      purpose_of_clearance: "",
      official_receipt_no: "",
      created_at: "",
      inhabitant_id: ""
    }),
    formBarangayCertificate: new Form({
      control_no: "",
      purpose_certification: "",
      ctc_no: "",
      official_receipt_no: "",
      amount_paid: "",
      created_at: "",
      inhabitant_id: ""
    }),
    formBusinessClearance: new Form({
      control_no: "",
      business_address: "",
      business_trade_name: "",
      business_application: "",
      kind_business: "",
      line_of_business: "",
      action_taken: "",
      reasons_approv_disapprove: "",
      ctc_no: "",
      official_receipt_no: "",
      total_amt_paid: "",
      created_at: "",
      inhabitant_id: ""
    }),
    formFiledCases: new Form({
      control_no: "",
      respondent: "",
      case: "",
      type_of_case: "",
      complainant: "",
      co_complainant: "",
      action_taken_on_settled: "",
      action_taken_on_unsettled: "",
      remarks: "",
      created_at: "",
      inhabitant_id: ""
    }),

    formUser: new Form({
      logo: ""
    })
  }),

  created() {
    if (this.$gate.isUser()) {
      this.getInhabitants();
      this.getUser();
      this.getOfficials();
      this.getAddress();
    }
  },
  components: {
    "app-print": RecordsPrint,
    "form-print": FormsPrint
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
    getAddress() {
      axios.get("api/address").then(response => {
        this.address = response.data;
      });
    },
    getUser() {
      axios.get("api/user").then(({ data }) => this.formUser.fill(data));
    },
    getOfficials() {
      axios.get("api/officials").then(response => {
        this.officials = response.data;
      });
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

    showBarangayClearance(id) {
      axios.get("api/getBarangayClearance/" + id).then(response => {
        this.barangayClearanceIssued = response.data;
        this.dialogBarangayClearanceForm = true;
        this.formBarangayClearance.reset();
        this.formBarangayClearance.inhabitant_id = this.selectedInhabitant[0].id;
      });
    },

    createBarangayClearance() {
      this.formBarangayClearance
        .post("api/createBarangayClearance")
        .then(() => {
          toast.fire({
            type: "success",
            title: "Inhabitant has been issued clearance"
          });
          this.showBarangayClearance(this.selectedInhabitant[0].id);
        })
        .catch(() => {});
    },

    printBarangayClearance(item) {
      this.dialogBarangayClearance = true;
      this.formBarangayClearance.fill(item);
    },

    showBarangayCertificate(id) {
      axios.get("api/getBarangayCertificate/" + id).then(response => {
        this.barangayCertificateIssued = response.data;
        this.dialogBarangayCertificateForm = true;
        this.formBarangayCertificate.reset();
        this.formBarangayCertificate.inhabitant_id = this.selectedInhabitant[0].id;
      });
    },

    createBarangayCertificate() {
      this.formBarangayCertificate
        .post("api/createBarangayCertificate")
        .then(() => {
          toast.fire({
            type: "success",
            title: "Inhabitant has been issued certificate"
          });
          this.showBarangayCertificate(this.selectedInhabitant[0].id);
        })
        .catch(() => {});
    },

    printBarangayCertificate(item) {
      this.dialogBarangayCertificate = true;
      this.formBarangayCertificate.fill(item);
    },

    showBusinessClearance(id) {
      axios.get("api/getBusinessClearance/" + id).then(response => {
        this.businessClearanceIssued = response.data;
        this.dialogBusinessClearanceForm = true;
        this.formBusinessClearance.reset();
        this.formBusinessClearance.inhabitant_id = this.selectedInhabitant[0].id;
      });
    },

    createBusinessClearance() {
      this.formBusinessClearance
        .post("api/createBusinessClearance")
        .then(() => {
          toast.fire({
            type: "success",
            title: "Inhabitant has been issued busines clearance"
          });
          this.showBusinessClearance(this.selectedInhabitant[0].id);
        })
        .catch(() => {});
    },

    printBusinessClearance(item) {
      this.dialogBusinessClearance = true;
      this.formBusinessClearance.fill(item);
    },

    showFiledCases(id) {
      axios.get("api/getFiledCases/" + id).then(response => {
        this.filedCasesIssued = response.data;
        this.dialogFiledCasesForm = true;
        this.formFiledCases.reset();
        this.formFiledCases.inhabitant_id = this.selectedInhabitant[0].id;
      });
    },

    createFiledCases() {
      this.formFiledCases
        .post("api/createFiledCases")
        .then(() => {
          toast.fire({
            type: "success",
            title: "Inhabitant has been issued busines clearance"
          });
          this.showFiledCases(this.selectedInhabitant[0].id);
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
              toast.fire({
                type: "success",
                title: "Inhabitant has been archived."
              });
              this.getInhabitants();
              this.selectedInhabitant.splice([0]);
            });
          }
        });
    },
    editDialog(inhabitants) {
      this.dialogEditInhabitant = true;
      this.inhabitantForm.fill(inhabitants);
    },
    getLogo() {
      let logo =
        this.formUser.logo.length > 200
          ? this.formUser.logo
          : "img/profile/" + this.formUser.logo;
      return logo;
    },

    clearForm() {
      this.dialogBarangayClearanceForm = false;
      this.dialogBarangayCertificateForm = false;
      this.dialogBusinessClearanceForm = false;
      this.dialogFiledCasesForm = false;
    },

    clearInput() {
      this.dialogBarangayClearance = false;
      this.dialogBarangayCertificate = false;
      this.dialogBusinessClearance = false;
      this.formBarangayClearance.reset();
      this.formBarangayCertificate.reset();
      this.formBusinessClearance.reset();
    },

    showColumn(col) {
      return this.headers.find(h => h.value === col).selected;
    }
  }
};
</script>
<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title class="hidden-sm-and-down">
        <span>{{ selected.length ? `#${selected[0].house_no} Purok ${selected[0].purok} ${selected[0].street}, ${address[0].name}` : 'Households' }}</span>
      </v-toolbar-title>
      <v-spacer class="hidden-sm-and-down"></v-spacer>
      <span v-if="selected.length" class="hidden-sm-and-down">
        <v-tooltip attach bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon text @click="selected = []">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </template>
          <span>Clear selected</span>
        </v-tooltip>
      </span>

      <v-divider v-if="selected.length" inset vertical class="hidden-sm-and-down"></v-divider>

      <div>
        <v-tooltip attach bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon text @click="newHouseholdDialog()">
              <v-icon>mdi-home-plus</v-icon>
            </v-btn>
          </template>
          <span>Add new household</span>
        </v-tooltip>
      </div>

      <div v-if="selected.length">
        <v-tooltip attach bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="editHouseholdDialog(selected[0])">
              <v-icon>mdi-pencil</v-icon>
            </v-btn>
          </template>
          <span>Edit household</span>
        </v-tooltip>
      </div>

      <div v-if="selected.length">
        <v-tooltip attach bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="HouseholdarchiveDialog()">
              <v-icon>mdi-archive</v-icon>
            </v-btn>
          </template>
          <span>Archive household</span>
        </v-tooltip>
      </div>

      <v-divider v-if="selected.length" inset vertical></v-divider>

      <div v-if="selected.length">
        <v-tooltip attach bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="newInhabitantDialog()">
              <v-icon>mdi-account-plus</v-icon>
            </v-btn>
          </template>
          <span>Add new inhabitant</span>
        </v-tooltip>
      </div>

      <div v-if="selected.length">
        <v-tooltip attach bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="showInhabitants(selected[0].id)">
              <v-icon>mdi-account-network</v-icon>
            </v-btn>
          </template>
          <span>View inhabitants</span>
        </v-tooltip>
      </div>

      <v-divider inset vertical></v-divider>

      <app-print :TableTitle="Table" :PageOrientation="Orientation" class="hidden-sm-and-down"></app-print>
      <div>
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
      <v-divider inset vertical></v-divider>
      <div v-if="!selected.length">
        <v-btn text to="/inhabitants">View all inhabitants</v-btn>
      </div>
      <v-flex xs2 ml-1 class="hidden-sm-and-down">
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
      <v-form
        ref="householdForm"
        v-model="validhouseholdForm"
        lazy-validation
        @submit.prevent="editmode ? updateHousehold() : createHousehold()"
      >
        <v-card>
          <v-card-title>
            <span class="headline" v-show="!editmode">Add household</span>
            <span class="headline" v-show="editmode">Edit household information</span>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text>
            <v-container grid-list-md pa-0>
              <v-layout wrap>
                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.room_no"
                    label="Room number"
                    :rules="[ v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.house_no"
                    label="House number*"
                    :rules="[v => !!v || 'House Number is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.purok"
                    label="Purok*"
                    v-mask="'#####'"
                    :rules="[v => !!v || 'Purok is required']"
                    required
                    hint="Only numbers are allowed"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.street"
                    label="Street*"
                    :rules="[v => !!v || 'Street is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.telephone_no"
                    label="Telephone number"
                    v-mask="'###########'"
                    hint="Only numbers are allowed"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.dateOfSurvey"
                    prepend-icon="mdi-calendar"
                    label="Date of survey*"
                    v-mask="'####-##-##'"
                    hint="YYYY-MM-DD format"
                    :rules="[v => !!v || 'Date of survey is required']"
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-text-field
                    v-model="householdForm.placeOfOrigin"
                    label="Place of origin*"
                    :rules="[v => !!v || 'Place of origin is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-select
                    v-model="householdForm.ethnic_group"
                    :items="['N/A','Bicol','Bisaya','Boholano','Capizeno','Cuyunon','Ibaloi','Ilonggo','Ifugao','Ilocano','Ivatan','Kalinga','Kankana-ey','Kapangpangan','Maguindanao','Maranao','Masbateno','Pangasinan','Surigaoan','Tagalog','Tausog','Waray','Yakan','Zambagueno/Chavacano']"
                    label="Ethnic group*"
                    :rules="[v => !!v || 'Ethnic group is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md4>
                  <v-select
                    v-model="householdForm.dialects"
                    :items="['Bicolano','Bontoc','Cebuano','English','Ibaloi','Ibanag','Ifugao','Ilocano','Itneg','Kalinga','Kankana-ey','Pampangan','Pangasinan','Tagalog','Waray-waray','Panggalatok','Visaya','Kapangpangan']"
                    label="Dialects*"
                    :rules="[v => !!v || 'Dialects is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md4>
                  <v-select
                    v-model="householdForm.solo_parent"
                    :items="['No','Death of spouse','Imprisonment of spouse of at least 1 year','Mental/physical incapacity of spouse','Legal or de facto separation from spouse for at least 1 year','Abandonment of spouse for at least 1 year','Unmarried mother/father who preferred to keep the child instead of others carrying him/her','Any other person who solely provides parental care and support to a child provided he/she is duly licensed foster parent of DSWD','Any family member who assumes the responsibility as head of the family as a result of death, abandonment, absence for at least one year','Others']"
                    label="Solo parent*"
                    :rules="[v => !!v || 'Solo parent is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md4 v-if="householdForm.solo_parent === 'Others'">
                  <v-text-field
                    v-model="householdForm.solo_parent_others"
                    label="Solo parent others"
                    :rules="[v => (v || '').indexOf('  ') < 0 ||'No multiple spaces are allowed']"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-select
                    v-model="householdForm.status_of_ownership_house"
                    :items="['Owned','Rented','Caretaker','Others']"
                    label="Status of ownership-house*"
                    :rules="[v => !!v || 'Status of ownership-house is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md4 v-if="householdForm.status_of_ownership_house === 'Others'">
                  <v-text-field
                    v-model="householdForm.status_of_ownership_house_others"
                    label="Status of ownership-house others"
                    :rules="[v => (v || '').indexOf('  ') < 0 ||'No multiple spaces are allowed']"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-select
                    v-model="householdForm.status_of_ownership_lot"
                    :items="['Owned','Rented','Caretaker','Others']"
                    label="Status of ownership-lot*"
                    :rules="[v => !!v || 'Status of ownership-lot is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md4 v-if="householdForm.status_of_ownership_lot === 'Others'">
                  <v-text-field
                    v-model="householdForm.status_of_ownership_lot_others"
                    label="Status of ownership-lot others"
                    :rules="[v => (v || '').indexOf('  ') < 0 ||'No multiple spaces are allowed']"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-select
                    v-model="householdForm.type_of_dwelling_structure"
                    :items="['Permanent Concrete','Semi Permanent','Temporary']"
                    label="Type of dwelling structure*"
                    :rules="[v => !!v || 'Type of dwelling structure is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md4>
                  <v-select
                    v-model="householdForm.type_of_dwelling"
                    :items="['Permanent Concrete','Semi Permanent','Temporary']"
                    label="Type of dwelling*"
                    :rules="[v => !!v || 'Type of dwelling is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md4>
                  <v-select
                    v-model="householdForm.lighting_source"
                    :items="['Electricity','Solar','Petromax','Kerosene']"
                    label="Lighting source*"
                    :rules="[v => !!v || 'Lighting source is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md4>
                  <v-select
                    v-model="householdForm.sources_of_info"
                    :items="['Television','Radio','Newspaper','Others']"
                    label="Sources of info*"
                    :rules="[v => !!v || 'Sources of info is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md4 v-if="householdForm.sources_of_info === 'Others'">
                  <v-text-field
                    v-model="householdForm.sources_of_info_others"
                    label="Sources of info others"
                    :rules="[v => (v || '').indexOf('  ') < 0 ||'No multiple spaces are allowed']"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-select
                    v-model="householdForm.communication_services"
                    :items="['Cell sites/Net','Internet','Telephone','Postal services','Others']"
                    label="Communication services*"
                    :rules="[v => !!v || 'Communication services is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md4 v-if="householdForm.communication_services === 'Others'">
                  <v-text-field
                    v-model="householdForm.communication_services_others"
                    label="Communication services others"
                    :rules="[v => (v || '').indexOf('  ') < 0 ||'No multiple spaces are allowed']"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md4>
                  <v-select
                    v-model="householdForm.means_of_transportation"
                    :items="['PU jeep',' Taxi','Tricycle','PU bus','Private car','Others']"
                    label="Means of transportation*"
                    :rules="[v => !!v || 'Means of transportation is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md4 v-if="householdForm.means_of_transportation === 'Others'">
                  <v-text-field
                    v-model="householdForm.means_of_transportation_others"
                    label="Means of transportation others"
                    :rules="[v => (v || '').indexOf('  ') < 0 ||'No multiple spaces are allowed']"
                  ></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <p class="mb-0">* indicates required field</p>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="cancelHousehold()">Cancel</v-btn>
            <v-btn color="blue darken-1" :disabled="!validhouseholdForm" text type="submit">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>

    <v-dialog v-model="dialogCreateInhabitant" persistent scrollable max-width="800px">
      <v-form
        ref="inhabitantForm"
        v-model="validinhabitantForm"
        lazy-validation
        @submit.prevent="editModeInhabitant ? updateInhabitant() : createInhabitant()"
      >
        <v-card>
          <v-card-title>
            <span class="headline" v-show="!editModeInhabitant">Add inhabitant</span>
            <span class="headline" v-show="editModeInhabitant">Edit inhabitant</span>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text>
            <v-container grid-list-md pa-0>
              <v-layout wrap>
                <v-flex xs12 md4>
                  <v-text-field
                    v-model="inhabitantForm.first_name"
                    label="First name*"
                    :rules="[v => !!v || 'First name is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 md4>
                  <v-text-field
                    v-model="inhabitantForm.middle_name"
                    label="Middle name"
                    :rules="[v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 md4>
                  <v-text-field
                    v-model="inhabitantForm.last_name"
                    label="Last name*"
                    :rules="[v => !!v || 'Last name is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 md6>
                  <v-select
                    v-model="inhabitantForm.relation_to_the_head"
                    :items="['The Head','Aunt','Uncle','Brother-in-law','Brother','Daughter-in-law','Daughter','Son','Son-in-law','Sister','Sister-in-law','Father','Mother','Grandfather','Grandmother','Husband','Wife','Tenant','Househelper','Common law wife']"
                    label="Relation to THE HEAD*"
                    :rules="[v => !!v || 'Relation to THE HEAD is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md6>
                  <v-select
                    v-model="inhabitantForm.sex"
                    :items="['Male','Female']"
                    label="Sex*"
                    :rules="[v => !!v || 'Sex is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md6>
                  <v-text-field
                    v-model="inhabitantForm.date_of_birth"
                    prepend-icon="mdi-calendar"
                    label="Date of birth*"
                    v-mask="'####-##-##'"
                    hint="YYYY-MM-DD format"
                    :rules="[v => !!v || 'Date of birth is required']"
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md6>
                  <v-text-field
                    v-model="inhabitantForm.placeOfBirth_native"
                    label="Place of birth*"
                    :rules="[v => !!v || 'Place of birth is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 md6>
                  <v-autocomplete
                    v-model="inhabitantForm.citizenship"
                    :items="['Afghan','Albanian','Algerian','American','Andorran','Angolan', 'Antiguan', 'Argentine', 'Armenian', 'Aruban', 'Australian', 'Austrian', 'Azerbaijani', 'Bahamian', 'Bahrainis', 'Bangladeshis', 'Barbadian', 'Basque', 'Belarusian', 'Belgian', 'Belizean', 'Beninese', 'Bermudian', 'Bhutanese', 'Bolivian', 'Bosniak', 'Bosnian', 'Botswana', 'Brazilian', 'Breton', 'British', 'British Virgin Islander', 'Bruneian', 'Bulgarian', 'Macedonian Bulgarian', 'Burkinabé', 'Burmese', 'Burundian', 'Cambodian', 'Cameroonian', 'Canadian', 'Catalan', 'Cape Verdean', 'Chadian', 'Chilean', 'Chinese', 'Colombian', 'Comorian', 'Congolese', 'Costa Rican', 'Croatian', 'Cuban', 'Cypriot', 'Czech', 'Dane', 'Greenlander', 'Djiboutian', 'Dominican', 'Dutch', 'East Timorese', 'Ecuadorian', 'Egyptian', 'Emirati', 'English', 'Equatoguinean', 'Eritrean', 'Estonian', 'Ethiopian', 'Falkland Islander', 'Faroese', 'Fijian', 'Finn', 'Finnish Swedish', 'Filipino', 'French citizen', 'Gabonese', 'Gambian', 'Georgian', 'German', 'Baltic German', 'Ghanaian', 'Gibraltarian', 'Greek', 'Greek Macedonian', 'Grenadian', 'Guatemalan', 'Guianese', 'Guinean', 'Guinea-Bissau national', 'Guyanese', 'Haitian', 'Honduran', 'Hong Konger', 'Hungarian', 'Icelander', 'I-Kiribati', 'Indian', 'Indonesian', 'Iranian', 'Iraqis', 'Irish', 'Israelis', 'Italian', 'Ivoirian', 'Jamaican', 'Japanese', 'Jordanian', 'Kazakh', 'Kenyan', 'Korean', 'Kosovar', 'Kuwaitis', 'Kyrgyz', 'Lao', 'Latvian', 'Lebanese', 'Liberian', 'Libyan', 'Liechtensteiner', 'Lithuanian', 'Luxembourger', 'Macao', 'Macedonian', 'Malagasy', 'Malawian', 'Malaysian', 'Maldivian', 'Malians', 'Maltese', 'Manx', 'Marshallese', 'Mauritanian', 'Mauritian', 'Mexicans', 'Micronesian', 'Moldovans', 'Monégasque', 'Mongolian', 'Montenegrin', 'Moroccan', 'Mozambican', 'Namibian', 'Nauran', 'Nepalese', 'New Zealander', 'Nicaraguan', 'Nigerien', 'Nigerian', 'Norwegian', 'Omani', 'Pakistanis', 'Palauan', 'Palestinian', 'Panamanian', 'Papua New Guinean', 'Paraguayan', 'Peruvian', 'Poles', 'Portuguese', 'Puerto Rican', 'Qatari', 'Quebecer', 'Réunionnais', 'Romanian', 'Russian', 'Baltic Russian', 'Rwandan', 'Saint Kitt', 'Saint Lucian', 'Salvadoran', 'Sammarinese', 'Samoans', 'São Tomé and Príncipe', 'Saudis', 'Scot', 'Senegalese', 'Serbs', 'Seychellois', 'Sierra Leonean', 'Singaporean', 'Slovak', 'Slovene', 'Solomon Islander', 'Somalis', 'Somalilander', 'Sotho', 'South African', 'Spaniard', 'Sri Lankan', 'Sudanese', 'Surinamese', 'Swazi', 'Swedes', 'Swiss', 'Syriac', 'Syrian', 'Taiwanese', 'Tamil', 'Tajik', 'Tanzanian', 'Thai', 'Tibetan', 'Tobagonian', 'Togolese', 'Tongan', 'Trinidadian', 'Tunisian', 'Turk', 'Tuvaluan', 'Ugandan', 'Ukrainian', 'Uruguayan', 'Uzbek', 'Vanuatuan', 'Venezuelan', 'Vietnamese', 'Vincentian', 'Welsh', 'Yemenis', 'Zambian', 'Zimbabwean']"
                    label="Citizenship*"
                    :rules="[v => !!v || 'Citizenship is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-autocomplete>
                </v-flex>
                <v-flex xs12 md6>
                  <v-select
                    v-model="inhabitantForm.civil_status"
                    :items="['Single', 'Married', 'Widow/er', 'Separated', 'Common-law', 'Complicated']"
                    label="Civil status*"
                    :rules="[v => !!v || 'Civil status is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md6>
                  <v-select
                    v-model="inhabitantForm.religion"
                    :items="['None','Aglipayan','Anglican','Apostolic Christian','Assembly of God','Baptist','Church of Christ','Born Again Christian','Iglesia ni Cristo','Islam','Saksi ni Jehovah','Seventh Day Adventist','Methodist','Mormons','Pentecost','Protestant','Roman Catholic']"
                    label="Religion*"
                    :rules="[v => !!v || 'Religion is required']"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 md6>
                  <v-select
                    v-model="inhabitantForm.status_of_residency"
                    :items="['Permanent', 'Live-in relative', 'Boarder', 'Buss resident', 'Moved out', 'Deceased']"
                    label="Status of residency*"
                    :rules="[v => !!v || 'Status of residency is required']"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 md6>
                  <v-select
                    v-model="inhabitantForm.schooling"
                    :items="['N/A', 'In School', 'Out of School', 'Not yet in school', 'Graduate']"
                    label="Schooling*"
                    :rules="[v => !!v || 'Schooling is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md6>
                  <v-select
                    v-model="inhabitantForm.Highest_educational_attainment"
                    :items="['Not yet attending school', 'Pre-school', 'Elementary Graduate','Elementary','High school undergraduate','High school','College undergraduate','College graduate','Vocational','Post Graduate']"
                    label="Highest educational attainment*"
                    :rules="[v => !!v || 'Highest educational attainment is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md6>
                  <v-text-field
                    v-model="inhabitantForm.date_settled_in_barangay"
                    prepend-icon="mdi-calendar"
                    label="Date settled in the barangay*"
                    v-mask="'####-##-##'"
                    hint="YYYY-MM-DD format"
                    :rules="[v => !!v || 'Date settled in the barangay is required']"
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md6>
                  <v-select
                    v-model="inhabitantForm.ethnicGroup"
                    :items="['Bago', 'Bicol', 'Bisaya', 'Boholano', 'Bontoc', 'Capizeno', 'Cuyunon', 'Ibaloi', 'Ilonggo', 'Ifugao', 'Ilocano', 'Ivatan', 'Kalinga', 'Kankana-ey', 'Kapangpangan', 'Maguindanao', 'Maranao', 'Masbateno', 'Pangasinan', 'Surigaoan', 'Tagalog', 'Tausog', 'Waray', 'Yakan', 'Zamboagueno/Chavacano']"
                    label="Ethnic group*"
                    :rules="[v => !!v || 'Ethnic group is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md6>
                  <v-select
                    v-model="inhabitantForm.registeredVoterOfTheBrgy"
                    :items="['Yes','No']"
                    label="Registered voter*"
                    :rules="[v => !!v || 'Registered voter is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md6>
                  <v-select
                    v-model="inhabitantForm.blood_type"
                    :items="['A', 'B', 'AB', 'O', 'Do not know']"
                    label="Blood type*"
                    :rules="[v => !!v || 'Blood type is required']"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 md6>
                  <v-text-field
                    v-model="inhabitantForm.Total_family_income"
                    label="Total family income"
                    prefix="₱"
                    v-mask="'###############'"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 md6>
                  <v-text-field
                    v-model="inhabitantForm.Final_family_income"
                    label="Final family income"
                    prefix="₱"
                    v-mask="'###############'"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 md6>
                  <v-select
                    v-model="inhabitantForm.disability"
                    :items="['None', 'Total blindness of one eye', 'Total blindness of both eye', 'Missing one or both arms', 'Mongoloid', 'Cleff Palate', 'Malabo ang paningin/poor eyesight', 'Hunchback', 'Paralyzed legs', 'Paralyzed arms', 'Speech disorder', 'Authistic', 'Fractured Vertebrate column', 'Paralyzed from neck down', 'Hydrocephalus',
                'Deaf', 'Mute and Deaf', 'Inability to walk alone', 'Deformity', 'Polio', 'Mental Impairment', 'Celebral Palsy', 'Epileptic', 'Dwarfism', 'Others']"
                    label="Disability*"
                    :rules="[v => !!v || 'Disability is required']"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 md6>
                  <v-text-field
                    v-if="inhabitantForm.disability === 'Others'"
                    v-model="inhabitantForm.dissability_others"
                    label="Disability others"
                    :rules="[v => (v || '').indexOf('  ') < 0 ||'No multiple spaces are allowed']"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 md6>
                  <v-checkbox v-model="vaccine" label="For ages 0-6 years old">Toggle</v-checkbox>
                </v-flex>

                <v-layout row wrap v-if="vaccine">
                  <v-flex xs4>
                    <v-autocomplete
                      v-model="inhabitantForm.childs_parent_guardian"
                      label="Child's Parent/Guardian"
                      :items="inhabitantsList"
                      :filter="customFilter"
                      item-text="first_name"
                    ></v-autocomplete>
                  </v-flex>
                  <v-flex xs4>
                    <v-select
                      v-model="inhabitantForm.dewormed"
                      label="Dewormed?"
                      :items="['Yes', 'No']"
                    ></v-select>
                  </v-flex>
                  <v-flex xs4>
                    <v-select
                      v-model="inhabitantForm.received_vitaminA"
                      label="Recieved Vitamin A?"
                      :items="['Yes', 'No']"
                    ></v-select>
                  </v-flex>

                  <v-flex xs3>
                    <v-text-field
                      v-model="inhabitantForm.weight"
                      label="Weight"
                      v-mask="'#####'"
                      suffix="kg"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs3>
                    <v-text-field
                      v-model="inhabitantForm.height"
                      label="Height"
                      v-mask="'#####'"
                      suffix="cm"
                    ></v-text-field>
                  </v-flex>

                  <v-flex xs12 md6>
                    <v-text-field
                      v-model="inhabitantForm.date_measured_height_weight"
                      prepend-icon="mdi-calendar"
                      label="Date measured height and weight"
                      v-mask="'####-##-##'"
                    hint="YYYY-MM-DD format"
                    ></v-text-field>
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
                    <v-select v-model="inhabitantForm.measles" label="measles" :items="['y', 'n']"></v-select>
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

                <v-flex xs12 md6>
                  <v-checkbox v-model="employed" label="For employed inhabitant">Toggle</v-checkbox>
                </v-flex>

                <v-layout wrap v-if="employed">
                  <v-flex xs12 md6>
                    <v-select
                      v-model="inhabitantForm.gen_job_description"
                      :items="[ 'N/A','Accountant','Architect','Barangay Official','Businessman','Doctor','Engineer','Fireman','Government office worker','IT Worker','Lawyer','Librarian','Manager/Supervisor','Missionary','Nurse','OFW','Pharmacist','Policemen','Priest','Professor/Instructor','Preacher/Pastor','Researcher','Soldier','Seafarer','Teacher','Therapist','Call center agent','Caregiver','Carpenter','Caretaker','Cashier/clerk','Construction worker','Cosmetologist/Beautician','Dispatcher/Barker','Driver','Electrician','Factory Worker','Farmer/Gardener','Helper/Aide','Laborer','Laundrywoman','Machinist','Mechanic','Mason','Mine Worker','Porter','Plumber','Salesperson','Security Guard','Secretary','Service Crew','Student Assistance','Tailor/Sewer/Dressmaker','Technician','Vendor','Volunteer Woker','Welder']"
                      label="General Job Description"
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 md6>
                    <v-text-field
                      v-model="inhabitantForm.specific_job_description"
                      label="Specific Job Description"
                      :rules="[v => (v || '').indexOf('  ') < 0 ||'No multiple spaces are allowed']"
                    ></v-text-field>
                  </v-flex>

                  <v-flex xs12 md6>
                    <v-select
                      v-model="inhabitantForm.employment_status"
                      :items="['Permanent', 'Contractual', 'Temporary', 'Self-employed', 'Retired', 'Unknown']"
                      label="Employment Status"
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 md6>
                    <v-select
                      v-model="inhabitantForm.job_category"
                      :items="['N/A','Offical Government and Special Interest','Professional','Technicians and Assoc. Professional','Clerks','Service Workers & Market sales workers','Farmers & Forestry Workers','Trades & related workers','Machine Operators/Assemblers','Laborers & skilled workers','Special Occupations']"
                      label="Job Category"
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 md6>
                    <v-text-field
                      v-model="inhabitantForm.estimated_monthly_income_cash"
                      label="Estimated monthly income-cash"
                      :rules="[v => (v || '').indexOf('  ') < 0 ||'No multiple spaces are allowed']"
                      prefix="₱"
                      v-mask="'###############'"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 md6>
                    <v-text-field
                      v-model="inhabitantForm.estimated_monthly_income_kind"
                      label="Estimated Monthly Income-kind"
                      :rules="[v => (v || '').indexOf('  ') < 0 ||'No multiple spaces are allowed']"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 md6>
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
            <p class="mb-0">* indicates required field</p>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="cancelInhabitant">Cancel</v-btn>
            <v-btn color="blue darken-1" :disabled="!validinhabitantForm" text type="submit">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>


    <v-dialog v-model="dialogArchive" persistent scrollable max-width="400px">
        <v-form 
        ref="archiveForm"
        @submit.prevent="archivehouse ? archiveHousehold(selected[0].id) : archiveInhabitant(selectedInhabitant[0].id)">
          <v-card min-width="400px">
            <v-card-title>
              <span class="headline">Remarks</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex>
                    <v-text-field v-model="archiveForm.remarks"></v-text-field>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="dialogArchive=false">Cancel</v-btn>
              <v-btn color="blue darken-1" text type="submit">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-dialog>

    <v-dialog v-model="dialogInhabitants" persistent scrollable max-width="800px">
      <v-card>
        <v-card-title>
          <span>{{ selectedInhabitant.length ? `${selectedInhabitant[0].first_name} ${selectedInhabitant[0].middle_name} ${selectedInhabitant[0].last_name}` : 'Inhabitants' }}</span>
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
          <div v-if="selected.length" class="ml-1">
            <v-tooltip attach bottom>
              <template v-slot:activator="{ on }">
                <v-btn v-on="on" icon @click="newInhabitantDialog()">
                  <v-icon>mdi-account-plus</v-icon>
                </v-btn>
              </template>
              <span>Add new inhabitant</span>
            </v-tooltip>
          </div>
          <div v-if="selectedInhabitant.length" class="ml-1">
            <v-tooltip attach bottom>
              <template v-slot:activator="{ on }">
                <v-btn v-on="on" icon @click="editInhabitantDialog(selectedInhabitant[0])">
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
              </template>
              <span>Edit inhabitant</span>
            </v-tooltip>
          </div>
          <div v-if="selectedInhabitant.length" class="ml-1">
            <v-tooltip attach bottom>
              <template v-slot:activator="{ on }">
                <v-btn v-on="on" icon @click="InhabitantarchiveDialog()">
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
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="done">close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-data-table
      id="printTable"
      v-model="selected"
      v-bind:headers="filteredHeaders"
      :items="households"
      :search="search"
      :loading="loadingHouseholds"
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
import RecordsPrint from "./RecordsPrint.vue";
export default {
  data() {
    return {
      Table: "Households",
      Orientation: "landscape",
      households: [],
      inhabitants: [],
      address: [],
      dialogArchive: false,
      dialogHousehold: false,
      dialogCreateInhabitant: false,
      dialogInhabitants: false,
      inhabitantsList: [],
      archivehouse: true,
      editmode: false,
      editModeInhabitant: false,
      selected: [],
      selectedInhabitant: [],
      calendarSurvey: false,
      search: "",
      vaccine: false,
      employed: false,
      menuSettled: false,
      menuHeight: false,
      validhouseholdForm: true,
      validinhabitantForm: true,
      archiveForm: new Form({
        remarks: ""
      }),
      householdForm: new Form({
        id: "",
        solo_parent: "",
        solo_parent_others: "",
        dateOfSurvey: "",
        familysize: "",
        room_no: "",
        house_no: "",
        purok: "",
        street: "",
        type_of_dwelling_structure: "",
        placeOfOrigin: "",
        ethnic_group: "",
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
        { text: "Place of Origin", value: "placeOfOrigin" },
        { text: "Mobile Number", value: "mobile_no" },
        { text: "Ethnic Group", value: "ethnic_group" },
        { text: "Telephone No.", value: "telephone_no" },
        { text: "Solo parent", value: "solo_parent" },
        { text: "Solo parent others", value: "solo_parent_others" },
        { text: "DateOfSurvey", value: "dateOfSurvey" },
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

  components: {
    "app-print": RecordsPrint
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
      this.loadingHouseholds = true;
      axios.get("api/household").then(response => {
        this.households = response.data;
        this.loadingHouseholds = false;
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

    fillInhabitants(id) {
      axios.get("api/household/" + id).then(response => {
        this.inhabitantsList = response.data;
      });
    },

    createHousehold() {
      if (this.$refs.householdForm.validate()) {
        this.householdForm
          .post("api/household")
          .then(() => {
            this.dialogHousehold = false;
            this.getHouseholds();
            this.$refs.householdForm.reset();
            this.householdForm.reset();
            toast.fire({
              type: "success",
              title: "Household has been created"
            });
          })
          .catch(() => {});
      }
    },

    createInhabitant(id) {
      if (this.$refs.inhabitantForm.validate()) {
        this.inhabitantForm
          .post("api/inhabitant")
          .then(() => {
            this.dialogCreateInhabitant = false;
            this.getHouseholds();
            this.fillInhabitants(this.selected[0].id);
            this.$refs.inhabitantForm.reset();
            this.inhabitantForm.reset();
            toast.fire({
              type: "success",
              title: "Inhabitant has been created"
            });
          })
          .catch(() => {});
      }
    },

    updateInhabitant() {
      this.inhabitantForm
        .put("api/inhabitant/" + this.inhabitantForm.id)
        .then(() => {
          this.dialogCreateInhabitant = false;
          this.getHouseholds();
          this.$refs.inhabitantForm.reset();
          this.inhabitantForm.reset();
          this.fillInhabitants(this.selected[0].id);
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
          this.$refs.householdForm.reset();
          this.householdForm.reset();
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
          text: "This inhabitant will be archived!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, archive it!"
        })
        .then(result => {
          if (result.value) {
            this.archiveForm.post("api/inhabitants/archived/" + id).then(response => {
              toast.fire({
                type: "success",
                title: "Inhabitant has been archived."
              });
              this.dialogArchive=false;
              this.getHouseholds();
              this.showInhabitants(this.selected[0].id);
              this.selectedInhabitant.splice([0]);
            });
          }
        });
    },

    archiveHousehold(id) {
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
            this.archiveForm.post("api/households/archived/" + id).then(response => {
              toast.fire({
                type: "success",
                title: "Household has been archived."
              });
              this.dialogArchive=false;
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
      this.fillInhabitants(this.selected[0].id);
      this.dialogCreateInhabitant = true;
    },

    InhabitantarchiveDialog() {
      this.archivehouse = false;
      this.archiveForm.reset();
      this.dialogArchive = true;
    },

    editInhabitantDialog(inhabitantsList) {
      this.editModeInhabitant = true;
      this.inhabitantForm.reset();
      this.dialogCreateInhabitant = true;
      this.inhabitantForm.fill(inhabitantsList);
    },

    newHouseholdDialog() {
      this.editmode = false;
      this.householdForm.reset();
      this.dialogHousehold = true;
    },

    HouseholdarchiveDialog() {
      this.archivehouse = true;
      this.archiveForm.reset();
      this.dialogArchive = true;
    },

    editHouseholdDialog(households) {
      this.editmode = true;
      this.householdForm.reset();
      this.dialogHousehold = true;
      this.householdForm.fill(households);
    },

    cancelInhabitant() {
      this.$refs.inhabitantForm.reset();
      this.inhabitantForm.reset();
      this.dialogCreateInhabitant = false;
    },

    cancelHousehold() {
      this.$refs.householdForm.reset();
      this.householdForm.reset();
      this.dialogHousehold = false;
    },
    done() {
      this.inhabitantsList = [];
      this.dialogInhabitants = false;
    },

    customFilter(item, queryText, itemText) {
      const textOne = item.first_name.toLowerCase();
      const textTwo = item.last_name.toLowerCase();
      const searchText = queryText.toLowerCase();
      return (
        textOne.indexOf(searchText) > -1 || textTwo.indexOf(searchText) > -1
      );
    },
    showColumn(col) {
      return this.headersHouseholds.find(h => h.value === col).selected;
    }
  }
};
</script>
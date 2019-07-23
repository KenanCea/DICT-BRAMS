<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span class="hidden-sm-and-down">Barangay Clearance</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn depressed color="primary" @click="createBarangayClearanceDialog">
        Fill-up form
        <v-icon right dark>mdi-file-document-edit</v-icon>
      </v-btn>
    </v-app-bar>

    <v-dialog v-model="dialogBarangayClearanceForm" scrollable persistent max-width="800px">
      <v-form
        ref="form"
        v-model="validForm"
        lazy-validation
        @submit.prevent="createBarangayClearance"
      >
        <v-card>
          <v-card-title>
            <span class="headline">Issue barangay clearance</span>
          </v-card-title>

          <v-spacer></v-spacer>

          <v-divider></v-divider>
          <v-card-text>
            <v-container grid-list-md class="pa-0">
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayClearance.first_name"
                    label="First name*"
                    :rules="[v => !!v || 'First name is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayClearance.middle_name"
                    label="Middle name"
                    :rules="[v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayClearance.last_name"
                    label="Last name*"
                    :rules="[v => !!v || 'Last name is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayClearance.date_of_birth"
                    label="Date of birth*"
                    v-mask="'####-##-##'"
                    hint="YYYY-MM-DD format"
                    :rules="[v => !!v || 'Date of birth is required']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="formBarangayClearance.sex"
                    :items="['Male','Female']"
                    label="Sex*"
                    :rules="[v => !!v || 'Sex is required']"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-autocomplete
                    v-model="formBarangayClearance.citizenship"
                    :items="['Afghan','Albanian','Algerian','American','Andorran','Angolan', 'Antiguan', 'Argentine', 'Armenian', 'Aruban', 'Australian', 'Austrian', 'Azerbaijani', 'Bahamian', 'Bahrainis', 'Bangladeshis', 'Barbadian', 'Basque', 'Belarusian', 'Belgian', 'Belizean', 'Beninese', 'Bermudian', 'Bhutanese', 'Bolivian', 'Bosniak', 'Bosnian', 'Botswana', 'Brazilian', 'Breton', 'British', 'British Virgin Islander', 'Bruneian', 'Bulgarian', 'Macedonian Bulgarian', 'Burkinabé', 'Burmese', 'Burundian', 'Cambodian', 'Cameroonian', 'Canadian', 'Catalan', 'Cape Verdean', 'Chadian', 'Chilean', 'Chinese', 'Colombian', 'Comorian', 'Congolese', 'Costa Rican', 'Croatian', 'Cuban', 'Cypriot', 'Czech', 'Dane', 'Greenlander', 'Djiboutian', 'Dominican', 'Dutch', 'East Timorese', 'Ecuadorian', 'Egyptian', 'Emirati', 'English', 'Equatoguinean', 'Eritrean', 'Estonian', 'Ethiopian', 'Falkland Islander', 'Faroese', 'Fijian', 'Finn', 'Finnish Swedish', 'Filipino', 'French citizen', 'Gabonese', 'Gambian', 'Georgian', 'German', 'Baltic German', 'Ghanaian', 'Gibraltarian', 'Greek', 'Greek Macedonian', 'Grenadian', 'Guatemalan', 'Guianese', 'Guinean', 'Guinea-Bissau national', 'Guyanese', 'Haitian', 'Honduran', 'Hong Konger', 'Hungarian', 'Icelander', 'I-Kiribati', 'Indian', 'Indonesian', 'Iranian', 'Iraqis', 'Irish', 'Israelis', 'Italian', 'Ivoirian', 'Jamaican', 'Japanese', 'Jordanian', 'Kazakh', 'Kenyan', 'Korean', 'Kosovar', 'Kuwaitis', 'Kyrgyz', 'Lao', 'Latvian', 'Lebanese', 'Liberian', 'Libyan', 'Liechtensteiner', 'Lithuanian', 'Luxembourger', 'Macao', 'Macedonian', 'Malagasy', 'Malawian', 'Malaysian', 'Maldivian', 'Malians', 'Maltese', 'Manx', 'Marshallese', 'Mauritanian', 'Mauritian', 'Mexicans', 'Micronesian', 'Moldovans', 'Monégasque', 'Mongolian', 'Montenegrin', 'Moroccan', 'Mozambican', 'Namibian', 'Nauran', 'Nepalese', 'New Zealander', 'Nicaraguan', 'Nigerien', 'Nigerian', 'Norwegian', 'Omani', 'Pakistanis', 'Palauan', 'Palestinian', 'Panamanian', 'Papua New Guinean', 'Paraguayan', 'Peruvian', 'Poles', 'Portuguese', 'Puerto Rican', 'Qatari', 'Quebecer', 'Réunionnais', 'Romanian', 'Russian', 'Baltic Russian', 'Rwandan', 'Saint Kitt', 'Saint Lucian', 'Salvadoran', 'Sammarinese', 'Samoans', 'São Tomé and Príncipe', 'Saudis', 'Scot', 'Senegalese', 'Serbs', 'Seychellois', 'Sierra Leonean', 'Singaporean', 'Slovak', 'Slovene', 'Solomon Islander', 'Somalis', 'Somalilander', 'Sotho', 'South African', 'Spaniard', 'Sri Lankan', 'Sudanese', 'Surinamese', 'Swazi', 'Swedes', 'Swiss', 'Syriac', 'Syrian', 'Taiwanese', 'Tamil', 'Tajik', 'Tanzanian', 'Thai', 'Tibetan', 'Tobagonian', 'Togolese', 'Tongan', 'Trinidadian', 'Tunisian', 'Turk', 'Tuvaluan', 'Ugandan', 'Ukrainian', 'Uruguayan', 'Uzbek', 'Vanuatuan', 'Venezuelan', 'Vietnamese', 'Vincentian', 'Welsh', 'Yemenis', 'Zambian', 'Zimbabwean']"
                    label="Citizenship"
                    :rules="[v => !!v || 'Citizenship is required']"
                    required
                  ></v-autocomplete>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayClearance.placeOfBirth_native"
                    label="Place of Birth"
                    :rules="[v => !!v || 'Place of birth is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayClearance.house_no"
                    label="House number*"
                    :rules="[v => !!v || 'House number is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayClearance.purok"
                    label="Purok*"
                    :rules="[v => !!v || 'Purok is required']"
                    required
                    v-mask="'################'"
                    hint="Only numbers are allowed"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayClearance.street"
                    label="Street*"
                    :rules="[v => !!v || 'Street is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayClearance.control_no"
                    label="Control number*"
                    :rules="[v => !!v || 'Control number is required']"
                    required
                    v-mask="'################'"
                    hint="Only numbers are allowed"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayClearance.ctc_no"
                    label="Community tax certificate number*"
                    :rules="[v => !!v || 'Community tax certificate number is required']"
                    required
                    v-mask="'################'"
                    hint="Only numbers are allowed"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="formBarangayClearance.purpose_of_clearance"
                    :items="['Local Employment','Foreign Employment','Travel Abroad','Loan Purpose','Open Account','Trycicle Franchise','Postal ID','Police Clearance','NBI Clearance','License Renewal (Firearms/Drivers)','Application for Valid ID']"
                    label="Purpose of clearance*"
                    :rules="[v => !!v || 'Purpose of clearance is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-select>
                  
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayClearance.official_receipt_no"
                    label="Official receipt number*"
                    :rules="[v => !!v || 'Official receipt number is required']"
                    required
                    v-mask="'################'"
                    hint="Only numbers are allowed"
                  ></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <p class="mb-0">* indicates required field</p>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="cancel" text>cancel</v-btn>
            <v-btn color="primary" :disabled="!validForm" type="submit" text>Save</v-btn>
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
              <v-flex offset-xs9>
                <p style="margin-bottom:0px">
                  Control no:
                  <span
                    v-if="formBarangayClearance.control_no"
                  >{{formBarangayClearance.control_no}}</span>
                  <span v-else>N/A</span>
                </p>
              </v-flex>
              <v-flex xs3>
                <img src="/img/baguio.png" alt="Logo" contain height="100" />
              </v-flex>
              <v-flex xs6 class="green--text title">
                <p class="mb-0">
                  Barangay
                  <span>{{ formBarangayClearance.first_name ? `${address[0].name}` : '______________________' }}</span>
                </p>
                <p class="mb-0">Republic of the Philippines</p>
                <p class="mb-0">Baguio City</p>
              </v-flex>
              <v-flex xs3>
                <img :src="getLogo()" alt="Logo" contain height="100" />
              </v-flex>
            </v-layout>
            <v-layout row wrap>
              <v-flex xs12 class="title font-weight-bold">
                <p class="mb-3">Office of the Punong Barangay</p>
                <p>Barangay Clearance</p>
              </v-flex>
            </v-layout>
            <v-layout row wrap>
              <v-flex xs4 class="form-border-right">
                <p
                  class="mb-0 text-capitalize"
                >{{ officials.length ? `${officials[0].name}` : 'Not registered'}}</p>
                <p>Punong Barangay</p>
                <p
                  class="mb-0 text-capitalize"
                >{{ officials.length ? `${officials[1].name}` : 'Not registered'}}</p>
                <p>Barangay Kagawad</p>
                <p
                  class="mb-0 text-capitalize"
                >{{ officials.length ? `${officials[2].name}` : 'Not registered'}}</p>
                <p>Barangay Kagawad</p>
                <p
                  class="mb-0 text-capitalize"
                >{{ officials.length ? `${officials[3].name}` : 'Not registered'}}</p>
                <p>Barangay Kagawad</p>
                <p
                  class="mb-0 text-capitalize"
                >{{ officials.length ? `${officials[4].name}` : 'Not registered'}}</p>
                <p>Barangay Kagawad</p>
                <p
                  class="mb-0 text-capitalize"
                >{{ officials.length ? `${officials[5].name}` : 'Not registered'}}</p>
                <p>Barangay Kagawad</p>
                <p
                  class="mb-0 text-capitalize"
                >{{ officials.length ? `${officials[6].name}` : 'Not registered'}}</p>
                <p>Barangay Kagawad</p>
                <p
                  class="mb-0 text-capitalize"
                >{{ officials.length ? `${officials[7].name}` : 'Not registered'}}</p>
                <p>Barangay Kagawad</p>
                <p
                  class="mb-0 text-capitalize"
                >{{ officials.length ? `${officials[8].name}` : 'Not registered'}}</p>
                <p>Barangay Secretary</p>
                <p
                  class="mb-0 text-capitalize"
                >{{ officials.length ? `${officials[9].name}` : 'Not registered'}}</p>
                <p>Barangay Treasurer</p>
              </v-flex>
              <v-flex xs8 text-xs-left class="pl-3">
                <v-layout row wrap>
                  <v-flex>
                    <p>TO WHOM IT MAY CONCERN:</p>
                    <p style="text-indent: 5%;">
                      This is to certify that
                      <span
                        v-if="formBarangayClearance.first_name"
                      >{{formBarangayClearance.first_name}}</span>
                      <span
                        v-if="formBarangayClearance.middle_name"
                      >{{formBarangayClearance.middle_name}}</span>
                      <span
                        v-if="formBarangayClearance.last_name"
                      >{{formBarangayClearance.last_name}}</span>
                      <span>{{ formBarangayClearance.first_name ? `${formBarangayClearance.age}` : '________' }}</span> years old,
                      <span>{{ formBarangayClearance.first_name ? `${formBarangayClearance.citizenship}` : '________________________' }}</span> citizen, a native of
                      <span>{{ formBarangayClearance.first_name ? `${formBarangayClearance.placeOfBirth_native}` : '________________________' }}</span>, and presently residing at
                      <span>{{ formBarangayClearance.first_name ? `${formBarangayClearance.house_no} Purok ${formBarangayClearance.purok} ${formBarangayClearance.street}, ${address[0].name}, ${address[0].municipality}, ${address[0].province}` : '________________________________________________' }}</span>

                      and whose signature appears hereunder, has no pending adverse case and deragatory records filed
                      against
                      <span
                        v-if="formBarangayClearance.sex === 'Male'"
                      >his</span>
                      <span v-else-if="formBarangayClearance.sex === 'Female'">her</span>
                      available records on file with this office as of the date of issuance thereof.
                    </p>
                  </v-flex>

                  <v-flex xs12>
                    <p style="text-indent: 5%;">
                      Issued
                      <span
                        v-if="formBarangayClearance.purpose_of_clearance"
                      >{{formBarangayClearance.purpose_of_clearance}}</span>
                      <span v-else>________________________________________</span> purposes.
                    </p>
                  </v-flex>

                  <v-flex xs12>
                    <p style="text-indent: 5%;">
                      Issued this
                      <span
                        v-if="formBarangayClearance.created_at"
                      >{{ formBarangayClearance.created_at | moment("Do") }}</span>
                      <span v-else>__</span>
                      day of
                      <span
                        v-if="formBarangayClearance.created_at"
                      >{{ formBarangayClearance.created_at | moment("MMMM YYYY") }}</span>
                      <span v-else>____________</span>
                      at Barangay {{formBarangayClearance.created_at ? `${address[0].name}, ${address[0].municipality}` : '____________'}}, Philippines
                    </p>
                  </v-flex>

                  <v-flex xs12 class="pt-4">
                    <p class="mb-0">______________________</p>
                    <p class="mb-3">Signature over printed name</p>
                  </v-flex>

                  <v-flex xs12 class="mb-3">
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
                      <span>{{ formBarangayClearance.created_at ? `${address[0].name}, ${address[0].municipality}` : '____________' }}</span>
                    </p>
                    <p class="mb-0">
                      Official receipt number:
                      <span
                        v-if="formBarangayClearance.official_receipt_no"
                      >{{formBarangayClearance.official_receipt_no}}</span>
                      <span v-else>____________</span>
                    </p>
                  </v-flex>

                  <v-flex offset-xs6 xs6 class="text-xs-center">
                    <p class="pb-2">CERTIFIED AND ISSUED BY:</p>
                    <p
                      class="mb-0 text-uppercase"
                    >{{ officials.length ? `${officials[0].name}` : 'Not registered'}}</p>
                    <p>Punong Barangay</p>
                  </v-flex>

                  <v-flex xs12>
                    <p class="caption">Note: Not valid without Barangay Seal</p>
                  </v-flex>
                </v-layout>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="done">Done</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-data-table
      :headers="barangayClearanceHeaders"
      :items="barangayClearanceIssued"
      :loading="loading"
    >
      <template v-slot:item.action="{ item }">
        <v-btn icon @click="printBarangayClearance(item)">
          <v-icon>mdi-printer</v-icon>
        </v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import FormsPrint from "./FormsPrint.vue";
export default {
  data: () => ({
    barangayClearanceIssued: [],
    user: {},
    address: [],
    officials: [],
    loading: false,
    dialogBarangayClearanceForm: false,
    dialogBarangayClearance: false,
    menuBirth: false,
    validForm: true,
    barangayClearanceHeaders: [
      { text: "Control no.", value: "control_no" },
      { text: "Community tax certificate no.", value: "ctc_no" },
      { text: "Purpose of clearance", value: "purpose_of_clearance" },
      { text: "Official receipt no.", value: "official_receipt_no" },
      { text: "Age", value: "age" },
      { text: "Sex", value: "sex" },
      { text: "Issued on", value: "created_at" },
      { text: "Actions", value: "action", sortable: false }
    ],
    formBarangayClearance: new Form({
      control_no: "",
      ctc_no: "",
      purpose_of_clearance: "",
      official_receipt_no: "",
      created_at: "",
      last_name: "",
      first_name: "",
      middle_name: "",
      house_no: "",
      purok: "",
      street: "",
      date_of_birth: "",
      citizenship: "",
      placeOfBirth_native: "",
      age: "",
      sex: ""
    }),
    formUser: new Form({
      logo: ""
    })
  }),
  created() {
    this.getBarangayClearance();
    this.getOfficials();
    this.getAddress();
    this.getUser();
  },
  components: {
    "form-print": FormsPrint
  },

  methods: {
    getBarangayClearance() {
      this.loading = true;
      axios.get("api/getUnregisteredBarangayClearance").then(response => {
        this.barangayClearanceIssued = response.data;
        this.loading = false;
      });
    },

    createBarangayClearance() {
      if (this.$refs.form.validate()) {
        this.formBarangayClearance
          .post("api/createBarangayClearance")
          .then(() => {
            this.dialogBarangayClearanceForm = false;
            toast.fire({
              type: "success",
              title: "Inhabitant has been issued business clearance"
            });
            this.getBarangayClearance();
            this.formBarangayClearance.reset();
          })
          .catch(() => {});
      }
    },

    printBarangayClearance(item) {
      this.dialogBarangayClearance = true;
      this.formBarangayClearance.fill(item);
    },

    createBarangayClearanceDialog() {
      this.formBarangayClearance.reset();
      this.dialogBarangayClearanceForm = true;
    },

    done() {
      this.dialogBarangayClearance = false;
      this.formBarangayClearance.reset();
    },

    cancel() {
      this.$refs.form.reset();
      this.formBarangayClearance.reset();
      this.dialogBarangayClearanceForm = false;
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
    getLogo() {
      let logo =
        this.formUser.logo.length > 200
          ? this.formUser.logo
          : "img/profile/" + this.formUser.logo;
      return logo;
    }
  }
};
</script>
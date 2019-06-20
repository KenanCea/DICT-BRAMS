<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span class="hidden-sm-and-down">Barangay Certificate</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn depressed color="primary" @click="createBarangayCertificateDialog">
        Fill-up form
        <v-icon right dark>mdi-file-document-edit</v-icon>
      </v-btn>
    </v-app-bar>

    <v-dialog v-model="dialogBarangayCertificateForm" scrollable persistent max-width="800px">
      <v-form
        ref="form"
        v-model="validForm"
        lazy-validation
        @submit.prevent="createBarangayCertificate"
      >
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
                    v-model="formBarangayCertificate.first_name"
                    label="First name*"
                    :rules="[v => !!v || 'First name is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayCertificate.middle_name"
                    label="Middle name*"
                    :rules="[v => !!v || 'Middle name is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayCertificate.last_name"
                    label="Last name*"
                    :rules="[v => !!v || 'Last name is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
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
                        v-model="formBarangayCertificate.date_of_birth"
                        label="Date of birth*"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-on="on"
                        :rules="[v => !!v || 'Date of birth is required']"
                        required
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="formBarangayCertificate.date_of_birth"
                      no-title
                      color="primary"
                      @input="menuBirth = false"
                    ></v-date-picker>
                  </v-menu>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-autocomplete
                    v-model="formBarangayCertificate.citizenship"
                    :items="['Afghan','Albanian','Algerian','American','Andorran','Angolan', 'Antiguan', 'Argentine', 'Armenian', 'Aruban', 'Australian', 'Austrian', 'Azerbaijani', 'Bahamian', 'Bahrainis', 'Bangladeshis', 'Barbadian', 'Basque', 'Belarusian', 'Belgian', 'Belizean', 'Beninese', 'Bermudian', 'Bhutanese', 'Bolivian', 'Bosniak', 'Bosnian', 'Botswana', 'Brazilian', 'Breton', 'British', 'British Virgin Islander', 'Bruneian', 'Bulgarian', 'Macedonian Bulgarian', 'Burkinabé', 'Burmese', 'Burundian', 'Cambodian', 'Cameroonian', 'Canadian', 'Catalan', 'Cape Verdean', 'Chadian', 'Chilean', 'Chinese', 'Colombian', 'Comorian', 'Congolese', 'Costa Rican', 'Croatian', 'Cuban', 'Cypriot', 'Czech', 'Dane', 'Greenlander', 'Djiboutian', 'Dominican', 'Dutch', 'East Timorese', 'Ecuadorian', 'Egyptian', 'Emirati', 'English', 'Equatoguinean', 'Eritrean', 'Estonian', 'Ethiopian', 'Falkland Islander', 'Faroese', 'Fijian', 'Finn', 'Finnish Swedish', 'Filipino', 'French citizen', 'Gabonese', 'Gambian', 'Georgian', 'German', 'Baltic German', 'Ghanaian', 'Gibraltarian', 'Greek', 'Greek Macedonian', 'Grenadian', 'Guatemalan', 'Guianese', 'Guinean', 'Guinea-Bissau national', 'Guyanese', 'Haitian', 'Honduran', 'Hong Konger', 'Hungarian', 'Icelander', 'I-Kiribati', 'Indian', 'Indonesian', 'Iranian', 'Iraqis', 'Irish', 'Israelis', 'Italian', 'Ivoirian', 'Jamaican', 'Japanese', 'Jordanian', 'Kazakh', 'Kenyan', 'Korean', 'Kosovar', 'Kuwaitis', 'Kyrgyz', 'Lao', 'Latvian', 'Lebanese', 'Liberian', 'Libyan', 'Liechtensteiner', 'Lithuanian', 'Luxembourger', 'Macao', 'Macedonian', 'Malagasy', 'Malawian', 'Malaysian', 'Maldivian', 'Malians', 'Maltese', 'Manx', 'Marshallese', 'Mauritanian', 'Mauritian', 'Mexicans', 'Micronesian', 'Moldovans', 'Monégasque', 'Mongolian', 'Montenegrin', 'Moroccan', 'Mozambican', 'Namibian', 'Nauran', 'Nepalese', 'New Zealander', 'Nicaraguan', 'Nigerien', 'Nigerian', 'Norwegian', 'Omani', 'Pakistanis', 'Palauan', 'Palestinian', 'Panamanian', 'Papua New Guinean', 'Paraguayan', 'Peruvian', 'Poles', 'Portuguese', 'Puerto Rican', 'Qatari', 'Quebecer', 'Réunionnais', 'Romanian', 'Russian', 'Baltic Russian', 'Rwandan', 'Saint Kitt', 'Saint Lucian', 'Salvadoran', 'Sammarinese', 'Samoans', 'São Tomé and Príncipe', 'Saudis', 'Scot', 'Senegalese', 'Serbs', 'Seychellois', 'Sierra Leonean', 'Singaporean', 'Slovak', 'Slovene', 'Solomon Islander', 'Somalis', 'Somalilander', 'Sotho', 'South African', 'Spaniard', 'Sri Lankan', 'Sudanese', 'Surinamese', 'Swazi', 'Swedes', 'Swiss', 'Syriac', 'Syrian', 'Taiwanese', 'Tamil', 'Tajik', 'Tanzanian', 'Thai', 'Tibetan', 'Tobagonian', 'Togolese', 'Tongan', 'Trinidadian', 'Tunisian', 'Turk', 'Tuvaluan', 'Ugandan', 'Ukrainian', 'Uruguayan', 'Uzbek', 'Vanuatuan', 'Venezuelan', 'Vietnamese', 'Vincentian', 'Welsh', 'Yemenis', 'Zambian', 'Zimbabwean']"
                    label="Citizenship"
                    :rules="[v => !!v || 'Citizenship is required']"
                    required
                  ></v-autocomplete>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayCertificate.placeOfBirth_native"
                    label="Place of birth"
                    :rules="[v => !!v || 'Place of birth is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayCertificate.house_no"
                    label="House number*"
                    :rules="[v => !!v || 'House number is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayCertificate.purok"
                    label="Purok*"
                    :rules="[v => !!v || 'Purok is required']"
                    v-mask="'################'"
                    hint="Only numbers are allowed"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayCertificate.street"
                    label="Street*"
                    :rules="[v => !!v || 'Street is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayCertificate.control_no"
                    label="Control number*"
                    :rules="[v => !!v || 'Control number is required']"
                    required
                    v-mask="'################'"
                    hint="Only numbers are allowed"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayCertificate.ctc_no"
                    label="Community tax certificate number*"
                    :rules="[v => !!v || 'Community tax certificate number is required']"
                    required
                    v-mask="'################'"
                    hint="Only numbers are allowed"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="formBarangayCertificate.official_receipt_no"
                    label="Official receipt number*"
                    :rules="[v => !!v || 'Official receipt number is required']"
                    required
                    v-mask="'################'"
                    hint="Only numbers are allowed"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md6>
                  <v-text-field
                    v-model="formBarangayCertificate.purpose_certification"
                    label="Purpose of certificate*"
                    :rules="[v => !!v || 'Purpose of certificate is required', v => (v || '').indexOf('  ') < 0 ||
              'No multiple spaces are allowed']"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md6>
                  <v-text-field
                    v-model="formBarangayCertificate.amount_paid"
                    label="Amount paid*"
                    :rules="[v => !!v || 'Amount paid is required']"
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
            <v-btn color="primary" :disabled="!validForm" text type="submit">Save</v-btn>
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
                <img src="/img/baguio.png" alt="Logo" contain height="100">
              </v-flex>
              <v-flex xs6 class="green--text title">
                <p class="mb-0">
                  Barangay
                  <span>{{ formBarangayCertificate.purpose_certification ? `${address[0].name}` : '______________________' }}</span>
                </p>
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
                      <span>{{ formBarangayCertificate.purpose_certification ? `${formBarangayCertificate.first_name} ${formBarangayCertificate.middle_name}. ${formBarangayCertificate.last_name}` : '______________________________________________' }},</span>
                      <span>{{ formBarangayCertificate.purpose_certification ? `${formBarangayCertificate.age}` : '________' }}</span> years old,
                      <span>{{ formBarangayCertificate.purpose_certification ? `${formBarangayCertificate.citizenship}` : '________________________' }}</span> citizen, is a resident of Barangay
                      <span>{{ formBarangayCertificate.purpose_certification ? `${address[0].name}` : '________________________' }}</span> with postal address at
                      <span>{{ formBarangayCertificate.purpose_certification ? `${formBarangayCertificate.house_no} Purok ${formBarangayCertificate.purok} ${formBarangayCertificate.street}, ${address[0].name}, ${address[0].municipality}, ${address[0].province}` : '________________________________________________' }}</span>.
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
                      <span>{{ formBarangayCertificate.created_at ? `${address[0].name}, ${address[0].municipality}` : '____________' }}</span>
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
          <v-btn color="primary" text @click="done">Done</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-data-table
      :headers="barangayCertificateHeaders"
      :items="barangayCertificateIssued"
      :loading="loading"
    >
      <template v-slot:item.action="{ item }">
        <v-btn icon @click="printBarangayCertificate(item)">
          <v-icon>mdi-printer</v-icon>
        </v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import Print from "./FormsPrint.vue";
export default {
  data: () => ({
    validForm: true,
    barangayCertificateIssued: [],
    user: {},
    address: [],
    officials: [],
    loading: false,
    dialogBarangayCertificateForm: false,
    dialogBarangayCertificate: false,
    menuBirth: false,
    barangayCertificateHeaders: [
      { text: "Control no.", value: "control_no" },
      { text: "Community tax certificate no.", value: "ctc_no" },
      { text: "Purpose of Certificate.", value: "purpose_certification" },
      { text: "Official receipt no.", value: "official_receipt_no" },
      { text: "Ammount paid", value: "amount_paid" },
      { text: "Issued on", value: "created_at" },
      { text: "Actions", value: "action", sortable: false }
    ],
    formBarangayCertificate: new Form({
      control_no: "",
      purpose_certification: "",
      ctc_no: "",
      official_receipt_no: "",
      amount_paid: "",
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
      age: ""
    }),
    formUser: new Form({
      logo: ""
    })
  }),

  created() {
    this.getBarangayCertificate();
    this.getOfficials();
    this.getAddress();
    this.getUser();
  },
  components: {
    "form-print": Print
  },
  methods: {
    getBarangayCertificate() {
      this.loading = true;
      axios.get("api/getUnregisteredBarangayCertificate/").then(response => {
        this.barangayCertificateIssued = response.data;
        this.loading = false;
      });
    },

    createBarangayCertificate() {
      if (this.$refs.form.validate()) {
        this.formBarangayCertificate
          .post("api/createBarangayCertificate")
          .then(() => {
            this.dialogBarangayCertificateForm = false;
            toast.fire({
              type: "success",
              title: "Inhabitant has been issued business Certificate"
            });
            this.getBarangayCertificate();
            this.formBarangayCertificate.reset();
          })
          .catch(() => {});
      }
    },

    printBarangayCertificate(item) {
      this.dialogBarangayCertificate = true;
      this.formBarangayCertificate.fill(item);
    },

    createBarangayCertificateDialog() {
      this.formBarangayCertificate.reset();
      this.dialogBarangayCertificateForm = true;
    },

    done() {
      this.$refs.form.reset();
      this.dialogBarangayCertificate = false;
      this.formBarangayCertificate.reset();
    },

    cancel() {
      this.$refs.form.reset();
      this.formBarangayCertificate.reset();
      this.dialogBarangayCertificateForm = false;
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
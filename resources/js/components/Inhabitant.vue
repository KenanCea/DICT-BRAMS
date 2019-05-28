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
              <v-btn v-on="on" icon>
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
              <v-container grid-list-md class="pa-0" v-if="!barangayClearance">
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
                    <v-text-field v-model="formBarangayClearance.ctc_issued_at" label="Issued at"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="formBarangayClearance.ctc_issued_on" label="Issued on"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-model="formBarangayClearance.official_receipt_no"
                      label="Official Receipt Number"
                    ></v-text-field>
                  </v-flex>
                </v-layout>
              </v-container>
              <v-container
                grid-list-md
                text-xs-center
                class="pa-0"
                v-if="barangayClearance"
                id="printForm"
              >
                <v-layout row wrap>
                  <v-flex xs4>
                    <v-img src="/img/baguio.png" alt="Logo" contain height="100"></v-img>
                  </v-flex>
                  <v-flex xs4 class="green--text title">
                    <p class="mb-0">Republic of the Philippines</p>
                    <p class="mb-0">BARANGAY AMBIONG</p>
                    <p>Aurora Hill, Baguio</p>
                  </v-flex>
                  <v-flex xs4>
                    <v-img src="/img/profile/profile1.png" alt="Logo" contain height="100"></v-img>
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
              <v-btn color="red darken-1" text v-if="barangayClearance" @click="barangayClearance = false">back</v-btn>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text v-if="!barangayClearance" @click="barangayClearance = true">proceed</v-btn>
              <v-btn
                color="blue darken-1"
                text
                v-if="barangayClearance"
                @click="clear()"
              >Ok</v-btn>
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
          <td v-if="showColumn('no_of_years_in_barangay')">{{ props.item.no_of_years_in_barangay }}</td>
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
    selectedInhabitant: [],
    headers: [
      { text: "First name", value: "first_name", selected: true },
      { text: "Middle name", value: "middle_name", selected: true },
      { text: "Last name", value: "last_name", selected: true },
      { text: "Age", value: "age", selected: true },
      { text: "Gender", value: "sex", selected: true },
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
      { text: "No. of Years in Barangay", value: "no_of_years_in_barangay" },
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
    inhabitants: [],
    dialogBarangayClearance: false,
    barangayClearance: false,
    loading: false,
    vaccine: false,
    employed: false,
    isLoading: false,
    editmode: false,
    search: null,
    formBarangayClearance: new Form({
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

    createInhabitant() {
      this.form
        .post("api/inhabitant")
        .then(() => {
          this.dialog = false;
          this.getInhabitants();
        })
        .catch(() => {});
    },

    updateInhabitant() {
      this.form
        .put("api/inhabitant/" + this.form.id)
        .then(() => {
          this.dialog = false;
          this.getInhabitants();
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
            axios.post("api/inhabitant/archived/" + id).then(response => {
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
      this.editmode = true;
      this.form.reset();
      this.dialog = true;
      this.form.fill(inhabitants);
    },

    newDialog() {
      this.editmode = false;
      this.form.household_id = this.selectedHousehold.id;
      this.dialog = true;
      this.householdDialog = false;
    },

    clear(){
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
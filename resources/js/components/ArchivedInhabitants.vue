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
        <div v-if="selectedInhabitant.length">
          <v-tooltip attach bottom>
            <template v-slot:activator="{ on }">
              <v-btn v-on="on" icon @click="editDialog(selectedInhabitant[0])">
                <v-icon>mdi-eye</v-icon>
              </v-btn>
            </template>
            <span>Edit inhabitant</span>
          </v-tooltip>
          </div>
        <div v-if="selectedInhabitant.length" class="ml-1">
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn v-on="on" icon @click="showInhabitants(selectedInhabitant[0].id)">
                <v-icon>mdi-package-up</v-icon>
              </v-btn>
            </template>
            <span>Restore inhabitant</span>
          </v-tooltip>
        </div>
        <v-divider class="mx-1" inset vertical></v-divider>
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

      <v-dialog v-model="dialogHouseholds" scrollable max-width="800px">
      <v-card >
        <v-card-title>
          <span>{{ selectedHouseholds.length ? `#${selectedHouseholds[0].house_no} ${selectedHouseholds[0].street}, ${address[0].name}, ${address[0].municipality}` : 'Households' }}</span>
          <v-spacer></v-spacer>
          <span v-if="selectedHouseholds.length">
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <v-btn v-on="on" icon @click="selectedHouseholds = []">
                  <v-icon>mdi-close</v-icon>
                </v-btn>
              </template>
              <span>Clear selected</span>
            </v-tooltip>
          </span>
          <div v-if="selectedHouseholds.length" class="ml-1">
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <v-btn v-on="on" icon @click="restore(selectedInhabitant[0].id,selectedHouseholds[0].id)">
                  <v-icon>mdi-check-decagram</v-icon>
                </v-btn>
              </template>
              <span>Restore inhabitant</span>
            </v-tooltip>
          </div>
            <v-flex xs2 ml-1 v-if="!selectedHouseholds.length" >
          <v-text-field
            v-model="searchhousehold"
            flat
            outlined
            single-line
            hide-details
            height="28"
            append-icon="mdi-magnify"
            label="Search"
          ></v-text-field>
          </v-flex>
        </v-card-title>
        <v-divider></v-divider>
        
        <v-card-text class="pa-0">
          <v-data-table
            v-model="selectedHouseholds"
            :headers="headersHouseholds"
            :items="households"
            :search="searchhousehold"
            show-select
            single-select
          >
            <template v-slot:items="props">
              <td>{{ props.item.house_no }}</td>
              <td>{{ props.item.purok }}</td>
              <td>{{ props.item.street }}</td>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>
    </v-dialog>
     
    <v-dialog v-model="dialogEditInhabitant" persistent scrollable max-width="800px">
        <v-form
          ref="inhabitantForm"
          v-model="validinhabitantForm"
        >
          <v-card>
            <v-card-title>
              <span class="headline">inhabitant</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <v-container grid-list-md pa-0>
                <v-layout wrap>
                  <v-flex xs6 md4>
                    <v-text-field
                      v-model="inhabitantForm.first_name"
                      label="First name*"
                      readonly
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs6 md4>
                    <v-text-field
                      v-model="inhabitantForm.middle_name"
                      label="Middle name"
                      readonly
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs6 md4>
                    <v-text-field
                      v-model="inhabitantForm.last_name"
                      label="Last name*"
                      readonly
                    ></v-text-field>
                  </v-flex>
                  
                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.relation_to_the_head"
                      label="Relation to THE HEAD*"
                      readonly
                    ></v-text-field>
                  </v-flex>

                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.sex"
                      label="Sex*"
                      readonly
                    ></v-text-field>
                  </v-flex>

                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.date_of_birth"
                      label="Date of birth*"
                      readonly
                    ></v-text-field>
                  </v-flex>

                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.placeOfBirth_native"
                      label="Place of birth*"
                      readonly
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.citizenship"
                      label="Citizenship*"
                      readonly
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.civil_status"
                      label="Civil status*"
                      readonly
                    ></v-text-field>
                  </v-flex>

                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.religion"
                      label="Religion*"
                      readonly
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.status_of_residency"
                      label="Status of residency*"
                      readonly
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.schooling"
                      label="Schooling*"
                      readonly
                    ></v-text-field>
                  </v-flex>

                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.Highest_educational_attainment"
                      label="Highest educational attainment*"
                      readonly
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.date_settled_in_barangay"
                      label="Date settled in the barangay*"
                      readonly
                    ></v-text-field>
                  </v-flex>

                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.ethnicGroup"
                      label="Ethnic group*"
                      readonly
                    ></v-text-field>
                  </v-flex>

                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.registeredVoterOfTheBrgy"
                      label="Registered voter*"
                      readonly
                    ></v-text-field>
                  </v-flex>

                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.blood_type"
                      label="Blood type*"
                      readonly
                    ></v-text-field>
                  </v-flex>


                  <v-flex xs6>
                    <v-text-field
                      v-model="inhabitantForm.disability"
                      label="Disability*"
                      readonly
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs6>
                    <v-text-field
                      v-if="inhabitantForm.disability === 'Others'"
                      v-model="inhabitantForm.dissability_others"
                      label="Disability others"
                      readonly
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
                        readonly
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs4>
                      <v-text-field
                        v-model="inhabitantForm.dewormed"
                        label="Dewormed?"
                        readonly
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs4>
                      <v-text-field
                        v-model="inhabitantForm.received_vitaminA"
                        label="Recieved Vitamin A?"
                        readonly
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs3>
                      <v-text-field
                        v-model="inhabitantForm.weight"
                        label="Weight"
                        readonly
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs3>
                      <v-text-field
                        v-model="inhabitantForm.height"
                        label="Height"
                        readonly
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs6>
                      <v-text-field
                        v-model="inhabitantForm.date_measured_height_weight"
                        label="Date measured height and weight"
                        readonly
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs1>
                      <v-text-field v-model="inhabitantForm.bcg" label="bcg" readonly></v-text-field>
                    </v-flex>

                    <v-flex xs1>
                      <v-text-field v-model="inhabitantForm.dpi1" label="dpi" readonly></v-text-field>
                    </v-flex>
                    <v-flex xs1>
                      <v-text-field v-model="inhabitantForm.dpi2" label="dpi" readonly></v-text-field>
                    </v-flex>
                    <v-flex xs1>
                      <v-text-field v-model="inhabitantForm.dpi3" label="dpi" readonly></v-text-field>
                    </v-flex>

                    <v-flex xs1>
                      <v-text-field v-model="inhabitantForm.opd1" label="opd" readonly></v-text-field>
                    </v-flex>
                    <v-flex xs1>
                      <v-text-field v-model="inhabitantForm.opd2" label="opd" readonly></v-text-field>
                    </v-flex>
                    <v-flex xs1>
                      <v-text-field v-model="inhabitantForm.opd3" label="opd" readonly></v-text-field>
                    </v-flex>

                    <v-flex xs2>
                      <v-text-field
                        v-model="inhabitantForm.measles"
                        label="measles"
                        readonly
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs1>
                      <v-text-field v-model="inhabitantForm.others1" label="others" readonly></v-text-field>
                    </v-flex>
                    <v-flex xs1>
                      <v-text-field v-model="inhabitantForm.others2" label="others" readonly></v-text-field>
                    </v-flex>
                    <v-flex xs1>
                      <v-text-field v-model="inhabitantForm.others3" label="others" readonly></v-text-field>
                    </v-flex>
                  </v-layout>

                  <v-flex xs6>
                    <v-checkbox v-model="employed" label="For employed inhabitant">Toggle</v-checkbox>
                  </v-flex>

                  <v-layout wrap v-if="employed">
                    <v-flex xs6>
                      <v-text-field
                        v-model="inhabitantForm.gen_job_description"
                        label="General Job Description"
                        readonly
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs6>
                      <v-text-field
                        v-model="inhabitantForm.specific_job_description"
                        label="Specific Job Description"
                        readonly
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs6>
                      <v-text-field
                        v-model="inhabitantForm.employment_status"
                        label="Employment Status"
                        readonly
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs6>
                      <v-text-field
                        v-model="inhabitantForm.job_category"
                        label="Job Category"
                        readonly
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs6>
                      <v-text-field
                        v-model="inhabitantForm.estimated_monthly_income_cash"
                        label="Estimated monthly income-cash"
                        readonly
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs6>
                      <v-text-field
                        v-model="inhabitantForm.estimated_monthly_income_kind"
                        label="Estimated Monthly Income-kind"
                        readonly
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs6>
                      <v-text-field
                        v-model="inhabitantForm.employment_category"
                        label="Employment Category"
                        readonly
                      ></v-text-field>
                    </v-flex>
                  </v-layout>
                </v-layout>
              </v-container>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="dialogEditInhabitant = false">Cancel</v-btn>
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
          <td v-if="showColumn('remarks')">{{ props.item.remarks }}</td>
          <td
            v-if="showColumn('estimated_monthly_income_cash')"
          >{{ props.item.estimated_monthly_income_cash }}</td>
          <td v-if="showColumn('date_of_birth')">{{ props.item.date_of_birth }}</td>
          <td
            v-if="showColumn('estimated_monthly_income_kind')"
          >{{ props.item.estimated_monthly_income_kind }}</td>
          
          <td v-if="showColumn('civil_status')">{{ props.item.civil_status }}</td>

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
    inhabitantsList: [],
    dialogHouseholds: false,
    households: [],
    selectedInhabitant: [],
    selectedHouseholds: [],
    vaccine: false,
    employed: false,
    dialogEditInhabitant: false,
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
    address: [],
    headers: [
      { text: "First name", value: "first_name", selected: true },
      { text: "Middle name", value: "middle_name", selected: true },
      { text: "Last name", value: "last_name", selected: true },
      { text: "Age", value: "age", selected: true },
      { text: "Sex", value: "sex", selected: true },
      { text: "Remarks", value: "remarks", selected: true },
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
     
      { text: "Civil Status", value: "civil_status" },
      { text: "Final Family Income", value: "Final_family_income" },
      { text: "Religion", value: "religion" },
      { text: "Status of Residency", value: "status_of_residency" },
      { text: "Schooling", value: "schooling" },

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
    headersHouseholds: [
        { text: "House No", value: "house_no" },
        { text: "Purok", value: "purok" },
        { text: "Street", value: "street" },
      ],
    inhabitants: [],
    user: {},
    isLoading: false,
    search: null,
    searchhousehold: null,
    menuIssued: false,

  }),

  created() {
    if (this.$gate.isUser()) {
      this.getInhabitants();
      this.getAddress();
      this.getHouseholds();
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
    getInhabitants() {
      this.loading = true;
      axios.get("api/archivedInhabitant").then(response => {
        this.inhabitants = response.data;
        this.loading = false;
      });
    },

    restore(id,houseID) {
      swal
        .fire({
          title: "Are you sure?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, Restore it!"
        })
        .then(result => {
          if (result.value) {
            axios.post("api/inhabitants/restore/" + id + "/" + houseID).then(response => {
              swal.fire(
                "Restored!",
                "archived Inhabitant has been restored.",
                "success"
              );
              this.getInhabitants();
              this.selectedInhabitant.splice([0]);
              this.dialogHouseholds = false;
            });
          }
        });
    },

    getLogo() {
      let logo =
        this.formBarangayClearance.logo.length > 200
          ? this.formBarangayClearance.logo
          : "img/profile/" + this.formBarangayClearance.logo;
      return logo;
    },

    showColumn(col) {
      return this.headers.find(h => h.value === col).selected;
    },

    
    showInhabitants(id) {
      axios.get("api/household/" + id).then(response => {
        this.inhabitantsList = response.data;
        this.dialogHouseholds = true;
      });
    },

    editDialog(inhabitants) {
      this.dialogEditInhabitant = true;
      this.inhabitantForm.fill(inhabitants);
      this.fillInhabitants(this.selectedInhabitant[0].household_id);
    },
  }
};
</script>
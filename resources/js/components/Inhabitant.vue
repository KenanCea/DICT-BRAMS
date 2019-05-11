<template>
  <div>
    <v-dialog v-model="dialog" persistent scrollable max-width="800px">
      <v-form @submit.prevent="editmode ? updateInhabitant() : createInhabitant()">
        <v-card>
          <v-card-title>
            <span class="headline" v-show="!editmode">Add Inhabitant</span>
            <span class="headline" v-show="editmode">Edit Inhabitant</span>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.first_name" label="First name"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.middle_name" label="Middle name"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="form.last_name" label="Last name"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="form.relation_to_the_head"
                    :items="['THE HEAD','Aunt','Brother-in-law','Brother','Daugther-in-law','Daughter','Father','Grandfather','Grandmother','Househelper','Husband','Mother','Son','Son-in -law','Sister-in-law','Tenant','Uncle','Wife','Common law wife']"
                    label="Relation to THE HEAD"
                  ></v-select>
                </v-flex>

                <v-flex xs12 sm6>
                  <v-select v-model="form.sex" :items="['Male','Female']" label="Sex" required></v-select>
                </v-flex>

                <v-flex xs12 sm6>
                  <v-menu
                    v-model="menu1"
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
                        v-model="form.date_of_birth"
                        label="Date of Birth"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="form.date_of_birth"
                      no-title
                      color="primary"
                      @input="menu1 = false"
                    ></v-date-picker>
                  </v-menu>
                </v-flex>

                <v-flex xs12 sm6>
                  <v-text-field
                    v-model="form.Total_family_income"
                    label="Total Family Income"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="form.civil_status"
                    :items="['Single','Married','Widow/er','Separated','Common-Law','complicated']"
                    label="Civil Status"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-text-field
                    v-model="form.Final_family_income"
                    label="Final Family Income"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-text-field
                    v-model="form.placeOfBirth_native"
                    label="Place of Birth/Native"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="form.religion"
                    :items="['Aglipayan','Anglican','Apostolic Christian','Assembly of God','Baptist','Church of Christ','Born Again Christian','Iglesia ni Cristo','Islam','Saksi ni Jehovah','Seventh Day Adventist','Methodist','Mormons','Pentecost','Protestant','Roman Catholic']"
                    label="Religion"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="form.status_of_residency"
                    :items="['Permanent','Live-in relative','Boarder','Buss Resident','Moved Out','Deceased']"
                    label="Status of Residency"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="form.schooling"
                    :items="['In school','Out of school','Not yet in school','Graduate']"
                    label="Schooling"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-text-field
                    v-model="form.no_of_years_in_barangay"
                    label="Number of Years in Barangay"
                    type="number"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="form.Highest_educational_attainment"
                    :items="['Elem. Graduate','Elementary','High school undergraduate','High school','College undergraduate','College graduate','Vocational','Post Graduate','Pre-school','Not yet attending school']"
                    label="Highest Educational Attainment"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-menu
                    v-model="menu2"
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
                        v-model="form.date_settled_in_barangay"
                        label="Date Settled in the Barangay"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="form.date_settled_in_barangay"
                      no-title
                      color="primary"
                      @input="menu2 = false"
                    ></v-date-picker>
                  </v-menu>
                </v-flex>

                <v-flex xs12 sm6>
                  <v-text-field v-model="form.weight" label="Weight(kg)" required></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-text-field v-model="form.height" label="Height(cm)" required></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="form.citizenship"
                    :items="['Filipino']"
                    label="Citizenship"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="form.ethnicGroup"
                    :items="['Bago','Bicol','Bisaya','Boholano','Bontoc','Capizeno','Cuyunon','Ibaloi','Ilonggo','Ifugao','Ilocano','Ivatan','Kalinga','Kapangpangan','Maguindanao','Maranao','Masbateno','Pangasinan','Surigaoan','Tagalog','Tausog','Waray','Yakan','Zamboagueno/Chavacano']"
                    label="Ethnic Group"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 sm6>
                  <v-select
                    v-model="form.registeredVoterOfTheBrgy"
                    :items="['Yes','No']"
                    label="Registered Voter"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="form.pregnant"
                    :items="['Yes','N/A']"
                    label="Pregnant"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12 sm6>
                  <v-select
                    v-model="form.blood_type"
                    :items="['A', 'B', 'AB', 'O', 'Do not know']"
                    label="Blood Type"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="form.disability"
                    :items="['None', 'Total blindness of one eye', 'Total blindness of both eye', 'Missing one or both arms', 'Mongoloid', 'Cleff Palate', 'Malabo ang paningin/poor eyesight', 'Hunchback', 'Paralyzed legs', 'Paralyzed arms', 'Speech disorder', 'Authistic', 'Fractured Vertebrate column', 'Paralyzed from neck down', 'Hydrocephalus',
                'Deaf', 'Mute and Deaf', 'Inability to walk alone', 'Deformity', 'Polio', 'Mental Impairment', 'Celebral Palsy', 'Epileptic', 'Dwarfism', 'Others']"
                    label="Disability"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-text-field
                    v-model="form.dissability_others"
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
                      v-model="form.specific_job_description"
                      label="Specific Job Description"
                      required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6>
                    <v-select
                      v-model="form.gen_job_description"
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
                      v-model="form.employment_status"
                      :items="['Permanent','Contractual','Temporary','Self-employed','Retired']"
                      label="Employment Status"
                      required
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 sm6>
                    <v-select
                      v-model="form.job_category"
                      :items="['Offical Government and Special Interest','Professional','Technicians and Assoc. Professional','Clerks','Service Workers & Market sales workers','Farmers & Forestry Workers','Trades & related workers','Machine Operators/Assemblers','Laborers & skilled workers','Special Occupations','n/a']"
                      label="Job Category"
                      required
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 sm6>
                    <v-text-field
                      v-model="form.estimated_monthly_income_cash"
                      label="Estimated Monthly Income-cash"
                      required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6>
                    <v-select
                      v-model="form.estimated_monthly_income_kind"
                      :items="['Rice','Vegetables','Free rental','City services']"
                      label="Estimated Monthly Income-kind"
                      required
                    ></v-select>
                  </v-flex>
                </v-layout>
                <v-layout wrap v-if="vaccine">
                  <v-flex xs12 sm6>
                    <v-text-field
                      v-model="form.child_parent"
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
            <v-btn color="blue darken-1" text @click="dialog=false">Cancel</v-btn>
            <v-btn color="blue darken-1" text type="submit">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>

    <v-dialog v-model="householdDialog" persistent scrollable max-width="500px">
      <v-card>
        <v-card-title>
          <v-autocomplete
            v-model="selectedHousehold"
            :items="items"
            :loading="isLoading"
            :search-input.sync="search"
            hide-no-data
            hide-selected
            item-text="house_no"
            item-value="API"
            label="Household where you belong.."
            placeholder="Start typing to search Households"
            return-object
          ></v-autocomplete>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text>
          <v-expand-transition>
            <v-list v-if="selectedHousehold">
              <v-list-item v-for="(field, i) in fields" :key="i">
                <v-list-item-content>
                  <v-list-item-subtitle v-text="field.key"></v-list-item-subtitle>
                  <v-list-item-title v-text="field.value"></v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-expand-transition>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="householdDialog=false">Close</v-btn>
          <v-btn
            color="primary"
            text
            :disabled="!selectedHousehold"
            @click="selectedHousehold = null"
          >Clear</v-btn>
          <v-btn color="primary" text :disabled="!selectedHousehold" @click="newDialog()">Next</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span class="hidden-sm-and-down">Inhabitants</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-tooltip bottom>
        <template v-slot:activator="{ on }">
          <v-btn text icon color="primary" v-on="on" @click="householdDialog = true">
            <v-icon color="grey darken-2">mdi-account-plus</v-icon>
          </v-btn>
        </template>
<<<<<<< HEAD
<<<<<<< HEAD
        <span>Add New Inhabitant</span>
=======
        <span>Add New Household</span>
>>>>>>> c23e70b3992b1b81ab0a08ad3ead82358b36d6fe
=======
        <span>Add New Household</span>
>>>>>>> parent of a43aa4b... added dashboard and fix Barangay Clearance
      </v-tooltip>
      <v-menu :close-on-content-click="false" offset-y max-height="400">
        <template #activator="{ on: menu }">
          <v-tooltip bottom>
            <template #activator="{ on: tooltip }">
              <v-btn text icon color="primary" v-on="{ ...tooltip, ...menu }">
                <v-icon color="grey darken-2">mdi-table-column</v-icon>
              </v-btn>
            </template>
            <span>Column Visibility</span>
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
      <app-print :TableTitle="Table" :PageOrientation="Orientation"></app-print>
      <v-tooltip bottom>
        <template v-slot:activator="{ on }">
          <v-btn text icon color="primary" v-on="on" @click="getInhabitant()">
            <v-icon color="grey darken-2">mdi-refresh</v-icon>
          </v-btn>
        </template>
        <span>Refresh</span>
      </v-tooltip>
    </v-app-bar>

    <v-data-table
      id="printTable"
      v-bind:headers="filteredHeaders"
      :items="inhabitants"
      :loading="loading"
      :search="tableSearch"
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
        <td v-if="showColumn('date_settled_in_barangay')">{{ props.item.date_settled_in_barangay }}</td>
        <td v-if="showColumn('specific_job_description')">{{ props.item.specific_job_description }}</td>
        <td v-if="showColumn('citizenship')">{{ props.item.citizenship }}</td>
        <td v-if="showColumn('gen_job_description')">{{ props.item.gen_job_description }}</td>
        <td v-if="showColumn('employment_status')">{{ props.item.employment_status }}</td>
        <td v-if="showColumn('ethnicGroup')">{{ props.item.ethnicGroup }}</td>
        <td v-if="showColumn('job_category')">{{ props.item.job_category }}</td>
        <td v-if="showColumn('placeOfBirth_native')">{{ props.item.placeOfBirth_native }}</td>
        <td v-if="showColumn('registeredVoterOfTheBrgy')">{{ props.item.registeredVoterOfTheBrgy }}</td>
        <td v-if="showColumn('childs_parent_guardian')">{{ props.item.childs_parent_guardian }}</td>
        <td v-if="showColumn('weight')">{{ props.item.weight }}</td>
        <td v-if="showColumn('height')">{{ props.item.height }}</td>
      </template>
      <template v-slot:item.column.action="{ item }">
        <v-icon small class="mr-2" @click="editDialog(item)">mdi-eye-circle</v-icon>
        <v-icon small class="mr-2" @click="editDialog(item)">mdi-file-document-edit</v-icon>
        <v-icon small @click="archive(item.id)">mdi-archive</v-icon>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import Print from './Print.vue';
export default {
  data: () => ({
    Table:'Inhabitants',
    Orientation:'landscape',
    headers: [
      {
        text: "ID",
        value: "id"
      },
      {
        text: "First name",
        value: "first_name",
        selected: true
      },
      {
        text: "Middle name",
        value: "middle_name",
        selected: true
      },

      {
        text: "Last name",
        value: "last_name",
        selected: true
      },

      {
        text: "Age",
        value: "age",
        selected: true
      },

      {
        text: "Gender",
        value: "sex",
        selected: true
      },
      {
        text: "Relation to The Head",
        value: "relation_to_the_head",
        selected: true
      },

      {
        text: "Employment Category",
        value: "employment_category"
      },
      {
        text: "Estimated Monthly Income-cash",
        value: "estimated_monthly_income_cash"
      },
      {
        text: "Date of Birth",
        value: "date_of_birth"
      },
      {
        text: "Estimated Monthly Income-kind",
        value: "estimated_monthly_income_kind"
      },
      {
        text: "Total Family Income",
        value: "Total_family_income"
      },
      {
        text: "Civil Status",
        value: "civil_status"
      },
      {
        text: "Final Family Income",
        value: "Final_family_income"
      },
      {
        text: "Religion",
        value: "religion"
      },
      {
        text: "Status of Residency",
        value: "status_of_residency"
      },
      {
        text: "Shooling",
        value: "schooling"
      },
      {
        text: "No. of Years in Barangay",
        value: "no_of_years_in_barangay"
      },
      {
        text: "Highest Educ'l Attainment",
        value: "Highest_educational_attainment"
      },
      {
        text: "Date Settled in the Barangay",
        value: "date_settled_in_barangay"
      },
      {
        text: "Specific Job Description",
        value: "specific_job_description"
      },
      {
        text: "Citizenship",
        value: "citizenship"
      },
      {
        text: "Gen. Job Description",
        value: "gen_job_description"
      },
      {
        text: "Employment Status",
        value: "employment_status"
      },

      {
        text: "Ethnic Group",
        value: "ethnicGroup"
      },
      {
        text: "Job Category",
        value: "job_category"
      },
      {
        text: "Place of Birth/Native",
        value: "placeOfBirth_native"
      },
      {
        text: "Registered Voter",
        value: "registeredVoterOfTheBrgy"
      },
      {
        text: "Child's Parent/Guardian",
        value: "childs_parent_guardian"
      },
      {
        text: "Weight(kg)",
        value: "weight"
      },
      {
        text: "Height(cm)",
        value: "height"
      },
      {
        text: "Actions",
        value: "action",
        selected: true
      }
    ],
    tableSearch: "",
    inhabitants: [],
    households: [],
    dialog: false,
    householdDialog: false,
    loading: false,
    vaccine: false,
    employed: false,
    isLoading: false,
    editmode: false,
    menu1: false,
    menu2: false,
    menu3: false,
    search: null,
    descriptionLimit: 60,
    selectedHousehold: null,
    form: new Form({
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
    })
  }),

  created() {
    this.getInhabitant();
  },

  computed: {
    fields() {
      if (!this.selectedHousehold) return [];
      return Object.keys(this.selectedHousehold).map(key => {
        return {
          key,
          value: this.selectedHousehold[key] || "n/a"
        };
      });
    },

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
    },

    items() {
      return this.households.map(entry => {
        const house_no =
          entry.house_no.length > this.descriptionLimit
            ? entry.house_no.slice(0, this.descriptionLimit) + "..."
            : entry.house_no;
        return Object.assign({}, entry, {
          house_no
        });
      });
    }
  },
  components:{
      'app-print': Print
  },
  watch: {
    search(val) {
      if (this.items.length > 0) return;
      if (this.isLoading) return;
      this.isLoading = true;
      axios
        .get("api/household")
        .then(response => {
          this.households = response.data;
        })
        .catch(err => {
          console.log(err);
        })
        .finally(() => (this.isLoading = false));
    }
  },

  methods: {
    getInhabitant() {
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
          this.getInhabitant();
        })
        .catch(() => {});
    },

    updateInhabitant() {
      this.form
        .put("api/inhabitant/" + this.form.id)
        .then(() => {
          this.dialog = false;
          this.getInhabitant();
        })
        .catch(() => {});
    },

    deleteInhabitant(id) {
      this.form
        .delete("api/inhabitant/" + id)
        .then(() => {})
        .catch(() => {});
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

    showColumn(col) {
      return this.headers.find(h => h.value === col).selected;
    },
    archive(id) {
      axios.post("api/inhabitant/archived/"+ id )
      this.getInhabitant();
    }
  }
};
</script>
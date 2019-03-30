<template>
  <div class="elevation-1">
    <v-dialog v-model="dialog" persistent max-width="800px">
      <v-form @submit.prevent="editmode ? updateInhabitant() : createInhabitant()">
        <v-card>
          <v-card-title>
            <span class="headline" v-show="!editmode">ADD</span>
            <span class="headline" v-show="editmode">EDIT</span>
          </v-card-title>
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
                  <v-select
                    v-model="form.employment_category"
                    :items="['Private','Government','Self employed','Overseas']"
                    label="Employment Category"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select v-model="form.sex" :items="['Male','Female']" label="Sex" required></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-text-field
                    v-model="form.est_monthly_income_cash"
                    label="EST. Monthly Income-cash"
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6>
                  <v-menu
                    v-model="menu1"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    lazy
                    transition="scale-transition"
                    offset-y
                    full-width
                    min-width="290px"
                  >
                    <template v-slot:activator="{ on }">
                      <v-text-field
                        v-model="form.date_of_birth"
                        label="Date of Birth"
                        prepend-icon="event"
                        readonly
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker v-model="form.date_of_birth" @input="menu1 = false"></v-date-picker>
                  </v-menu>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="form.est_monthly_income_kind"
                    :items="['Rice','Vegetables','Free rental','City services']"
                    label="EST. Monthly Income-kind"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-text-field
                    v-model="form.total_family_income"
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
                    v-model="form.final_family_income"
                    label="Final Family Income"
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
                    label="No. of Years in Barangay"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="form.highest_educ_attainment"
                    :items="['Elem. undergraduate','Elementary','High sch undergraduate','High school','College undergraduate','College Graduate','Vocational','Post Graduate','Pre-school','Not yet attending school']"
                    label="Highest Educ'l Attainment"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-menu
                    v-model="menu2"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    lazy
                    transition="scale-transition"
                    offset-y
                    full-width
                    min-width="290px"
                  >
                    <template v-slot:activator="{ on }">
                      <v-text-field
                        v-model="form.date_settled_in_the_barangay"
                        label="Date Settled in the Barangay"
                        prepend-icon="event"
                        readonly
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="form.date_settled_in_the_barangay"
                      @input="menu2 = false"
                    ></v-date-picker>
                  </v-menu>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-text-field
                    v-model="form.specific_job_description"
                    label="Specific Job Description"
                    required
                  ></v-text-field>
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
                    v-model="form.gen_job_description"
                    :items="['Security Guard','Secretary','Service Crew','Student Assistant','Tailor/Sewer/Dressmaker','Technician','Vendor','Volunteer Woker','Welder','none','n/a']"
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
                    v-model="form.ethnic_group"
                    :items="['Bago','Bicol','Bisaya','Boholano','Bontoc','Capizeno','Cuyunon','Ibaloi','Ilonggo','Ifugao','Ilocano','Ivatan','Kalinga','Kapangpangan','Maguindanao','Maranao','Masbateno','Pangasinan','Surigaoan','Tagalog','Tausog','Waray','Yakan','Zamboagueno/Chavacano']"
                    label="Ethnic Group"
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
                    v-model="form.place_of_birth"
                    label="Place of Birth/Native"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    v-model="form.registered_voter"
                    :items="['Yes','No']"
                    label="Registered Voter"
                    required
                  ></v-select>
                </v-flex>

                <v-checkbox v-model="vaccine" label="Immunized children (0-6 yrs. old)">Toggle</v-checkbox>
                <v-flex xs12 sm6></v-flex>
                <v-layout wrap v-if="vaccine">
                  <v-flex xs12 sm6>
                    <v-text-field
                      v-model="form.child_parent"
                      label="Child's Parent/Guardian"
                      required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6>
                    <v-text-field v-model="form.weight" label="Weight(kg)" required></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6>
                    <v-text-field v-model="form.height" label="Height(cm)" required></v-text-field>
                  </v-flex>
                </v-layout>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="dialog=false">Cancel</v-btn>
            <v-btn color="blue darken-1" flat type="submit">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>

    <v-dialog v-model="dialog2" max-width="500px">
      <v-card>
        <v-card-text>
          <v-autocomplete
            v-model="model"
            :items="items"
            :loading="isLoading"
            :search-input.sync="search"
            hide-no-data
            hide-selected
            item-text="house_number"
            item-value="API"
            label="Households"
            placeholder="Start typing to Search"
            return-object
          ></v-autocomplete>
        </v-card-text>
        <v-divider></v-divider>
        <v-expand-transition>
          <v-list v-if="model">
            <v-list-tile v-for="(field, i) in fields" :key="i">
              <v-list-tile-content>
                <v-list-tile-sub-title v-text="field.key"></v-list-tile-sub-title>
                <v-list-tile-title v-text="field.value"></v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list>
        </v-expand-transition>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" flat @click="dialog2=false">Close</v-btn>
          <v-btn color="primary" flat :disabled="!model" @click="model = null">Clear</v-btn>
          <v-btn color="primary" flat :disabled="!model" @click="newDialog()">Next</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-toolbar flat color="white">
      <v-toolbar-title>INHABITANTS</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-menu :close-on-content-click="false" offset-y max-height="400">
        <template v-slot:activator="{ on }">
          <v-btn color="primary" dark v-on="on">Columns</v-btn>
        </template>
        <v-list>
          <v-list-tile v-for="(item, index) in headers" :key="index">
            <v-switch
              color="green"
              v-bind:label="item.text"
              v-model="item.selected"
              :value="item.selected"
            ></v-switch>
          </v-list-tile>
        </v-list>
      </v-menu>
      <v-btn color="primary" dark @click="dialog2 = true">NEW</v-btn>
    </v-toolbar>

    <v-data-table v-bind:headers="filteredHeaders" :items="inhabitants" :loading="loading">
      <template v-slot:items="props">
        <td v-if="showColumn('id')">{{ props.item.id }}</td>
        <td v-if="showColumn('first_name')">{{ props.item.first_name }}</td>
        <td v-if="showColumn('middle_name')">{{ props.item.middle_name }}</td>
        <td v-if="showColumn('last_name')">{{ props.item.last_name }}</td>
        <td v-if="showColumn('relation_to_the_head')">{{ props.item.relation_to_the_head }}</td>
        <td v-if="showColumn('employment_category')">{{ props.item.employment_category }}</td>
        <td v-if="showColumn('sex')">{{ props.item.sex }}</td>
        <td v-if="showColumn('est_monthly_income_cash')">{{ props.item.est_monthly_income_cash }}</td>
        <td v-if="showColumn('date_of_birth')">{{ props.item.date_of_birth }}</td>
        <td v-if="showColumn('est_monthly_income_kind')">{{ props.item.est_monthly_income_kind }}</td>
        <td v-if="showColumn('total_family_income')">{{ props.item.total_family_income }}</td>
        <td v-if="showColumn('civil_status')">{{ props.item.civil_status }}</td>
        <td v-if="showColumn('final_family_income')">{{ props.item.final_family_income }}</td>
        <td v-if="showColumn('religion')">{{ props.item.religion }}</td>
        <td v-if="showColumn('status_of_residency')">{{ props.item.status_of_residency }}</td>
        <td v-if="showColumn('schooling')">{{ props.item.schooling }}</td>
        <td v-if="showColumn('no_of_years_in_barangay')">{{ props.item.no_of_years_in_barangay }}</td>
        <td v-if="showColumn('highest_educ_attainment')">{{ props.item.highest_educ_attainment }}</td>
        <td
          v-if="showColumn('date_settled_in_the_barangay')"
        >{{ props.item.date_settled_in_the_barangay }}</td>
        <td v-if="showColumn('specific_job_description')">{{ props.item.specific_job_description }}</td>
        <td v-if="showColumn('citizenship')">{{ props.item.citizenship }}</td>
        <td v-if="showColumn('gen_job_description')">{{ props.item.gen_job_description }}</td>
        <td v-if="showColumn('employment_status')">{{ props.item.employment_status }}</td>
        <td v-if="showColumn('ethnic_group')">{{ props.item.ethnic_group }}</td>
        <td v-if="showColumn('job_category')">{{ props.item.job_category }}</td>
        <td v-if="showColumn('place_of_birth')">{{ props.item.place_of_birth }}</td>
        <td v-if="showColumn('registered_voter')">{{ props.item.registered_voter }}</td>
        <td v-if="showColumn('child_parent')">{{ props.item.child_parent }}</td>
        <td v-if="showColumn('weight')">{{ props.item.weight }}</td>
        <td v-if="showColumn('height')">{{ props.item.height }}</td>
        <td v-if="showColumn('actions')">
          <v-icon small class="mr-2" @click="editDialog(props.item)">remove_red_eye</v-icon>
          <v-icon small class="mr-2" @click="editDialog(props.item)">edit</v-icon>
          <v-icon small @click="deleteInhabitant(props.item.id)">delete</v-icon>
        </td>
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data: () => ({
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
        text: "Relation to The Head",
        value: "relation_to_the_head",
        selected: true
      },
      {
        text: "Employment Category",
        value: "employment_category"
      },
      {
        text: "Sex",
        value: "sex",
        selected: true
      },
      {
        text: "EST. Monthly Income-cash",
        value: "est_monthly_income_cash"
      },
      {
        text: "Date of Birth",
        value: "date_of_birth",
        selected: true
      },
      {
        text: "EST. Monthly Income-kind",
        value: "est_monthly_income_kind"
      },
      {
        text: "Total Family Income",
        value: "total_family_income"
      },
      {
        text: "Civil Status",
        value: "civil_status",
        selected: true
      },
      {
        text: "Final Family Income",
        value: "final_family_income"
      },
      {
        text: "Religion",
        value: "religion",
        selected: true
      },
      {
        text: "Status of Residency",
        value: "status_of_residency",
        selected: true
      },
      {
        text: "Shooling",
        value: "schooling",
        selected: true
      },
      {
        text: "No. of Years in Barangay",
        value: "no_of_years_in_barangay"
      },
      {
        text: "Highest Educ'l Attainment",
        value: "highest_educ_attainment",
        selected: true
      },
      {
        text: "Date Settled in the Barangay",
        value: "date_settled_in_the_barangay"
      },
      {
        text: "Specific Job Description",
        value: "specific_job_description"
      },
      {
        text: "Citizenship",
        value: "citizenship",
        selected: true
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
        value: "ethnic_group"
      },
      {
        text: "Job Category",
        value: "job_category"
      },
      {
        text: "Place of Birth/Native",
        value: "place_of_birth"
      },
      {
        text: "Registered Voter",
        value: "registered_voter"
      },
      {
        text: "Child's Parent/Guardian",
        value: "child_parent"
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
        value: "actions",
        sortable: false,
        selected: true,
        width: "200px"
      }
    ],
    inhabitants: [],
    households: [],
    dialog: false,
    dialog2: false,
    loading: false,
    vaccine: false,
    isLoading: false,
    editmode: false,
    menu1: false,
    menu2: false,
    search: null,
    date: new Date().toISOString().substr(0, 10),
    descriptionLimit: 60,
    model: {},
    form: new Form({
      id: "",
      household_id: "",
      first_name: "",
      middle_name: "",
      last_name: "",
      relation_to_the_head: "",
      employment_category: "",
      sex: "",
      est_monthly_income_cash: "",
      date_of_birth: "",
      est_monthly_income_kind: "",
      total_family_income: "",
      civil_status: "",
      final_family_income: "",
      religion: "",
      status_of_residency: "",
      schooling: "",
      no_of_years_in_barangay: "",
      highest_educ_attainment: "",
      date_settled_in_the_barangay: "",
      specific_job_description: "",
      citizenship: "",
      gen_job_description: "",
      employment_status: "",
      ethnic_group: "",
      job_category: "",
      place_of_birth: "",
      registered_voter: "",
      child_parent: "",
      weight: "",
      height: ""
    })
  }),

  created() {
    this.getInhabitant();
  },

  computed: {
    fields() {
      if (!this.model) return [];
      return Object.keys(this.model).map(key => {
        return {
          key,
          value: this.model[key] || "n/a"
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
        const house_number =
          entry.house_number.length > this.descriptionLimit
            ? entry.house_number.slice(0, this.descriptionLimit) + "..."
            : entry.house_number;
        return Object.assign({}, entry, {
          house_number
        });
      });
    }
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
          this.getInhabitant()
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
      this.form.household_id = this.model.id;
      this.dialog = true;
      this.dialog2 = false;
    },

    showColumn(col) {
      return this.headers.find(h => h.value === col).selected;
    }
  }
};
</script>

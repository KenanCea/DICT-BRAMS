<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span class="hidden-sm-and-down">Inhabitants</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
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
      <v-tooltip bottom>
        <template v-slot:activator="{ on }">
          <v-btn text icon color="primary" v-on="on">
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
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data: () => ({
    headers: [
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
        text: "EST. Monthly Income-cash",
        value: "est_monthly_income_cash"
      },
      {
        text: "Date of Birth",
        value: "date_of_birth"
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
        value: "civil_status"
      },
      {
        text: "Final Family Income",
        value: "final_family_income"
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
        value: "highest_educ_attainment"
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
        text: "ID",
        value: "id"
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
    model: {}
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
      axios.get("api/archivedInhabitant").then(response => {
        this.inhabitants = response.data;
        this.loading = false;
      });
    },

    showColumn(col) {
      return this.headers.find(h => h.value === col).selected;
    },

    archive(id) {
      axios.post("api/inhabitant/restore/" + id);
      this.getInhabitant();
    }
  }
};
</script>
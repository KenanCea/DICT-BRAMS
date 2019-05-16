<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span class="hidden-sm-and-down">Barangay Population Gender Age</span>
      </v-toolbar-title>
    </v-app-bar>
    <v-container grid-list-md text-xs-center id="printForm">
      <v-layout row wrap>
        <v-flex text-xs-left class="pl-3">
          <p class="mb-4">I. IDENTIFYING DATA</p>
          <p>
              Region:<br>
              Province:<br>
              City:<br>
              Barangay:<br>
          </p>
          <p class="mb-4">
              Total Number Of Puroks:<br>
              Total Household:<br>
              Ave. Size Per Household:<br>
              Barangay Population:<br>
          </p>
          <p class="mb-0">
              I. DEMOGRAPHICS
          </p>
          <p>
              Table 1. Population Distribution by Age and Sex
          </p>
            <table class='table'>
                <thead>
                    <tr>
                        <th rowspan="2">Age Group</th>
                        <th colspan="6">TOTAL NUMBER</th>
                    </tr>
                    <tr>
                        <th>Male</th>
                        <th>%</th>
                        <th>Female</th>
                        <th>%</th>
                        <th>Total</th>
                        <th>%</th>
                    </tr>
                </thead>
            </table>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import Print from './Print.vue';
    export default {
        data: () => ({
            Table:'List Of Registered Voters',
            Orientation:'landscape',
            search:'',
            loading: false,
            registeredVoters: [],
        }),
       created() {
            this.loadQuery();
        },
        components:{
            'app-print': Print
        },
        methods: {
            loadQuery() {
                this.loading = true;
                axios.get("api/registeredVoters").then(response => {
                    this.registeredVoters = response.data;
                    this.loading = false;
                });
            },
            showColumn(col) {
                return this.headers.find(h => h.value === col).selected;
            }
        }
    }
</script>
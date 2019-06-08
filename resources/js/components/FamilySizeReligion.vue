<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span class="hidden-sm-and-down">Barangay Population Gender Age</span>
      </v-toolbar-title>
    </v-app-bar>
    <v-container grid-list-md text-xs-center>
      <v-layout row wrap>
        <v-flex text-xs-left class="pl-3">
          <p>
              Table 2. Household Population by civil Status and Gender
          </p>
            <table class='kiosktable'>
                <thead>
                    <tr>
                        <th>Household</th>
                        <th>Total Number</th>
                        <th>Percentage</th>
                        <th>Total Population</th>
                        <th>Perentage</th>
                    </tr>
                    <tr v-for="household in households" :key="household.id">
                        <td>{{household.civil_status}}</td>
                        <td>{{household.male}}</td>
                        <td>{{household.malepercent}}</td>
                        <td>{{household.female}}</td>
                        <td>{{household.femalepercent}}</td>
                    </tr>
                </thead>
            </table>
            <p style="padding-top:20px;">
              Table 3. Household Population by Tribe
          </p>
          
            <table class='kiosktable'>
                <thead>
                    <tr>
                        <th>Religion</th>
                        <th>Household Members</th>
                        <th>% to Population</th>
                    </tr>
                    <tr v-for="religion in religions" :key="religion.id">
                        <td>{{religion.ethnicgroup}}</td>
                        <td>{{religion.totalnumber}}</td>
                        <td>{{religion.percent}}</td>
                    </tr>
                </thead>
            </table>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import Print from './DocumentPrint.vue';
    export default {
        data: () => ({
            Table:'List Of Registered Voters',
            Orientation:'landscape',
            search:'',
            loading: false,
            household: [],
            religion: []
        }),
       mounted() {
            this.loadCivilStat();
            this.loadEthnic();
        },
        components:{
            'app-print': Print
        },
        methods: {
            loadCivilStat() {
                this.loading = true;
                axios.get("api/FamilySize").then(response => {
                    this.civilStats = response.data;
                    this.loading = false;
                });
            },
            loadEthnic() {
                this.loading = true;
                axios.get("api/Religion").then(response => {
                    this.ethnics = response.data;
                    this.loading = false;
                });
            },
            showColumn(col) {
                return this.headers.find(h => h.value === col).selected;
            }
        }
    }
</script>
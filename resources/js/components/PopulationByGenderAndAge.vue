<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
        <v-toolbar-title>
            <span class="hidden-sm-and-down">{{Table}}</span>
        </v-toolbar-title>
    <v-spacer></v-spacer>

    <app-print></app-print>
    </v-app-bar>
    <v-container grid-list-md text-xs-center id="printKiosk">
      <v-layout row wrap>
        <v-flex text-xs-left class="pl-3">
          <p class="mb-4"><strong>BARANGAY PROFILE</strong></p>
          <div class='spacing'>
            <p>
                <span>Region  :  </span>{{barangayInfo.municipality}}<br>
                <span>Province  :  </span>{{barangayInfo.province}}<br>
                <span>City :  </span>{{barangayInfo.municipality}}<br>
                <span>Barangay  :  </span>{{barangayInfo.name}}<br>
            </p>
            <p class="mb-4">
                <span>Total Number Of Puroks  :  </span>{{householdInfo.totalpurok}}<br>
                <span>Total Household  :  </span>{{householdInfo.totalhouseholds}}<br>
                <span>Ave. Size Per Household  :  </span><br>
                <span>Barangay Population  :  </span>{{householdInfo.totalinhabitants}}<br>
            </p>
          </div>
          <p class="mb-0">
           <strong> DEMOGRAPHICS</strong>
          </p>
          <p>
              Population Distribution by Age and Sex
          </p>
            <table class='kiosktable' id="printTable">
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
                    <tr v-for="demographic in demographics" :key="demographic.id">
                        <td>{{demographic.agegroup}}</td>
                        <td>{{demographic.male}}</td>
                        <td>{{demographic.malepercent}}</td>
                        <td>{{demographic.female}}</td>
                        <td>{{demographic.femalepercent}}</td>
                        <td>{{demographic.total}}</td>
                        <td>{{demographic.totalpercent}}</td>
                    </tr>
                </thead>
            </table>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import Print from './KioskPrint.vue';
    export default {
        data: () => ({
            Table:'Barangay Population By Gender and Age',
            Orientation:'portrait',
            search:'',
            loading: false,
            demographics: [],
            barangayInfo: [],
            householdInfo: []
        }),
       mounted() {
            this.loadQuery();
            this.loadInfo();
            this.loadHousehold();
        },
        components:{
            'app-print': Print
        },
        methods: {
            loadQuery() {
                this.loading = true;
                axios.get("api/ageGroup").then(response => {
                    this.demographics = response.data;
                    this.loading = false;
                });
            },
            loadInfo(){
            axios.get('api/barangayInfo').then(response => {
                    this.barangayInfo = response.data[0] ;
                });
            },
            loadHousehold(){
            axios.get('api/householdsInfo').then(response => {
                    this.householdInfo = response.data[0] ;
                });
            },
            showColumn(col) {
                return this.headers.find(h => h.value === col).selected;
            }
        }
    }
</script>
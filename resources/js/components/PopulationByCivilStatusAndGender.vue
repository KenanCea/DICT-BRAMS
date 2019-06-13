<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
        <v-toolbar-title>
            <span class="hidden-sm-and-down">{{Table}}</span>
        </v-toolbar-title>
    <v-spacer></v-spacer>

    <app-print :TableTitle="Table" :PageOrientation="Orientation"></app-print>
    </v-app-bar>
    <v-container grid-list-md text-xs-center>
      <v-layout row wrap>
        <v-flex text-xs-left class="pl-3">
            <table class='kiosktable' id="printTable">
                <thead>
                    <tr>
                        <th rowspan="2">Civil Status</th>
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
                    <tr v-for="civilStat in civilStats" :key="civilStat.id">
                        <td>{{civilStat.civil_status}}</td>
                        <td>{{civilStat.male}}</td>
                        <td>{{civilStat.malepercent}}</td>
                        <td>{{civilStat.female}}</td>
                        <td>{{civilStat.femalepercent}}</td>
                        <td>{{civilStat.total}}</td>
                        <td>{{civilStat.totalpercent}}</td>
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
            Table:'Household Population by civil Status and Gender',
            Orientation:'landscape',
            search:'',
            loading: false,
            civilStats: [],
        }),
       mounted() {
            this.loadCivilStat();
        },
        components:{
            'app-print': Print
        },
        methods: {
            loadCivilStat() {
                this.loading = true;
                axios.get("api/civilStatus").then(response => {
                    this.civilStats = response.data;
                    this.loading = false;
                });
            },
            showColumn(col) {
                return this.headers.find(h => h.value === col).selected;
            }
        },
        components:{
            'app-print': Print
        },
    }
</script>
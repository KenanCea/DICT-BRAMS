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
            <table class='kiosktable'>
                <thead>
                    <tr>
                        <th>Household</th>
                        <th>Total Number</th>
                        <th>Percentage</th>
                        <th>Total Population</th>
                        <th>Percentage</th>
                    </tr>
                    <tr v-for="ethnic in ethnics" :key="ethnic.id">
                        <td>{{ethnic.ethnicgroup}}</td>
                        <td>{{ethnic.totalnumber}}</td>
                        <td>{{ethnic.percent}}</td>
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
            Table:'Household Population by Size',
            Orientation:'potrait',
            search:'',
            loading: false,
            householdPop: []
        }),
       mounted() {
            this.loadEthnic();
        },
        components:{
            'app-print': Print
        },
        methods: {
            loadEthnic() {
                this.loading = true;
                axios.get("api/HouseholdPop").then(response => {
                    this.householdPop = response.data;
                    this.loading = false;
                });
            },
            showColumn(col) {
                return this.headers.find(h => h.value === col).selected;
            }
        }
    }
</script>
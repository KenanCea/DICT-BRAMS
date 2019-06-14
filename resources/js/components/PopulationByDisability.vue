<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
        <v-toolbar-title>
            <span class="hidden-sm-and-down">Barangay Kiosk</span>
        </v-toolbar-title>
    <v-spacer></v-spacer>

    <app-print></app-print>
    </v-app-bar>
    <v-container grid-list-md text-xs-center id="printKiosk">
      <v-layout row wrap>
        <v-flex text-xs-left class="pl-3">
            <p style="padding-top:20px;">
              Household Population by Disability
          </p>
          
            <table class='kiosktable' id="printTable">
                <thead>
                    <tr>
                        <th>Religion</th>
                        <th>Total Number</th>
                        <th>%</th>
                    </tr>
                    <tr v-for="disability in disabilities" :key="disability.id">
                        <td>{{disability.disability}}</td>
                        <td>{{disability.totalnumber}}</td>
                        <td>{{disability.percent}}</td>
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
            Table:'Household Population by Disability',
            Orientation:'landscape',
            search:'',
            loading: false,
            disabilities: []
        }),
       mounted() {
            this.loadQuery();
        },
        components:{
            'app-print': Print
        },
        methods: {
            loadQuery() {
                this.loading = true;
                axios.get("api/Disability").then(response => {
                    this.disabilities = response.data;
                    this.loading = false;
                });
            },
            showColumn(col) {
                return this.headers.find(h => h.value === col).selected;
            }
        }
    }
</script>
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
                        <th>Type of Crimes Committed</th>
                        <th>Total Number</th>
                        <th>%</th>
                    </tr>
                    <tr v-for="crime in crimes" :key="crime.id">
                        <td>{{crime.cases}}</td>
                        <td>{{crime.totalnumber}}</td>
                        <td>{{crime.percent}}</td>
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
            Table:'Incident Crimes Filed',
            Orientation:'landscape',
            search:'',
            loading: false,
            crimes: []
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
                axios.get("api/Crimes").then(response => {
                    this.crimes = response.data;
                    this.loading = false;
                });
            },
            showColumn(col) {
                return this.headers.find(h => h.value === col).selected;
            }
        }
    }
</script>
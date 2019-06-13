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
import Print from './DocumentPrint.vue';
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
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
            <p style="padding-top:20px;">
              Table 3. Household Population by Tribe
          </p>
          
            <table class='kiosktable'>
                <thead>
                    <tr>
                        <th>Ethnic Group</th>
                        <th>Total Number</th>
                        <th>%</th>
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
            Table:'Household Population by Tribe',
            Orientation:'landscape',
            search:'',
            loading: false,
            ethnics: []
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
                axios.get("api/ethnicGroup").then(response => {
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
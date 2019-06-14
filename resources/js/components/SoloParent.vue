<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
        <v-toolbar-title>
            <span class="hidden-sm-and-down">{{Table}}</span>
        </v-toolbar-title>
    <v-spacer></v-spacer>

    <app-print :TableTitle="Table"></app-print>
    </v-app-bar>
    <v-container grid-list-md text-xs-center id="printKiosk">
      <v-layout row wrap>
        <v-flex text-xs-left class="pl-3">
            <p style="padding-top:20px;">
              Reasons for being a solo parent
          </p>
          
            <table class='kiosktable'>
                <thead>
                    <tr>
                        <th>Reasons</th>
                        <th>Total Number</th>
                        <th>%</th>
                    </tr>
                    <tr v-for="reason in reasons" :key="reason.id">
                        <td>{{reason.solo_parent}}</td>
                        <td>{{reason.totalnumber}}</td>
                        <td>{{reason.percent}}</td>
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
            Table:'Reasons for being a solo parent',
            Orientation:'landscape',
            search:'',
            loading: false,
            reasons: []
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
                axios.get("api/SoloParentReason").then(response => {
                    this.reasons = response.data;
                    this.loading = false;
                });
            },
            showColumn(col) {
                return this.headers.find(h => h.value === col).selected;
            }
        }
    }
</script>
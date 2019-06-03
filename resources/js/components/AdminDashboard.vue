<template>
  <v-app>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span>Dashboard</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <div>
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="refresh()">
              <v-icon>mdi-refresh</v-icon>
            </v-btn>
          </template>
          <span>Refresh</span>
        </v-tooltip>
      </div>
    </v-app-bar>

    <v-container grid-list-md class="pl-0 pr-2 py-2" style="background-color:white;">
      <v-layout row wrap>
        <v-flex lg4>
          <v-card :loading="loadingBarangays" outlined>
            <v-card-text class="pa-0">
              <v-container class="pa-0">
                <v-layout row text-sm-center justify-center align-center class="ma-0">
                  <v-flex xs6>
                    <v-icon size="56px" color="red darken-1">mdi-home-city</v-icon>
                  </v-flex>
                  <v-flex xs6 py-3 class="white--text red darken-1">
                    <div class="headline">{{barangays}}</div>
                    <span class="caption">Barangays</span>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex lg4>
          <v-card :loading="loadingPopulation" outlined>
            <v-card-text class="pa-0">
              <v-container class="pa-0">
                <v-layout row text-sm-center justify-center align-center class="ma-0">
                  <v-flex xs6>
                    <v-icon size="56px" color="deep-purple darken-1">mdi-account-multiple</v-icon>
                  </v-flex>
                  <v-flex xs6 py-3 class="white--text deep-purple darken-1">
                    <div class="headline">{{inhabitantTotalpop}}</div>
                    <span class="caption">Population</span>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex lg4>
          <v-card :loading="loadingHouseholdPop" outlined>
            <v-card-text class="pa-0">
              <v-container class="pa-0">
                <v-layout row text-sm-center justify-center align-center class="ma-0">
                  <v-flex xs6>
                    <v-icon size="56px" color="indigo darken-1">mdi-home-group</v-icon>
                  </v-flex>
                  <v-flex xs6 py-3 class="white--text indigo darken-1">
                    <div class="headline">{{householdpop}}</div>
                    <span class="caption">Household Population</span>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex lg12>
          <v-card :loading="loadingTopPop" outlined>
            <v-card-title>Top 10 Populous Barangay</v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <ve-histogram :data="totalPopBarangay"></ve-histogram>
            </v-card-text>
          </v-card>
        </v-flex>
        
        <v-flex lg12>
         <v-card>
    <v-card-title>
    <div>
            Barangays in the City of Baguio
            <div> There are {{barangays}} barangays as of the year {{currentYear}}   </div>
          </div>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search Barangay"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      v-bind:headers="filteredHeaders"
      :search="search"
      :items="BarangayCensus"
      :loading="loading"
    ><template v-slot:items = "props">
              <td>{{ props.item.Barangay }}</td>
              <td>{{ props.item.Inhabitants }}</td>
              <td>{{ props.item.Households }}</td>
              <td>{{ props.item.type }}</td>
            </template></v-data-table>

  
  </v-card>
  </v-flex>
      </v-layout>
    </v-container>
  </v-app>
</template>
<script>
import VeHistogram from "v-charts/lib/histogram.common";
import VePie from "v-charts/lib/pie.common";
export default {
  components: {
    VeHistogram,
    VePie
  },
  data() {
      return {
        barangays: "",
      loading: false,
      loadingBarangays: true,
      loadingPopulation: true,
      loadingHouseholdPop: true,
      loadingTopPop: true,
      inhabitantTotalpop: "",
      householdpop: "",
      totalPopBarangay: {
        columns: ["Barangay", "Households", "Inhabitants"],
        rows: []
      },
      currentYear: '',
     search: '',
     BarangayCensus: [],
        headers: [
          {
            text: 'Barangay',
            align: 'left',
            sortable: false,
            value: 'Barangay',
            selected: true
          },{
            text: 'Population',
            value: 'Inhabitants',
            selected: true
          }, {
            text: 'Households',
            value: 'Households',
            selected: true
          }, {
            text: 'Type',
            value: 'type',
            selected: true
          }
          
        ],
      }
  },
  
  created() {
    this.getBarangays();
    this.getInhabitantTotalPop();
    this.getHouseholdpop();
    this.getTotalPopBarangay();
    this.getCurrentYear();
    this.loadQuery();
  },
  computed:{
            filteredHeaders() {
                return this.headers.filter(h => h.selected);
            },

            filteredItems() {
                return this.items.map(item => {
                    let filtered = Object.assign({}, item);
                    this.headers.forEach(header => {
                    if (!header.selected) delete filtered[header.value];
                    });
                    return filtered;
                });
            }
        },
  methods: {
      getCurrentYear() {	
		this.currentYear = (new Date()).getFullYear();
      },
      loadQuery() {
                this.loading = true;
                axios.get("api/AllBarangay").then(response => {
                    this.BarangayCensus = response.data;
                    this.loading = false;
                });
            },
    getBarangays() {
      axios
        .get("api/Barangay")
        .then(response => {
        this.barangays = response.data;
        this.loadingBarangays = false;
        });
    },
    getInhabitantTotalPop() {
      axios
        .get("api/InhabitantPop")
        .then(response => {
        this.inhabitantTotalpop = response.data;
        this.loadingPopulation = false;
        });
    },
    getHouseholdpop() {
      axios.get("api/HouseholdPop")
      .then(response => {
      this.householdpop = response.data;
      this.loadingHouseholdPop = false;
      });
    },
    getTotalPopBarangay() {
      axios
        .get("api/TotalPopBarangay")
        .then(response => {
          this.totalPopBarangay.rows = response.data;
          this.loadingTopPop = false;
        });
    },
    refresh() {
      this.getBarangays();
      this.getInhabitantTotalPop();
      this.getHouseholdpop();
      this.getTotalPopBarangay();
      this.getCurrentYear();
      this.loadQuery();
    }
  }
};
</script>
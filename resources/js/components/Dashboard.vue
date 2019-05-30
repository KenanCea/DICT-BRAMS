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

    <v-container grid-list-md class="pl-0 pr-2 py-2" style="background-color:white">
      <v-layout row wrap>
        <v-flex lg4>
          <v-card outlined>
            <v-card-text class="pa-0">
              <v-container class="pa-0">
                <div class="layout row ma-0">
                  <div class="sm6 xs6 flex">
                    <div class="layout column ma-0 justify-center align-center">
                      <v-icon size="56px" color="red darken-1">mdi-account-multiple</v-icon>
                    </div>
                  </div>
                  <div class="sm6 xs6 flex text-sm-center py-3 white--text red darken-1">
                    <div class="headline">{{inhabitant}}</div>
                    <span class="caption">Inhabitants</span>
                  </div>
                </div>
              </v-container>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex lg4>
          <v-card outlined>
            <v-card-text class="pa-0">
              <v-container class="pa-0">
                <div class="layout row ma-0">
                  <div class="sm6 xs6 flex">
                    <div class="layout column ma-0 justify-center align-center">
                      <v-icon size="56px" color="deep-purple darken-1">mdi-home-group</v-icon>
                    </div>
                  </div>
                  <div class="sm6 xs6 flex text-sm-center py-3 white--text deep-purple darken-1">
                    <div class="headline">{{household}}</div>
                    <span class="caption">Households</span>
                  </div>
                </div>
              </v-container>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex lg4>
          <v-card outlined>
            <v-card-text class="pa-0">
              <v-container class="pa-0">
                <div class="layout row ma-0">
                  <div class="sm6 xs6 flex">
                    <div class="layout column ma-0 justify-center align-center">
                      <v-icon size="56px" color="indigo darken-1">mdi-map-marker</v-icon>
                    </div>
                  </div>
                  <div class="sm6 xs6 flex text-sm-center py-3 white--text indigo darken-1">
                    <div class="headline">{{purok}}</div>
                    <span class="caption">Puroks / Sitios</span>
                  </div>
                </div>
              </v-container>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex lg8>
          <v-card outlined>
            <v-card-title>Inhabitants and households per purok</v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <ve-histogram :data="totalInhabitantsPurok"></ve-histogram>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex lg4>
          <v-card outlined>
            <v-card-title>Gender</v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <ve-pie :data="gender"></ve-pie>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex lg4>
          <v-card outlined>
            <v-card-title>Registered voters</v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <ve-pie :data="regVoters"></ve-pie>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex lg12>
          <v-card outlined>
            <v-card-title>Religions</v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <ve-pie :data="religions"></ve-pie>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex lg12>
          <v-card outlined>
            <v-card-title>Ethnic group</v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <ve-pie :data="ethnicGroups"></ve-pie>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex lg12>
          <v-card outlined>
            <v-card-title>Dialects</v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <ve-pie :data="dialects"></ve-pie>
            </v-card-text>
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
      inhabitant: "",
      household: "",
      purok: "",
      totalInhabitantsPurok: {
        columns: ["Purok", "Households", "Inhabitants"],
        rows: []
      },
      ethnicGroups: {
        columns: ["EthnicGroup", "Total"],
        rows: []
      },
      gender: {
        columns: ["Gender", "Total"],
        rows: []
      },
      regVoters: {
        columns: ["RegisteredVoter", "Total"],
        rows: []
      },
      religions: {
        columns: ["Religion", "Total"],
        rows: []
      },
      dialects: {
        columns: ["Dialects", "Total"],
        rows: []
      }
    };
  },
  created() {
    this.getInhabitants();
    this.getHouseholds();
    this.getPuroks();
    this.getHouseholdsPurok();
    this.getReligion();
    this.getEthnicGroup();
    this.getGender();
    this.getRegisteredVoter();
    this.getDialects();
  },
  methods: {
    getInhabitants() {
      axios
        .get("api/Inhabitants")
        .then(response => (this.inhabitant = response.data));
    },
    getHouseholds() {
      axios
        .get("api/Households")
        .then(response => (this.household = response.data));
    },
    getPuroks() {
      axios.get("api/Puroks").then(response => (this.purok = response.data));
    },
    getHouseholdsPurok() {
      axios
        .get("api/HouseholdsPurok")
        .then(response => (this.totalInhabitantsPurok.rows = response.data));
    },
    getReligion() {
      axios
        .get("api/Religion")
        .then(response => (this.religions.rows = response.data));
    },
    getRegisteredVoter() {
      axios
        .get("api/RegisteredVoter")
        .then(response => (this.regVoters.rows = response.data));
    },
    getDialects() {
      axios
        .get("api/Dialects")
        .then(response => (this.dialects.rows = response.data));
    },
    getGender() {
      axios
        .get("api/Gender")
        .then(response => (this.gender.rows = response.data));
    },

    getEthnicGroup() {
      axios
        .get("api/EthnicGroup")
        .then(response => (this.ethnicGroups.rows = response.data));
    },

    refresh() {
      this.getInhabitants();
      this.getHouseholds();
      this.getPuroks();
      this.getHouseholdsPurok();
      this.getReligion();
      this.getEthnicGroup();
      this.getGender();
      this.getRegisteredVoter();
      this.getDialects();
    }
  }
};
</script>
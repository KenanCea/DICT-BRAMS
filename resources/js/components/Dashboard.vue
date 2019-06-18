<template>
  <v-app>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span>Dashboard</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <div>
        <v-tooltip attach bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="refresh()">
              <v-icon>mdi-refresh</v-icon>
            </v-btn>
          </template>
          <span>Refresh</span>
        </v-tooltip>
      </div>
    </v-app-bar>

    <v-container grid-list-md style="background-color:white;">
      <v-layout row wrap>
        <v-flex xs12 md4>
          <v-card :loading="loadingInhabitants" outlined>
            <v-card-text class="pa-0">
              <v-container class="pa-0">
                <v-layout row text-xs-center justify-center align-center class="ma-0">
                  <v-flex xs6>
                    <v-icon size="56px" color="red darken-1">mdi-account-multiple</v-icon>
                  </v-flex>
                  <v-flex xs6 py-3 class="white--text red darken-1">
                    <div class="headline">{{inhabitant}}</div>
                    <span class="caption">Inhabitants</span>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 md4>
          <v-card :loading="loadingHousehold" outlined>
            <v-card-text class="pa-0">
              <v-container class="pa-0">
                <v-layout row text-xs-center justify-center align-center class="ma-0">
                  <v-flex xs6>
                    <v-icon size="56px" color="deep-purple darken-1">mdi-home-group</v-icon>
                  </v-flex>
                  <v-flex xs6 py-3 class="white--text deep-purple darken-1">
                    <div class="headline">{{household}}</div>
                    <span class="caption">Households</span>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 md4>
          <v-card :loading="loadingPurok" outlined>
            <v-card-text class="pa-0">
              <v-container class="pa-0">
                <v-layout row text-xs-center justify-center align-center class="ma-0">
                  <v-flex xs6>
                    <v-icon size="56px" color="indigo darken-1">mdi-map-marker</v-icon>
                  </v-flex>
                  <v-flex xs6 py-3 class="white--text indigo darken-1">
                    <div class="headline">{{purok}}</div>
                    <span class="caption">Puroks / Sitios</span>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex md8 xs12>
          <v-card :loading="loadingInhabitantsPurok" outlined>
            <v-card-title>Inhabitants and households per purok</v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <ve-histogram :data="totalInhabitantsPurok"></ve-histogram>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex md4 xs12>
          <v-card :loading="loadingGender" outlined>
            <v-card-title>Gender</v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <ve-pie :data="gender"></ve-pie>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex md4 xs12>
          <v-card :loading="loadingRegVoters" outlined>
            <v-card-title>Registered voters</v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <ve-pie :data="regVoters"></ve-pie>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex md12 xs12>
          <v-card :loading="loadingReligions" outlined>
            <v-card-title>Religions</v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <ve-pie :data="religions"></ve-pie>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex md12 xs12>
          <v-card :loading="loadingEthnicGroups" outlined>
            <v-card-title>Ethnic group</v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <ve-pie :data="ethnicGroups"></ve-pie>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex md12 xs12>
          <v-card :loading="loadingDialects" outlined>
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
      loadingInhabitants: true,
      loadingHousehold: true,
      loadingPurok: true,
      loadingInhabitantsPurok: true,
      loadingGender: true,
      loadingRegVoters: true,
      loadingReligions: true,
      loadingEthnicGroups: true,
      loadingDialects: true,
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
      axios.get("api/Inhabitants").then(response => {
        this.inhabitant = response.data;
        this.loadingInhabitants = false;
      });
    },
    getHouseholds() {
      axios.get("api/Households").then(response => {
        this.household = response.data;
        this.loadingHousehold = false;
      });
    },
    getPuroks() {
      axios.get("api/Puroks").then(response => {
        this.purok = response.data;
        this.loadingPurok = false;
      });
    },
    getHouseholdsPurok() {
      axios.get("api/HouseholdsPurok").then(response => {
        this.totalInhabitantsPurok.rows = response.data;
        this.loadingInhabitantsPurok = false;
      });
    },
    getReligion() {
      axios.get("api/Religion").then(response => {
        this.religions.rows = response.data;
        this.loadingReligions = false;
      });
    },
    getRegisteredVoter() {
      axios.get("api/RegisteredVoter").then(response => {
        this.regVoters.rows = response.data;
        this.loadingRegVoters = false;
      });
    },
    getDialects() {
      axios.get("api/Dialects").then(response => {
        this.dialects.rows = response.data;
        this.loadingDialects = false;
      });
    },
    getGender() {
      axios.get("api/Gender").then(response => {
        this.gender.rows = response.data;
        this.loadingGender = false;
      });
    },

    getEthnicGroup() {
      axios.get("api/EthnicGroup").then(response => {
        this.ethnicGroups.rows = response.data;
        this.loadingEthnicGroups = false;
      });
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
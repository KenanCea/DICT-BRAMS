<template>
  <v-app>
    <v-container grid-list-xl fluid>
      <v-layout row wrap>
        <v-flex lg4 sm6 xs12>
          <v-card>
            <v-card-text class="pa-0">
              <v-container class="pa-0">
                <div class="layout row ma-0">
                  <div class="sm6 xs6 flex">
                    <div class="layout column ma-0 justify-center align-center">
                      <v-icon size="56px" color="red darken-1">mdi-account</v-icon>
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
        <v-flex lg4 sm6 xs12>
          <v-card>
            <v-card-text class="pa-0">
              <v-container class="pa-0">
                <div class="layout row ma-0">
                  <div class="sm6 xs6 flex">
                    <div class="layout column ma-0 justify-center align-center">
                      <v-icon size="56px" color="pink darken-1">mdi-account</v-icon>
                    </div>
                  </div>
                  <div class="sm6 xs6 flex text-sm-center py-3 white--text pink darken-1">
                    <div class="headline">{{child}}</div>
                    <span class="caption">Children</span>
                  </div>
                </div>
              </v-container>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex lg4 sm6 xs12>
          <v-card>
            <v-card-text class="pa-0">
              <v-container class="pa-0">
                <div class="layout row ma-0">
                  <div class="sm6 xs6 flex">
                    <div class="layout column ma-0 justify-center align-center">
                      <v-icon size="56px" color="purple darken-1">mdi-account</v-icon>
                    </div>
                  </div>
                  <div class="sm6 xs6 flex text-sm-center py-3 white--text purple darken-1">
                    <div class="headline">{{senior}}</div>
                    <span class="caption">Seniors</span>
                  </div>
                </div>
              </v-container>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex lg4 sm6 xs12>
          <v-card>
            <v-card-text class="pa-0">
              <v-container class="pa-0">
                <div class="layout row ma-0">
                  <div class="sm6 xs6 flex">
                    <div class="layout column ma-0 justify-center align-center">
                      <v-icon size="56px" color="deep-purple darken-1">mdi-home</v-icon>
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
        <v-flex lg4 sm6 xs12>
          <v-card>
            <v-card-text class="pa-0">
              <v-container class="pa-0">
                <div class="layout row ma-0">
                  <div class="sm6 xs6 flex">
                    <div class="layout column ma-0 justify-center align-center">
                      <v-icon size="56px" color="indigo darken-1">mdi-home-group</v-icon>
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

        <v-flex xs6>
          <v-card>
            <v-toolbar flat dense>
              <v-toolbar-title>
                <h4>Inhabitants and Households per Purok</h4>
              </v-toolbar-title>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text>
              <ve-histogram :data="totalInhabitantsPurok"></ve-histogram>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs6>
          <v-card>
            <v-toolbar flat dense>
              <v-toolbar-title>
                <h4>Religions</h4>
              </v-toolbar-title>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text>
              <ve-pie :data="religions"></ve-pie>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs6>
          <v-card>
            <v-toolbar flat dense>
              <v-toolbar-title>
                <h4>Ethnic Group</h4>
              </v-toolbar-title>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text>
              <ve-histogram :data="ethnicGroups"></ve-histogram>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex xs4>
          <v-card>
            <v-toolbar flat dense>
              <v-toolbar-title>
                <h4>Gender Population Summary</h4>
              </v-toolbar-title>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text>
              <ve-pie :data="gender"></ve-pie>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex xs4>
          <v-card>
            <v-toolbar flat dense>
              <v-toolbar-title>
                <h4>Registered Voters</h4>
              </v-toolbar-title>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text>
              <ve-pie :data="regVoters"></ve-pie>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs4>
          <v-card>
            <v-toolbar flat dense>
              <v-toolbar-title>
                <h4>Dialects</h4>
              </v-toolbar-title>
            </v-toolbar>
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
      senior: "",
      child: "",
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
    this.getChildren();
    this.getSeniors();
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
    getSeniors() {
      axios.get("api/Seniors").then(response => (this.senior = response.data));
    },
    getChildren() {
      axios.get("api/Children").then(response => (this.child = response.data));
    },
    getHouseholdsPurok() {
      axios
        .get("api/HouseholdsPurok")
        .then(response => (this.totalInhabitantsPurok.rows = response.data));
    },
    getReligion(){
      axios  
        .get("api/Religion")
        .then(response => (this.religions.rows = response.data));
    },
    getRegisteredVoter(){
      axios  
        .get("api/RegisteredVoter")
        .then(response => (this.regVoters.rows = response.data));
    },
    getDialects(){
      axios  
        .get("api/Dialects")
        .then(response => (this.dialects.rows = response.data));
    },
    getGender(){
      axios  
        .get("api/Gender")
        .then(response => (this.gender.rows = response.data));
    },
    
    getEthnicGroup(){
      axios  
        .get("api/EthnicGroup")
        .then(response => (this.ethnicGroups.rows = response.data));
    },
  }
};
</script>
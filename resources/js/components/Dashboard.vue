<template>
  <v-app>
    <v-container grid-list-xl fluid>
      <v-layout row wrap>
        <v-flex lg4 sm6 xs12>
          <mini-statistic icon="mdi-account" v-bind:title='inhabitant' sub-title="Inhabitants" color="indigo"></mini-statistic>
        </v-flex>
        <v-flex lg4 sm6 xs12>
          <mini-statistic icon="mdi-account" v-bind:title="child" sub-title="Children" color="orange"></mini-statistic>
        </v-flex>
        <v-flex lg4 sm6 xs12>
          <mini-statistic icon="mdi-account" v-bind:title="senior" sub-title="Seniors" color="black"></mini-statistic>
        </v-flex>
        <v-flex lg4 sm6 xs12>
          <mini-statistic icon="mdi-home" v-bind:title='household' sub-title="Households" color="purple"></mini-statistic>
        </v-flex>
        <v-flex lg4 sm6 xs12>
          <mini-statistic icon="mdi-home-group" v-bind:title="purok" sub-title="Puroks / Sitios" color="light-blue"></mini-statistic>
        </v-flex>
        
        <v-flex xs6>
          <v-card>
            <v-toolbar color="transparent" flat dense flat>
              <v-toolbar-title>
                <h4>Total Inhabitants Per Purok</h4>
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
            <v-toolbar color="transparent" flat dense flat>
              <v-toolbar-title>
                <h4>Total Households Per Purok</h4>
              </v-toolbar-title>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text>
              <ve-histogram :data="totalHouseholdsPurok"></ve-histogram>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs6>
          <v-card>
            <v-toolbar color="transparent" flat dense flat>
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
        <v-flex xs6>
          <v-card>
            <v-toolbar color="transparent" flat dense flat>
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
        <v-flex xs4>
          <v-card>
            <v-toolbar color="transparent" flat dense flat>
              <v-toolbar-title>
                <h4>Male and Female</h4>
              </v-toolbar-title>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text>
              <ve-pie :data="maleFemale"></ve-pie>
            </v-card-text>
          </v-card>
        </v-flex>
        
        
        <v-flex xs4>
          <v-card>
            <v-toolbar color="transparent" flat dense flat>
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
            <v-toolbar color="transparent" flat dense flat>
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
import MiniStatistic from "./widgets/MiniStatistic";
import Material from "vuetify/es5/util/colors";
import VeHistogram from "v-charts/lib/histogram.common";
import VePie from "v-charts/lib/pie.common";
export default {
  components: {
    MiniStatistic,
    VeHistogram,
    VePie
  },
  data() {
    return {
      inhabitant: '',
      household: '',
      purok: '',
      senior: '',
      child: '',
      color: Material,
      totalInhabitantsPurok: {
        columns: ["Purok", "Inhabitants"],
        rows: [
          {
            Purok: "1",
            Inhabitants: 50
          },
          {
            Purok: "2",
            Inhabitants: 250
          },
          {
            Purok: "3",
            Inhabitants: 155
          },
          {
            Purok: "4",
            Inhabitants: 400
          }
        ]
      },
      totalHouseholdsPurok: {
        columns: ["Purok", "Households"],
        rows: [
          {
            Purok: "1",
            Households: 7
          },
          {
            Purok: "2",
            Households: 5
          },
          {
            Purok: "3",
            Households: 11
          },
          {
            Purok: "4",
            Households: 9
          }
        ]
      },
      ethnicGroups: {
        columns: ["Ethnic Group", "Total"],
        rows: [
          {
            "Ethnic Group": "Maranao",
            Total: 21
          },
          {
            "Ethnic Group": "Ibaloi",
            Total: 23
          },
          {
            "Ethnic Group": "Tagalog",
            Total: 61
          },
          {
            "Ethnic Group": "Ilocano",
            Total: 43
          }
        ]
      },
      maleFemale: {
        columns: ["Gender", "Total"],
        rows: [
          { "Gender": "Male", "Total": 550 },
          { "Gender": "Female", "Total": 305}
        ]
      },
      regVoters: {
        columns: ["Registered", "Total"],
        rows: [
          { "Registered": "Yes", "Total": 350 },
          { "Registered": "No", "Total": 401 }
        ]
      },
      religions: {
        columns: ["Name", "Total"],
        rows: [
          { "Name": "Islam", "Total": 36 },
          { "Name": "Mormons", "Total": 37 },
          { "Name": "Church of Christ", "Total": 37 },
          { "Name": "Islam", "Total": 30 },
          { "Name": "Iglesia ni Cristo", "Total": 36 },
          { "Name": "Roman Catholic", "Total": 96 },
          { "Name": "Born Again Christian", "Total": 46 }
        ]
      },
      dialects: {
        columns: ["Name", "Total"],
        rows: [
          { "Name": "Visaya", "Total": 26 },
          { "Name": "Cebuano", "Total": 29 },
          { "Name": "Ifugao", "Total": 27 },
          { "Name": "Kapangpangan", "Total": 18 },
          { "Name": "English", "Total": 58 },
          { "Name": "Tagalog", "Total": 66 },
          { "Name": "Ilocano", "Total": 44 }
        ]
      }
    };
  },
  created() {
    this.getInhabitants();
    this.getHouseholds();
    this.getPuroks();
    this.getSeniors();
    this.getChildren();
  },
  methods:{
    getInhabitants() {
      axios.post("api/Inhabitants").then(response => (this.inhabitant = response.data));
    },
    getHouseholds() {
      axios.post("api/Households").then(response => (this.household = response.data));
    },
    getPuroks() {
      axios.post("api/Puroks").then(response => (this.purok = response.data));
    },
    getSeniors() {
      axios.post("api/Seniors").then(response => (this.senior = response.data));
    },
    getChildren() {
      axios.post("api/Children").then(response => (this.child = response.data));
    }
  }
};
</script>
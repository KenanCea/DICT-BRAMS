<template>
  <v-app>
    <v-container grid-list-xl fluid>
      <v-layout row wrap>
        <v-flex lg4 sm6 xs12>
          <mini-statistic icon="person" v-bind:title='inhabitant' sub-title="Inhabitants" color="indigo"></mini-statistic>
        </v-flex>
        <v-flex lg4 sm6 xs12>
          <mini-statistic icon="people" v-bind:title='household' sub-title="Households" color="purple"></mini-statistic>
        </v-flex>
        <v-flex lg4 sm6 xs12>
          <mini-statistic icon="map" title="" sub-title="Purok / Sitio" color="light-blue"></mini-statistic>
        </v-flex>
        <v-flex lg8 sm12 xs12>
          <v-card>
            <v-toolbar color="transparent" flat dense card>
              <v-toolbar-title>
                <h4>Statistics</h4>
              </v-toolbar-title>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text>
              <ve-histogram :data="histogramData"></ve-histogram>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex lg4 sm12 xs12>
          <v-card>
            <v-toolbar color="transparent" flat dense card>
              <v-toolbar-title>
                <h4>Population Summary</h4>
              </v-toolbar-title>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text>
              <ve-ring :data="ringData"></ve-ring>
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
import VeRing from "v-charts/lib/ring.common";
export default {
  components: {
    MiniStatistic,
    VeHistogram,
    VeRing
  },
  data() {
    return {
      inhabitant: '',
      household: '',
      color: Material,
      histogramData: {
        columns: ["Purok", "Male", "Female"],
        rows: [
          {
            Purok: "1",
            Male: 50,
            Female: 32
          },
          {
            Purok: "2",
            Male: 250,
            Female: 200
          },
          {
            Purok: "3",
            Male: 155,
            Female: 190
          },
          {
            Purok: "4",
            Male: 400,
            Female: 230
          }
        ]
      },
      ringData: {
        columns: ["Purok", "cost"],
        rows: [
          { Purok: "1", cost: 123 },
          { Purok: "2", cost: 22},
          { Purok: "3", cost: 153 },
          { Purok: "4", cost: 43 },
          { Purok: "5", cost: 43 },
          { Purok: "6", cost: 23 }
        ]
      }
    };
  },
  created(){
    this.getInhabitants();
    this.getHouseholds();
  },
  methods:{
    getInhabitants(){
      axios.post("api/Inhabitants").then(response => (this.inhabitant = response.data));
    },
    getHouseholds(){
      axios.post("api/Households").then(response => (this.household = response.data));
    }
  }
};
</script>
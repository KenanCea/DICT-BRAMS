<template>
  <v-app>
    <v-container grid-list-xl fluid>
      <v-layout row wrap>
      <v-flex lg4 sm6 xs12>
          <mini-statistic icon="mdi-home-city" v-bind:title='barangay' sub-title="Barangays of Baguio" color="indigo"></mini-statistic>
        </v-flex>
        <v-flex lg4 sm6 xs12>
          <mini-statistic icon="mdi-account" v-bind:title='inhabitant' sub-title="Inhabitants of Baguio" color="indigo"></mini-statistic>
        </v-flex>
        <v-flex lg4 sm6 xs12>
          <mini-statistic icon="mdi-account" v-bind:title="child" sub-title="Children's of Baguio" color="orange"></mini-statistic>
        </v-flex>
        <v-flex lg4 sm6 xs12>
          <mini-statistic icon="mdi-account" v-bind:title="senior" sub-title="Seniors of Baguio" color="black"></mini-statistic>
        </v-flex>
        <v-flex lg4 sm6 xs12>
          <mini-statistic icon="mdi-home" v-bind:title='household' sub-title="Households of Baguio" color="purple"></mini-statistic>
        </v-flex>
       

      </v-layout>
    </v-container>
  </v-app>
</template>

<script>
import MiniStatistic from "./widgets/MiniStatistic";
import Material from "vuetify/es5/util/colors";
export default {
  components: {
    MiniStatistic,
  },
  data() {
    return {
      barangay: '',
      inhabitant: '',
      household: '',
      senior: '',
      child: '',
      color: Material,
    };
  },
  created() {
    this.getBarangays();
    this.getInhabitants();
    this.getHouseholds();
    this.getSeniors();
    this.getChildren();
  },
  methods:{
      getBarangays() {
      axios.post("api/Barangays").then(response => (this.barangay = response.data));
    },
    getInhabitants() {
      axios.post("api/Inhabitants").then(response => (this.inhabitant = response.data));
    },
    getHouseholds() {
      axios.post("api/Households").then(response => (this.household = response.data));
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
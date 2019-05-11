<template>
<<<<<<< HEAD
<<<<<<< HEAD
  <v-app>
    <v-container grid-list-xl fluid>
      <v-layout row wrap>
        <v-flex lg4 sm6 xs12>
          <mini-statistic icon="mdi-account" v-bind:title='inhabitant' sub-title="Inhabitants" color="indigo"></mini-statistic>
        </v-flex>
        <v-flex lg4 sm6 xs12>
          <mini-statistic icon="mdi-account" v-bind:title="child" sub-title="Children" color="yellow"></mini-statistic>
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
            <v-toolbar color="transparent" flat dense card>
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
            <v-toolbar color="transparent" flat dense card>
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
            <v-toolbar color="transparent" flat dense card>
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
            <v-toolbar color="transparent" flat dense card>
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
            <v-toolbar color="transparent" flat dense card>
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
            <v-toolbar color="transparent" flat dense card>
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
            <v-toolbar color="transparent" flat dense card>
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
=======
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span class="hidden-sm-and-down">Dashboard</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-icon>mdi-refresh</v-icon>
    </v-app-bar>

  </div>
>>>>>>> parent of a43aa4b... added dashboard and fix Barangay Clearance
</template>

<script>
export default {
  data() {
    const srcs = {
      1: "https://cdn.vuetifyjs.com/images/lists/1.jpg",
      2: "https://cdn.vuetifyjs.com/images/lists/2.jpg",
      3: "https://cdn.vuetifyjs.com/images/lists/3.jpg",
      4: "https://cdn.vuetifyjs.com/images/lists/4.jpg",
      5: "https://cdn.vuetifyjs.com/images/lists/5.jpg"
    };

    return {

      friends: [],

      name: "Midnight Crew",
      people: [
        { header: "Group 1" },
        { name: "Sandra Adams", group: "Group 1", avatar: srcs[1] },
        { name: "Ali Connors", group: "Group 1", avatar: srcs[2] },
        { name: "Trevor Hansen", group: "Group 1", avatar: srcs[3] },
        { name: "Tucker Smith", group: "Group 1", avatar: srcs[2] },
        { divider: true },
        { header: "Group 2" },
        { name: "Britta Holt", group: "Group 2", avatar: srcs[4] },
        { name: "Jane Smith ", group: "Group 2", avatar: srcs[5] },
        { name: "John Smith", group: "Group 2", avatar: srcs[1] },
        { name: "Sandra Williams", group: "Group 2", avatar: srcs[3] }
      ],
      title: "The summer breeze"
    };
  },

  watch: {
    isUpdating(val) {
      if (val) {
        setTimeout(() => (this.isUpdating = false), 3000);
      }
    }
  },
<<<<<<< HEAD
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
=======
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span class="hidden-sm-and-down">Dashboard</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-icon>mdi-refresh</v-icon>
    </v-app-bar>

  </div>
</template>

<script>
export default {
  data() {
    const srcs = {
      1: "https://cdn.vuetifyjs.com/images/lists/1.jpg",
      2: "https://cdn.vuetifyjs.com/images/lists/2.jpg",
      3: "https://cdn.vuetifyjs.com/images/lists/3.jpg",
      4: "https://cdn.vuetifyjs.com/images/lists/4.jpg",
      5: "https://cdn.vuetifyjs.com/images/lists/5.jpg"
    };

    return {

      friends: [],

      name: "Midnight Crew",
      people: [
        { header: "Group 1" },
        { name: "Sandra Adams", group: "Group 1", avatar: srcs[1] },
        { name: "Ali Connors", group: "Group 1", avatar: srcs[2] },
        { name: "Trevor Hansen", group: "Group 1", avatar: srcs[3] },
        { name: "Tucker Smith", group: "Group 1", avatar: srcs[2] },
        { divider: true },
        { header: "Group 2" },
        { name: "Britta Holt", group: "Group 2", avatar: srcs[4] },
        { name: "Jane Smith ", group: "Group 2", avatar: srcs[5] },
        { name: "John Smith", group: "Group 2", avatar: srcs[1] },
        { name: "Sandra Williams", group: "Group 2", avatar: srcs[3] }
      ],
      title: "The summer breeze"
    };
  },

  watch: {
    isUpdating(val) {
      if (val) {
        setTimeout(() => (this.isUpdating = false), 3000);
      }
    }
  },
=======
>>>>>>> parent of a43aa4b... added dashboard and fix Barangay Clearance

  methods: {
    remove(item) {
      const index = this.friends.indexOf(item.name);
      if (index >= 0) this.friends.splice(index, 1);
<<<<<<< HEAD
>>>>>>> c23e70b3992b1b81ab0a08ad3ead82358b36d6fe
=======
>>>>>>> parent of a43aa4b... added dashboard and fix Barangay Clearance
    }
  }
};
</script>
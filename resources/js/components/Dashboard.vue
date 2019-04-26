<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span class="hidden-sm-and-down">Dashboard</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-icon>mdi-refresh</v-icon>
    </v-app-bar>

    <v-data-table
      :headers="headers"
      :items="inhabitants.data"
      :items-per-page="inhabitants.per_page"
      :page="inhabitants.current_page"
      :server-items-length="inhabitants.total"
    ></v-data-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      headers: [
        { text: "First Name", value: "first_name" },
        { text: "Middle Name", value: "middle_name" },
        { text: "Last Name", value: "last_name" }
      ],
      inhabitants: {}
    };
  },
  created() {
    this.getInhabitant();
  },
  methods: {
    getInhabitant() {
      axios.get("api/inhabitant").then(response => {
        this.inhabitants = response.data;
      });
    }
  }
};
</script>
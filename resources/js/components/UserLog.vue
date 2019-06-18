<template>
  <div id="app">
    <v-app>
      <div class="elevation-1">
        <v-card>
          <v-app-bar id="navbar" dense flat app>
            <v-toolbar-title>
              <span>{{Table}}</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>
          </v-app-bar>

          <v-data-table :items="logs" :loading="loading" :search="search" v-bind:headers="headers">
            <template v-slot:items="props">
              <td>{{ props.item.date }}</td>
              <td>{{ props.item.time }}</td>
              <td>{{ props.item.log }}</td>
            </template>
          </v-data-table>
        </v-card>
      </div>
    </v-app>
  </div>
</template>
<script>
export default {
  data: () => ({
    Table: "Log History",
    search: "",
    loading: false,
    logs: [],
    headers: [
      {
        text: "Date",
        value: "date",
        selected: true,
        sortable: true
      },
      {
        text: "Time",
        value: "time",
        selected: true,
        sortable: true
      },
      {
        text: "Log",
        value: "log",
        selected: true,
        sortable: true
      }
    ]
  }),
  created() {
    this.loadQuery();
  },
  methods: {
    loadQuery() {
      this.loading = true;
      axios.get("api/Logs").then(response => {
        this.logs = response.data;
        this.loading = false;
      });
    }
  }
};
</script>

<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span>Log History</span>
      </v-toolbar-title>

      <v-spacer></v-spacer>

      <v-flex xs2 ml-1>
          <v-text-field
            v-model="search"
            flat
            outlined
            single-line
            hide-details
            height="32"
            append-icon="mdi-magnify"
            label="Search"
          ></v-text-field>
        </v-flex>
    </v-app-bar>

    <v-data-table
      v-model="selected"
      v-bind:headers="filteredHeaders"
      :items="users"
      :search="search"
      :loading="loading"
    >
      <template v-slot:items="props">
        <td v-if="showColumn('id')">{{ props.item.name }}</td>
        <td v-if="showColumn('name')">{{ props.item.date }}</td>
        <td v-if="showColumn('email')">{{ props.item.time }}</td>
        <td v-if="showColumn('email_verified_at')">{{ props.item.log }}</td>
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: [],
      dialogAccounts: false,
      selected: [],
      search: "",
      form: new Form({
        name: "",
        email: "",   
      }),
      headers: [
        { text: "Account", value: "name", selected: true },
        { text: "Date", value: "date", selected: true },
        { text: "Time", value: "time", selected: true },
        { text: "Logs", value: "log", selected: true }
      ]
    };
  },

  computed: {
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

  created() {
    this.getAccounts();
  },

  methods: {
    getAccounts() {
      this.loading = true;
      axios.get("api/AdminLogs").then(response => {
        this.users = response.data;
        this.loading = false;
      });
    },
    showColumn(col) {
      return this.headers.find(h => h.value === col).selected;
    }
  }
};
</script>
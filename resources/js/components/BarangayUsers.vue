<template>
  <div class="elevation-1">

    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span class="hidden-sm-and-down">Users</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <!--<v-tooltip bottom>
        <template v-slot:activator="{ on }">
          <v-btn text icon color="primary" v-on="on" @click="dialog = true">
            <v-icon color="grey darken-2">mdi-home-plus</v-icon>
          </v-btn>
        </template>
        <span>Add New Inhabitant</span>
      </v-tooltip> 
      <v-menu :close-on-content-click="false" offset-y max-height="400">
        <template #activator="{ on: menu }">
          <v-tooltip bottom>
            <template #activator="{ on: tooltip }">
              <v-btn text icon color="primary" v-on="{ ...tooltip, ...menu }">
                <v-icon color="grey darken-2">mdi-table-column</v-icon>
              </v-btn>
            </template>
            <span>Column Visibility</span>
          </v-tooltip>
        </template>
        <v-list>
          <v-list-item v-for="(item, index) in headers" :key="index">
            <v-switch
              color="green"
              v-bind:label="item.text"
              v-model="item.selected"
              :value="item.selected"
            ></v-switch>
          </v-list-item>
        </v-list>
      </v-menu>-->
      <v-tooltip bottom>
        <template v-slot:activator="{ on }">
          <v-btn text icon color="primary" v-on="on" @click="getBarangayUsers()">
            <v-icon color="grey darken-2">mdi-refresh</v-icon>
          </v-btn>
        </template>
        <span>Refresh</span>
      </v-tooltip>
    </v-app-bar>

    <v-data-table
      id="printTable"
      v-bind:headers="filteredHeaders"
      :items="barangays"
      :loading="loading"
    >
      <template v-slot:items="props">
        <td v-if="showColumn('id')">{{ props.item.id }}</td>
        <td v-if="showColumn('name')">{{ props.item.name }}</td>
        <td v-if="showColumn('email')">{{ props.item.email }}</td>
        <td v-if="showColumn('email_verified_at')">{{ props.item.email_verified_at }}</td>
        <td v-if="showColumn('password')">{{ props.item.password }}</td>
        <td v-if="showColumn('disable')">{{ props.item.disable }}</td>
        <td v-if="showColumn('created_at')">{{ props.item.created_at }}</td>
        <td v-if="showColumn('updated_at')">{{ props.item.updated_at }}</td>
      </template>
      <template v-slot:item.column.action="{ item }">
        <v-icon small @click="resetPassword(item.id)">mdi-lock-reset</v-icon>
        <v-icon small @click="disableUser(item.id)">mdi-account-remove</v-icon>
        <v-icon small @click="archive(item.id)">mdi-delete</v-icon>
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data: () => ({
    Orientation:'landscape',
    headers: [
      { text: "id", value: "id" , selected: true },
      { text: "Name", value: "name", selected: true },
      { text: "Email", value: "email", selected: true },
      { text: "Email Verified Date", value: "email_verified_at", selected: true },
      { text: "Password", value: "password", selected: true },
      { text: "Disable", value: "disable", selected: true },
      { text: "Created at", value: "created_at", selected: true },
      { text: "Updated at", value: "updated_at" , selected: true },
      { text: "Actions", value: "action", selected: true}
    ],
    barangays: [],
    loading: false,
    dialog: false,
  }),
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
    this.getBarangayUsers();
  },

  methods: {
    getBarangayUsers() {
      this.loading = true;
      axios.get("api/barangay").then(response => {
        this.barangays = response.data;
        this.loading = false;
      });
    },

    showColumn(col) {
      return this.headers.find(h => h.value === col).selected;
    },

    disableUser(id){
      axios.post("api/barangay/disable/"+id)
      this.getBarangayUsers();
    },

    archive(id) {
      axios.post("api/barangay/archived/"+ id )
      this.getBarangayUsers();
    }
  }
};
</script>
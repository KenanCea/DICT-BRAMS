<template>
  <div>
    <div v-if="$gate.isAdmin()">
      <v-app-bar id="navbar" dense flat app>
        <v-toolbar-title>
          <span>{{ selected.length ? `${selected[0].name}` : 'Users' }}</span>
        </v-toolbar-title>

        <v-spacer></v-spacer>

        <span v-if="selected.length">
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn v-on="on" icon @click="selected = []">
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </template>
            <span>Clear selected</span>
          </v-tooltip>
        </span>

        <v-divider v-if="selected.length" class="ml-1" inset vertical></v-divider>

        <div v-if="selected.length" class="ml-1">
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn v-on="on" v-if="selected.length" icon @click="restore(selected[0].id)">
                <v-icon>mdi-restore</v-icon>
              </v-btn>
            </template>
            <span>Restore User</span>
          </v-tooltip>
        </div>

        <div class="ml-1">
          <v-menu :close-on-content-click="false" offset-y max-height="400">
            <template #activator="{ on: menu }">
              <v-tooltip bottom>
                <template #activator="{ on: tooltip }">
                  <v-btn icon v-on="{ ...tooltip, ...menu }">
                    <v-icon>mdi-table-column-width</v-icon>
                  </v-btn>
                </template>
                <span>Column visibility</span>
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
          </v-menu>
        </div>

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
        show-select
        single-select
      >
        <template v-slot:items="props">
          <td v-if="showColumn('id')">{{ props.item.id }}</td>
          <td v-if="showColumn('name')">{{ props.item.name }}</td>
          <td v-if="showColumn('email')">{{ props.item.email }}</td>
          <td v-if="showColumn('email_verified_at')">{{ props.item.email_verified_at }}</td>
          <td v-if="showColumn('created_at')">{{ props.item.created_at }}</td>
          <td v-if="showColumn('updated_at')">{{ props.item.updated_at }}</td>
          <td v-if="showColumn('disable')">{{ props.item.disable }}</td>
        </template>
      </v-data-table>
    </div>
    <div v-if="!$gate.isAdmin()">
      <not-found></not-found>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: [],
      selected: [],
      search: "",
      form: new Form({
        name: "",
        email: ""
      }),
      headers: [
        { text: "Barangay Name", value: "name", selected: true },
        { text: "Barangay Email", value: "email", selected: true },
        {
          text: "Email Verified At",
          value: "email_verified_at",
          selected: true
        },
        { text: "Created At", value: "created_at", selected: true },
        { text: "Updated At", value: "updated_at", selected: true },
        { text: "State", value: "disable", selected: true }
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
    if (this.$gate.isAdmin()) {
      this.getAccounts();
    }
  },

  methods: {
    getAccounts() {
      this.loading = true;
      axios.get("api/archivedUsers").then(response => {
        this.users = response.data;
        this.loading = false;
      });
    },

    restore(id) {
      axios.post("api/barangay/restore/" + id).then(response => {
        this.getAccounts();
        toast.fire({
          type: "success",
          title: "User has been restored"
        });
        this.selected.splice([0]);
      });
    },

    showColumn(col) {
      return this.headers.find(h => h.value === col).selected;
    }
  }
};
</script>
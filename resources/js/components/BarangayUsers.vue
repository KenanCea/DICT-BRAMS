<template>
  <div>
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
            <v-btn v-on="on" v-if="selected.length" icon @click="archive(selected[0].id)">
              <v-icon>mdi-archive</v-icon>
            </v-btn>
          </template>
          <span>Archive User</span>
        </v-tooltip>
      </div>

      <div v-if="selected.length" class="ml-1">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" v-if="selected.length" icon @click="disable(selected[0].id)">
              <v-icon>mdi-account-remove</v-icon>
            </v-btn>
          </template>
          <span>Disable/Enable User</span>
        </v-tooltip>
      </div>

      <div v-if="selected.length" class="ml-1">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" v-if="selected.length" icon @click="resetPassword(selected[0].id)">
              <v-icon>mdi-lock-reset</v-icon>
            </v-btn>
          </template>
          <span>Rest User password</span>
        </v-tooltip>
      </div>

      <div class="ml-1">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="newDialog()">
              <v-icon>mdi-home-plus</v-icon>
            </v-btn>
          </template>
          <span>Add new User</span>
        </v-tooltip>
      </div>

      <v-divider class="ml-1" inset vertical></v-divider>

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

      <v-flex xs12 sm6 md2 ml-1>
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

    <v-dialog v-model="dialogAccounts" persistent scrollable max-width="400px">
      <v-form @submit.prevent="createUser()">
        <v-card>
          <v-card-title>
            <span class="headline">Add User</span>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex>
                  <v-text-field v-model="form.name" label="name"></v-text-field>
                </v-flex>
                <v-flex>
                  <v-text-field v-model="form.email" label="email"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-select
                    v-model="form.roles"
                    :items="['user','admin']"
                    label="role"
                  ></v-select>
                </v-flex>
             </v-layout>
            </v-container>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialogAccounts=false">Cancel</v-btn>
            <v-btn color="blue darken-1" text type="submit">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>

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
        password: "",
        roles: ""        
      }),
      headers: [
        { text: "id", value: "id", selected: true },
        { text: "Name", value: "name", selected: true },
        { text: "Email", value: "email", selected: true },
        { text: "Email Verified", value: "email_verified_at", selected: true },
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
    this.getAccounts();
  },

  methods: {
    getAccounts() {
      this.loading = true;
      axios.get("api/barangay").then(response => {
        this.users = response.data;
        this.loading = false;
      });
    },

    createUser() {
      this.form
        .post("api/barangay")
        .then(() => {
          this.dialogAccounts = false;
          this.getAccounts();
          toast.fire({
            type: "success",
            title: "User has been created"
          });
        })
        .catch(() => {});
    },

    archive(id) {
      axios.post("api/barangay/archived/" + id).then(response => {
        this.getAccounts();
        toast.fire({
          type: "success",
          title: "User has been archived"
        });
        this.selected.splice([0]);
      });
    },

    disable(id) {
      axios.post("api/barangay/disable/" + id).then(response => {
        this.getAccounts();
        toast.fire({
          type: "success",
          title: "User has been disabled"
        });
        this.selected.splice([0]);
      });
    },

    resetPassword(id) {
      axios.post("api/barangay/reset/" + id).then(response => {
        this.getAccounts();
        toast.fire({
          type: "success",
          title: "User password has been reset"
        });
        this.selected.splice([0]);
      });
    },

    newDialog() {
      this.editmode = false;
      this.form.reset();
      this.dialogAccounts = true;
    },

    showColumn(col) {
      return this.headers.find(h => h.value === col).selected;
    }
  }
};
</script>
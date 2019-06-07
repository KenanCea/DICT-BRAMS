<template>
  <div>
    <v-app-bar id="navbar" dense flat app>
      <v-toolbar-title>
        <span class="hidden-sm-and-down">User Account</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <div>
        <v-tooltip attach bottom>
          <template v-slot:activator="{ on }">
            <v-btn text icon @click="isEditing = !isEditing" v-on="on">
              <v-icon v-if="isEditing">mdi-close</v-icon>
              <v-icon v-else>mdi-pencil</v-icon>
            </v-btn>
          </template>
          <span v-if="isEditing">Cancel</span>
          <span v-else>Edit</span>
        </v-tooltip>
      </div>
      <div class="ml-1">
        <v-tooltip attach bottom>
          <template v-slot:activator="{ on }">
            <v-btn text icon color="primary" v-on="on">
              <v-icon color="grey darken-2">mdi-refresh</v-icon>
            </v-btn>
          </template>
          <span>Refresh</span>
        </v-tooltip>
      </div>
    </v-app-bar>
    <v-container fill-height fluid grid-list-xl class="pl-0">
      <v-layout justify-center wrap>
        <v-flex xs12 md4>
          <v-card outlined>
            <v-card-text class="text-xs-center">
              <v-avatar class="mx-auto d-block" size="150">
                <img :src="getLogo()" alt="Logo">
              </v-avatar>
              <h3 class="mt-2">{{form.name}}</h3>
              <p>{{form.email}}</p>
              <p class="mb-0">Created at</p>
              <p>{{form.created_at}}</p>
              <p class="mb-0">Updated on</p>
              <p>{{form.updated_at}}</p>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 md8>
          <v-card outlined>
            <v-form>
              <v-container>
                <v-layout wrap>
                  <v-flex xs12>
                    <v-text-field v-model="form.name" label="Name" :disabled="!isEditing" required></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field
                      v-model="form.email"
                      label="Email"
                      :disabled="!isEditing"
                      required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <input
                      type="file"
                      name="photo"
                      @change="updateProfile"
                      label="Logo"
                      :disabled="!isEditing"
                      required
                    >
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field
                      v-model="form.password"
                      label="Password  (leave empty if not changing)"
                      :disabled="!isEditing"
                      required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 text-xs-right>
                    <v-btn
                      color="success"
                      type="submit"
                      :disabled="!isEditing"
                      @click.prevent="updateInfo"
                    >Save</v-btn>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-form>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
export default {
  data: () => ({
    form: new Form({
      id: "",
      name: "",
      email: "",
      password: "",
      logo: "",
      created_at: "",
      updated_at: ""
    }),
    isEditing: null
  }),
  created() {
    this.getUser();
  },
  methods: {
    getUser() {
      axios.get("api/profile").then(({ data }) => this.form.fill(data));
    },
    getLogo() {
      let logo =
        this.form.logo.length > 200
          ? this.form.logo
          : "img/profile/" + this.form.logo;
      return logo;
    },
    updateInfo() {
      if (this.form.password == "") {
        this.form.password = undefined;
      }
      this.form.put("api/updateProfile").then(() => {
        toast.fire({
          type: "success",
          title: "User account has been updated"
        });
        this.isEditing = null;
      });
    },

    updateProfile(e) {
      let file = e.target.files[0];
      let reader = new FileReader();
      let limit = 1024 * 1024 * 2;
      if (file["size"] > limit) {
        toast.fire({
          type: "error",
          title: "You are uploading a large file"
        });
        return false;
      }
      reader.onloadend = file => {
        this.form.logo = reader.result;
      };
      reader.readAsDataURL(file);
    }
  }
};
</script>
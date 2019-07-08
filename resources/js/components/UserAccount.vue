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
              <p class="mb-0"><strong>{{barangayForm.zip_code}}</strong></p>
              <p >Zip Code</p>
              <p class="mb-0"><strong>{{barangayForm.region}}</strong></p>
              <p>Region</p>
              <p class="mb-0"><strong>{{barangayForm.province}}</strong></p>
              <p>Province</p>
              <p class="mb-0"><strong>{{barangayForm.municipality}}</strong></p>
              <p>Municipality</p>
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
    <div v-if="$gate.isUser()">
      <v-container grid-list-xl fluid>
        <v-layout row wrap>
          <v-flex md12>
            <v-card>
              <v-layout>
                <v-flex md12>
                  <v-toolbar flat color="white">
                    <v-toolbar-title>Barangay Officials</v-toolbar-title>
                    <v-divider class="mx-3" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-tooltip attach bottom>
                      <template v-slot:activator="{ on }">
                        <v-btn v-on="on" icon @click="newOfficialDialog()">
                          <v-icon>mdi-account-plus</v-icon>
                        </v-btn>
                      </template>
                      <span>Add new official</span>
                    </v-tooltip>
                  </v-toolbar>
                  <v-data-table
                    id="barangayOfficials"
                    :headers="headersOfficials"
                    :items="officials"
                    hide-default-footer
                  >
                    <template v-slot:top>
                      <v-dialog v-model="dialogOfficial" max-width="400px">
                        <v-form
                          ref="officialForm"
                          v-model="validOfficialForm"
                          lazy-validation
                          @submit.prevent="editmode ? updateOfficial() : createOfficial()"
                        >
                          <v-card>
                            <v-card-title>
                              <span class="headline" v-show="!editmode">Add a new official</span>
                              <span class="headline" v-show="editmode">Edit official information</span>
                            </v-card-title>
                            <v-divider></v-divider>
                            <v-card-text>
                              <v-container grid-list-md>
                                <v-layout wrap>
                                  <v-flex xs12 md12>
                                    <v-select
                                      v-model="officialForm.position"
                                      :items="['Punong Barangay', 'Barangay Kagawad','Barangay Treasurer','Barangay Secretary']"
                                      label="Position"
                                      :rules="[v => !!v || 'Position is required']"
                                      required
                                    ></v-select>
                                  </v-flex>
                                  <v-flex xs12 md12>
                                    <v-text-field
                                      v-model="officialForm.name"
                                      label="Barangay Official name"
                                      :rules="[v => !!v || 'Official name is required']"
                                      required
                                    ></v-text-field>
                                  </v-flex>
                                  <v-flex xs12 md6>
                                    <v-text-field
                                      v-model="officialForm.start_term"
                                      prepend-icon="mdi-calendar"
                                      label="Start Term"
                                      v-mask="'####-##-##'"
                                      hint="YYYY-MM-DD format"
                                    ></v-text-field>
                                  </v-flex>
                                  <v-flex xs12 md6>
                                    <v-text-field
                                      v-model="officialForm.end_term"
                                      prepend-icon="mdi-calendar"
                                      label="End Term"
                                      v-mask="'####-##-##'"
                                      hint="YYYY-MM-DD format"
                                    ></v-text-field>
                                  </v-flex>
                                </v-layout>
                              </v-container>
                            </v-card-text>

                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn color="blue darken-1" text @click="cancelOfficial()">Cancel</v-btn>
                              <v-btn
                                color="blue darken-1"
                                :disabled="!validOfficialForm"
                                text
                                type="submit"
                              >Save</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-form>
                      </v-dialog>
                    </template>

                    <template v-slot:items="props">
                      <td>{{ props.item.position }}</td>
                      <td>{{ props.item.name }}</td>
                      <td>{{ props.item.start_term }}</td>
                      <td>{{ props.item.end_term }}</td>
                    </template>

                    <template v-slot:item.action="{ item }">
                      <v-tooltip attach bottom>
                        <template v-slot:activator="{ on }">
                          <v-btn text icon @click="editOfficialDialog(item)">
                            <v-icon>mdi-pencil</v-icon>
                          </v-btn>
                        </template>
                        <span>Edit official</span>
                      </v-tooltip>
                      <v-tooltip attach bottom>
                        <template v-slot:activator="{ on }">
                          <v-btn text icon @click="deleteOfficials(item)">
                            <v-icon>mdi-delete</v-icon>
                          </v-btn>
                        </template>
                        <span>Delete official</span>
                      </v-tooltip>
                    </template>
                  </v-data-table>
                </v-flex>
              </v-layout>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </div>
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
    barangayForm: new Form({
      id: "",
      municipality: "",
      province: "",
      region: "",
      zip_code: ""
    }),
    isEditing: null,
    editmode: false,
    Table: "Officials",
    Orientation: "landscape",
    dialogOfficial: false,
    headersOfficials: [
      { text: "Position", value: "position", align: "center", sortable: false },
      { text: "Name", value: "name", align: "center", sortable: false },
      {
        text: "Start Term",
        value: "start_term",
        align: "center",
        sortable: false
      },
      { text: "End Term", value: "end_term", align: "center", sortable: false },
      { text: "Actions", value: "action", align: "center", sortable: false }
    ],
    officials: [],
    calendarStartTerm: false,
    calendarEndTerm: false,
    validOfficialForm: true,
    officialForm: new Form({
      id: "",
      position: "",
      name: "",
      start_term: "",
      end_term: ""
    })
  }),
  created() {
    this.getUser();
    this.getBarangay();
    this.getOfficials();
  },
  methods: {
    getUser() {
      axios.get("api/profile").then(({ data }) => this.form.fill(data));
    },

    getBarangay() {
      axios
        .get("api/barangayForm")
        .then(({ data }) => this.barangayForm.fill(data));
    },

    getOfficials() {
      axios.get("api/official").then(response => {
        this.officials = response.data;
      });
    },

    getLogo() {
      let logo =
        this.form.logo.length > 200
          ? this.form.logo
          : "img/profile/" + this.form.logo;
      return logo;
    },

    createOfficial(id) {
      if (this.$refs.officialForm.validate()) {
        this.officialForm
          .post("api/official")
          .then(() => {
            this.dialogOfficial = false;
            this.getOfficials();
            this.$refs.officialForm.reset();
            this.officialForm.reset();
            toast.fire({
              type: "success",
              title: "Official has been created"
            });
          })
          .catch(() => {});
      }
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

    updateOfficial() {
      this.officialForm
        .put("api/official/" + this.officialForm.id)
        .then(() => {
          this.dialogOfficial = false;
          this.getOfficials();
          this.$refs.officialForm.reset();
          this.officialForm.reset();
          toast.fire({
            type: "success",
            title: "Official has been edited"
          });
        })
        .catch(() => {});
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
    },

    newOfficialDialog() {
      this.editmode = false;
      this.officialForm.reset();
      this.dialogOfficial = true;
    },

    editOfficialDialog(officials) {
      this.editmode = true;
      this.officialForm.reset();
      this.dialogOfficial = true;
      this.officialForm.fill(officials);
    },
    deleteOfficials(official){
      swal
        .fire({
          title: "Are you sure?",
          text: "This Barangay official will be PERMANENTLY DELETED!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText:"Yes, Delete it!"
        })
        .then(result => {
          if (result.value) {
            axios.delete("api/official/" + official.id).then(response => {
              toast.fire({
                type: "success",
                title: "Barangay Official has been Deleted."
              });
              this.getOfficials();
            });
          }
        });
    },

    cancelOfficial() {
      this.$refs.officialForm.reset();
      this.officialForm.reset();
      this.dialogOfficial = false;
    }
  }
};
</script>


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
              <p class="mb-0">Barangay Code</p>
              <p>{{barangayForm.zip_code}}</p>
              <p class="mb-0">Region</p>
              <p>{{barangayForm.region}}</p>
              <p class="mb-0">Province</p>
              <p>{{barangayForm.province}}</p>
              <p class="mb-0">Municipality</p>
              <p>{{barangayForm.municipality}}</p>
              <p><v-btn to="/barangayprofile" small color="primary">View More</v-btn></p>
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
    <v-container grid-list-xl fluid>
      <v-layout row wrap>
        <v-flex md12>
          <v-card>
            <v-layout>
              <v-flex md12>
                <v-toolbar flat color="white">
                  <v-toolbar-title>Barangay Officials</v-toolbar-title>
                  <v-divider
                    class="mx-3"
                    inset
                    vertical
                  ></v-divider>
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
                  hide-default-footer>
                  <template v-slot:top>
                    <v-dialog v-model="dialogOfficial" max-width="400px">
                      <v-form
                        ref="formOfficials"
                        v-model="valid"
                        lazy-validation 
                        @submit.prevent="editmode ? updateOfficial() : createOfficial()"
                      >
                        <v-card>
                          <v-card-title>
                            <span class="headline" v-show="!editmode">Add a new official</span>
                            <span class="headline" v-show="editmode">Edit official information</span>
                          </v-card-title>
    
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
                                  <v-menu
                                    v-model="calendarStartTerm"
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    eager
                                    transition="scale-transition"
                                    offset-y
                                    full-width
                                    min-width="290px"
                                  >
                                    <template v-slot:activator="{ on }">
                                      <v-text-field
                                        v-model="officialForm.start_term"
                                        label="Start Term"
                                        prepend-icon="mdi-calendar"
                                        readonly
                                        required
                                        v-on="on"
                                        :rules="[v => !!v || 'Start Term Date is required']"
                                      ></v-text-field>
                                    </template>
                                    <v-date-picker
                                      v-model="officialForm.start_term"
                                      no-title
                                      color="primary"
                                      @input="calendarStartTerm = false"
                                    ></v-date-picker>
                                  </v-menu>
                                </v-flex>
                                <v-flex xs12 md6>
                                  <v-menu
                                    v-model="calendarEndTerm"
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    eager
                                    transition="scale-transition"
                                    offset-y
                                    full-width
                                    min-width="290px"
                                  >
                                    <template v-slot:activator="{ on }">
                                      <v-text-field
                                        v-model="officialForm.end_term"
                                        label="End Term"
                                        prepend-icon="mdi-calendar"
                                        readonly
                                        required
                                        v-on="on"
                                        :rules="[v => !!v || 'End Term Date is required']"
                                      ></v-text-field>
                                    </template>
                                    <v-date-picker
                                      v-model="officialForm.end_term"
                                      no-title
                                      color="primary"
                                      @input="calendarEndTerm = false"
                                    ></v-date-picker>
                                  </v-menu>
                                </v-flex>
                              </v-layout>
                            </v-container>
                          </v-card-text>
    
                          <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="dialogOfficial = false">Cancel</v-btn>
                            <v-btn 
                              color="blue darken-1" 
                              text type="submit" 
                              @click="submitOfficials"
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
                      <span>Edit</span>
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
      { text: 'Position', value: 'position', align: 'center', sortable: false },
      { text: 'Name', value: 'name', align: 'center', sortable: false },
      { text: 'Start Term', value: 'start_term', align: 'center', sortable: false },
      { text: 'End Term', value: 'end_term', align: 'center', sortable: false },
      { text: 'Actions', value: 'action', align: 'center', sortable: false }
    ],
    valid: true,
    calendarStartTerm: false,
    calendarEndTerm: false,
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
      axios.get("api/barangayForm").then(({ data }) => this.barangayForm.fill(data));
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
      this.officialForm
        .post("api/official")
        .then(() => {
          this.dialogOfficial = false;
          this.getOfficials();
          toast.fire({
            type: "success",
            title: "Official has been created"
          });
        })
        .catch(() => {});
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

    submitOfficials() {
      this.$refs.formOfficials.validate();
    }
  }
};
</script>

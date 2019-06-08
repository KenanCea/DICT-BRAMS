<template>
    <v-app>
      <v-container grid-list-xl fluid>
        <v-layout row wrap>
          <v-flex md12>
            <v-card>
              <v-layout>
                <v-flex md6>
                  <v-card-primary-title>
                    <div>Barangay Logo</div>
                  </v-card-primary-title>
                  <v-card>
                    <v-card-text class="text-xs-center">
                      <v-avatar class="mx-auto d-block" size="180">
                        <img :src="getLogo()" alt="Logo">
                      </v-avatar>
                    </v-card-text>
                  </v-card>
                </v-flex>
                <v-flex md6>
                  <div>Barangay Name:</div>
                  <div>Barangay Code</div>
                  <div>Region:</div>
                  <div>Province:</div>
                  <div>Municipality/City:</div><div>
                    <v-btn to="/barangayprofile" small color="primary">View More</v-btn>
                  </div>
                </v-flex> 
              </v-layout>
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
                  <v-data-table
                    id="barangayOfficials"
                    :headers="headersOfficials"
                    :items="officials"
                    hide-default-footer>
                    <template v-slot:top>
                      <v-dialog v-model="dialogOfficial" max-width="300px">
                        <v-form
                          ref="formOfficials"
                          v-model="valid"
                          lazy-validation 
                          @submit.prevent="updateOfficial()">
                          <v-card>
                            <v-card-title>
                              <span class="headline">Edit Row</span>
                            </v-card-title>
      
                            <v-card-text>
                              <v-container grid-list-md>
                                <v-layout wrap>
                                  <v-flex xs12 md12>
                                    <v-text-field v-model="officialForm.name" label="Barangay Official name"></v-text-field>
                                  </v-flex>
                                  <v-flex xs12 md6>
                                    <v-text-field v-model="officialForm.start_term" label="Start Term"></v-text-field>
                                  </v-flex>
                                  <v-flex xs12 md6>
                                    <v-text-field v-model="officialForm.end_term" label="End Term"></v-text-field>
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
    </v-app>
</template>

<script>
  export default {
    data: () => ({
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
      officials: [],
      officialForm: new Form({
        id: "",
        position: "",
        name: "",
        start_term: "",
        end_term: "",
        logo: ""
      })
    }),

    created () {
      this.getOfficials()
    },

    methods: {
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

      editOfficialDialog(officials) {
        this.officialForm.reset();
        this.dialogOfficial = true;
        this.officialForm.fill(officials);
      },

      submitOfficials() {
        this.$refs.formOfficials.validate();
      }
    }
  }
</script>

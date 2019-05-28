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
                        <img src="https://picsum.photos/510/300?random" alt="User Logo">
                      </v-avatar>
                    </v-card-text>
                  </v-card>
                  <input type="file" @change="updateLogo" label="Logo"></input>
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
                    :headers="headers"
                    :items="officials"
                    hide-default-footer>
                    <template v-slot:top>
                      <v-dialog v-model="dialog" max-width="300px">
                        <v-card>
                          <v-card-title>
                            <span class="headline">Edit Row</span>
                          </v-card-title>
    
                          <v-card-text>
                            <v-container grid-list-md>
                              <v-layout wrap>
                                <v-flex xs12 md12>
                                  <v-text-field v-model="editedItem.name" label="Barangay Official name"></v-text-field>
                                </v-flex>
                                <v-flex xs12 md6>
                                  <v-text-field v-model="editedItem.start" label="Start Term"></v-text-field>
                                </v-flex>
                                <v-flex xs12 md6>
                                  <v-text-field v-model="editedItem.end" label="End Term"></v-text-field>
                                </v-flex>
                              </v-layout>
                            </v-container>
                          </v-card-text>
    
                          <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                            <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                          </v-card-actions>
                        </v-card>
                      </v-dialog>
                    </template>

                    <template v-slot:item.action="{ item }">
                      <v-tooltip bottom>
                        <template v-slot:activator="{ on }">
                          <v-btn text icon @click="editItem(item)" v-on="on">
                            <v-icon>mdi-pencil</v-icon>
                          </v-btn>
                        </template>
                        <span>Edit</span>
                      </v-tooltip>
                    </template>

                    <template #no-data>
                      <v-btn color="primary" @click="initialize">Reset</v-btn>
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
      dialog: false,
      headers: [
        {
          text: 'POSITION',
          value: 'position',
          align: 'center',
          sortable: false
        },
        { 
          text: 'NAME',
          value: 'name',
          align: 'center',
          sortable: false    
        },
        { 
          text: 'START TERM', 
          value: 'start', 
          align: 'center',
          sortable: false
        },
        { 
          text: 'END TERM', 
          value: 'end', 
          align: 'center',
          sortable: false
        },
        { 
          text: 'Actions', 
          value: 'action',
          align: 'center', 
          sortable: false 
        }
      ],
      officials: [],
      editedIndex: -1,
      editedItem: {
        name: '',
        start: 0,
        end: 0
      },
      defaultItem: {
        name: '',
        start: 0,
        end: 0
      }
    }),

    watch: {
      dialog (val) {
        val || this.close()
      }
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        this.officials = [
          {
            position: 'Punong Barangay',
            name: 'Gati, Randy Tadique',
            start: '2013',
            end: '2016'
          },
          {
            position: 'Kagawad',
            name: 'Anton, Brian Anton Cornel',
            start: '2013',
            end: '2016'
          },
          {
            position: 'Kagawad',
            name: 'Willy, Arthur Tony',
            start: '2013',
            end: '2016'
          },
          {
            position: 'Kagawad',
            name: 'Contic, Martin Galino',
            start: '2013',
            end: '2016'
          },
          {
            position: 'Kagawad',
            name: 'Balleras, Emily Ramos',
            start: '2013',
            end: '2016'
          },
          {
            position: 'Kagawad',
            name: 'Amistad, Rudy Date',
            start: '2013',
            end: '2016'
          },
          {
            position: 'Kagawad',
            name: 'Zapanta, Vincente Jubilo',
            start: '2013',
            end: '2016'
          },
          {
            position: 'Kagawad',
            name: 'Columbres, Modesto Pagaway',
            start: '2013',
            end: '2016'
          },
          {
            position: 'Barangay Treasurer',
            name: '',
            start: '2013',
            end: '2016' 
          },
          {
            position: 'Barangay Secretary',
            name: '',
            start: '2013',
            end: '2016'
          }
        ]
      },

      editItem (item) {
        this.editedIndex = this.officials.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.officials[this.editedIndex], this.editedItem)
        } else {
          this.officials.push(this.editedItem)
        }
        this.close()
      },

      updateLogo(e) {
        let file = e.target.files[0];
        console.log(file);
        let reader = new FileReader();
        if (file["size"] < 1048576) {
          reader.onloadend = file => {
            this.form.logo = reader.result;
          };
          reader.readAsDataURL(file);
        } else {
        }
      }
    }
  }
</script>

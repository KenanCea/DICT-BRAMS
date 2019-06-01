<template>
    <v-app>
      <v-container grid-list-xl fluid>
        <v-layout row wrap>
          <v-flex xs12>
            <v-card>
              <v-layout>
                <v-flex xs8>
                  <div>
                    <v-btn to="/barangayinformation" small color="primary">Back</v-btn>
                  </div>
                  <div>Barangay Name:</div>
                  <div>Barangay Code</div>
                  <div>Region:</div>
                  <div>Province:</div>
                  <div>Municipality/City:</div>
                </v-flex>
                <v-flex xs4>
                  <div>
                    <v-btn 
                      small 
                      color="primary"
                      >Print</v-btn>
                    <v-tooltip bottom>
                      <template v-slot:activator="{ on }">
                        <v-btn text icon @click="isEditing = !isEditing" v-on="on">
                          <v-icon v-if="isEditing">mdi-close</v-icon>
                          <v-icon v-else>mdi-pencil</v-icon>
                        </v-btn>
                      </template>
                      <span v-if="isEditing">Cancel</span>
                      <span v-else>Edit</span>
                    </v-tooltip>
                    <v-btn
                      color="success"
                      type="submit"
                      :disabled="!isEditing"
                      @click.prevent="updateBarangay"
                    >Save</v-btn>
                  </div>
                </v-flex> 
              </v-layout>
              <v-layout>
                <v-flex xs6>
                  <div>I. General Information</div>
                  <div class="ml-3">A. Creation</div>
                  <div class="ml-4">
                    <v-form>

                      <v-text-field
                        v-model="form.legal_basis"
                        label="Legal Basis"
                        :disabled="!isEditing"
                      ></v-text-field>

                      <v-menu
                        ref="date_legal"
                        v-model="date_legal"
                        :close-on-content-click="false"
                        :nudge-right="40"
                        :return-value.sync="date"
                        transition="scale-transition"
                        offset-y
                        full-width
                        min-width="290px"
                      >
                        <template v-slot:activator="{ on }">
                          <v-text-field
                            v-model="form.date"
                            label="Date Legal Basis"
                            :disabled="!isEditing"
                            readonly
                            v-on="on"
                          ></v-text-field>
                        </template>
                        <v-date-picker v-model="date" no-title scrollable>
                          <v-spacer></v-spacer>
                          <v-btn text color="primary" @click="date_legal = false">Cancel</v-btn>
                          <v-btn text color="primary" @click="$refs.date_legal.save(date)">OK</v-btn>
                        </v-date-picker>
                      </v-menu>

                      <v-menu
                        ref="date_ratification"
                        v-model="date_ratification"
                        :close-on-content-click="false"
                        :nudge-right="40"
                        :return-value.sync="date"
                        transition="scale-transition"
                        offset-y
                        full-width
                        min-width="290px"
                      >
                        <template v-slot:activator="{ on }">
                          <v-text-field
                            v-model="form.date"
                            label="Date Ratification/Plebiscite"
                            :disabled="!isEditing"
                            readonly
                            v-on="on"
                          ></v-text-field>
                        </template>
                        <v-date-picker v-model="date" no-title scrollable>
                          <v-spacer></v-spacer>
                          <v-btn text color="primary" @click="date_ratification = false">Cancel</v-btn>
                          <v-btn text color="primary" @click="$refs.date_ratification.save(date)">OK</v-btn>
                        </v-date-picker>
                      </v-menu>

                      <v-text-field
                        v-model="form.mother_barangay"
                        label="Mother Barangay/s"
                        :disabled="!isEditing"
                      ></v-text-field>

                      <v-text-field
                        v-model="form.old_name"
                        label="Old Name, if named"
                        :disabled="!isEditing"
                      ></v-text-field>
                    </v-form>
                  </div>
                  <div class="ml-3">
                    <v-form>
                      <v-select
                        v-model="form.select"
                        :items="type_barangay"
                        :rules="[v => !!v || 'Item is required']"
                        label="B. Type of Barangay"
                        :disabled="!isEditing"
                        required
                      ></v-select>
                    </v-form>
                  </div>
                  <div class="ml-4">Boundaries</div>
                  <div class="ml-5">
                    <v-form>
                      <v-text-field
                        v-model="form.north"
                        label="North"
                        :disabled="!isEditing"
                      ></v-text-field>

                      <v-text-field
                        v-model="form.east"
                        label="East"
                        :disabled="!isEditing"
                      ></v-text-field>

                      <v-text-field
                        v-model="form.west"
                        label="West"
                        :disabled="!isEditing"
                      ></v-text-field>

                      <v-text-field
                        v-model="form.south"
                        label="South"
                        :disabled="!isEditing"
                      ></v-text-field>
                    </v-form>
                  </div>
                </v-flex>
                <v-flex xs6>
                  <div>C. Total Land Area</div>
                  <div class="mx-3">
                    <v-form>
                      <v-text-field
                        v-model="form.total_square"
                        label="Total Land Area (sq. km.)"
                        :disabled="!isEditing"
                      ></v-text-field>

                      <v-text-field
                        v-model="form.total_hectare"
                        label="Total Land Area (hec.)"
                        :disabled="!isEditing"
                      ></v-text-field>
                    </v-form>
                  </div>
                  <div>D. Distance from:</div>
                  <div class="mx-3">
                    <v-form>
                      <v-text-field
                        v-model="form.city"
                        label="City/Municipal Hall"
                        :disabled="!isEditing"
                      ></v-text-field>

                      <v-text-field
                        v-model="form.capitol"
                        label="Provincial Capitol"
                        :disabled="!isEditing"
                      ></v-text-field>

                      <v-text-field
                        v-model="form.highway"
                        label="National Highway"
                        :disabled="!isEditing"
                      ></v-text-field>
                    </v-form>
                  </div><br/>
                  <div>E. Land Form</div>
                  <div> 
                    <v-data-table 
                      :headers="headers" 
                      :items="land" 
                      hide-default-footer>
                      <template v-slot:top>
                        <v-dialog v-model="dialog" max-width="175px">
                          <v-card>
                            <v-card-title>
                              <span class="headline">Edit Row</span>
                            </v-card-title>
                      
                            <v-card-text>
                              <v-container grid-list-md>
                                <v-layout wrap>
                                  <v-flex xs12 md12>
                                    <v-text-field v-model="editedItem.percent" label="Percent"></v-text-field>
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
                  </div>
                </v-flex>
              </v-layout>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
      
      <v-container grid-list-xl fluid>
        <v-layout row wrap>
          <v-flex xs12>
            <v-card>
              <v-layout>
                <v-flex xs6>
                  <div>For Table F: Distribution of Land Use</div>
                  <div>
                    <v-data-table 
                      :headers="distribheaders" 
                      :items="use" 
                      hide-default-footer>
                      <template v-slot:top>
                        <v-dialog v-model="dialog2" max-width="300px">
                          <v-card>
                            <v-card-title>
                              <span class="headline">Edit Row</span>
                            </v-card-title>
                      
                            <v-card-text>
                              <v-container grid-list-md>
                                <v-layout wrap>
                                  <v-flex xs4 md12>
                                    <v-text-field v-model="editedItem2.square" label="Land Area (sq. kms.)"></v-text-field>
                                  </v-flex>
                                  <v-flex xs4 md12>
                                    <v-text-field v-model="editedItem2.hectare" label="Land Area (hectares)"></v-text-field>
                                  </v-flex>
                                  <v-flex xs4 md12>
                                    <v-text-field v-model="editedItem2.total" label="% Total Population"></v-text-field>
                                  </v-flex>
                                </v-layout>
                              </v-container>
                            </v-card-text>
                      
                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn color="blue darken-1" text @click="close2">Cancel</v-btn>
                              <v-btn color="blue darken-1" text @click="save2">Save</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                      </template>

                      <template v-slot:item.action="{ item }">
                        <v-tooltip bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn text icon @click="editItem2(item)" v-on="on">
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
                  </div>
                </v-flex>
                <v-flex xs6>
                  <div>For Table H: Household Distribution</div>
                  <div class="mx-3">Total no. of households - 3 years ago:</div>
                  <div class="mx-3">Average no. of persons per household - 3 years ago:</div>
                  <div class="mx-3">Average income per household - 3 years ago:</div>
                </v-flex>
              </v-layout>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>

      <v-container grid-list-xl fluid>
        <v-layout row wrap>
          <v-flex xs12>
            <v-card>
              <v-layout>
                <v-flex xs8>
                  <div>Socio Cultural Data</div><br/>
                  <div>For Table 2: Health Facilities</div>
                  <div>
                    <v-data-table 
                      :headers="healthheaders" 
                      :items="facilities" 
                      hide-default-footer>

                      <template v-slot:top>
                        <v-dialog v-model="dialog3" max-width="450px">
                          <v-card>
                            <v-card-title>
                              <span class="headline">Edit Row</span>
                            </v-card-title>
                      
                            <v-card-text>
                              <v-container grid-list-md>
                                <v-layout wrap>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem3.number" label="Number"></v-text-field>
                                  </v-flex>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem3.patient" label="Number of patients served (preceding year)"></v-text-field>
                                  </v-flex>
                                </v-layout>
                              </v-container>
                            </v-card-text>
                      
                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn color="blue darken-1" text @click="close3">Cancel</v-btn>
                              <v-btn color="blue darken-1" text @click="save3">Save</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                      </template>

                      <template v-slot:item.action="{ item }">
                        <v-tooltip bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn text icon @click="editItem3(item)" v-on="on">
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
                  </div>
                  <div>Other Health Facilities:</div>
                </v-flex>
              </v-layout>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
          
      <v-container grid-list-xl fluid>
        <v-layout row wrap>
          <v-flex xs12>
            <v-card>
              <v-layout>
                <v-flex xs6>
                  <div>Education</div><br/>
                  <div>For Table B.1 Number of School Buildings</div>
                  <div>
                    <v-data-table 
                      :headers="schoolheaders" 
                      :items="buildings" 
                      hide-default-footer>
                      <template v-slot:top>
                        <v-dialog v-model="dialog4" max-width="175px">
                          <v-card>
                            <v-card-title>
                              <span class="headline">Edit Row</span>
                            </v-card-title>
                      
                            <v-card-text>
                              <v-container grid-list-md>
                                <v-layout wrap>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem4.number2" label="Number"></v-text-field>
                                  </v-flex>
                                </v-layout>
                              </v-container>
                            </v-card-text>
                      
                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn color="blue darken-1" text @click="close4">Cancel</v-btn>
                              <v-btn color="blue darken-1" text @click="save4">Save</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                      </template>

                      <template v-slot:item.action="{ item }">
                        <v-tooltip bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn text icon @click="editItem4(item)" v-on="on">
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
                  </div>
                </v-flex>
                <v-flex xs6>
                  <div>For Table D: Sports and Recreational Facilities</div>
                  <div>
                    <v-data-table 
                      :headers="sportheaders" 
                      :items="sports" 
                      hide-default-footer>

                      <template v-slot:top>
                        <v-dialog v-model="dialog5" max-width="175px">
                          <v-card>
                            <v-card-title>
                              <span class="headline">Edit Row</span>
                            </v-card-title>
                      
                            <v-card-text>
                              <v-container grid-list-md>
                                <v-layout wrap>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem5.number3" label="Number"></v-text-field>
                                  </v-flex>
                                </v-layout>
                              </v-container>
                            </v-card-text>
                      
                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn color="blue darken-1" text @click="close5">Cancel</v-btn>
                              <v-btn color="blue darken-1" text @click="save5">Save</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                      </template>

                      <template v-slot:item.action="{ item }">
                        <v-tooltip bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn text icon @click="editItem5(item)" v-on="on">
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
                  </div>
                </v-flex>
              </v-layout>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>

      <v-container grid-list-xl fluid>
        <v-layout row wrap>    
          <v-flex xs12>
            <v-card>
              <v-layout>
                <v-flex xs12>
                  <div>C. INFRASTRUCTURE: TRANSPORT FACILITIES AND SERVICES</div><br/>
                  <div class="ml-3">For Table 1: Bridge by Administrative level (in meters):</div>
                  <div class="ml-5">
                    <v-data-table 
                      :headers="bridgemeters" 
                      :items="meters" 
                      hide-default-footer>

                      <template v-slot:top>
                        <v-dialog v-model="dialog6" max-width="300px">
                          <v-card>
                            <v-card-title>
                              <span class="headline">Edit Row</span>
                            </v-card-title>
                      
                            <v-card-text>
                              <v-container grid-list-md>
                                <v-layout wrap>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem6.national" label="National"></v-text-field>
                                  </v-flex>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem6.provincial" label="Provincial"></v-text-field>
                                  </v-flex>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem6.city" label="City/Municipality"></v-text-field>
                                  </v-flex>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem6.barangay" label="Barangay"></v-text-field>
                                  </v-flex>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem6.total" label="Barangay"></v-text-field>
                                  </v-flex>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem6.operational" label="Barangay"></v-text-field>
                                  </v-flex>
                                </v-layout>
                              </v-container>
                            </v-card-text>
                      
                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn color="blue darken-1" text @click="close6">Cancel</v-btn>
                              <v-btn color="blue darken-1" text @click="save6">Save</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                      </template>

                      <template v-slot:item.action="{ item }">
                        <v-tooltip bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn text icon @click="editItem6(item)" v-on="on">
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
                  </div><br/>
                  <div ml-3>Bridge by Administrative level (in kilometers)</div>
                  <div class="ml-5">
                    <v-data-table 
                      :headers="bridgekilometers" 
                      :items="kilometers" 
                      hide-default-footer>

                      <template v-slot:top>
                        <v-dialog v-model="dialog7" max-width="300px">
                          <v-card>
                            <v-card-title>
                              <span class="headline">Edit Row</span>
                            </v-card-title>
                      
                            <v-card-text>
                              <v-container grid-list-md>
                                <v-layout wrap>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem7.national2" label="National"></v-text-field>
                                  </v-flex>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem7.provincial2" label="Provincial"></v-text-field>
                                  </v-flex>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem7.city2" label="City/Municipality"></v-text-field>
                                  </v-flex>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem7.barangay2" label="Barangay"></v-text-field>
                                  </v-flex>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem7.total2" label="Barangay"></v-text-field>
                                  </v-flex>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem7.operational2" label="Barangay"></v-text-field>
                                  </v-flex>
                                </v-layout>
                              </v-container>
                            </v-card-text>
                      
                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn color="blue darken-1" text @click="close7">Cancel</v-btn>
                              <v-btn color="blue darken-1" text @click="save7">Save</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                      </template>

                      <template v-slot:item.action="{ item }">
                        <v-tooltip bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn text icon @click="editItem7(item)" v-on="on">
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
                  </div>
                </v-flex>
              </v-layout>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>

      <v-container grid-list-xl fluid>
        <v-layout row wrap>    
          <v-flex xs12>
            <v-card>
              <v-layout>
                <v-flex xs12>
                  <div class="ml-3">For Table 2: Communications Services:</div>
                  <div class="ml-5">
                    <v-data-table 
                      :headers="communicationheaders" 
                      :items="services" 
                      hide-default-footer>

                      <template v-slot:top>
                        <v-dialog v-model="dialog8" max-width="300px">
                          <v-card>
                            <v-card-title>
                              <span class="headline">Edit Row</span>
                            </v-card-title>
                      
                            <v-card-text>
                              <v-container grid-list-md>
                                <v-layout wrap>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem8.provider" label="Provider"></v-text-field>
                                  </v-flex>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem8.company" label="Company"></v-text-field>
                                  </v-flex>
                                  <v-flex md12>
                                    <v-text-field v-model="editedItem8.household" label="Household"></v-text-field>
                                  </v-flex>
                                </v-layout>
                              </v-container>
                            </v-card-text>
                      
                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn color="blue darken-1" text @click="close8">Cancel</v-btn>
                              <v-btn color="blue darken-1" text @click="save8">Save</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                      </template>

                      <template v-slot:item.action="{ item }">
                        <v-tooltip bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn text icon @click="editItem8(item)" v-on="on">
                              <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                          </template>
                          <span>Edit</span>
                        </v-tooltip>
                      </template>

                      <template #no-data>
                        <v-btn color="primary" @click="initialize">Reset</v-btn>
                      </template>

                      <template slot="items" slot-scope="props">
                          <td>{{ props.item.type }}</td>
                          <td>{{ props.item.provider }}</td>
                          <td>{{ props.item.company }}</td>
                          <td>{{ props.item.household }}</td>
                      </template>
                    </v-data-table>
                  </div>
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
      form: new Form({
        legal_basis: "",    
        date: new Date().toISOString().substr(0, 10),
        mother_barangay: "",
        old_name: "",
        north: "",
        east: "",
        west: "",
        south: "",
        total_square: "",
        total_hectare: "",
        city: "",
        capitol: "",
        highway: "",
        select: null
      }),
      dialog: false,
      dialog2: false,
      dialog3: false,
      dialog4: false,
      dialog5: false,
      dialog6: false,
      dialog7: false,
      dialog8: false,
      date_legal: false,
      date_ratification: false,
      type_barangay: [
        'Rural',
        'Urban',
        'Tribal'
      ],
      isEditing: null,
      headers: [
        {
          text: 'Type',
          value: 'type',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        { 
          text: 'Percent', 
          value: 'percent', 
          align: 'center',
          sortable: false,
          width: "1%"
        },
        { 
          text: 'Actions', 
          value: 'action',
          align: 'center', 
          sortable: false,
          width: "1%" 
        }
      ],
      land: [],
      distribheaders: [
        {
          text: 'Type',
          value: 'distribution',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        { 
          text: 'Land Area (Square kms.)', 
          value: 'square',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        { 
          text: 'Land Area (Hectares)', 
          value: 'hectare',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        { 
          text: '% Total Population', 
          value: 'total',
          sortable: false,
          align: 'center',
          sortable: false,
          width: "1%"
        },
        { 
          text: 'Actions', 
          value: 'action',
          align: 'center', 
          sortable: false,
          width: "1%" 
        }
      ],
      use: [],
      healthheaders: [
        {
          text: 'Type',
          value: 'facility',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        { 
          text: 'Number', 
          value: 'number',
          align: 'center',
          sortable: false,
          width: "1%" 
        },
        { 
          text: 'Number of patients served (preceding year)', 
          value: 'patient',
          align: 'center',
          sortable: false,
          width: "1%" 
        },
        { 
          text: 'Actions', 
          value: 'action',
          align: 'center', 
          sortable: false,
          width: "1%" 
        }
      ],
      facilities: [],
      schoolheaders: [
        {
          text: 'Type',
          value: 'type',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        { 
          text: 'Number', 
          value: 'number2',
          align: 'center',
          sortable: false,
          width: "1%" 
        },
        { 
          text: 'Actions', 
          value: 'action',
          align: 'center', 
          sortable: false,
          width: "1%" 
        }
      ],
      buildings: [],
      sportheaders: [
        {
          text: 'Type',
          value: 'type',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        { 
          text: 'Number', 
          value: 'number3',
          align: 'center',
          sortable: false,
          width: "1%" 
        },
        { 
          text: 'Actions', 
          value: 'action',
          align: 'center', 
          sortable: false,
          width: "1%" 
        }
      ],
      sports: [],
      bridgemeters: [
        {
          text: 'Type',
          value: 'type',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        { 
          text: 'National', 
          value: 'national',
          align: 'center',
          sortable: false,
          width: "1%" 
        },
        {
          text: 'Provincial', 
          value: 'provincial',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        {
          text: 'City/Municipality', 
          value: 'city',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        {
          text: 'Barangay', 
          value: 'barangay',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        {
          text: 'Total', 
          value: 'total',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        {
          text: 'Operational', 
          value: 'operational',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        { 
          text: 'Actions', 
          value: 'action',
          align: 'center', 
          sortable: false,
          width: "1%" 
        }
      ],
      meters: [],
      bridgekilometers: [
        {
          text: 'Type',
          value: 'type2',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        { 
          text: 'National', 
          value: 'national2',
          align: 'center',
          sortable: false,
          width: "1%" 
        },
        {
          text: 'Provincial', 
          value: 'provincial2',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        {
          text: 'City/Municipality', 
          value: 'city2',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        {
          text: 'Barangay', 
          value: 'barangay2',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        {
          text: 'Total', 
          value: 'total2',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        {
          text: 'Operational', 
          value: 'operational2',
          align: 'center',
          sortable: false,
          width: "1%"
        },
        { 
          text: 'Actions', 
          value: 'action',
          align: 'center', 
          sortable: false,
          width: "1%" 
        }
      ],
      kilometers: [],
      communicationheaders: [
        {
          text: 'Type of Communications',
          value: 'type',
          align: 'center',
          sortable: false
        },
        { 
          text: 'Total Provider', 
          value: 'provider',
          align: 'center',
          sortable: false
        },
        {
          text: 'Name/s of Company', 
          value: 'company',
          align: 'center',
          sortable: false
        },
        {
          text: 'No. of households served', 
          value: 'household',
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
      services: [],
      editedIndex: -1,
      editedItem: {
        percent: ''
      },
      editedItem2: {
        square: '',
        hectare: '',
        total: ''
      },
      editedItem3: {
        number: 0,
        patient: 0
      },
      editedItem4: {
        number2: 0
      },
      editedItem5: {
        number3: 0
      },
      editedItem6: {
        national: 0,
        provincial: 0,
        city: 0,
        barangay: 0,
        total: 0,
        operational: 0
      },
      editedItem7: {
        national2: 0,
        provincial2: 0,
        city2: 0,
        barangay2: 0,
        total2: 0,
        operational2: 0
      },
      editedItem8: {
        provider: '',
        company: '',
        household: ''
      },
      defaultItem: {
        percent: '',
        square: '',
        hectare: '',
        total: ''
      },
      defaultItem2: {
        square: '',
        hectare: '',
        total: ''
      },
      defaultItem3: {
        number: 0,
        patient: 0
      },
      defaultItem4: {
        number2: 0
      },
      defaultItem5: {
        number3: 0
      },
      defaultItem6: {
        national: 0,
        provincial: 0,
        city: 0,
        barangay: 0,
        total: 0,
        operational: 0
      },
      defaultItem7: {
        national2: 0,
        provincial2: 0,
        city2: 0,
        barangay2: 0,
        total2: 0,
        operational2: 0
      },
      defaultItem8: {
        provider: '',
        company: '',
        household: ''
      },
    }),

    created () {
      this.initialize()
    },

    methods: {
      formatDate (date) {
        if (!date) return null

        const [year, month, day] = date.split('-')
        return `${month}/${day}/${year}`
      },
      parseDate (date) {
        if (!date) return null

        const [month, day, year] = date.split('/')
        return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
      },

      updateBarangay() {
        this.form
          .put("api/user")
          .then(() => {})
          .catch(() => {});
      },

      initialize () {
        this.land = [
          {
            type: 'Mountainous',
            percent: '15.67%'
          },
          {
            type: 'Plain',
            percent: '2.34%'
          },
          {
            type: 'Valley',
            percent: '8%'
          }
        ],
        this.use = [
          {
            distribution: 'Residential',
            square: '',
            hectare: '',
            total: ''
          },
          {
            distribution: 'Commercial',
            square: '',
            hectare: '',
            total: ''
          },
          {
            distribution: 'Industrial',
            square: '',
            hectare: '',
            total: ''
          },
          {
            distribution: 'Agricultural',
            square: '',
            hectare: '',
            total: ''
          },
          {
            distribution: 'Aquatic',
            square: '',
            hectare: '',
            total: ''
          },
          {
            distribution: 'Forest',
            square: '',
            hectare: '',
            total: ''
          },
          {
            distribution: 'Idle Land',
            square: '',
            hectare: '',
            total: ''
          }
        ],
        this.facilities = [
          {
            facility: 'Public Hospital',
            number: '',
            patient: ''
          },
          {
            facility: 'Private Hospital',
            number: '',
            patient: ''
          },
          {
            facility: 'Health Center',
            number: '',
            patient: ''
          },
          {
            facility: 'Clinic',
            number: '',
            patient: ''
          },
          {
            facility: 'Self-medication',
            number: '',
            patient: ''
          }
        ],
        this.buildings = [
          {
            type: 'Pre-School Day Care Building',
            number2: ''
          },
          {
            type: 'Primary/Elementary Building',
            number2: ''
          },
          {
            type: 'Secondary/High School Building',
            number2: ''
          },
          {
            type: 'Vocational/Technical Building',
            number2: ''
          },
          {
            type: 'College/University Building',
            number2: ''
          },
          {
            type: 'Post Graduate Building',
            number2: ''
          }
        ],
        this.sports = [
          {
            type: 'Covered Court',
            number3: ''
          },
          {
            type: 'Gymnasium',
            number3: ''
          },
          {
            type: 'Park/Plaza',
            number3: ''
          },
          {
            type: 'Specify Other Sports Facilities',
            number3: ''
          },
          {
            type: 'Specify Sports/Recreational Facilities',
            number3: ''
          },
          {
            type: 'Total Facilities',
            number3: ''
          }
        ],
        this.meters = [
          {
            type: 'Concrete',
            national: '',
            provincial: '',
            city: '',
            barangay: '',
            total: '',
            operational: ''
          },
          {
            type: 'Steel',
            national: '',
            provincial: '',
            city: '',
            barangay: '',
            total: '',
            operational: ''
          },
          {
            type: 'Wooden',
            national: '',
            provincial: '',
            city: '',
            barangay: '',
            total: '',
            operational: ''
          },
          {
            type: 'TOTAL',
            national: '',
            provincial: '',
            city: '',
            barangay: '',
            total: '',
            operational: ''
          }
        ],
        this.kilometers = [
          {
            type2: 'Concrete',
            national2: '',
            provincial2: '',
            city2: '',
            barangay2: '',
            total2: '',
            operational2: ''
          },
          {
            type2: 'Asphalt',
            national2: '',
            provincial2: '',
            city2: '',
            barangay2: '',
            total2: '',
            operational2: ''
          },
          {
            type2: 'Gravel',
            national2: '',
            provincial2: '',
            city2: '',
            barangay2: '',
            total2: '',
            operational2: ''
          },
          {
            type2: 'Earthfill',
            national2: '',
            provincial2: '',
            city2: '',
            barangay2: '',
            total2: '',
            operational2: ''
          },
          {
            type2: 'TOTAL',
            national2: '',
            provincial2: '',
            city2: '',
            barangay2: '',
            total2: '',
            operational2: ''
          }
        ],
        this.services = [
          {
            type: 'Telephone',
            provider: '',
            company: '',
            household: ''
          },
          {
            type: 'Cellular Networks/Sites',
            provider: '',
            company: '',
            household: ''
          },
          {
            type: 'Internet',
            provider: '',
            company: '',
            household: ''
          },
          {
            type: 'Postal Service',
            provider: '',
            company: '',
            household: ''
          },
          {
            type: 'Delivery Service',
            provider: '',
            company: '',
            household: ''
          }
        ]
      },

      editItem (item) {
        this.editedIndex = this.land.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      editItem2 (item) {
        this.editedIndex = this.use.indexOf(item)
        this.editedItem2 = Object.assign({}, item)
        this.dialog2 = true
      },

      editItem3 (item) {
        this.editedIndex = this.facilities.indexOf(item)
        this.editedItem3 = Object.assign({}, item)
        this.dialog3 = true
      },

      editItem4 (item) {
        this.editedIndex = this.buildings.indexOf(item)
        this.editedItem4 = Object.assign({}, item)
        this.dialog4 = true
      },

      editItem5 (item) {
        this.editedIndex = this.sports.indexOf(item)
        this.editedItem5 = Object.assign({}, item)
        this.dialog5 = true
      },   

      editItem6 (item) {
        this.editedIndex = this.meters.indexOf(item)
        this.editedItem6 = Object.assign({}, item)
        this.dialog6 = true
      },   

      editItem7 (item) {
        this.editedIndex = this.kilometers.indexOf(item)
        this.editedItem7 = Object.assign({}, item)
        this.dialog7 = true
      },

      editItem8 (item) {
        this.editedIndex = this.services.indexOf(item)
        this.editedItem8 = Object.assign({}, item)
        this.dialog8 = true
      },      

      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      close2 () {
        this.dialog2 = false
        setTimeout(() => {
          this.editedItem2 = Object.assign({}, this.defaultItem2)
          this.editedIndex = -1
        }, 300)
      },

      close3 () {
        this.dialog3 = false
        setTimeout(() => {
          this.editedItem3 = Object.assign({}, this.defaultItem3)
          this.editedIndex = -1
        }, 300)
      },

      close4 () {
        this.dialog4 = false
        setTimeout(() => {
          this.editedItem4 = Object.assign({}, this.defaultItem4)
          this.editedIndex = -1
        }, 300)
      },

      close5 () {
        this.dialog5 = false
        setTimeout(() => {
          this.editedItem5 = Object.assign({}, this.defaultItem5)
          this.editedIndex = -1
        }, 300)
      },   

      close6 () {
        this.dialog6 = false
        setTimeout(() => {
          this.editedItem6 = Object.assign({}, this.defaultItem6)
          this.editedIndex = -1
        }, 300)
      },  

      close7 () {
        this.dialog7 = false
        setTimeout(() => {
          this.editedItem7 = Object.assign({}, this.defaultItem7)
          this.editedIndex = -1
        }, 300)
      },

      close8 () {
        this.dialog8 = false
        setTimeout(() => {
          this.editedItem8 = Object.assign({}, this.defaultItem8)
          this.editedIndex = -1
        }, 300)
      },      

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.land[this.editedIndex], this.editedItem)
        } else {
          this.land.push(this.editedItem)
        }
        this.close()
      },

      save2 () {
        if (this.editedIndex > -1) {
          Object.assign(this.use[this.editedIndex], this.editedItem2)
        } else {
          this.use.push(this.editedItem2)
        }
        this.close2()
      },

      save3 () {
        if (this.editedIndex > -1) {
          Object.assign(this.facilities[this.editedIndex], this.editedItem3)
        } else {
          this.facilities.push(this.editedItem3)
        }
        this.close3()
      },

      save4 () {
        if (this.editedIndex > -1) {
          Object.assign(this.buildings[this.editedIndex], this.editedItem4)
        } else {
          this.buildings.push(this.editedItem4)
        }
        this.close4()
      },

      save5 () {
        if (this.editedIndex > -1) {
          Object.assign(this.sports[this.editedIndex], this.editedItem5)
        } else {
          this.sports.push(this.editedItem5)
        }
        this.close5()
      },

      save6 () {
        if (this.editedIndex > -1) {
          Object.assign(this.meters[this.editedIndex], this.editedItem6)
        } else {
          this.meters.push(this.editedItem6)
        }
        this.close6()
      },

      save7 () {
        if (this.editedIndex > -1) {
          Object.assign(this.kilometers[this.editedIndex], this.editedItem7)
        } else {
          this.kilometers.push(this.editedItem7)
        }
        this.close7()
      },

      save8 () {
        if (this.editedIndex > -1) {
          Object.assign(this.services[this.editedIndex], this.editedItem8)
        } else {
          this.services.push(this.editedItem8)
        }
        this.close8()
      }
    }
  }
</script>

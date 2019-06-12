<template>
    <v-app>
      <v-container grid-list-xl fluid>
        <v-layout row wrap>
          <v-flex xs12>
            <v-card>
              <v-layout>
                <v-flex xs8>
                  <div>
                    <v-btn to="/useraccount" small color="primary">Back</v-btn>
                  </div>
                </v-flex>
                <v-flex xs4>
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
                </v-flex> 
              </v-layout>
              <v-layout>
                <v-flex xs6>
                  <div>I. General Information</div>
                  <div class="ml-3">A. Creation</div>
                  <div class="ml-4">
                    <v-form>
                      <v-text-field v-model="barangayForm.legal_basis" label="Legal Basis" :disabled="!isEditing"
                      ></v-text-field>

                      <v-menu
                        v-model="menuLegal"
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
                            v-model="barangayForm.date_legal_basis"
                            label="Date of Legal Basis"
                            :disabled="!isEditing"
                            prepend-icon="mdi-calendar"
                            readonly
                            v-on="on"
                          ></v-text-field>
                        </template>
                        <v-date-picker
                          v-model="barangayForm.date_legal_basis"
                          no-title
                          color="primary"
                          @input="menuLegal = false"
                        ></v-date-picker>
                      </v-menu>

                      <v-menu
                        v-model="menuRatification"
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
                            v-model="barangayForm.date_ratification"
                            label="Date of Ratification/Plebiscite"
                            :disabled="!isEditing"
                            prepend-icon="mdi-calendar"
                            readonly
                            v-on="on"
                          ></v-text-field>
                        </template>
                        <v-date-picker
                          v-model="barangayForm.date_ratification"
                          no-title
                          color="primary"
                          @input="menuRatification = false"
                        ></v-date-picker>
                      </v-menu>

                      <v-text-field
                        v-model="barangayForm.mother_barangay"
                        label="Mother Barangay/s"
                        :disabled="!isEditing"
                      ></v-text-field>

                      <v-text-field
                        v-model="barangayForm.old_name"
                        label="Old Name, if named"
                        :disabled="!isEditing"
                      ></v-text-field>
                    </v-form>
                  </div>
                  <div class="ml-3">
                    <v-form>
                      <v-select
                        v-model="barangayForm.type_barangay"
                        :items="[ 'Rural', 'Urban', 'Tribal']"
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
                        v-model="barangayForm.boundaries_north"
                        label="North"
                        :disabled="!isEditing"
                      ></v-text-field>

                      <v-text-field
                        v-model="barangayForm.boundaries_east"
                        label="East"
                        :disabled="!isEditing"
                      ></v-text-field>

                      <v-text-field
                        v-model="barangayForm.boundaries_west"
                        label="West"
                        :disabled="!isEditing"
                      ></v-text-field>

                      <v-text-field
                        v-model="barangayForm.boundaries_south"
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
                        v-model="barangayForm.totalland_area_sqkm"
                        label="Total Land Area (sq. km.)"
                        :disabled="!isEditing"
                      ></v-text-field>

                      <v-text-field
                        v-model="barangayForm.totalland_area_hec"
                        label="Total Land Area (hec.)"
                        :disabled="!isEditing"
                      ></v-text-field>
                    </v-form>
                  </div>
                  <div>D. Distance from:</div>
                  <div class="mx-3">
                    <v-form>
                      <v-text-field
                        v-model="barangayForm.distance_municipal_city"
                        label="City/Municipal Hall"
                        :disabled="!isEditing"
                      ></v-text-field>

                      <v-text-field
                        v-model="barangayForm.province_capitol"
                        label="Provincial Capitol"
                        :disabled="!isEditing"
                      ></v-text-field>

                      <v-text-field
                        v-model="barangayForm.national_highway"
                        label="National Highway"
                        :disabled="!isEditing"
                      ></v-text-field>
                    </v-form>
                  </div><br/>
                  <div>E. Land Form</div>
                  <div> 
                    <v-data-table 
                      id="landForms"
                      :headers="headersLandForms" 
                      :items="landforms" 
                      :loading="loadingLandForms"
                      hide-default-footer>
                      <template v-slot:top>
                        <v-dialog v-model="dialogLandForm" max-width="175px">
                          <v-form
                            ref="formLandForms"
                            v-model="valid"
                            lazy-validation 
                            @submit.prevent="updateLandForm()">
                            <v-card>
                              <v-card-title>
                                <span class="headline">Edit Row</span>
                              </v-card-title>
                        
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-layout wrap>
                                    <v-flex xs12 md12>
                                      <v-text-field v-model="landformForm.landform_type" label="Percent"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md12>
                                      <v-text-field v-model="landformForm.percent" label="Percent"></v-text-field>
                                    </v-flex>
                                  </v-layout>
                                </v-container>
                              </v-card-text>

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="dialogLandForm = false">Cancel</v-btn>
                                <v-btn 
                                  color="blue darken-1" 
                                  text type="submit" 
                                  @click="submitLandForms"
                                >Save</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-form>
                        </v-dialog>
                      </template>

                      <template v-slot:items="props">
                        <td>{{ props.item.landform_type }}</td>
                        <td>{{ props.item.percent }}</td>
                      </template>

                      <template v-slot:item.action="{ item }">
                        <v-tooltip attach bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn text icon @click="editLandFormDialog(item)">
                              <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                          </template>
                          <span>Edit</span>
                        </v-tooltip>
                      </template>
                    </v-data-table>
                  </div>
                  <v-btn
                    color="success"
                    type="submit"
                    :disabled="!isEditing"
                    @click.prevent="updateBarangay"
                  >Save</v-btn>
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
                      id="landUses"
                      :headers="headersLandUses" 
                      :items="landuses" 
                      hide-default-footer>
                      <template v-slot:top>
                        <v-dialog v-model="dialogLandUse" max-width="300px">
                          <v-form
                            ref="formLandUses"
                            v-model="valid"
                            lazy-validation 
                            @submit.prevent="updateLandUse()">
                            <v-card>
                              <v-card-title>
                                <span class="headline">Edit Row</span>
                              </v-card-title>
                        
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-layout wrap>
                                    <v-flex xs4 md12>
                                      <v-text-field v-model="landUseForm.land_area_sqm" label="Land Area (sq. kms.)"></v-text-field>
                                    </v-flex>
                                    <v-flex xs4 md12>
                                      <v-text-field v-model="landUseForm.land_area_hec" label="Land Area (hectares)"></v-text-field>
                                    </v-flex>
                                    <v-flex xs4 md12>
                                      <v-text-field v-model="landUseForm.totalpop" label="% Total Population"></v-text-field>
                                    </v-flex>
                                  </v-layout>
                                </v-container>
                              </v-card-text>

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="dialogLandUse = false">Cancel</v-btn>
                                <v-btn 
                                  color="blue darken-1" 
                                  text type="submit" 
                                  @click="submitLandUses"
                                >Save</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-form>
                        </v-dialog>
                      </template>

                      <template v-slot:items="props">
                        <td>{{ props.item.landuse_type }}</td>
                        <td>{{ props.item.land_area_sqm }}</td>
                        <td>{{ props.item.land_area_hec }}</td>
                        <td>{{ props.item.totalpop }}</td>
                      </template>

                      <template v-slot:item.action="{ item }">
                        <v-tooltip attach bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn text icon @click="editLandUseDialog(item)">
                              <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                          </template>
                          <span>Edit</span>
                        </v-tooltip>
                      </template>
                    </v-data-table>
                  </div>
                </v-flex>
                <v-flex xs6>
                  <div>For Table H: Household Distribution</div>
                  <v-form>
                    <v-text-field v-model="householdDistributionForm.total_no_hhold" label="Total no. of households - 3 years ago" :disabled="!isEditing"
                    ></v-text-field>
                    <v-text-field v-model="householdDistributionForm.ave_persons_hhold" label="Average no. of persons per household - 3 years ago" :disabled="!isEditing"
                    ></v-text-field>
                    <v-text-field v-model="householdDistributionForm.ave_income_hhold" label="Average income per household - 3 years ago" :disabled="!isEditing"
                    ></v-text-field>
                  </v-form>
                  <div>Employment Data</div>
                  <v-form>
                    <v-text-field v-model="householdDistributionForm.rank1_employment" label="Rank 1 employment" :disabled="!isEditing"
                    ></v-text-field>
                    <v-text-field v-model="householdDistributionForm.rank2_employment" label="Rank 2 employment" :disabled="!isEditing"
                    ></v-text-field>
                    <v-text-field v-model="householdDistributionForm.rank3_employment" label="Rank 3 employment" :disabled="!isEditing"
                    ></v-text-field>
                  </v-form>
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
                      id="healthFacilities" 
                      :headers="headersHealthFacilities" 
                      :items="healthfacilities" 
                      hide-default-footer>
                      <template v-slot:top>
                        <v-dialog v-model="dialog3" max-width="450px">
                          <v-form
                            ref="formHealthFacilities"
                            v-model="valid"
                            lazy-validation 
                            @submit.prevent="updateHealthFacility()">
                            <v-card>
                              <v-card-title>
                                <span class="headline">Edit Row</span>
                              </v-card-title>
                        
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-layout wrap>
                                    <v-flex md12>
                                      <v-text-field v-model="healthFacilityForm.number" label="Number"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-text-field v-model="healthFacilityForm.numpatients" label="Number of patients served (preceding year)"></v-text-field>
                                    </v-flex>
                                  </v-layout>
                                </v-container>
                              </v-card-text>

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="dialogHealthFacility = false">Cancel</v-btn>
                                <v-btn 
                                  color="blue darken-1" 
                                  text type="submit" 
                                  @click="submitHealthFacilities"
                                >Save</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-form>
                        </v-dialog>
                      </template>

                      <template v-slot:items="props">
                        <td>{{ props.item.healthfacility_type }}</td>
                        <td>{{ props.item.number }}</td>
                        <td>{{ props.item.numpatients }}</td>
                      </template>

                      <template v-slot:item.action="{ item }">
                        <v-tooltip bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn text icon @click="editHealthFacilityDialog(item)" v-on="on">
                              <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                          </template>
                          <span>Edit</span>
                        </v-tooltip>
                      </template>
                    </v-data-table>
                  </div>
                  <v-form>
                    <v-text-field v-model="healthFacilityForm.otherSpecify" label="Other Health Facilities" :disabled="!isEditing"
                    ></v-text-field>
                  </v-form>
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
                      id="education"
                      :headers="headersEducations" 
                      :items="educations" 
                      hide-default-footer>
                      <template v-slot:top>
                        <v-dialog v-model="dialogEducation" max-width="175px">
                          <v-form
                            ref="formEducations"
                            v-model="valid"
                            lazy-validation 
                            @submit.prevent="updateEducation()">
                            <v-card>
                              <v-card-title>
                                <span class="headline">Edit Row</span>
                              </v-card-title>
                        
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-layout wrap>
                                    <v-flex md12>
                                      <v-text-field v-model="educationForm.education_number" label="Number"></v-text-field>
                                    </v-flex>
                                  </v-layout>
                                </v-container>
                              </v-card-text>
                        
                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="close4">Cancel</v-btn>
                                <v-btn color="blue darken-1" text @click="save4">Save</v-btn>
                              </v-card-actions>

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn 
                                  color="blue darken-1" 
                                  text 
                                  @click="dialogEducation = false">
                                  Cancel
                                </v-btn>
                                <v-btn 
                                  color="blue darken-1" 
                                  text type="submit" 
                                  @click="submitEducations"
                                >Save</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-form>
                        </v-dialog>
                      </template>

                      <template v-slot:items="props">
                        <td>{{ props.item.education_type }}</td>
                        <td>{{ props.item.education_number }}</td>
                      </template>

                      <template v-slot:item.action="{ item }">
                        <v-tooltip bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn text icon @click="editEducationDialog(item)">
                              <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                          </template>
                          <span>Edit</span>
                        </v-tooltip>
                      </template>
                    </v-data-table>
                  </div>
                </v-flex>
                <v-flex xs6>
                  <div>For Table D: Sports and Recreational Facilities</div>
                  <div>
                    <v-data-table
                      id="sports" 
                      :headers="headersSports" 
                      :items="sports" 
                      hide-default-footer>
                      <template v-slot:top>
                        <v-dialog v-model="dialog5" max-width="175px">
                          <v-form
                            ref="formSports"
                            v-model="valid"
                            lazy-validation 
                            @submit.prevent="updateSport()">
                            <v-card>
                              <v-card-title>
                                <span class="headline">Edit Row</span>
                              </v-card-title>
                        
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-layout wrap>
                                    <v-flex md12>
                                      <v-text-field v-model="educationForm.sports_number" label="Number"></v-text-field>
                                    </v-flex>
                                  </v-layout>
                                </v-container>
                              </v-card-text>

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn 
                                  color="blue 
                                  darken-1" 
                                  text 
                                  @click="dialogSport = false">
                                  Cancel
                                </v-btn>
                                <v-btn 
                                  color="blue darken-1" 
                                  text type="submit" 
                                  @click="submitSports"
                                >Save</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-form>
                        </v-dialog>
                      </template>

                      <template v-slot:items="props">
                        <td>{{ props.item.sports_type }}</td>
                        <td>{{ props.item.sports_number }}</td>
                      </template>

                      <template v-slot:item.action="{ item }">
                        <v-tooltip bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn text icon @click="editSportDialog(item)">
                              <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                          </template>
                          <span>Edit</span>
                        </v-tooltip>
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
                      id="meters" 
                      :headers="headersMeters" 
                      :items="meters" 
                      hide-default-footer>
                      <template v-slot:top>
                        <v-dialog v-model="dialogMeter" max-width="300px">
                          <v-form
                            ref="formMeters"
                            v-model="valid"
                            lazy-validation 
                            @submit.prevent="updateMeter()">  
                            <v-card>
                              <v-card-title>
                                <span class="headline">Edit Row</span>
                              </v-card-title>
                        
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-layout wrap>
                                    <v-flex md12>
                                      <v-text-field v-model="infrastructureForm.national_m" label="National"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-text-field v-model="infrastructureForm.provincial_m" label="Provincial"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-text-field v-model="infrastructureForm.city_m" label="City/Municipality"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-text-field v-model="infrastructureForm.barangay_m" label="Barangay"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-text-field v-model="infrastructureForm.total_m" label="Barangay"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-text-field v-model="infrastructureForm.operational_m" label="Barangay"></v-text-field>
                                    </v-flex>
                                  </v-layout>
                                </v-container>
                              </v-card-text>
                        
                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="close6">Cancel</v-btn>
                                <v-btn color="blue darken-1" text @click="save6">Save</v-btn>
                              </v-card-actions>

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn 
                                  color="blue 
                                  darken-1" 
                                  text 
                                  @click="dialogMeter = false">
                                  Cancel
                                </v-btn>
                                <v-btn 
                                  color="blue darken-1" 
                                  text type="submit" 
                                  @click="submitMeters"
                                >Save</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-form>
                        </v-dialog>
                      </template>

                      <template v-slot:items="props">
                        <td>{{ props.item.meter_type }}</td>
                        <td>{{ props.item.national_m }}</td>
                        <td>{{ props.item.provincial_m }}</td>
                        <td>{{ props.item.city_m }}</td>
                        <td>{{ props.item.barangay_m }}</td>
                        <td>{{ props.item.total_m }}</td>
                        <td>{{ props.item.operational_m }}</td>
                      </template>

                      <template v-slot:item.action="{ item }">
                        <v-tooltip bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn text icon @click="editMeterDialog(item)">
                              <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                          </template>
                          <span>Edit</span>
                        </v-tooltip>
                      </template>
                    </v-data-table>
                  </div><br/>
                  <div ml-3>Bridge by Administrative level (in kilometers)</div>
                  <div class="ml-5">
                    <v-data-table 
                      id="kilometers"
                      :headers="headersKilometers" 
                      :items="kilometers" 
                      hide-default-footer>
                      <template v-slot:top>
                        <v-dialog v-model="dialogKilometer" max-width="300px">
                          <v-form
                            ref="formKilometers"
                            v-model="valid"
                            lazy-validation 
                            @submit.prevent="updateKilometer()">
                            <v-card>
                              <v-card-title>
                                <span class="headline">Edit Row</span>
                              </v-card-title>
                        
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-layout wrap>
                                    <v-flex md12>
                                      <v-text-field v-model="infrastructureForm.national_km" label="National"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-text-field v-model="infrastructureForm.provincial_km" label="Provincial"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-text-field v-model="infrastructureForm.city_km" label="City/Municipality"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-text-field v-model="infrastructureForm.barangay2" label="Barangay"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-text-field v-model="infrastructureForm.total_km" label="Barangay"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-text-field v-model="infrastructureForm.operational_km" label="Barangay"></v-text-field>
                                    </v-flex>
                                  </v-layout>
                                </v-container>
                              </v-card-text>
                        
                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="close7">Cancel</v-btn>
                                <v-btn color="blue darken-1" text @click="save7">Save</v-btn>
                              </v-card-actions>

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn 
                                  color="blue 
                                  darken-1" 
                                  text 
                                  @click="dialogKilometer = false">
                                  Cancel
                                </v-btn>
                                <v-btn 
                                  color="blue darken-1" 
                                  text type="submit" 
                                  @click="submitKilometers"
                                >Save</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-form>
                        </v-dialog>
                      </template>

                      <template v-slot:items="props">
                        <td>{{ props.item.kilometer_type }}</td>
                        <td>{{ props.item.national_km }}</td>
                        <td>{{ props.item.provincial_km }}</td>
                        <td>{{ props.item.city_km }}</td>
                        <td>{{ props.item.barangay_km }}</td>
                        <td>{{ props.item.total_km }}</td>
                        <td>{{ props.item.operational_km }}</td>
                      </template>

                      <template v-slot:item.action="{ item }">
                        <v-tooltip bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn text icon @click="editKilometerDialog(item)" v-on="on">
                              <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                          </template>
                          <span>Edit</span>
                        </v-tooltip>
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
                      id="communications" 
                      :headers="headersCommunications" 
                      :items="communications" 
                      hide-default-footer>

                      <template v-slot:top>
                        <v-dialog v-model="dialogCommunication" max-width="300px">
                          <v-form
                            ref="formCommunications"
                            v-model="valid"
                            lazy-validation 
                            @submit.prevent="editmode ? updateCommunication() : createCommunication()"
                          >
                            <v-card>
                              <v-card-title>
                                <span class="headline" v-show="!editmode">Add a new communication</span>
                                <span class="headline" v-show="editmode">Edit communication information</span>
                              </v-card-title>
                        
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-layout wrap>
                                    <v-flex md12>
                                      <v-text-field v-model="communicationForm.totalProvider" label="Total Providers"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-text-field v-model="communicationForm.name_company" label="Company Name"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-text-field v-model="communicationForm.no_hhold_served" label="No. of Served Households"></v-text-field>
                                    </v-flex>
                                  </v-layout>
                                </v-container>
                              </v-card-text>

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="dialogCommunication = false">Cancel</v-btn>
                                <v-btn 
                                  color="blue darken-1" 
                                  text type="submit" 
                                  @click="submitCommunications"
                                >Save</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-form>
                        </v-dialog>
                      </template>

                      <template v-slot:items="props">
                        <td>{{ props.item.communication_type }}</td>
                        <td>{{ props.item.totalProvider }}</td>
                        <td>{{ props.item.name_company }}</td>
                        <td>{{ props.item.no_hhold_served }}</td>
                      </template>

                      <template v-slot:item.action="{ item }">
                        <v-tooltip attach bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn text icon @click="editCommunicationDialog(item)">
                              <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                          </template>
                          <span>Edit</span>
                        </v-tooltip>
                        <v-tooltip attach bottom>
                          <template v-slot:activator="{ on }">
                            <v-btn v-on="on" icon @click="newCommunicationDialog()">
                              <v-icon>mdi-account-plus</v-icon>
                            </v-btn>
                          </template>
                          <span>Add new communication</span>
                        </v-tooltip>
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
      editmode: false,
      menuLegal: false,
      menuRatification: false,
      isEditing: null,    
      barangayForm: new Form({
        id: "",
        name: "",    
        province: "",
        muni_city: "",
        zip_code: "",
        region: "",
        legal_basis: "",
        date_legal_basis: "",
        date_ratification: "",
        mother_barangay: "",
        old_name: "",
        type_barangay: "",
        boundaries_north: "",
        boundaries_east: "",
        boundaries_west: "",
        boundaries_south: "",
        totalland_area_sqkm: "",
        totalland_area_hec: "",
        distance_municipal_city: "",
        province_capitol: "",
        national_highway: ""
      }),  
      dialogLandForm: false,
      headersLandForms: [
        { text: 'Type', value: 'landform_type', align: 'center', sortable: false },
        { text: 'Percent', value: 'percent', align: 'center', sortable: false },
        { text: 'Actions', value: 'action', align: 'center', sortable: false }
      ],
      valid: true,
      landforms: [],
      landformForm: new Form({
        id: "",
        landform_type: "",    
        percent: ""
      }),
      dialogLandUse: false,
      headersLandUses: [
        { text: 'Type', value: 'landuse_type', align: 'center', sortable: false },
        { text: 'Land Area (Square kms.)', value: 'land_area_sqm', align: 'center', sortable: false },
        { text: 'Land Area (Hectares)', value: 'land_area_hec', align: 'center', sortable: false },
        { text: 'Total Population', value: 'totalpop', sortable: false, align: 'center', sortable: false },
        { text: 'Actions', value: 'action', align: 'center', sortable: false }
      ],
      landuses: [],
      landUseForm: new Form({
        id: "",
        landuse_type: "", 
        land_area_sqm: "",
        land_area_hec: "",
        totalpop: ""
      }),
      householdDistributionForm: new Form({
        id: "",
        total_no_hhold: "",
        ave_persons_hhold: "",
        ave_income_hhold: "",
        rank1_employment: "",
        rank2_employment: "",
        rank3_employment: "",
      }),
      dialogHealthFacility: false,
      headersHealthFacilities: [
        { text: 'Type', value: 'healthfacility_type', align: 'center', sortable: false },
        { text: 'Number', value: 'number', align: 'center', sortable: false },
        { text: 'Number of patients served (preceding year)', value: 'numpatients', align: 'center', sortable: false },
        { text: 'Actions', value: 'action', align: 'center', sortable: false, width: "1%" }
      ],
      healthfacilities: [],
      healthFacilityForm: new Form({
        id: "",
        healthfacility_type: "",
        number: "",
        numpatients: "",
        otherSpecify: ""
      }),
      dialogEducation: false,
      headersEducations: [
        { text: 'Type', value: 'education_type', align: 'center', sortable: false },
        { text: 'Number', value: 'education_number', align: 'center', sortable: false },
        { text: 'Actions', value: 'action', align: 'center', sortable: false }
      ],
      educations: [],
      dialogSport: false,
      headersSports: [
        { text: 'Type', value: 'sports_type', align: 'center', sortable: false },
        { text: 'Number', value: 'sports_number', align: 'center', sortable: false },
        { text: 'Actions', value: 'action', align: 'center', sortable: false }
      ],
      sports: [],
      educationForm: new Form({
        id: "",
        education_type: "",
        education_number: "",
        sports_type: "",
        sports_number: "",
        total_facilities: ""
      }),
      dialogMeter: false,
      headersMeters: [
        { text: 'Type', value: 'meter_type', align: 'center', sortable: false },
        { text: 'National', value: 'national_m', align: 'center', sortable: false },
        { text: 'Provincial', value: 'provincial_m', align: 'center', sortable: false },
        { text: 'City/Municipality', value: 'city_m', align: 'center', sortable: false },
        { text: 'Barangay', value: 'barangay_m', align: 'center', sortable: false },
        { text: 'Total', value: 'total_m', align: 'center', sortable: false },
        { text: 'Operational', value: 'operational_m', align: 'center', sortable: false },
        { text: 'Actions', value: 'action', align: 'center', sortable: false }
      ],
      meters: [],
      dialogKilometer: false,
      headersKilometers: [
        { text: 'Type', value: 'kilometer_type', align: 'center', sortable: false },
        { text: 'National', value: 'national_km', align: 'center', sortable: false },
        { text: 'Provincial', value: 'provincial_km', align: 'center', sortable: false },
        { text: 'City/Municipality', value: 'city_km', align: 'center', sortable: false },
        { text: 'Barangay', value: 'barangay_km', align: 'center', sortable: false },
        { text: 'Total', value: 'total_km', align: 'center', sortable: false },
        { text: 'Operational', value: 'operational_km', align: 'center', sortable: false },
        { text: 'Actions', value: 'action', align: 'center', sortable: false }
      ],
      kilometers: [],
      infrastructureForm: new Form({
        id: "",
        meter_type: "",
        national_m: "",
        provincial_m: "",
        city_m: "",
        barangay_m: "",
        total_m: "",
        operational_m: "",
        national_m_total: "",
        provincial_m_total: "",
        city_m_total: "",
        barangay_m_total: "",
        total_m_total: "",
        operational_m_total: "",
        kilometer_type: "",
        national_km: "",
        provincial_km: "",
        city_km: "",
        barangay_km: "",
        total_km: "",
        operational_km: "",
        national_km_total: "",
        provincial_km_total: "",
        city_km_total: "",
        barangay_km_total: "",
        total_km_total: "",
        operational_km_total: ""
      }),
      dialogCommunication: false,
      headersCommunications: [
        { text: 'Type', value: 'communication_type', align: 'center', sortable: false },
        { text: 'Total Provider', value: 'totalProvider', align: 'center', sortable: false },
        { text: 'Name of Company', value: 'name_company', align: 'center', sortable: false },
        { text: 'No. of households served', value: 'no_hhold_served', align: 'center', sortable: false },
        { text: 'Actions', value: 'action', align: 'center', sortable: false }
      ],
      communications: [],
      communicationForm: new Form({
        id: "",
        communication_type: "",
        totalProvider: "",
        name_company: "",
        no_hhold_served: ""
      })
    }),

    created () {
      this.getBarangay();
      this.getLandForms();
      this.getLandUses();
      this.getHouseholdDistribution();
      this.getHealthFacilities();
      this.getEducations();
      this.getSports();
      this.getMeters();
      this.getKilometers();
      this.getCommunications();
    },

    methods: {
      getBarangay() {
        axios.get("api/barangayForm").then(({ data }) => this.barangayForm.fill(data));
      },
      
      updateBarangay() {
        this.barangayForm.put("api/barangayForm").then(() => {
        toast.fire({
          type: "success",
          title: "Barangay has been updated"
        });
      });
      },

      getLandForms() {
        this.loadingLandForms = true;
        axios.get("api/landForm").then(response => {
          this.landforms = response.data;
          this.loadingLandForms = false;
        });
      },

      updateLandForm() {
        this.landformForm
          .put("api/landForm/" + this.landformForm.id)
          .then(() => {
            this.dialogLandForm = false;
            this.getLandForms();
            toast.fire({
              type: "success",
              title: "Land Form has been edited"
            });
          })
          .catch(() => {});
      },

      getLandUses() {
        axios.get("api/landUse").then(response => {
          this.landuses = response.data;
        });
      },

      updateLandUse() {
        this.landUseForm
          .put("api/landUse/" + this.landUseForm.id)
          .then(() => {
            this.dialogLandUse = false;
            this.getLandUses();
            toast.fire({
              type: "success",
              title: "Land Use has been edited"
            });
          })
          .catch(() => {});
      },

      getHouseholdDistribution() {
        axios.get("api/householdDistribution").then(({ data }) => this.householdDistributionForm.fill(data));
      },

      updateHouseholdDistribution() {
        this.householdDistributionForm.put("api/householdDistribution").then(() => {
          toast.fire({
            type: "success",
            title: "Household Distribution has been updated"
          });
        });
      },

      getHealthFacilities() {
        axios.get("api/healthFacility").then(response => {
          this.healthfacilities = response.data;
        });
      },

      updateHealthFacility() {
        this.healthFacilityForm
          .put("api/healthFacility/" + this.healthFacilityForm.id)
          .then(() => {
            this.dialogHealthFacility = false;
            this.getHealthFacilities();
            toast.fire({
              type: "success",
              title: "Health Facility has been edited"
            });
          })
          .catch(() => {});
      },

      getEducations() {
        axios.get("api/education").then(response => {
          this.educations = response.data;
        });
      },

      updateEducation() {
        this.educationForm
          .put("api/education/" + this.educationForm.id)
          .then(() => {
            this.dialogEducation = false;
            this.getEducations();
            toast.fire({
              type: "success",
              title: "Education has been edited"
            });
          })
          .catch(() => {});
      },

      getSports() {
        axios.get("api/education").then(response => {
          this.sports = response.data;
        });
      },

      updateSport() {
        this.educationForm
          .put("api/education/" + this.educationForm.id)
          .then(() => {
            this.dialogSport = false;
            this.getSports();
            toast.fire({
              type: "success",
              title: "Sport has been edited"
            });
          })
          .catch(() => {});
      },

      getMeters() {
        axios.get("api/infrastructure").then(response => {
          this.meters = response.data;
        });
      },

      updateMeter() {
        this.infrastructureForm
          .put("api/infrastructure/" + this.infrastructureForm.id)
          .then(() => {
            this.dialogMeter = false;
            this.getMeters();
            toast.fire({
              type: "success",
              title: "Infrastructure has been edited"
            });
          })
          .catch(() => {});
      },

      getKilometers() {
        axios.get("api/infrastructure").then(response => {
          this.kilometers = response.data;
        });
      },

      updateKilometer() {
        this.infrastructureForm
          .put("api/infrastructure/" + this.infrastructureForm.id)
          .then(() => {
            this.dialogKilometer = false;
            this.getKilometers();
            toast.fire({
              type: "success",
              title: "Infrastructure has been edited"
            });
          })
          .catch(() => {});
      },

      getCommunications() {
        axios.get("api/communication").then(response => {
          this.communications = response.data;
        });
      },

      createCommunication(id) {
        this.communicationForm
          .post("api/communication")
          .then(() => {
            this.dialogCommunication = false;
            this.getCommunications();
            toast.fire({
              type: "success",
              title: "Communication has been created"
            });
          })
          .catch(() => {});
      },

      updateCommunication() {
        this.communicationForm
          .put("api/communication/" + this.communicationForm.id)
          .then(() => {
            this.dialogCommunication = false;
            this.getCommunications();
            toast.fire({
              type: "success",
              title: "Communication has been edited"
            });
          })
          .catch(() => {});
      },

      editLandFormDialog(landforms) {
        this.landformForm.reset();
        this.dialogLandForm = true;
        this.landformForm.fill(landforms);
      },

      submitLandForms() {
        this.$refs.formLandForms.validate();
      },

      editLandUseDialog(landuses) {
        this.landUseForm.reset();
        this.dialogLandUse = true;
        this.landUseForm.fill(landuses);
      },

      submitLandUses() {
        this.$refs.formLandUses.validate();
      },

      editHealthFacilityDialog(healthfacilities) {
        this.healthFacilityForm.reset();
        this.dialogHealthFacility = true;
        this.healthFacilityForm.fill(healthfacilities);
      },

      submitHealthFacilities() {
        this.$refs.formHealthFacilities.validate();
      },

      editEducationDialog(educations) {
        this.educationForm.reset();
        this.dialogEducation = true;
        this.educationForm.fill(educations);
      },

      submitEducations() {
        this.$refs.formEducations.validate();
      },

      editSportDialog(sports) {
        this.educationForm.reset();
        this.dialogSport = true;
        this.educationForm.fill(sports);
      },

      submitSports() {
        this.$refs.formSports.validate();
      },

      editMeterDialog(meters) {
        this.infrastructureForm.reset();
        this.dialogMeter = true;
        this.infrastructureForm.fill(meters);
      },

      submitMeters() {
        this.$refs.formMeters.validate();
      },

      editKilometerDialog(kilometers) {
        this.infrastructureForm.reset();
        this.dialogKilometer = true;
        this.infrastructureForm.fill(kilometers);
      },

      submitKilometers() {
        this.$refs.formKilometers.validate();
      },

      newCommunicationDialog() {
        this.editmode = false;
        this.communicationForm.reset();
        this.dialogCommunication = true;
      },

      editCommunicationDialog(communications) {
        this.editmode = true;
        this.communicationForm.reset();
        this.dialogCommunication = true;
        this.communicationForm.fill(communications);
      },

      submitCommunications() {
        this.$refs.formCommunications.validate();
      }
    }
  }
</script>

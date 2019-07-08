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
                  <v-form>
                    <v-text-field v-model="barangayForm.zip_code" label="Barangay Code" :disabled="!isEditing"
                    ></v-text-field>
                    <v-text-field v-model="barangayForm.region" label="Region" :disabled="!isEditing"
                    ></v-text-field>
                    <v-text-field v-model="barangayForm.province" label="Province" :disabled="!isEditing"
                    ></v-text-field>
                    <v-text-field v-model="barangayForm.municipality" label="Municipality/City" :disabled="!isEditing"
                    ></v-text-field>
                  </v-form>
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
                  <div> 
                    <v-toolbar flat color="white">
                      <v-toolbar-title>Land Forms</v-toolbar-title>
                      <v-divider
                        class="mx-3"
                        inset
                        vertical
                      ></v-divider>
                    </v-toolbar>
                    <v-data-table 
                      id="landForms"
                      :headers="headersLandForms" 
                      :items="landforms" 
                      hide-default-footer>
                      <template v-slot:top>
                        <v-dialog v-model="dialogLandForm" max-width="400px">
                          <v-form
                            ref="barangayForm"
                            v-model="validBarangayForm"
                            lazy-validation 
                            @submit.prevent="updateLandForm()"
                          >
                            <v-card>
                              <v-card-title>
                                <span class="headline">Edit land form information</span>
                              </v-card-title>
                              <v-divider></v-divider>
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-layout wrap>
                                    <v-flex xs12 md12>
                                      <v-card-text>Mountainous</v-card-text>
                                      <v-select
                                        v-model="barangayForm.mountainous"
                                        :items="['0-25%', '26-50%', '51-75%', '76-100%']"
                                        label="Percent"
                                        :rules="[v => !!v || 'Percent is required']"
                                        required
                                      ></v-select>
                                    </v-flex>
                                    <v-flex xs12 md12>
                                      <v-card-text>Plain</v-card-text>
                                      <v-select
                                        v-model="barangayForm.plain"
                                        :items="['0-25%', '26-50%', '51-75%', '76-100%']"
                                        label="Percent"
                                        :rules="[v => !!v || 'Percent is required']"
                                        required
                                      ></v-select>
                                    </v-flex>
                                    <v-flex xs12 md12>
                                      <v-card-text>Valley</v-card-text>
                                      <v-select
                                        v-model="barangayForm.valley"
                                        :items="['0-25%', '26-50%', '51-75%', '76-100%']"
                                        label="Percent"
                                        :rules="[v => !!v || 'Percent is required']"
                                        required
                                      ></v-select>
                                    </v-flex>
                                  </v-layout>
                                </v-container>
                              </v-card-text>

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn 
                                  color="blue darken-1" 
                                  text 
                                  @click="cancelLandForm()"
                                >Cancel</v-btn>
                                <v-btn 
                                  color="blue darken-1"
                                  :disabled="!validBarangayForm" text 
                                  type="submit" 
                                >Save</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-form>
                        </v-dialog>
                      </template>

                      <template v-slot:items="props">
                        <td>{{ props.item.landform_type }}</td>
                        <td>{{ props.item.landform_percent }}</td>
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
                  <v-spacer></v-spacer>
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
                  <div>
                    <v-toolbar flat color="white">
                      <v-toolbar-title>Distribution of Land Use</v-toolbar-title>
                      <v-divider
                        class="mx-3"
                        inset
                        vertical
                      ></v-divider>
                    </v-toolbar>
                    <v-data-table 
                      id="landUses"
                      :headers="headersLandUses" 
                      :items="landuses" 
                      hide-default-footer>
                      <template v-slot:top>
                        <v-dialog v-model="dialogLandUse" max-width="300px">
                          <v-form
                            ref="landUseForm"
                            v-model="validLandUseForm"
                            lazy-validation 
                            @submit.prevent="updateLandUse()">
                            <v-card>
                              <v-card-title>
                                <span class="headline">Edit Land Use Information</span>
                              </v-card-title>
                              <v-divider></v-divider>
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-layout wrap>
                                    <v-flex xs12 md4>
                                      <v-card-text>Residential</v-card-text>
                                      <v-text-field v-model="landUseForm.residential_land_area_sqm" label="Land Area (sq. kms.)"></v-text-field>
                                      <v-text-field v-model="landUseForm.residential_land_area_hec" label="Land Area (hectares)"></v-text-field>
                                      <v-text-field 
                                      v-model="landUseForm.residential_totalpop" label="Total Population"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md4>
                                      <v-card-text>Commercial</v-card-text>
                                      <v-text-field v-model="landUseForm.commercial_land_area_sqm" label="Land Area (sq. kms.)"></v-text-field>
                                      <v-text-field v-model="landUseForm.commercial_land_area_hec" label="Land Area (hectares)"></v-text-field>
                                      <v-text-field 
                                      v-model="landUseForm.commercial_totalpop" label="Total Population"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md4>
                                      <v-card-text>Industrial</v-card-text>
                                      <v-text-field v-model="landUseForm.industrial_land_area_sqm" label="Land Area (sq. kms.)"></v-text-field>
                                      <v-text-field v-model="landUseForm.industrial_land_area_hec" label="Land Area (hectares)"></v-text-field>
                                      <v-text-field 
                                      v-model="landUseForm.industrial_totalpop" label="Total Population"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md4>
                                      <v-card-text>Agricultural</v-card-text>
                                      <v-text-field v-model="landUseForm.agricultural_land_area_sqm" label="Land Area (sq. kms.)"></v-text-field>
                                      <v-text-field v-model="landUseForm.agricultural_land_area_hec" label="Land Area (hectares)"></v-text-field>
                                      <v-text-field 
                                      v-model="landUseForm.agricultural_totalpop" label="Total Population"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md4>
                                      <v-card-text>Aquatic</v-card-text>
                                      <v-text-field v-model="landUseForm.aquatic_land_area_sqm" label="Land Area (sq. kms.)"></v-text-field>
                                      <v-text-field v-model="landUseForm.aquatic_land_area_hec" label="Land Area (hectares)"></v-text-field>
                                      <v-text-field 
                                      v-model="landUseForm.aquatic_totalpop" label="Total Population"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md4>
                                      <v-card-text>Forest</v-card-text>
                                      <v-text-field v-model="landUseForm.forest_land_area_sqm" label="Land Area (sq. kms.)"></v-text-field>
                                      <v-text-field v-model="landUseForm.forest_land_area_hec" label="Land Area (hectares)"></v-text-field>
                                      <v-text-field 
                                      v-model="landUseForm.forest_totalpop" label="Total Population"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md4>
                                      <v-card-text>Idle</v-card-text>
                                      <v-text-field v-model="landUseForm.idle_land_area_sqm" label="Land Area (sq. kms.)"></v-text-field>
                                      <v-text-field v-model="landUseForm.idle_land_area_hec" label="Land Area (hectares)"></v-text-field>
                                      <v-text-field 
                                      v-model="landUseForm.idle_totalpop" label="Total Population"></v-text-field>
                                    </v-flex>
                                  </v-layout>
                                </v-container>
                              </v-card-text>

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn 
                                  color="blue darken-1" 
                                  text 
                                  @click="cancelLandUse()"
                                >Cancel</v-btn>
                                <v-btn 
                                  color="blue darken-1"
                                  :disabled="!validLandUseForm" text 
                                  type="submit" 
                                >Save</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-form>
                        </v-dialog>
                      </template>

                      <template v-slot:items="props">
                        <td>{{ props.item.landuse_type }}</td>
                        <td>{{ props.item.squarekilometers }}</td>
                        <td>{{ props.item.hectares }}</td>
                        <td>{{ props.item.totalpopulation }}</td>
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
                    <v-text-field v-model="landUseForm.total_no_hhold" label="Total no. of households - 3 years ago" :disabled="!isEditing"
                    ></v-text-field>
                    <v-text-field v-model="landUseForm.ave_persons_hhold" label="Average no. of persons per household - 3 years ago" :disabled="!isEditing"
                    ></v-text-field>
                    <v-text-field v-model="landUseForm.ave_income_hhold" label="Average income per household - 3 years ago" :disabled="!isEditing"
                    ></v-text-field>
                  </v-form>
                  <div>Employment Data</div>
                  <v-form>
                    <v-text-field v-model="landUseForm.rank1_employment" label="Rank 1 employment" :disabled="!isEditing"
                    ></v-text-field>
                    <v-text-field v-model="landUseForm.rank2_employment" label="Rank 2 employment" :disabled="!isEditing"
                    ></v-text-field>
                    <v-text-field v-model="landUseForm.rank3_employment" label="Rank 3 employment" :disabled="!isEditing"
                    ></v-text-field>
                  </v-form>
                  <v-btn
                    color="success"
                    type="submit"
                    :disabled="!isEditing"
                    @click.prevent="updateLandUseForm"
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
                <v-flex xs8>
                  <div>Socio Cultural Data</div><br/>
                  <div>
                    <v-toolbar flat color="white">
                      <v-toolbar-title>Health Facilities</v-toolbar-title>
                      <v-divider
                        class="mx-3"
                        inset
                        vertical
                      ></v-divider>
                    </v-toolbar>
                    <v-data-table
                      id="healthFacilities" 
                      :headers="headersHealthFacilities" 
                      :items="healthfacilities" 
                      hide-default-footer>
                      <template v-slot:top>
                        <v-dialog v-model="dialogHealthFacility" max-width="450px">
                          <v-form
                            ref="healthFacilityForm"
                            v-model="validHealthFacilityForm"
                            lazy-validation 
                            @submit.prevent="updateHealthFacility()">
                            <v-card>
                              <v-card-title>
                                <span class="headline">Edit Health Facility Information</span>
                              </v-card-title>
                              <v-divider></v-divider>
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-layout wrap>
                                    <v-flex md12>
                                      <v-card-text>Public Hospital</v-card-text>
                                      <v-text-field v-model="healthFacilityForm.pubhos_num" label="Number"></v-text-field>
                                      <v-text-field v-model="healthFacilityForm.pubhos_numpatients" label="Number of patients served (preceding year)"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-card-text>Private Hospital</v-card-text>
                                      <v-text-field v-model="healthFacilityForm.prihos_num" label="Number"></v-text-field>
                                      <v-text-field v-model="healthFacilityForm.prihos_numpatients" label="Number of patients served (preceding year)"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-card-text>Health Center</v-card-text>
                                      <v-text-field v-model="healthFacilityForm.healthcenter_num" label="Number"></v-text-field>
                                      <v-text-field v-model="healthFacilityForm.healthcenter_numpatients" label="Number of patients served (preceding year)"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-card-text>Clinic</v-card-text>
                                      <v-text-field v-model="healthFacilityForm.clinic_num" label="Number"></v-text-field>
                                      <v-text-field v-model="healthFacilityForm.clinic_numpatients" label="Number of patients served (preceding year)"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-card-text>Self-medication</v-card-text>
                                      <v-text-field v-model="healthFacilityForm.self_medication_num" label="Number"></v-text-field>
                                      <v-text-field v-model="healthFacilityForm.self_medication_numpatients" label="Number of patients served (preceding year)"></v-text-field>
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

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn 
                                  color="blue darken-1" 
                                  text 
                                  @click="cancelHealthFacility()"
                                >Cancel</v-btn>
                                <v-btn 
                                  color="blue darken-1"
                                  :disabled="!validHealthFacilityForm" text 
                                  type="submit" 
                                >Save</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-form>
                        </v-dialog>
                      </template>

                      <template v-slot:items="props">
                        <td>{{ props.item.healthfacility_type }}</td>
                        <td>{{ props.item.healthfacility_number }}</td>
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
                    <v-toolbar flat color="white">
                      <v-toolbar-title>Education Facilities</v-toolbar-title>
                      <v-divider
                        class="mx-3"
                        inset
                        vertical
                      ></v-divider>
                    </v-toolbar>
                    <v-data-table 
                      id="education"
                      :headers="headersEducations" 
                      :items="educations" 
                      hide-default-footer>
                      <template v-slot:top>
                        <v-dialog v-model="dialogEducation" max-width="175px">
                          <v-form
                            ref="educationForm"
                            v-model="validEducationForm"
                            lazy-validation 
                            @submit.prevent="updateEducation()">
                            <v-card>
                              <v-card-title>
                                <span class="headline">Edit Education Information</span>
                              </v-card-title>
                              <v-divider></v-divider>
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-layout wrap>
                                    <v-flex md12>
                                      <v-card-text>Pre-school</v-card-text>
                                      <v-text-field v-model="educationForm.no_pre_school_building" label="Number"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-card-text>Primary</v-card-text>
                                      <v-text-field v-model="educationForm.no_primary_building" label="Number"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-card-text>Secondary</v-card-text>
                                      <v-text-field v-model="educationForm.no_secondary_building" label="Number"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-card-text>Vocational</v-card-text>
                                      <v-text-field v-model="educationForm.no_vocational_building" label="Number"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-card-text>College</v-card-text>
                                      <v-text-field v-model="educationForm.no_college_building" label="Number"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-card-text>Post-graduate</v-card-text>
                                      <v-text-field v-model="educationForm.no_post_graduate_building" label="Number"></v-text-field>
                                    </v-flex>
                                  </v-layout>
                                </v-container>
                              </v-card-text>

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn 
                                  color="blue darken-1" 
                                  text 
                                  @click="cancelEducation()"
                                >Cancel</v-btn>
                                <v-btn 
                                  color="blue darken-1"
                                  :disabled="!validEducationForm" text 
                                  type="submit" 
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
                          <span>Edit education</span>
                        </v-tooltip>
                      </template>
                    </v-data-table>
                  </div>
                </v-flex>
                <v-flex xs6>
                  <div>For Table D: Sports and Recreational Facilities</div>
                  <div>
                    <v-toolbar flat color="white">
                      <v-toolbar-title>Sport Facilities</v-toolbar-title>
                      <v-divider
                        class="mx-3"
                        inset
                        vertical
                      ></v-divider>
                    </v-toolbar>
                    <v-data-table
                      id="sports" 
                      :headers="headersSports" 
                      :items="sports" 
                      hide-default-footer>
                      <template v-slot:top>
                        <v-dialog v-model="dialogSport" max-width="175px">
                          <v-form
                            ref="educationForm"
                            v-model="validEducationForm"
                            lazy-validation 
                            @submit.prevent="updateSport()">
                            <v-card>
                              <v-card-title>
                                <span class="headline">Edit Sport Information</span>
                              </v-card-title>
                              <v-divider></v-divider>
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-layout wrap>
                                    <v-flex md12>
                                      <v-card-text>Covered Court</v-card-text>
                                      <v-text-field v-model="educationForm.no_covered_courts" label="Number"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-card-text>Gymnasium</v-card-text>
                                      <v-text-field v-model="educationForm.no_gymnasiums" label="Number"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-card-text>Park/Plaza</v-card-text>
                                      <v-text-field v-model="educationForm.no_parks_plaza" label="Number"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-card-text>Other sport facilities</v-card-text>
                                      <v-text-field v-model="educationForm.others_sport_facilities" label="Number"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-card-text>Recreational activities</v-card-text>
                                      <v-text-field v-model="educationForm.recreational_activities" label="Number"></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                      <v-card-text>Total facilities</v-card-text>
                                      <v-text-field v-model="educationForm.total_facilities" label="Number"></v-text-field>
                                    </v-flex>
                                  </v-layout>
                                </v-container>
                              </v-card-text>

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn 
                                  color="blue darken-1" 
                                  text 
                                  @click="cancelSport()"
                                >Cancel</v-btn>
                                <v-btn 
                                  color="blue darken-1"
                                  :disabled="!validEducationForm" text 
                                  type="submit" 
                                >Save</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-form>
                        </v-dialog>
                      </template>

                      <template v-slot:items="props">
                        <td>{{ props.item.sport_type }}</td>
                        <td>{{ props.item.sport_number }}</td>
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
      valid: true, 
      editmode: false,
      menuLegal: false,
      menuRatification: false,
      isEditing: null,   
      dialogLandForm: false,
      headersLandForms: [
        { text: 'Type', value: 'landform_type', align: 'center', sortable: false },
        { text: 'Percent', value: 'landform_percent', align: 'center', sortable: false },
        { text: 'Actions', value: 'action', align: 'center', sortable: false }
      ],
      landforms: [],
      validBarangayForm: true, 
      barangayForm: new Form({
        id: "",
        municipality: "",
        province: "",
        region: "",
        zip_code: "",
        mother_barangay: "",
        old_name: "",
        legal_basis: "",
        date_legal_basis: "",
        date_ratification: "",    
        type_barangay: "",
        boundaries_north: "",
        boundaries_east: "",
        boundaries_west: "",
        boundaries_south: "",
        totalland_area_sqkm: "",
        totalland_area_hec: "",
        distance_municipal_city: "",
        province_capitol: "",
        national_highway: "",
        mountainous: "",
        plain: "",
        valley: ""
      }),      
      dialogLandUse: false,
      headersLandUses: [
        { text: 'Type', value: 'landuse_type', align: 'center', sortable: false },
        { text: 'Square Kilometers', value: 'squarekilometers', align: 'center', sortable: false },
        { text: 'Hectares', value: 'hectares', align: 'center', sortable: false },
        { text: 'Total Population', value: 'totalpopulation', sortable: false, align: 'center', sortable: false },
        { text: 'Actions', value: 'action', align: 'center', sortable: false }
      ],
      landuses: [],
      validLandUseForm: true,
      landUseForm: new Form({
        id: "",
        residential_land_area_sqm: "", 
        residential_land_area_hec: "", 
        residential_totalpop: "", 
        commercial_land_area_sqm: "", 
        commercial_land_area_hec: "", 
        commercial_totalpop: "", 
        industrial_land_area_sqm: "", 
        industrial_land_area_hec: "", 
        industrial_totalpop: "", 
        agricultural_land_area_sqm: "", 
        agricultural_land_area_hec: "", 
        agricultural_totalpop: "", 
        aquatic_land_area_sqm: "", 
        aquatic_land_area_hec: "", 
        aquatic_totalpop: "",
        forest_land_area_sqm: "",
        forest_land_area_hec: "",
        forest_totalpop: "",
        idle_land_area_sqm: "",
        idle_land_area_hec: "",
        idle_land_area_totalpop: "",
        total_no_hhold: "",
        ave_persons_hhold: "",
        ave_income_hhold: "",
        rank1_employment: "",
        rank2_employment: "",
        rank3_employment: ""
      }),
      dialogHealthFacility: false,
      headersHealthFacilities: [
        { text: 'Type', value: 'healthfacility_type', align: 'center', sortable: false },
        { text: 'Number', value: 'healthfacility_number', align: 'center', sortable: false },
        { text: 'Number of patients served (preceding year)', value: 'numpatients', align: 'center', sortable: false },
        { text: 'Actions', value: 'action', align: 'center', sortable: false, width: "1%" }
      ],
      healthfacilities: [],
      validHealthFacilityForm: true,
      healthFacilityForm: new Form({
        id: "",
        pubhos_num: "",
        pubhos_numpatients: "",
        prihos_num: "",
        prihos_numpatients: "",
        healthcenter_num: "",
        healthcenter_numpatients: "",
        clinic_num: "",
        clinic_numpatients: "",
        self_medication_num: "",
        self_medication_numpatients: "",
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
        { text: 'Type', value: 'sport_type', align: 'center', sortable: false },
        { text: 'Number', value: 'sport_number', align: 'center', sortable: false },
        { text: 'Actions', value: 'action', align: 'center', sortable: false }
      ],
      sports: [],
      validEducationForm: true,
      educationForm: new Form({
        id: "",
        no_pre_school_building: "",
        no_primary_building: "",
        no_secondary_building: "",
        no_vocational_building: "",
        no_college_building: "",
        no_post_graduate_building: "",
        no_covered_courts: "",
        no_gymnasiums: "",
        no_parks_plaza: "",
        others_sport_facilities: "",
        recreational_activities: "",
        total_facilities: ""
      }),
      dialogCommunication: false,
      headersCommunications: [
        { text: 'Type', value: 'communication_type', align: 'center', sortable: false },
        { text: 'Total Provider', value: 'totalProvider', align: 'center', sortable: false },
        { text: 'Name of Company', value: 'name_company', align: 'center', sortable: false },
        { text: 'No. of households served', value: 'households_served', align: 'center', sortable: false },
        { text: 'Actions', value: 'action', align: 'center', sortable: false }
      ],
      communications: [],
      validCommunicationForm: true,
      communicationForm: new Form({
        id: "",
        telephone_totalProvider: "",
        telephone_name_company: "",
        telephone_no_hhold_served: "",
        cellular_totalProvider: "",
        cellular_name_company: "",
        cellular_no_hhold_served: "",
        internet_totalProvider: "",
        internet_name_company: "",
        internet_no_hhold_served: "",
        postalservive_totalProvider: "",
        postalservive_name_company: "",
        postalservive_no_hhold_served: "",
        deliveryservice_totalProvider: "",
        deliveryservice_name_company: "",
        deliveryservice_no_hhold_served: ""
      })
    }),

    created () {
      this.getBarangay();
      this.getLandForms();
      this.getLandUses();
      this.getLandUseForm()
      this.getHealthFacilities();
      this.getEducations();
      this.getSports();
      this.getCommunications();
    },

    methods: {
      getBarangay() {
        axios.get("api/barangayForm").then(({ data }) => this.barangayForm.fill(data));
      },

      updateBarangay() {
        this.barangayForm.put("api/updateBarangay").then(() => {
          toast.fire({
            type: "success",
            title: "Barangay has been updated"
          });
          this.isEditing = null;
        });
      },

      getLandForms() {
        axios.get("api/landForm").then(response => {
          this.landforms = response.data;
        });
      },

      updateLandForm() {
        this.barangayForm
          .put("api/updateLandForm/" + this.barangayForm.id)
          .then(() => {
            this.dialogLandForm = false;
            this.getLandForms();
            this.$refs.barangayForm.reset();
            this.barangayForm.reset();
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
          .put("api/updateLandUse/" + this.landUseForm.id)
          .then(() => {
            this.dialogLandUse = false;
            this.getLandUses();
            this.$refs.landUseForm.reset();
            this.landUseForm.reset();
            toast.fire({
              type: "success",
              title: "Land Use has been edited"
            });
          })
          .catch(() => {});
      },

      getLandUseForm() {
        axios.get("api/landUseForm").then(({ data }) => this.landUseForm.fill(data));
      },

      updateLandUseForm() {
        this.landUseForm.put("api/updateLandUseForm").then(() => {
          toast.fire({
            type: "success",
            title: "Land Use Form has been updated"
          });
          this.isEditing = null;
        });
      },

      getHealthFacilities() {
        axios.get("api/healthFacility").then(response => {
          this.healthfacilities = response.data;
        });
      },

      updateHealthFacility() {
        this.healthFacilityForm
          .put("api/updateHealthFacility/" + this.healthFacilityForm.id)
          .then(() => {
            this.dialogHealthFacility = false;
            this.getHealthFacilities();
            this.$refs.healthFacilityForm.reset();
            this.heathFacilityForm.reset();
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
          .put("api/updateEducation/" + this.educationForm.id)
          .then(() => {
            this.dialogEducation = false;
            this.getEducations();
            this.$refs.educationForm.reset();
            this.educationForm.reset();
            toast.fire({
              type: "success",
              title: "Education table has been edited"
            });
          })
          .catch(() => {});
      },

      getSports() {
        axios.get("api/sport").then(response => {
          this.sports = response.data;
        });
      },

      updateSport() {
        this.educationForm
          .put("api/updateSport/" + this.educationForm.id)
          .then(() => {
            this.dialogSport = false;
            this.getSports();
            this.$refs.educationForm.reset();
            this.educationForm.reset();
            toast.fire({
              type: "success",
              title: "Sport table has been edited"
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
          .put("api/updateCommunication/" + this.communicationForm.id)
          .then(() => {
            this.dialogCommunication = false;
            this.getCommunications();
            this.$refs.communicationForm.reset();
            this.communicationForm.reset();
            toast.fire({
              type: "success",
              title: "Communication has been edited"
            });
          })
          .catch(() => {});
      },

      editLandFormDialog(landforms) {
        this.barangayForm.reset();
        this.dialogLandForm = true;
        this.barangayForm.fill(landforms);
      },

      cancelLandForm() {
        this.$refs.barangayForm.reset();
        this.barangayForm.reset();
        this.dialogLandForm = false;
      },

      editLandUseDialog(landuses) {
        this.landUseForm.reset();
        this.dialogLandUse = true;
        this.landUseForm.fill(landuses);
      },

      cancelLandUse() {
        this.$refs.landUseForm.reset();
        this.landUseForm.reset();
        this.dialogLandUse = false;
      },

      editHealthFacilityDialog(healthfacilities) {
        this.healthFacilityForm.reset();
        this.dialogHealthFacility = true;
        this.healthFacilityForm.fill(healthfacilities);
      },

      cancelHealthFacility() {
        this.$refs.healthFacilityForm.reset();
        this.healthFacilityForm.reset();
        this.dialogHealthFacility = false;
      },

      editEducationDialog(educations) {
        this.educationForm.reset();
        this.dialogEducation = true;
        this.educationForm.fill(educations);
      },

      cancelEducation() {
        this.$refs.educationForm.reset();
        this.educationForm.reset();
        this.dialogEducation = false;
      },

      editSportDialog(sports) {
        this.educationForm.reset();
        this.dialogSport = true;
        this.educationForm.fill(sports);
      },

      cancelSport() {
        this.$refs.educationForm.reset();
        this.educationForm.reset();
        this.dialogSport = false;
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

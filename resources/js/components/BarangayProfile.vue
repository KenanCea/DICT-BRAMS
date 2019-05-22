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
                    <v-btn small color="primary">Print</v-btn>
                    <v-btn small color="primary">Edit</v-btn>
                  </div>
                </v-flex> 
              </v-layout>
              <v-layout>
                <v-flex xs6>
                  <div>I. General Information</div>
                  <div class="ml-3">A. Creation</div>
                  <div class="ml-4">Legal Basis:</div>
                  <div class="ml-4">Date Legal Basis:</div>
                  <div class="ml-4">Date Ratification/Plebiscite:</div>
                  <div class="ml-4">Mother Barangay/s</div>
                  <div class="ml-4">Old Name, if named:</div>
                  <div class="ml-3">B. Type of Barangay</div>
                  <div class="ml-4">Boundaries</div>
                  <div class="ml-5">North:</div>
                  <div class="ml-5">East:</div>
                  <div class="ml-5">West:</div>
                  <div class="ml-5">South:</div>
                </v-flex>
                <v-flex xs6>
                  <div>C. Total Land Area</div>
                  <div class="mx-3">Total Land Area (sq. km.):</div>
                  <div class="mx-3">Total Land Area (hec.):</div>
                  <div>D. Distance from:</div>
                  <div class="mx-3">City/Municipal Hall:</div>
                  <div class="mx-3">Provincial Capitol:</div>
                  <div class="mx-3">National Highway:</div>
                  <div>E. Land Form</div>
                  <div> 
                  <v-data-table 
                    :headers="headers" 
                    :items="land" 
                    hide-actions 
                    class="elevation-1">
                      <template slot="items" slot-scope="props">
                          <td>{{ props.item.type }}</td>
                          <td>{{ props.item.percent }}</td>
                          <td class="justify-center layout px-0">
                            <v-btn icon class="mx-0" @click="editItem(props.item)">
                              <v-icon color="teal">edit</v-icon>
                            </v-btn>
                          </td>
                      </template>
                    </v-data-table>
                  </div>
                </v-flex>
              </v-layout>
            </v-card>
          </v-flex>

          <v-flex xs12>
            <v-card>
              <v-layout>
                <v-flex xs6>
                  <div>For Table F: Distribution of Land Use</div>
                  <div>
                    <v-data-table 
                    :headers="distribheaders" 
                    :items="use" 
                    hide-actions 
                    class="elevation-1">
                      <template slot="items" slot-scope="props">
                          <td>{{ props.item.distribution }}</td>
                          <td>{{ props.item.square }}</td>
                          <td>{{ props.item.hectare }}</td>
                          <td>{{ props.item.total }}</td>
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

          <v-flex xs12>
            <v-card>
              <v-layout>
                <v-flex xs8>
                  <div>Socio Cultural Data</div>
                  <div>For Table 2: Health Facilities</div>
                  <div>
                    <v-data-table 
                    :headers="healthheaders" 
                    :items="facilities" 
                    hide-actions 
                    class="elevation-1">
                      <template slot="items" slot-scope="props">
                          <td>{{ props.item.facility }}</td>
                          <td>{{ props.item.number }}</td>
                          <td>{{ props.item.patient }}</td>
                      </template>
                    </v-data-table>
                  </div>
                  <div>Other Health Facilities:</div>
                </v-flex>
              </v-layout>
            </v-card>
          </v-flex>

          <v-flex xs12>
            <v-card>
              <v-layout>
                <v-flex xs6>
                  <div>Education</div>
                  <div>For Table B.1 Number of School Buildings</div>
                  <div>
                    <v-data-table 
                    :headers="schoolheaders" 
                    :items="buildings" 
                    hide-actions 
                    class="elevation-1">
                      <template slot="items" slot-scope="props">
                          <td>{{ props.item.type }}</td>
                          <td>{{ props.item.number }}</td>
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
                    hide-actions 
                    class="elevation-1">
                      <template slot="items" slot-scope="props">
                          <td>{{ props.item.type }}</td>
                          <td>{{ props.item.number }}</td>
                      </template>
                    </v-data-table>
                  </div>
                </v-flex>
              </v-layout>
            </v-card>
          </v-flex>

          <v-flex xs12>
            <v-card>
              <v-layout>
                <v-flex xs12>
                  <div>C. INFRASTRUCTURE: TRANSPORT FACILITIES AND SERVICES</div>
                  <div class="ml-3">For Table 1: Bridge by Administrative level (in meters):</div>
                  <div class="ml-5">
                    <v-data-table 
                    :headers="bridgeheaders" 
                    :items="meters" 
                    hide-actions 
                    class="elevation-1">
                      <template slot="items" slot-scope="props">
                          <td>{{ props.item.type }}</td>
                          <td>{{ props.item.national }}</td>
                          <td>{{ props.item.provincial }}</td>
                          <td>{{ props.item.city }}</td>
                          <td>{{ props.item.barangay }}</td>
                          <td>{{ props.item.total }}</td>
                          <td>{{ props.item.operational }}</td>
                      </template>
                    </v-data-table>
                  </div>
                  <div ml-3>Bridge by Administrative level (in kilometers)</div>
                  <div class="ml-5">
                    <v-data-table 
                    :headers="bridgeheaders" 
                    :items="kilometers" 
                    hide-actions 
                    class="elevation-1">
                      <template slot="items" slot-scope="props">
                          <td>{{ props.item.type }}</td>
                          <td>{{ props.item.national }}</td>
                          <td>{{ props.item.provincial }}</td>
                          <td>{{ props.item.city }}</td>
                          <td>{{ props.item.barangay }}</td>
                          <td>{{ props.item.total }}</td>
                          <td>{{ props.item.operational }}</td>
                      </template>
                    </v-data-table>
                  </div>
                </v-flex>
              </v-layout>
            </v-card>
          </v-flex>

          <v-flex xs12>
            <v-card>
              <v-layout>
                <v-flex xs12>
                  <div class="ml-3">For Table 2: Communications Services:</div>
                  <div class="ml-5">
                    <v-data-table 
                    :headers="communicationheaders" 
                    :items="services" 
                    hide-actions 
                    class="elevation-1">
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
        dialog: false,
        headers: [
          {
            text: 'Type',
            align: 'center',
            sortable: false,
            value: 'type'
          },
          { 
            text: 'Percent', 
            align: 'center',
            value: 'percent' 
          }
        ],
        land: [
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
        distribheaders: [
          {
            text: 'Type',
            align: 'center',
            sortable: false,
            value: 'distribution'
          },
          { 
            text: 'Land Area (Square kms.)', 
            align: 'center',
            value: 'square' 
          },
          { 
            text: 'Land Area (Hectares)', 
            align: 'center',
            value: 'hectare' 
          },
          { 
            text: '% Total Population', 
            align: 'center',
            value: 'total' 
          }
        ],
        use: [
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
        healthheaders: [
          {
            text: 'Type',
            align: 'center',
            sortable: false,
            value: 'facility'
          },
          { 
            text: 'Number', 
            align: 'center',
            value: 'number' 
          },
          { 
            text: 'Number of patients served (preceding year)', 
            align: 'center',
            value: 'patient' 
          }
        ],
        facilities: [
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
        schoolheaders: [
          {
            text: 'Type',
            align: 'center',
            sortable: false,
            value: 'type'
          },
          { 
            text: 'Number', 
            align: 'center',
            value: 'number' 
          }
        ],
        buildings: [
          {
            type: 'Pre-School Day Care Building',
            number: ''
          },
          {
            type: 'Primary/Elementary Building',
            number: ''
          },
          {
            type: 'Secondary/High School Building',
            number: ''
          },
          {
            type: 'Vocational/Technical Building',
            number: ''
          },
          {
            type: 'College/University Building',
            number: ''
          },
          {
            type: 'Post Graduate Building',
            number: ''
          }
        ],
        sportheaders: [
          {
            text: 'Type',
            align: 'center',
            sortable: false,
            value: 'type'
          },
          { 
            text: 'Number', 
            align: 'center',
            value: 'number' 
          }
        ],
        sports: [
          {
            type: 'Covered Court',
            number: ''
          },
          {
            type: 'Gymnasium',
            number: ''
          },
          {
            type: 'Park/Plaza',
            number: ''
          },
          {
            type: 'Specify Other Sports Facilities',
            number: ''
          },
          {
            type: 'Specify Sports/Recreational Facilities',
            number: ''
          },
          {
            type: 'Total Facilities',
            number: ''
          }
        ],
        bridgeheaders: [
          {
            text: 'Type',
            align: 'center',
            sortable: false,
            value: 'type'
          },
          { 
            text: 'National', 
            align: 'center',
            value: 'national' 
          },
          {
            text: 'Provincial', 
            align: 'center',
            value: 'provincial'
          },
          {
            text: 'City/Municipality', 
            align: 'center',
            value: 'city'
          },
          {
            text: 'Barangay', 
            align: 'center',
            value: 'barangay'
          },
          {
            text: 'Total', 
            align: 'center',
            value: 'total'
          },
          {
            text: 'Operational', 
            align: 'center',
            value: 'operational'
          }
        ],
        meters: [
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
        kilometers: [
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
            type: 'Asphalt',
            national: '',
            provincial: '',
            city: '',
            barangay: '',
            total: '',
            operational: ''
          },
          {
            type: 'Gravel',
            national: '',
            provincial: '',
            city: '',
            barangay: '',
            total: '',
            operational: ''
          },
          {
            type: 'Earthfill',
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
        communicationheaders: [
          {
            text: 'Type of Communications',
            align: 'center',
            sortable: false,
            value: 'type'
          },
          { 
            text: 'Total Provider', 
            align: 'center',
            value: 'provider' 
          },
          {
            text: 'Name/s of Company', 
            align: 'center',
            value: 'company'
          },
          {
            text: 'No. of households served', 
            align: 'center',
            value: 'household'
          }
        ],
        services: [
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
      })
    }
</script>
<!--
<template>
    <v-app>
        
        
          <v-list>
            <v-list-group>
              <template v-slot:activator>
                <v-list-tile>
                  <v-list-tile-content>
                    <v-list-tile-title>Barangay Ecological Profile</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
              </template>

              <v-list-tile
                v-for="subItem in immunizedChildren"
                :key="subItem.text"
                :to="subItem.url"
              >
                <v-list-tile-content>
                  <v-list-tile-title>{{ subItem.text }}</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list-group>
          </v-list>



          <v-list>
            <v-list-group>
              <template v-slot:activator>
                <v-list-tile>
                  <v-list-tile-content>
                    <v-list-tile-title>Barangay Socio-Economic profile</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
              </template>

              <v-list-tile
                v-for="subItem in immunizedChildren"
                :key="subItem.text"
                :to="subItem.url"
              >
                <v-list-tile-content>
                  <v-list-tile-title>{{ subItem.text }}</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list-group>
          </v-list>
          
          

    </v-app>
</template>

<script>
    export default {
        data: () => ({
            :[ 
                {
                    text: 'Children with conflict',
                    url: '/childrenWithConflict'
                },
                {
                    text: 'List of Registered Voters',
                    url: '/listOfRegisteredVoters'
                },
                {
                    text: 'List of prosprective Sanguniang Kabataan voters',
                    url: '/listOfProspectiveSkVoters'
                },
                {
                    text: 'List of Senior citizens',
                    url: '/listOfSeniorCitizens'
                },
                {
                    text: 'List Of Out Of School Youth 7-14 years',
                    url: '/listOfOutOfSchoolYouth7-14'
                },
                {
                    text: 'ListOfOutOfSchoolYouth 15-25 years',
                    url: '/listOfOutOfSchoolYouth15-25'
                }
            ],
            :[
                {
                    text: 'List of Children between 0 to 23 years old - for monthly monitoring',
                    url: '/Immunized0-23Years'
                },
                {
                    text: "List of Children between 6-59 months-vitamin A monitoring",
                    url: '/Immunized6-59Months'
                },
                {
                    text: "List of Children between 11-71 months for deworming",
                    url: '/Immunized11-71months'
                },
                {
                    text: "List of Children between 24-71 months old-for quarterly monitoring",
                    url: '/immunized24-71months'
                }
            ]
        }),
        methods: {
        }
    }
</script>
-->
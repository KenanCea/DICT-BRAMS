<template>
    <v-app>
      <v-container grid-list-xl fluid>
        <v-layout row wrap>
          <v-flex xs12>
            <v-card>
              <v-layout>
                <v-flex xs6>
                  <v-card-primary-title>
                    <div>Barangay Logo</div>
                  </v-card-primary-title>
                  <v-img
                  ></v-img>
                </v-flex>
                <v-flex xs6>
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
          <v-flex xs12>
            <v-card>
              <v-layout>
                <v-flex xs12>
                  <v-data-table
                    :headers="headers"
                    :items="officials"
                    :loading="loading">
                    <template slot="headerCell" slot-scope="props">
                      <v-tooltip bottom>
                        <template v-slot:activator="{ on }">
                          <span v-on="on">
                            {{ props.header.text }}
                          </span>
                        </template>
                        <span>
                          {{ props.header.text }}
                        </span>
                      </v-tooltip>
                    </template>
                    <template v-slot:items="props">
                      <td>{{ props.item.positon }}</td>
                      <td>{{ props.item.name }}</td>
                      <td>{{ props.item.start }}</td>
                      <td>{{ props.item.end }}</td>
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
      data () {
        return {
          headers: [
            {
              text: 'POSITION',
              align: 'center',
              sortable: false,
              value: 'position'
            },
            { 
              text: 'NAME',
              align: 'center', 
              value: 'name' 
            },
            { 
              text: 'START TERM', 
              align: 'center',
              value: 'start' 
            },
            { 
              text: 'END TERM', 
              align: 'center',
              value: 'end' 
            }
          ],
          officials: [
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
        }
      }
    }
</script>
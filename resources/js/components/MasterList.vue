<template>
<div id="app">
    <v-app>
        <div>
            <v-card>
                
                <v-app-bar id="navbar" dense flat app>
                    <v-toolbar-title>
                        <span class="hidden-sm-and-down">{{Table}}</span>
                    </v-toolbar-title>
                <v-spacer></v-spacer>

      <v-menu :close-on-content-click="false" offset-y max-height="400">
        <template #activator="{ on: menu }">
          <v-tooltip attach bottom>
            <template #activator="{ on: tooltip }">
              <v-btn text icon color="primary" v-on="{ ...tooltip, ...menu }">
                <v-icon color="grey darken-2">mdi-table-column</v-icon>
              </v-btn>
            </template>
            <span>Column Visibility</span>
          </v-tooltip>
        </template>
            <v-list>
              <v-list-item v-for="(item, index) in headers" :key="index">
                <v-switch
                  color="green"
                  v-bind:label="item.text"
                  v-model="item.selected"
                  :value="item.selected"
                ></v-switch>
              </v-list-item>
            </v-list>
      </v-menu>

        <app-print :TableTitle="Table" :PageOrientation="Orientation"></app-print>
    </v-app-bar>

                <v-data-table
                    id="printTable"
                    v-bind:headers="filteredHeaders"
                    :items="masterList"
                    :loading="loading"
                    :search="search"
                >
                    <template v-slot:items = "props">
                    <td v-if="showColumn('fullname')">{{ props.item.fullname }}</td>
                    <td v-if="showColumn('sex')">{{ props.item.sex }}</td>
                    <td v-if="showColumn('age')">{{ props.item.age }}</td>
                    <td v-if="showColumn('date_of_birth')">{{ props.item.date_of_birth }}</td>
                    <td v-if="showColumn('civil_status')">{{ props.item.civil_status }}</td>
                    <td v-if="showColumn('religion')">{{ props.item.religion }}</td>
                    <td v-if="showColumn('registeredVoterOfTheBrgy')">{{ props.item.registeredVoterOfTheBrgy }}</td>
                    <td v-if="showColumn('status_of_residency')">{{ props.item.status_of_residency }}</td>
                    <td v-if="showColumn('purok')">{{ props.item.purok}}</td>
                    <td v-if="showColumn('housenum')">{{ props.item.house_num}}</td>
                    </template>
                </v-data-table>
            </v-card>
        </div>
    </v-app>
</div>
</template>
<script>
import Print from './DocumentPrint.vue';
    export default {
        data: () => ({
            Table:'Master List',
            Orientation:'landscape',
            search:'',
            loading: false,
            masterList: [],
            headers:[
                {
                    text: 'Fullname',
                    value: 'fullname',
                    selected: true,
                    sortable: true
                },
                {
                    text: 'Gender',
                    value: 'sex',
                    sortable: true,
                    selected: true,
                },
                {
                    text: 'Age',
                    value: 'age',
                    selected: true,
                    sortable: true
                },
                {
                    text: 'Date of Birth',
                    value: 'date_of_birth',
                    selected: true,
                    sortable: true
                },
                {
                    text: 'Civil Status',
                    value: 'civil_status',
                    sortable: true,
                    selected: true,
                },
                {
                    text: 'Religion',
                    value: 'religion',
                    sortable: true,
                    selected: true,
                },
                {
                    text: 'Registered Voters',
                    value: 'registeredVoterOfTheBrgy',
                    selected: true,
                    sortable: true
                },
                {
                    text: 'Status of residency',
                    value: 'status_of_residency',
                    sortable: true,
                    selected: true,
                },
                {
                    text: 'Purok',
                    value: 'purok',
                    selected: true,
                    sortable: true
                },
                {
                    text: 'House#',
                    value: 'housenum',
                    selected: true,
                    sortable: true
                }
            ]
        }),
       created() {
            this.loadQuery();
        },
        components:{
            'app-print': Print
        },
        computed:{
            filteredHeaders() {
                return this.headers.filter(h => h.selected);
            },

            filteredItems() {
                return this.items.map(item => {
                    let filtered = Object.assign({}, item);
                    this.headers.forEach(header => {
                    if (!header.selected) delete filtered[header.value];
                    });
                    return filtered;
                });
            }
        },
        methods: {
            loadQuery() {
                this.loading = true;
                axios.get("api/masterList").then(response => {
                    this.masterList = response.data;
                    this.loading = false;
                });
            },
            showColumn(col) {
                return this.headers.find(h => h.value === col).selected;
            }
        }
    }
</script>

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
                    :loading="loading"
                    :items="immunized"
                    :search="search"
                >
                    <template v-slot:items = "props">
                    <td v-if="showColumn('childs_parent_guardian')">{{ props.item.childs_parent_quardian }}</td>
                    <td v-if="showColumn('fullname')">{{ props.item.fullname }}</td>
                    <td v-if="showColumn('age')">{{ props.item.sex }}</td>
                    <td v-if="showColumn('date_of_birth')">{{ props.item.date_of_birth }}</td>
                    <td v-if="showColumn('sex')">{{ props.item.sex }}</td>
                    <td v-if="showColumn('weight')">{{ props.item.weight }}</td>
                    <td v-if="showColumn('height')">{{ props.item.height }}</td>
                    <td v-if="showColumn('dewormed')">{{ props.item.dewormed }}</td>
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
            Table:'List of Children between 11-71 months for deworming',
            Orientation:'portrait',
            search:'',
            loading: false,
            immunized: [],
            headers:[
                {
                    text: 'Childs Parent Guardian',
                    value: 'childs_parent_guardian',
                    selected: true,
                    sortable: true
                },
                {
                    text: 'Name',
                    value: 'fullname',
                    selected: true,
                    sortable: true
                },
                {
                    text: 'Age(months)',
                    value: 'age',
                    selected: true,
                    sortable: true
                },
                {
                    text: 'Date Of Birth',
                    value: 'date_of_birth',
                    sortable: true,
                    selected: true,
                },
                {
                    text: 'Gender',
                    value: 'sex',
                    sortable: true,
                    selected: true,
                },
                {
                    text: 'Weight(kg)',
                    value: 'weight',
                    sortable: true,
                    selected: true,
                },
                {
                    text: 'Height(cm)',
                    value: 'height',
                    selected: true,
                    sortable: true
                },
                {
                    text: 'Deworm',
                    value: 'dewormed',
                    sortable: true,
                    selected: true,
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
                axios.get("api/DewormMonitoring").then(response => {
                    this.immunized = response.data;
                    this.loading = false;
                });
            },
            showColumn(col) {
                return this.headers.find(h => h.value === col).selected;
            }
        }
    }
</script>

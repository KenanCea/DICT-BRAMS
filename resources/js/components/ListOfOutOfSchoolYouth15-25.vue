

<template>
    <v-app>
        <div class="elevation-1">
            <v-card>
                
                <v-app-bar id="navbar" dense flat app>
                    <v-toolbar-title>
                        <span class="hidden-sm-and-down">{{Table}}</span>
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
<v-menu :close-on-content-click="false" offset-y max-height="400">
        <template #activator="{ on: menu }">
          <v-tooltip bottom>
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
            :items="OutOfSchool"
            :loading="loading"
            :search="search"
          >
            <template v-slot:items = "props">
              <td v-if="showColumn('fullname')">{{ props.item.fullname }}</td>
              <td v-if="showColumn('age')">{{ props.item.age }}</td>
              <td v-if="showColumn('sex')">{{ props.item.sex }}</td>
              <td v-if="showColumn('date_of_birth')">{{ props.item.date_of_birth }}</td>
              <td v-if="showColumn('civil_status')">{{ props.item.civil_status }}</td>
              <td v-if="showColumn('religion')">{{ props.item.religion }}</td>
              <td v-if="showColumn('citizenship')">{{ props.item.citizenship }}</td>
              <td v-if="showColumn('highest_educational_attainment')">{{ props.item.highest_educational_attainment}}</td>
              <td v-if="showColumn('gen_job_description')">{{ props.item.gen_job_description}}</td>
              <td v-if="showColumn('address')">{{ props.item.address }}</td>
            </template>
        </v-data-table></v-card>
        </div>
    </v-app>
</template>
<script>
import Print from './Print.vue';
    export default {
        data: () => ({
            Table:'List Of Out School Youth 15-25',
            Orientation:'landscape',
            search:'',
            loading: false,
            OutOfSchool: [],
            headers:[
                {
                    text: 'Fullname',
                    value: 'fullname',
                    selected: true
                },
                {
                    text: 'Age',
                    value: 'age',
                    selected: true
                },
                {
                    text: 'Sex',
                    value: 'sex',
                    selected: true,
                },
                {
                    text: 'Date of Birth',
                    value: 'date_of_birth',
                    selected: true,
                },
                {
                    text: 'Civil Status',
                    value: 'civil_status',
                    selected: true
                },
                {
                    text: 'Religion',
                    value: 'religion',
                    selected: true,
                },
                {
                    text: 'Citizenship',
                    value: 'citizenship',
                    selected: true,
                },
                
                {
                    text: 'Hi_Educ_attain',
                    value: 'highest_educational_attainment',
                    selected: true
                },
                {
                    text: "Job",
                    value: 'gen_job_description',
                    selected: true
                },
                {
                    text: 'Address',
                    value: 'address',
                    selected: true
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
                axios.get("api/listOfOutOfSchoolYouth15_25").then(response => {
                    this.OutOfSchool = response.data;
                    this.loading = false;
                });
            },
             showColumn(col) {
                return this.headers.find(h => h.value === col).selected;
            }
        }
    }
</script>

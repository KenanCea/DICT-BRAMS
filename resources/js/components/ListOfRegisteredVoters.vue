<template>
    <v-app>
        <v-container>
            <v-card>
                <v-card-title class="pb-0">
                    
                    <h1 class="font-weight-light">List Of Registered Voters</h1>
                    <v-divider class="ma-2" vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" prepend-inner-icon="search" label="Search"></v-text-field>
                </v-card-title>
        <v-data-table
            :headers="headers"
            :items="registeredVoters"
            :search="search"
            class="fixed-header"
            hide-actions
          >
            <template v-slot:items = "props">
              <td>{{ props.item.fullname }}</td>
              <td>{{ props.item.age }}</td>
              <td>{{ props.item.sex }}</td>
              <td>{{ props.item.date_of_birth }}</td>
              <td>{{ props.item.civil_status }}</td>
              <td>{{ props.item.religion }}</td>
              <td>{{ props.item.citizenship }}</td>
              <td>{{ props.item.address }}</td>
            </template>
        </v-data-table>
            </v-card></v-container>

    </v-app>
</template>
<script>
    export default {
        data: () => ({
            search:'',
            registeredVoters: [],
            headers:[
                {
                    text: 'Fullname',
                    value: 'fullname'
                },
                {
                    text: 'Age',
                    value: 'age'
                },
                {
                    text: 'Sex',
                    value: 'sex'
                },
                {
                    text: 'Date Birth',
                    value: 'date_birth'
                },
                {
                    text: 'Civil_stat',
                    value: 'civil_stat'
                },
                {
                    text: 'religion',
                    value: 'religion'
                },
                {
                    text: 'Citizenship',
                    value: 'citizenship'
                },
                {
                    text: 'Address',
                    value: 'Status_Case'
                }
            ]
        }),
       created() {
            this.loadQuery();
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
                axios.get("api/registeredVoters").then(response => {
                    this.registeredVoters = response.data;
                });
            }
        }
    }
</script>

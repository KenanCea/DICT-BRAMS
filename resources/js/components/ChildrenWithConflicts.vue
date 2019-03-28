<template>
    <v-app>
        <v-container>
            <v-card>
                <v-card-title class="pb-0">
                    
                    <v-toolbar-title>Children With Conflicts</v-toolbar-title>
                    <v-divider class="ma-2" vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" prepend-inner-icon="search" label="Search"></v-text-field>
                </v-card-title>
                <v-data-table
                    :headers="headers"
                    :items="childrenWithConflict"
                    :search="search"
                    class="fixed-header"
                    hide-actions
                >
                    <template v-slot:items = "props">
                    <td>{{ props.item.fullname }}</td>
                    <td>{{ props.item.age }}</td>
                    <td>{{ props.item.date_of_birth }}</td>
                    <td>{{ props.item.sex }}</td>
                    <td>{{ props.item.citizenship }}</td>
                    <td>{{ props.item.address }}</td>
                    <td>{{ props.item.respondent_case }}</td>
                    <td>{{ props.item.date_filed_case }}</td>
                    <td>{{ props.item.remarks_case}}</td>
                    </template>
                </v-data-table>
            </v-card>
        </v-container>
    </v-app>
</template>
<script>
    export default {
        data: () => ({
            search:'',
            childrenWithConflict: [],
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
                    text: 'Date Birth',
                    value: 'date_birth'
                },
                {
                    text: 'Gender',
                    value: 'gender'
                },
                {
                    text: 'Citizenship',
                    value: 'citizenship'
                },
                {
                    text: 'Address',
                    value: 'address'
                },
                {
                    text: 'Case',
                    value: 'case'
                },
                {
                    text: 'Year',
                    value: 'year'
                },
                {
                    text: 'Status_Case',
                    value: 'status_case'
                }
            ]
        }),
       created() {
            this.loadQuery();
        },
        methods: {
            loadQuery() {
                this.loading = true;
                axios.get("api/childrenWithConflicts").then(response => {
                    this.childrenWithConflict = response.data;
                });
            }
        }
    }
</script>

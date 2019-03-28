<template>
    <v-app>
        <v-container>
            <v-card>
                <v-card-title class="pb-0">
                    
                    <h1 class="font-weight-light">List Of Senior Citizens</h1>
                    <v-divider class="ma-2" vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" prepend-inner-icon="search" label="Search"></v-text-field>
                </v-card-title>
        <v-data-table
            :headers="headers"
            :items="SKVoters"
                    :search="search"
            class="fixed-header"
            hide-actions
          >
            <template v-slot:items = "props">
              <td>{{ props.item.fullname }}</td>
              <td>{{ props.item.age }}</td>
              <td>{{ props.item.sex }}</td>
              <td>{{ props.item.date_of_birth }}</td>
              <td>{{ props.item.civilStatus }}</td>
              <td>{{ props.item.religion }}</td>
              <td>{{ props.item.citizenship }}</td>
              <td>{{ props.item.address}}</td>
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
            SKVoters: [],
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
                    text: 'Civil Status',
                    value: 'civil_status'
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
                    value: 'address'
                },
            ]
        }),
       created() {
            this.loadMember();
        },
        methods: {
            loadMember() {
                axios.get("api/listOfSeniorCitizens").then(({ data }) => 
                    (this.SKVoters = data)
                );
            }
        }
    }
</script>

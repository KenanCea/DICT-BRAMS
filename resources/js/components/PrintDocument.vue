<template>
<div>
  <v-list>
    <v-list-item v-for="item in printDocument" :key="item.text" :to="item.url" ripple>
      <template>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title>{{ item.text }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </template>
    </v-list-item>
  </v-list>

  <v-list>
    <v-list-group>
      <template v-slot:activator>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title>Immunized Child Monitoring</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </template>
      <v-list-item v-for="subItem in immunizedChildren" :key="subItem.text" :to="subItem.url">
        <v-list-item-content>
          <v-list-item-title>{{ subItem.text }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list-group>
  </v-list>
  </div>
</template>

<script>
export default {
  data: () => ({
    printDocument: [
      {
        text: "Children with conflict",
        url: "/childrenWithConflict"
      },
      {
        text: "List of Registered Voters",
        url: "/listOfRegisteredVoters"
      },
      {
        text: "List of prosprective Sanguniang Kabataan voters",
        url: "/listOfProspectiveSkVoters"
      },
      {
        text: "List of Senior citizens",
        url: "/listOfSeniorCitizens"
      },
      {
        text: "List Of Out Of School Youth 7-14 years",
        url: "/listOfOutOfSchoolYouth7-14"
      },
      {
        text: "ListOfOutOfSchoolYouth 15-25 years",
        url: "/listOfOutOfSchoolYouth15-25"
      }
    ],
    immunizedChildren: [
      {
        text:
          "List of Children between 0 to 24 months old - for monthly monitoring",
        url: "/monthlyMonitoring"
      },
      {
        text: "List of Children between 6-59 months-vitamin A monitoring",
        url: "/vitaminAMonitoring"
      },
      {
        text: "List of Children between 11-71 months for deworming",
        url: "/dewormingMonitoring"
      },
      {
        text:
          "List of Children between 24-71 months old-for quarterly monitoring",
        url: "/quarterlyMonitoring"
      }
    ]
  }),
  methods: {}
};
</script>

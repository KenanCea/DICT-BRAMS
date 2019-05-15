<template>
<div>
  <v-list>
    <v-list-group>
      <template v-slot:activator>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title>BARANGAY SOCIO ECONOMIC PROFILE ON:</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </template>
      <v-list-item v-for="subItem in EconomicProfile" :key="subItem.text" :to="subItem.url">
        <v-list-item-content>
          <v-list-item-title>{{ subItem.text }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list-group>
  </v-list>

  <v-list>
    <v-list-group>
      <template v-slot:activator>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title>BARANGAY ECOLOGICAL PROFILE(3yrs)</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </template>
      <v-list-item v-for="subItem in EcologicalProfile" :key="subItem.text" :to="subItem.url">
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
    EconomicProfile: [
      {
        text:
          "Barangay Population Gender Age",
        url: "/populationGenderAge"
      },
      {
        text:
          "Barangay Pop Civil Status and Tribe ",
        url: "/civilstatusTribe"
      },
      {
        text:
          "Brgy Pop by Family size - Religion",
        url: "/familysizeReligion"
      },
      {
        text:
          "Pop by Blood Health Facilities availed",
        url: "/bloodtypeHealth"
      },
      {
        text:
          "Fam Plan Death Nutrition",
        url: "/planningDeath"
      },
      {
        text:
          "Access to Water Garabage Disposal",
        url: "/nutritionWaterGarbage"
      },
      {
        text:
          "Freq Garb Collection Toilet, Tenurial ",
        url: "/garbCollectionToiletTenurial"
      },
      {
        text:
          "Const. Mtls, Residency, Crime",
        url: "/constMtlsResidencyCrime"
      },
      {
        text:
          "Family Income, Economic Activity ",
        url: "/familyIncomeEconomicActivity"
      },
      {
        text:
          "Job Status, Pop by Industry ",
        url: "/jobStatusIndustry"
      },
      {
        text:
          "Educational Attainment, Professional Achievement",
        url: "/educationAchievement"
      },
      {
        text:
          "Reasons for Solo Parent",
        url: "/soloParent"
      },
      {
        text:
          "Population by Disability",
        url: "/disability"
      }
    ],
    EcologicalProfile: [
      {
        text:
          "2",
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

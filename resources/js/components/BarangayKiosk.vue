<template>
<div>
  <v-list>
    <v-list-item v-for="item in EconomicProfile" :key="item.text" :to="item.url" ripple>
      <template>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title>{{ item.text }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </template>
    </v-list-item>
  </v-list>

  </div>
</template>

<script>
export default {
  data: () => ({
    EconomicProfile: [
      {
        text:
          "Population by Gender and Age ",
        url: "/populationByGenderAndAge"
      },
      {
        text:
          "Population by Civil Status And Gender",
        url: "/populationByCivilStatusAndGender"
      },
      {
        text:
          "Population by Tribe",
        url: "/populationByTribe"
      }
    ]
  }),
  methods: {}
};
</script>

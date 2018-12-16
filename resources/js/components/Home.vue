<template>
  <v-app>
    <v-container>
    </v-container>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    selected0: [],
    selected2: [],
    selected3: [],
    selected5: [],
    headers: [
      {
        text: "Dessert (100g serving)",
        value: "name",
        width: "100px",
        fixed: true
      },
      { text: "Calories", value: "calories", width: "100px", fixed: true },
      { text: "Fat (g)", value: "fat", width: "200px" },
      { text: "Carbs (g)", value: "carbs", width: "300px" },
      { text: "Protein (g)", value: "protein", width: "300px" },
      { text: "New Protein (g)", value: "nprotein", width: "300px" },
      { text: "Iron (%)", value: "iron", width: "300px" },
      { text: "New Iron (%)", value: "niron", width: "300px" }
    ],
    desserts: [
      {
        value: false,
        name: "Orange Juice",
        category: "Beverage",
        calories: 262,
        fat: 16.0,
        carbs: 23,
        protein: 6.0,
        nprotein: 6.0,
        iron: "7%",
        niron: "7%"
      },
      {
        value: false,
        name: "Larabar",
        category: "Snack",
        calories: 408,
        fat: 3.2,
        carbs: 87,
        protein: 6.5,
        nprotein: 6.5,
        iron: "45%",
        niron: "45%"
      },
      {
        value: false,
        name: "Donut",
        category: "Breakfast",
        calories: 452,
        fat: 25.0,
        carbs: 51,
        protein: 4.9,
        nprotein: 4.9,
        iron: "22%",
        niron: "22%"
      },

      {
        value: false,
        name: "Bagel",
        category: "Breakfast",
        calories: 999,
        fat: 28.0,
        carbs: 151,
        protein: 2.9,
        nprotein: 2.9,
        iron: "29%",
        niron: "29%"
      },
      {
        value: false,
        name: "KitKat",
        category: "Snack",
        calories: 518,
        fat: 26.0,
        carbs: 65,
        protein: 7,
        nprotein: 7,
        iron: "6%",
        niron: "6%"
      }
    ]
  }),

  computed: {
    headers0() {
      return this.headers.map(header =>
        Object.assign({}, header, { fixed: false })
      );
    },
    headers2() {
      return [
        { text: "", fixed: true, width: "100px", sortable: false }
      ].concat(this.headers);
    },
    headers3() {
      return [{ text: "", fixed: true, width: "100px" }].concat(this.headers);
    },
    headers5() {
      return this.headers3;
    }
  }
};
</script>


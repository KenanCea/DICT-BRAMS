<template>
  <v-card>
    <v-card-title class="headline">Search for Public APIs</v-card-title>
    <v-card-text>
      <v-autocomplete
        v-model="model"
        :items="items"
        :loading="isLoading"
        :search-input.sync="search"
        hide-no-data
        hide-selected
        item-text="name"
        item-value="API"
        label="Public APIs"
        placeholder="Start typing to Search"
        prepend-icon="mdi-database-search"
        return-object
      ></v-autocomplete>
    </v-card-text>
    <v-divider></v-divider>
    <v-expand-transition>
      <v-list v-if="model">
        <v-list-tile v-for="(field, i) in fields" :key="i">
          <v-list-tile-content>
            <v-list-tile-title v-text="field.value"></v-list-tile-title>
            <v-list-tile-sub-title v-text="field.key"></v-list-tile-sub-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-expand-transition>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn :disabled="!model" @click="model = null">
        Clear
        <v-icon right>mdi-close-circle</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  data: () => ({
    descriptionLimit: 60,
    households: [],
    isLoading: false,
    model: null,
    search: null
  }),

  computed: {
    fields() {
      if (!this.model) return [];
      return Object.keys(this.model).map(key => {
        return {
          key,
          value: this.model[key] || "n/a"
        };
      });
    },

    items() {
      return this.households.map(entry => {
        const name =
          entry.name.length > this.descriptionLimit
            ? entry.name.slice(0, this.descriptionLimit) + "..."
            : entry.name;
        return Object.assign({}, entry, { name });
      });
    }
  },

  watch: {
    search(val) {
      if (this.items.length > 0) return;
      if (this.isLoading) return;
      this.isLoading = true;
      axios
        .get("api/household")
        .then(response => {
          this.households = response.data;
        })
        .catch(err => {
          console.log(err);
        })
        .finally(() => (this.isLoading = false));
    }
  }
};
</script>
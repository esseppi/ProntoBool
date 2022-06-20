<template>
  <v-toolbar dark>
    <v-toolbar-title></v-toolbar-title>
    <v-autocomplete
      v-model="profession"
      :items="professions"
      :loading="loadingProf"
      :search-input.sync="searchProf"
      multiple
      cache-items
      class="mx-4"
      flat
      hide-no-data
      hide-details
      label="What state are you from?"
      solo-inverted
    />
    <v-autocomplete
      prepend-icon="mdi-city"
      v-model="city"
      :items="cities"
      :loading="loadingCity"
      :search-input.sync="searchCity"
      cache-items
      class="mx-4"
      flat
      hide-no-data
      hide-details
      label="What state are you from?"
      solo-inverted
    />
    <v-btn icon>
      <v-icon>mdi-magnify</v-icon>
    </v-btn>
  </v-toolbar>
</template>
<script>
export default {
  data() {
    return {
      // FIRST AUTOCOMPLETE DATA
      professions: ["foo", "bar", "fizz", "buzz"],
      profession: ["foo", "bar"],
      value: null,
      loadingProf: false,
      searchProf: null,
      //   SECOND AUTOCOMPLETE
      cities: ["Reggio", "Roma", "Asti", "Milano"],
      city: null,
      value: null,
      loadingCity: false,
      searchCity: null,
    };
  },
  watch: {
    search(val) {
      val && val !== this.select && this.querySelections(val);
    },
  },
  methods: {
    querySelections(v) {
      this.loading = true;
      // Simulated ajax query
      setTimeout(() => {
        this.items = this.states.filter((e) => {
          return (e || "").toLowerCase().indexOf((v || "").toLowerCase()) > -1;
        });
        this.loading = false;
      }, 500);
    },
  },
};
</script>
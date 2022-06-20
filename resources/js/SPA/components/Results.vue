<template>
  <v-container> </v-container>
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
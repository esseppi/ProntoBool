<template>
  <v-row dark no-gutters>
    <v-col cols="12" md="5">
      <v-card height="100%">
        <v-card-title>Cerca un professionista</v-card-title>
        <v-card-text>
          <v-autocomplete
            prepend-icon="mdi-briefcase "
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
        </v-card-text>
        <v-card-actions></v-card-actions>
      </v-card>
    </v-col>
    <v-col cols="12" md="5">
      <v-card height="100%">
        <v-card-title> Seleziona la tua città </v-card-title>
        <v-card-text>
          <v-autocomplete
            prepend-icon="mdi-city"
            multiple
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
        </v-card-text>
      </v-card>
    </v-col>
    <v-col cols="12" md="1">
      <v-card
        class="yellow d-flex flex-col justify-center align-center"
        height="100%"
      >
        <v-btn icon large>
          <v-icon>mdi-magnify</v-icon>
        </v-btn>
      </v-card>
    </v-col>
  </v-row>
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
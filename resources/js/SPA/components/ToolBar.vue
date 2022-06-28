<template>
  <v-row dark no-gutters>
    <v-col cols="12" md="5">
      <v-card height="100%">
        <p class="pt-5 text-center text-h5 font-weight-medium">
          Cerca un professionista
        </p>
        <v-card-text>
          <v-tooltip bottom>
            <template v-slot:activator="{ on, attrs }">
              <v-autocomplete
                v-bind="attrs"
                v-on="on"
                prepend-icon="mdi-briefcase "
                v-model="form.profession"
                :items="professions"
                :loading="loadingProf"
                :search-input.sync="searchProf"
                cache-items
                class="mx-4"
                flat
                hide-no-data
                hide-details
                label="Select a profession"
                solo-inverted
              />
            </template>
            <span>Seleziona la professione che cerchi</span>
          </v-tooltip>
        </v-card-text>
        <v-card-actions></v-card-actions>
      </v-card>
    </v-col>
    <v-col cols="12" md="5">
      <v-card height="100%">
        <div class="d-none">
          {{ form }}
        </div>
        <p class="pt-5 text-center text-h5 font-weight-medium">
          In che città cerchi il servizio?
        </p>
        <v-card-text>
          <v-tooltip bottom>
            <template v-slot:activator="{ on, attrs }">
              <v-autocomplete
                v-bind="attrs"
                v-on="on"
                prepend-icon="mdi-city"
                v-model="form.city"
                :items="cities"
                :loading="loadingCity"
                :search-input.sync="searchCity"
                cache-items
                class="mx-4"
                flat
                hide-no-data
                hide-details
                label="Available city to get the service"
                solo-inverted
              />
            </template>
            <span>Seleziona fino a 5 città contemporaneamente</span>
          </v-tooltip>
        </v-card-text>
      </v-card>
    </v-col>
    <v-col cols="12" md="1">
      <v-card
        @click="searchPage()"
        class="yellow d-flex flex-col justify-center align-center"
        height="100%"
      >
        <div class="text-center">
          <v-btn
            icon
            large
            :disabled="dialog"
            :loading="dialog"
            class="white--text"
            color="purple darken-2"
          >
            <v-icon>mdi-magnify</v-icon>
          </v-btn>
        </div>
      </v-card>
    </v-col>
    <!-- RESPONSE LOADER ACTIVATOR -->
    <v-dialog v-model="dialog" hide-overlay persistent width="300">
      <v-card color="primary" dark>
        <v-card-text>
          Please stand by
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
import FooterApp from "../pages/FooterApp.vue";
import Carousel from "./Carousel2.vue";
import HeaderApp from "./HeaderApp.vue";
export default {
  data() {
    return {
      form: {
        // profession: [],
        city: [],
      },
      // FIRST AUTOCOMPLETE DATA
      professions: ["Qualsiasi"],
      value: null,
      loadingProf: false,
      searchProf: null,
      //   SECOND AUTOCOMPLETE
      cities: ["Ovunque"],
      city: null,
      value: null,
      loadingCity: false,
      searchCity: null,
      // RESPONSE
      dialog: false,
      responsePage: false,

      // CARD
      loadingCard: false,
    };
  },
  components: {
    FooterApp,
    HeaderApp,
    Carousel,
  },
  watch: {
    // LANDING PAGE
    search(val) {
      val && val !== this.select && this.querySelections(val);
    },
    // OPEN DIALOG
    dialog(val) {
      if (!val) return;

      setTimeout(
        () => ((this.dialog = false), (this.responsePage = true))
        // 1500
      );
    },
    // RESULT TABLE
  },
  computed: {
    // RESULT
    numberOfPages() {
      return Math.ceil(this.items.length / this.itemsPerPage);
    },
    filteredKeys() {
      return this.keys.filter((key) => key !== "Name");
    },
  },
  methods: {
    searchPage() {
      this.$router.push({ path: "results/" + this.form.city });
    },
    openPage() {
      this.dialog = true;
      this.getProfInfo();
    },

    // LANDING PAGE
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
    // ATTIVATORE FINESTRA RICERCA E GENERATORE

    // GENERATORE INFORMAZIONI
    getProfInfo() {
      axios.get("/api/getProfInfo").then((res) => {
        res.data.data.forEach((element) => {
          let avg = [];
          const average = (array) =>
            Number((array.reduce((a, b) => a + b) / array.length).toFixed(2));
          let profession = [];
          if (element.reviews) {
            element.reviews.forEach((elemento) => {
              avg.push(elemento.vote);
            });
          } else {
            avg.push([0, 0]);
          }
          if (element.professions) {
            element.professions.forEach((elemento) => {
              profession.push(elemento.name);
            });
          }
          this.items.push({
            name: element.name,
            city: element.address,
            image: element.pic,
            review: average(avg),
            count_review: avg.length,
            description: element.description,
            profession: profession,
            views: element.views,
          });
        });
      });
    },
    // RESULT SETTINGS
    nextPage() {
      if (this.page + 1 <= this.numberOfPages) this.page += 1;
    },
    formerPage() {
      if (this.page - 1 >= 1) this.page -= 1;
    },
    updateItemsPerPage(number) {
      this.itemsPerPage = number;
    },
  },
  created() {
    axios
      .all([axios.get("/api/getSearchInfo"), axios.get("/api/landingPage")])
      .then(
        axios.spread((firstResponse, secondResponse) => {
          this.cities = Object.keys(firstResponse.data["placeNames"]);
          let items = secondResponse.data["profNames"];
          items.forEach((element) => {
            this.professions.push(element.name);
          });
        })
      )
      .catch((error) => console.log(error));
  },
};
</script>
<style>
.v-select__selections input {
  max-width: 0;
}
[type="text"] {
  background-color: transparent;
}
</style>
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
                multiple
                cache-items
                class="mx-4"
                flat
                hide-no-data
                hide-details
                label="What state are you from?"
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
                multiple
                v-model="form.city"
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
            </template>
            <span>Seleziona fino a 5 città contemporaneamente</span>
          </v-tooltip>
        </v-card-text>
      </v-card>
    </v-col>
    <v-col cols="12" md="1">
      <v-card
        @click="openPage"
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
    <!-- RESPONSE -->
    <v-dialog
      v-model="responsePage"
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
    >
      <!-- NUOVA HEADER APP QUI -->
      <div>
        <v-app-bar color="blue" dark>
          <v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>
          <v-toolbar-title>
            <v-btn @click="responsePage = false"> Prontobool </v-btn>
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn icon dark @click="responsePage = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-app-bar>
        <Carousel />
      </div>

      <!-- PAGINA RISULTATI -->
      <v-card tile>
        <v-data-iterator
          loading
          loading-text="Loading Professionist Data"
          :items="items"
          :items-per-page.sync="itemsPerPage"
          :page.sync="page"
          :search="search"
          :sort-by="sortBy.toLowerCase()"
          :sort-desc="sortDesc"
          hide-default-footer
        >
          <!-- TOOLBAR-->
          <template v-slot:header class="py-5">
            <v-toolbar dark color="blue lighten-3">
              <v-text-field
                type="text"
                v-model="search"
                flat
                hide-details
                prepend-inner-icon="mdi-magnify"
                label="Search"
              ></v-text-field>
              <v-spacer></v-spacer>

              <template v-if="$vuetify.breakpoint.mdAndUp">
                <v-select
                  v-model="sortBy"
                  flat
                  hide-details
                  chips
                  :items="keys"
                  prepend-inner-icon="mdi-magnify"
                  label="Sort by"
                ></v-select>
                <v-spacer></v-spacer>
                <v-btn-toggle v-model="sortDesc" mandatory>
                  <v-btn large depressed color="blue" :value="false">
                    <v-icon>mdi-arrow-up</v-icon>
                  </v-btn>
                  <v-btn large depressed color="blue" :value="true">
                    <v-icon>mdi-arrow-down</v-icon>
                  </v-btn>
                </v-btn-toggle>
              </template>
            </v-toolbar>
          </template>
          <!-- CARD -->
          <template height="100%" v-slot:default="props">
            <v-container>
              <v-row>
                <!-- STAMPA COLONNA CARTA -->
                <v-col
                  v-for="item in props.items"
                  :key="item.name"
                  cols="12"
                  sm="6"
                  md="4"
                  lg="3"
                >
                  <!-- CARTA -->
                  <v-card :loading="loadingCard" class="mx-auto" height="100%">
                    <template slot="progress">
                      <v-progress-linear
                        color="deep-purple"
                        height="10"
                        indeterminate
                      ></v-progress-linear>
                    </template>

                    <v-img
                      height="250"
                      src="https://cdn.vuetifyjs.com/images/john.jpg"
                    >
                    </v-img>

                    <v-card-title>{{ item.name }}</v-card-title>

                    <v-card-text>
                      <v-row align="center" class="mx-0">
                        <v-rating
                          :value="item.review_avg"
                          color="amber"
                          dense
                          half-increments
                          readonly
                          size="14"
                        ></v-rating>

                        <div class="grey--text ms-4">
                          {{ item.review_avg }} ({{ item.count_review }})
                        </div>
                      </v-row>

                      <div class="my-4 text-subtitle-1">
                        <v-icon>mdi-city</v-icon> • {{ item.city }}
                      </div>

                      <v-sheet class="overflow-y-auto" height="100">
                        {{ item.description }}
                      </v-sheet>
                    </v-card-text>

                    <v-divider class="mx-4"></v-divider>

                    <!-- BOTTOM -->
                    <v-card-actions class="d-flex justify-center">
                      <v-chip-group show-arrows>
                        <v-chip
                          center-active
                          v-for="item in item.profession"
                          :key="item"
                          class="warning accent-4 white--text"
                        >
                          {{ item }}
                        </v-chip>
                      </v-chip-group>
                      <v-spacer></v-spacer>
                    </v-card-actions>
                    <v-card-actions class="d-flex justify-center">
                      <v-chip-group center-active>
                        <v-chip center-active>
                          <v-icon dark color="blue" text> mdi-eye </v-icon>
                        </v-chip>
                        <v-chip>
                          <v-icon color="blue" text>
                            mdi-message-arrow-right-outline
                          </v-icon>
                        </v-chip>
                        <v-chip>
                          <v-icon color="blue" text> mdi-shape </v-icon>
                        </v-chip>
                      </v-chip-group>
                    </v-card-actions>
                  </v-card>
                </v-col>
              </v-row>
            </v-container>
          </template>

          <template v-slot:footer>
            <v-row class="mt-2" align="center" justify="center">
              <span class="grey--text">Items per page</span>
              <v-menu offset-y>
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    dark
                    text
                    color="primary"
                    class="ml-2"
                    v-bind="attrs"
                    v-on="on"
                  >
                    {{ itemsPerPage }}
                    <v-icon>mdi-chevron-down</v-icon>
                  </v-btn>
                </template>
                <v-list>
                  <v-list-item
                    v-for="(number, index) in itemsPerPageArray"
                    :key="index"
                    @click="updateItemsPerPage(number)"
                  >
                    <v-list-item-title>{{ number }}</v-list-item-title>
                  </v-list-item>
                </v-list>
              </v-menu>
              <v-spacer></v-spacer>
              <span class="mr-4 grey--text">
                Page {{ page }} of {{ numberOfPages }}
              </span>
              <v-btn
                fab
                dark
                color="blue darken-3"
                class="mr-1"
                @click="formerPage"
              >
                <v-icon>mdi-chevron-left</v-icon>
              </v-btn>
              <v-btn
                fab
                dark
                color="blue darken-3"
                class="ml-1"
                @click="nextPage"
              >
                <v-icon>mdi-chevron-right</v-icon>
              </v-btn>
            </v-row>
          </template>
        </v-data-iterator>
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
      // RESULT DATA TABLE
      itemsPerPageArray: [12, 24, 36],
      search: "",
      // filter: {},
      sortDesc: false,
      page: 1,
      itemsPerPage: 20,
      sortBy: "name",
      keys: ["name", "city", "review_avg", "profession", "views"],
      items: [],

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
          let avg = [0];
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
            review_avg: average(avg),
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
          // secondResponse.data["profNames"].forEach((element) => {
          //   this.professions = element["name"];
          // });
        })
      )
      .catch((error) => console.log(error));
  },
};
</script>
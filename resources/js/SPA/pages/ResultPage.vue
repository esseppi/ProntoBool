<template>
  <v-card class="overflow-hidden">
    <!-- NUOVA HEADER APP QUI -->
    <Carousel />
    <!-- PAGINA RISULTATI -->
    <v-card tile>
      <v-data-iterator
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
            <v-spacer></v-spacer>
            <v-autocomplete
              v-if="sortBy == 'profession'"
              v-bind="attrs"
              v-on="on"
              :items="profession"
              :loading="loadingProf"
              :search-input.sync="searchProf"
              v-model="search"
              flat
              hide-details
              prepend-inner-icon="mdi-magnify"
              label="Search"
              solo-inverted
            />

            <v-text-field
              v-else
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
                <v-btn large depressed color="warning" :value="false">
                  <v-icon>mdi-arrow-up</v-icon>
                </v-btn>
                <v-btn large depressed color="warning" :value="true">
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

                  <v-img height="250" :src="item.image"> </v-img>

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
                        class="deep-purple accent-4 white--text"
                      >
                        {{ item }}
                      </v-chip>
                    </v-chip-group>
                    <v-spacer></v-spacer>
                  </v-card-actions>
                  <v-card-actions class="d-flex justify-center">
                    <v-chip-group center-active>
                      <v-chip center-active>
                        <v-icon color="deep-purple lighten-2" text>
                          mdi-eye
                        </v-icon>
                      </v-chip>
                      <v-chip>
                        <v-icon color="deep-purple lighten-2" text>
                          mdi-message-arrow-right-outline
                        </v-icon>
                      </v-chip>
                      <v-chip>
                        <v-icon color="deep-purple lighten-2" text>
                          mdi-shape
                        </v-icon>
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
  </v-card>
</template>
<script>
import Carousel from "../components/Carousel2.vue";
export default {
  data() {
    return {
      form: {
        profession: "",
        city: "",
      },
      // RESULT DATA TABLE
      profession: [],
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
    Carousel,
  },
  watch: {
    // LANDING PAGE
    search(val) {
      val && val !== this.select && this.querySelections(val);
    },
  },
  mounted() {
    this.form.city = this.$route.params.city;
    this.form.profession = this.$route.params.profession;
    axios.post("/api/customFilter", { ...this.form }).then((res) => {
      res.data.data[0].forEach((element) => {
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
            this.profession.push(elemento.name);
          });
        }
        this.items.push({
          name: element.name,
          city: element.address,
          image: element.pic,
          review_avg: average(avg),
          description: element.description,
          count_review: avg.length,
          profession: profession,
          views: element.views,
        });
      });
      console.log(res.data.data[0]);
    });
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
    // GENERATORE INFORMAZIONI
    customFilter() {},
    getProfInfo() {},
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
  created() {},
};
</script>
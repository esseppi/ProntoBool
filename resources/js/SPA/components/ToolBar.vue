<template>
  <v-row dark no-gutters>
    <v-col cols="12" md="5">
      <v-card height="100%">
        <v-card-title>Cerca un professionista</v-card-title>
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
            <span>Seleziona fino a 5 professioni</span>
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
        <v-card-title> Seleziona la tua città </v-card-title>
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
            @click="customFilter"
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
      <v-card tile>
        <v-toolbar flat dark color="primary">
          <v-btn icon dark @click="responsePage = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title>Prontobool Search</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn dark text @click="dialog = false"> Save </v-btn>
          </v-toolbar-items>
          <v-menu bottom right offset-y>
            <template v-slot:activator="{ on, attrs }">
              <v-btn dark icon v-bind="attrs" v-on="on">
                <v-icon>mdi-dots-vertical</v-icon>
              </v-btn>
            </template>
          </v-menu>
        </v-toolbar>
        <v-card-text>
          <v-list three-line subheader>
            <div>
              <v-data-table
                :headers="headers"
                :items="allProfiles"
                item-key="name"
                class="elevation-1"
                :search="search"
              >
                <template v-slot:top>
                  <v-text-field
                    v-model="search"
                    label="Cerca un professionista"
                    class="mx-4"
                  ></v-text-field>
                </template>
                <!-- <template v-slot:body.append>
                  <tr>
                    <td></td>
                    <td>
                      <v-text-field
                        v-model="calories"
                        type="number"
                        label="Less than"
                      ></v-text-field>
                    </td>
                    <td colspan="4"></td>
                  </tr>
                </template> -->
              </v-data-table>
            </div>
          </v-list>
          <v-divider></v-divider>
        </v-card-text>
        <FooterApp />
        <div style="flex: 1 1 auto"></div>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
import FooterApp from "../pages/FooterApp.vue";
export default {
  data() {
    return {
      form: {
        profession: [],
        city: [],
      },
      // FIRST AUTOCOMPLETE DATA
      professions: [],
      value: null,
      loadingProf: false,
      searchProf: null,
      //   SECOND AUTOCOMPLETE
      cities: [],
      city: null,
      value: null,
      loadingCity: false,
      searchCity: null,
      // RESPONSE
      dialog: false,
      responsePage: false,
      // RESULT DATA TABLE
      search: "",
      review_avg: null,
      actions: ["show", "lead", "category"],
      allProfiles: [],
    };
  },
  components: {
    FooterApp,
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
        () => ((this.dialog = false), (this.responsePage = true)),
        1500
      );
    },
    // RESULT TABLE
  },
  computed: {
    headers() {
      return [
        {
          text: "Name",
          align: "start",
          sortable: false,
          value: "name",
        },
        { text: "Image", value: "image" },
        {
          text: "Review",
          value: "review_avg",
          // filter: (value) => {
          //   if (!this.calories) return true;

          //   return value < parseInt(this.calories);
          // },
        },
        { text: "Profession", value: "profession" },
        { text: "Views", value: "views" },
      ];
    },
  },
  methods: {
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
    // MAKE A RESEARCH
    customFilter() {
      this.dialog = true;
      axios.post("/api/customFilter", { ...this.form }).then((res) => {
        this.getProfInfo();
      });
    },
    getProfInfo() {
      axios.get("/api/getProfInfo").then((res) => {
        res.data.data.forEach((element) => {
          let avg = [];
          let profession = [];
          if (element.reviews) {
            element.reviews.forEach((elemento) => {
              avg.push(elemento.vote);
            });
          }
          if (element.professions) {
            element.professions.forEach((elemento) => {
              profession.push(elemento.name);
            });
          }
          this.allProfiles.push({
            name: element.name,
            image: element.pic,
            review_avg: avg / avg.length,
            profession: profession,
            views: element.views,
          });
        });
      });
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
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
            </template>
            <span>Seleziona fino a 5 professioni</span>
          </v-tooltip>
        </v-card-text>
        <v-card-actions></v-card-actions>
      </v-card>
    </v-col>
    <v-col cols="12" md="5">
      <v-card height="100%">
        <v-card-title> Seleziona la tua città </v-card-title>
        <v-card-text>
          <v-tooltip bottom>
            <template v-slot:activator="{ on, attrs }">
              <v-autocomplete
                v-bind="attrs"
                v-on="on"
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
            @click="dialog = true"
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
            <v-list>
              <v-list-item
                v-for="(item, i) in items"
                :key="i"
                @click="() => {}"
              >
                <v-list-item-title>{{ item.title }}</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-toolbar>
        <v-card-text>
          <v-list three-line subheader>
            <div>
              <v-data-table
                :headers="headers"
                :items="desserts"
                item-key="name"
                class="elevation-1"
                :search="search"
              >
                <template v-slot:top>
                  <v-text-field
                    v-model="search"
                    label="Cerca un professionista)"
                    class="mx-4"
                  ></v-text-field>
                </template>
                <template v-slot:body.append>
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
                </template>
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
      // RESPONSE
      dialog: false,
      responsePage: false,
      // RESULT DATA TABLE
      search: "",
      calories: "",
      desserts: [
        {
          name: "Frozen Yogurt",
          calories: 159,
          fat: 6.0,
          carbs: 24,
          protein: 4.0,
        },
        {
          name: "Ice cream sandwich",
          calories: 237,
          fat: 9.0,
          carbs: 37,
          protein: 4.3,
        },
        {
          name: "Eclair",
          calories: 262,
          fat: 16.0,
          carbs: 23,
          protein: 6.0,
        },
        {
          name: "Cupcake",
          calories: 305,
          fat: 3.7,
          carbs: 67,
          protein: 4.3,
        },
        {
          name: "Gingerbread",
          calories: 356,
          fat: 16.0,
          carbs: 49,
          protein: 3.9,
        },
        {
          name: "Jelly bean",
          calories: 375,
          fat: 0.0,
          carbs: 94,
          protein: 0.0,
        },
        {
          name: "Lollipop",
          calories: 392,
          fat: 0.2,
          carbs: 98,
          protein: 0,
        },
        {
          name: "Honeycomb",
          calories: 408,
          fat: 3.2,
          carbs: 87,
          protein: 6.5,
        },
        {
          name: "Donut",
          calories: 452,
          fat: 25.0,
          carbs: 51,
          protein: 4.9,
        },
        {
          name: "KitKat",
          calories: 518,
          fat: 26.0,
          carbs: 65,
          protein: 7,
        },
      ],
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
        { text: "Image", value: "fat" },
        {
          text: "Review",
          value: "calories",
          filter: (value) => {
            if (!this.calories) return true;

            return value < parseInt(this.calories);
          },
        },
        { text: "Actions", value: "carbs" },
        { text: "Service", value: "protein" },
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
  },
};
</script>
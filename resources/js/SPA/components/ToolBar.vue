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
      scrollable
    >
      <v-card tile>
        <v-toolbar flat dark color="primary">
          <v-btn icon dark @click="responsePage = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title>Settings</v-toolbar-title>
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
          <v-btn color="primary" dark class="ma-2" @click="dialog2 = !dialog2">
            Open Dialog 2
          </v-btn>
          <v-tooltip right>
            <template v-slot:activator="{ on, attrs }">
              <v-btn class="ma-2" v-bind="attrs" v-on="on">
                Tool Tip Activator
              </v-btn>
            </template>
            Tool Tip
          </v-tooltip>
          <v-list three-line subheader>
            <v-subheader>User Controls</v-subheader>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>Content filtering</v-list-item-title>
                <v-list-item-subtitle
                  >Set the content filtering level to restrict apps that can be
                  downloaded</v-list-item-subtitle
                >
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>Password</v-list-item-title>
                <v-list-item-subtitle
                  >Require password for purchase or use password to restrict
                  purchase</v-list-item-subtitle
                >
              </v-list-item-content>
            </v-list-item>
          </v-list>
          <v-divider></v-divider>
          <v-list three-line subheader>
            <v-subheader>General</v-subheader>
            <v-list-item>
              <v-list-item-action>
                <v-checkbox v-model="notifications"></v-checkbox>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Notifications</v-list-item-title>
                <v-list-item-subtitle
                  >Notify me about updates to apps or games that I
                  downloaded</v-list-item-subtitle
                >
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-action>
                <v-checkbox v-model="sound"></v-checkbox>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Sound</v-list-item-title>
                <v-list-item-subtitle
                  >Auto-update apps at any time. Data charges may
                  apply</v-list-item-subtitle
                >
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-action>
                <v-checkbox v-model="widgets"></v-checkbox>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Auto-add widgets</v-list-item-title>
                <v-list-item-subtitle
                  >Automatically add home screen widgets</v-list-item-subtitle
                >
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card-text>

        <div style="flex: 1 1 auto"></div>
      </v-card>
    </v-dialog>
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
      // RESPONSE
      dialog: false,
      responsePage: false,
    };
  },
  watch: {
    search(val) {
      val && val !== this.select && this.querySelections(val);
    },
    dialog(val) {
      if (!val) return;

      setTimeout(
        () => ((this.dialog = false), (this.responsePage = true)),
        4000
      );
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
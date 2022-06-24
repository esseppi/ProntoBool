<template>
  <v-row justify="start" elevetion="24" no-gutters>
    <v-col cols="12">
      <v-card color="#D6E4F4" class="pb-12">
        <v-container>
          <v-card-title class="black--text text-h2 my-8">
            <p class="word-wrap brake-word overflow-wrap text-weight-black">
              Find local
              <v-carousel
                height="56px"
                vertical
                hide-delimiters
                :show-arrows="false"
                :continuous="true"
                :cycle="true"
              >
                <v-carousel-item v-for="(word, i) in professions" :key="i">
                  <v-sheet color="warning" shaped tile> {{ word }} </v-sheet>
                </v-carousel-item>
              </v-carousel>

              who solve your problems
            </p>
          </v-card-title>
          <v-card-actions>
            <Toolbar />
          </v-card-actions>
        </v-container>
      </v-card>
      <v-system-bar height="10" dark> </v-system-bar>
    </v-col>
  </v-row>
</template>


<script>
import Toolbar from "./ToolBar.vue";
export default {
  name: "HeroApp",
  data: () => ({
    cities: [],
    professions: [],
    words: ["professionist", "ciao"],
    model: 0,
    colors: ["primary", "secondary", "yellow darken-2", "red", "orange"],
  }),
  components: {
    Toolbar,
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

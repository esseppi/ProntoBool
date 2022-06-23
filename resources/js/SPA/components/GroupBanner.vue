<template>
  <v-carousel cycle height="300" hide-delimiters show-arrows-on-hover>
    <template v-slot:prev="{ on, attrs }">
      <v-btn color="success" v-bind="attrs" v-on="on"
        ><v-icon>mdi-skip-previous-circle</v-icon></v-btn
      >
    </template>
    <template v-slot:next="{ on, attrs }">
      <v-btn color="info" v-bind="attrs" v-on="on"
        ><v-icon>mdi-skip-next-circle</v-icon></v-btn
      >
    </template>
    <v-carousel-item v-for="(card, i) in cards" :key="i" height="300">
      <v-sheet color="#D7E4F3" height="320">
        <v-container>
          <v-row class="fill-height" align="center" justify="center">
            <v-col :cols="card.flex">
              <v-sheet>
                <p
                  class="
                    text-h5
                    font-weight-bold
                    text-center
                    word-wrap
                    brake-word
                    overflow-wrap
                    text-gray-800x
                  "
                >
                  {{ card.title }}
                </p>
              </v-sheet>
            </v-col>
            <v-col :cols="card.flex">
              <v-card height="280" shaped>
                <v-card-text>
                  <v-img
                    :src="card.src"
                    class="white--text align-end"
                    gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                    height="230px"
                  >
                    <v-card-title v-text="card.title"></v-card-title>
                  </v-img>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </v-sheet>
    </v-carousel-item>
  </v-carousel>
</template>
<script>
export default {
  data() {
    return {
      slides: ["First", "Second", "Third", "Fourth", "Fifth"],
      cards: [
        {
          title: "Pre-fab homes",
          title2: "Best airlines",

          src: "https://cdn.vuetifyjs.com/images/cards/house.jpg",
          flex: 6,
        },
        {
          title: "Pre-fab homes",
          title2: "Best airlines",

          src: "https://cdn.vuetifyjs.com/images/cards/house.jpg",
          flex: 5,
        },
        {
          title: "Favorite road trips",
          title2: "Best airlines",

          src: "https://cdn.vuetifyjs.com/images/cards/road.jpg",
          flex: 6,
        },
        {
          title: "Best airlines",
          title2: "Best airlines",

          src: "https://cdn.vuetifyjs.com/images/cards/plane.jpg",
          flex: 5,
        },
      ],
    };
  },
};
</script>
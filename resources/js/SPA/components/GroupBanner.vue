<template>
  <v-carousel cycle height="400" hide-delimiter-background show-arrows-on-hover>
    <template v-slot:prev="{ on, attrs }">
      <v-btn color="success" v-bind="attrs" v-on="on">Previous slide</v-btn>
    </template>
    <template v-slot:next="{ on, attrs }">
      <v-btn color="info" v-bind="attrs" v-on="on">Next slide</v-btn>
    </template>
    <v-carousel-item v-for="(card, i) in cards" :key="i">
      <v-sheet :color="colors[i]" height="100%">
        <v-container>
          <v-row class="fill-height" align="center" justify="center">
            <v-col cols="6">
              <v-card>
                <v-card-title
                  class="text-h5 font-weight-bold text-center text-gray-800x"
                  >Scegli tra migliaia di professionisti in cerca di lavoro!
                </v-card-title>
                <v-card>
                  <v-img
                    :src="card.src"
                    class="white--text align-end"
                    gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                    height="200px"
                  >
                    <v-card-title v-text="card.title"></v-card-title>
                  </v-img>

                  <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn icon>
                      <v-icon>mdi-heart</v-icon>
                    </v-btn>

                    <v-btn icon>
                      <v-icon>mdi-bookmark</v-icon>
                    </v-btn>

                    <v-btn icon>
                      <v-icon>mdi-share-variant</v-icon>
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-card>
            </v-col>
            <v-col cols="6">
              <v-card>
                <v-card-title
                  class="text-h5 font-weight-bold text-center text-gray-800x"
                  >Scegli tra migliaia di professionisti in cerca di lavoro!
                </v-card-title>
                <v-card>
                  <v-img
                    :src="card.src"
                    class="white--text align-end"
                    gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                    height="200px"
                  >
                    <v-card-title v-text="card.title"></v-card-title>
                  </v-img>

                  <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn icon>
                      <v-icon>mdi-heart</v-icon>
                    </v-btn>

                    <v-btn icon>
                      <v-icon>mdi-bookmark</v-icon>
                    </v-btn>

                    <v-btn icon>
                      <v-icon>mdi-share-variant</v-icon>
                    </v-btn>
                  </v-card-actions>
                </v-card>
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
      colors: [
        "indigo",
        "warning",
        "yellow darken-2",
        "red darken-5",
        "deep-purple darken-8",
      ],
      slides: ["First", "Second", "Third", "Fourth", "Fifth"],
      cards: [
        {
          title: "Pre-fab homes",
          src: "https://cdn.vuetifyjs.com/images/cards/house.jpg",
          flex: 3,
        },
        {
          title: "Pre-fab homes",
          src: "https://cdn.vuetifyjs.com/images/cards/house.jpg",
          flex: 3,
        },
        {
          title: "Favorite road trips",
          src: "https://cdn.vuetifyjs.com/images/cards/road.jpg",
          flex: 3,
        },
        {
          title: "Best airlines",
          src: "https://cdn.vuetifyjs.com/images/cards/plane.jpg",
          flex: 3,
        },
        {
          title: "Best airlines",
          src: "https://cdn.vuetifyjs.com/images/cards/plane.jpg",
          flex: 3,
        },
      ],
    };
  },
};
</script>
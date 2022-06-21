<template>
  <v-card>
    <v-container>
      <v-row>
        <v-col
          v-for="card in cards"
          :key="card.title"
          :md="card.flex"
          cols="12"
        >
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
              <v-btn v-if="card.flex == 3" icon>
                <v-icon>mdi-heart</v-icon>
              </v-btn>

              <v-spacer></v-spacer>
              <v-btn v-if="card.flex == 3" icon>
                <v-icon>mdi-eye</v-icon>
              </v-btn>
              <v-btn
                v-else
                class="ma-2"
                :loading="loading4"
                :disabled="loading4"
                color="info"
                @click="loader = 'loading4'"
              >
                Visita questa sezione
                <template v-slot:loader>
                  <span class="custom-loader">
                    <v-icon light>mdi-cached</v-icon>
                  </span>
                </template>
              </v-btn>
              <v-spacer></v-spacer>

              <v-btn v-if="card.flex == 3" icon>
                <v-icon>mdi-message</v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-card>
</template>
<script>
export default {
  data: () => ({
    cards: [
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
      {
        title: "Best airlines",
        src: "https://cdn.vuetifyjs.com/images/cards/plane.jpg",
        flex: 6,
      },
      {
        title: "Best airlines",
        src: "https://cdn.vuetifyjs.com/images/cards/plane.jpg",
        flex: 6,
      },
      {
        title: "Best airlines",
        src: "https://cdn.vuetifyjs.com/images/cards/plane.jpg",
        flex: 12,
      },
    ],
  }),
};
</script>
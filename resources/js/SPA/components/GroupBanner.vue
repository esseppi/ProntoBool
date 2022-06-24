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
      <v-card color="#D7E4F3" height="320" :to="`/doc/` + card.id" link>
        <v-container>
          <v-row class="fill-height" align="center" justify="center">
            <v-col :cols="card.flex">
              <v-sheet
                color="transparent"
                class="d-flex flex-col align-middle justify-center"
              >
                <v-rating
                  class="mx-auto"
                  :value="card.review_avg"
                  color="amber"
                  dense
                  half-increments
                  readonly
                  size="30"
                ></v-rating>

                <v-card-title class="text-h4 mb-4 mx-auto">
                  {{ card.name }}
                </v-card-title>

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
                <v-spacer></v-spacer>
              </v-sheet>
            </v-col>
            <v-col :cols="card.flex">
              <v-sheet
                height="280"
                color="transparent"
                class="d-flex flex-col align-center"
              >
                <v-spacer></v-spacer>

                <v-avatar class="profile" size="250">
                  <v-img
                    :src="card.src"
                    class="white--text align-center"
                  ></v-img>
                </v-avatar>

                <v-spacer></v-spacer>
              </v-sheet>
            </v-col>
          </v-row>
        </v-container>
      </v-card>
    </v-carousel-item>
  </v-carousel>
</template>
<script>
export default {
  data() {
    return {
      slides: ["First", "Second", "Third", "Fourth", "Fifth"],
      cards: [],
    };
  },
  created() {
    axios.get("/api/promotedUser").then((res) => {
      res.data.data.forEach((element) => {
        let avg = [0];
        this.loading = true;
        const average = (array) =>
          Number((array.reduce((a, b) => a + b) / array.length).toFixed(2));

        let profession = [];
        if (element.professions) {
          element.professions.forEach((elemento) => {
            profession.push(elemento.name);
          });
          if (element.reviews) {
            element.reviews.forEach((elemento) => {
              avg.push(elemento.vote);
            });
          }
          this.cards.push({
            flex: 6,
            id: element.id,
            review_avg: average(avg),
            name: element.name,
            city: element.address,
            src: element.pic,
            title: profession,
          });
        }
      });
      console.log(res.data.data);
    });
  },
};
</script>
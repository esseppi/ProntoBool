<template>
  <v-card elevation="24" max-width="100%" class="mx-auto">
    <!-- <v-system-bar dark> </v-system-bar> -->

    <v-carousel
      :interval="interval"
      progress-color="blue"
      hide-delimiters
      :show-arrows="false"
      :continuous="true"
      :cycle="cycle"
      height="300"
    >
      <template v-slot:prev="{ on, attrs }">
        <v-btn color="blue lighten-3" v-bind="attrs" v-on="on"
          ><v-icon>mdi-skip-previous-circle</v-icon></v-btn
        >
      </template>
      <template v-slot:next="{ on, attrs }">
        <v-btn color="yellow darken" v-bind="attrs" v-on="on"
          ><v-icon>mdi-skip-next-circle</v-icon></v-btn
        >
      </template>
      <v-carousel-item height="300" v-for="(slide, i) in slides" :key="i">
        <v-sheet color="warning" height="310" tile>
          <v-row class="fill-height" align="center" justify="center">
            <v-col :order="colOrder1">
              <v-sheet class="text-h2">{{ slide.name }}</v-sheet>
            </v-col>
            <v-col :order="colOrder2">
              <v-sheet class="text-h2">{{ slide.city }} </v-sheet>
            </v-col>
            <v-col :order="colOrder3">
              <v-sheet class="text-h2">{{ slide.profession }}</v-sheet>
            </v-col>
          </v-row>
        </v-sheet>
      </v-carousel-item>
    </v-carousel>
  </v-card>
</template>
<script>
import { identifier } from "@babel/types";
import NoWorkResult from "postcss/lib/no-work-result";

export default {
  data() {
    return {
      advUser: [],
      interval: 3300,
      colOrder1: 1,
      colOrder2: 2,
      colOrder3: 3,
      slides: [],
      valueBottom: 1,
      socials: ["mdi-instagram", "mdi-facebook"],
      cycle: true,
    };
  },
  mounted() {
    this.colOrder();
  },
  methods: {
    colOrder() {
      let rand = Math.floor(Math.random() * 3 + 1);
      if (rand == 3) {
        this.colOrder1 = 3;
        this.colOrder2 = 1;
        this.colOrder3 = 2;
      } else if (rand == 2) {
        this.colOrder1 = 2;
        this.colOrder2 = 3;
        this.colOrder3 = 1;
      } else {
        this.colOrder1 = 1;
        this.colOrder2 = 2;
        this.colOrder3 = 3;
      }
      setTimeout(() => {
        this.colOrder();
      }, this.interval);
    },
  },
  created() {
    const d = new Date();
    const average = (array) =>
      Number((array.reduce((a, b) => a + b) / array.length).toFixed(2));
    let date = d.toISOString();
    axios.get("/api/promotedUser").then((res) => {
      let bundleGroup = [];

      res.data.data.forEach((el) => {
        let profession = [];
        let avg = [0];

        if (el.reviews) {
          el.reviews.forEach((elemento) => {
            avg.push(elemento.vote);
          });
        } else {
          avg.push([0, 0]);
        }
        if (el.professions) {
          el.professions.forEach((elemento) => {
            profession.push(elemento.name);
          });
        } else profession = null;
        this.slides.push({
          name: el.name,
          review_avg: average(avg),
          count_review: avg.length,
          city: el.address,
          profession: profession,
        });
      });
    });
  },
};
</script>
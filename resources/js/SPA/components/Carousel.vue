<template>
  <v-card elevation="24" max-width="100%" class="mx-auto" :loading="loading">
    <v-system-bar dark height="10"> </v-system-bar>

    <v-carousel
      :interval="interval"
      progress-color="blue"
      hide-delimiters
      show-arrows-on-hover
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
              <div class="d-flex justify-center">
                <v-avatar class="mb-5" color="grey" size="164">
                  <v-img :src="slide.pic"></v-img>
                </v-avatar>
              </div>
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
    <v-bottom-navigation height="70" v-model="valueBottom" dark shift>
      <v-btn x-large>
        <span>Facebook</span>

        <v-icon x-large>mdi-facebook</v-icon>
      </v-btn>

      <v-btn x-large>
        <span>Instagram</span>

        <v-icon x-large>mdi-instagram</v-icon>
      </v-btn>

      <v-btn x-large>
        <span>Linkedin</span>

        <v-icon x-large>mdi-linkedin</v-icon>
      </v-btn>

      <v-btn x-large>
        <span>Slack</span>

        <v-icon x-large>mdi-slack</v-icon>
      </v-btn>
      <!-- <v-list-item-action>
        <v-switch v-model="cycle" label="Cycle Slides" inset></v-switch>
      </v-list-item-action> -->
    </v-bottom-navigation>
  </v-card>
</template>
<script>
export default {
  data() {
    return {
      loading: true,
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
    axios.get("/api/promotedUser").then((res) => {
      res.data.data.forEach((element) => {
        this.loading = true;
        let profession = [];
        if (element.professions) {
          element.professions.forEach((elemento) => {
            profession.push(elemento.name);
          });
          this.slides.push({
            name: element.name,
            city: element.address,
            pic: element.pic,
            profession: profession,
          });
        }
      });
    });
  },
};
</script>
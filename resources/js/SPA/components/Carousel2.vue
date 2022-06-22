<template>
  <v-carousel
    :continuous="false"
    :cycle="cycle"
    :show-arrows="false"
    hide-delimiter-background
    delimiter-icon="mdi-minus"
    height="200"
  >
    <v-carousel-item v-for="(slide, i) in slides" :key="i">
      <v-sheet :color="colors[i]" height="230" tile>
        <v-row class="fill-height" align="center" justify="center">
          <v-col>
            <v-sheet class="text-h2 d-flex justify-center"
              >{{ slide }} Slide</v-sheet
            >
          </v-col>
          <v-col>
            <v-sheet class="text-h2">{{ slide }} Slide</v-sheet>
          </v-col>
          <v-col>
            <v-sheet class="text-h2">{{ slide }} Slide</v-sheet>
          </v-col>
        </v-row>
      </v-sheet>
    </v-carousel-item>
  </v-carousel>
</template>
<script>
export default {
  data() {
    return {
      colors: [
        "warning",
        "secondary",
        "yellow darken-4",
        "red lighten-2",
        "orange darken-1",
      ],
      cycle: true,
      slides: ["First", "Second", "Third", "Fourth", "Fifth"],
    };
  },
};
</script>
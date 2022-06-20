<template>
  <v-sheet>
    <HeroApp />
    <Results />
  </v-sheet>
</template>

<script>
import HeroApp from "../components/HeroApp.vue";
import Results from "../components/Results.vue";
export default {
  name: "Home",
  components: {
    HeroApp,
    Results,
  },
};
</script>
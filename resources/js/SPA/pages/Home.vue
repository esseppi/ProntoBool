<template>
  <div>
    <HeroApp />
    <v-main>
      <v-container fluid> </v-container>
    </v-main>
  </div>
</template>

<script>
import HeroApp from "../components/HeroApp.vue";
export default {
  name: "Home",
  components: {
    HeroApp,
  },
};
</script>
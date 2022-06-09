<template>
  <v-app>
    <Drawer />
    <HeaderApp />
    <v-main>
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import HeaderApp from "./components/HeaderApp.vue";
import Drawer from "./components/Drawer.vue";

export default {
  name: "App",
  components: {
    HeaderApp,
    Drawer,
  },
};
</script>
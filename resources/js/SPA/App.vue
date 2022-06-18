<template>
  <v-app>
    <Drawer :user="user" v-if="user" />
    <HeaderApp :bool="bool" />
    <v-main class="align-center justify-center d-flex">
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
  data() {
    return {
      user: null,
      bool: null,
    };
  },
  components: {
    HeaderApp,
    Drawer,
  },
  mounted() {
    axios.get("/api/user").then((res) => {
      this.user = res.data;
      if (this.user) {
        this.bool = true;
      } else {
        this.bool = false;
      }
    });
  },
};
</script>
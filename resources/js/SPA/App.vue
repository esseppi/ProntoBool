<template>
  <v-app>
    <Drawer :user="user" v-if="user" />
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
  data() {
    return {
      user: null,
    };
  },
  components: {
    HeaderApp,
    Drawer,
  },
  mounted() {
    axios.get("/api/user").then((res) => {
      this.user = res.data;
    });
  },
};
</script>
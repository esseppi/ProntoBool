<template>
  <v-app>
    <Drawer :user="user" v-if="user" />
    <HeaderApp :bool="bool" />
    <v-content>
      <router-view></router-view>
    </v-content>
    <FooterApp />
  </v-app>
</template>

<script>
import HeaderApp from "./components/HeaderApp.vue";
import Drawer from "./components/Drawer.vue";
import FooterApp from "./pages/FooterApp.vue";

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
    FooterApp,
  },
  updated() {
    if (this.$route.name != "home") this.headerShow = true;
  },
  created() {
    if (localStorage.getItem("auth")) {
      axios.get("/api/user").then((res) => {
        this.user = res.data;
        if (this.user) {
          this.bool = true;
        }
      });
    } else {
      this.bool = false;
    }
  },
  mounted() {},
};
</script>
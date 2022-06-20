<template>
  <v-app>
    <Drawer :user="user" v-if="bool" />
    <HeaderApp :bool="bool" v-if="headerShow" />
    <HeaderHome :bool="bool" v-if="headerShow" />
    <v-main>
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import HeaderApp from "./components/HeaderApp.vue";
import HeaderHome from "./components/HeaderApp.vue";
import Drawer from "./components/Drawer.vue";

export default {
  name: "App",
  data() {
    return {
      user: null,
      bool: null,
      headerShow: false,
      profile: null
    };
  },
  components: {
    HeaderApp,
    Drawer,
  },
  updated() {
    if (this.$route.name != "home") this.headerShow = true;
  },
  mounted() {
    if (localStorage.getItem("auth")) {
      axios.get("/api/user").then((res) => {
        this.user = res.data;
        if (this.user) {
          this.bool = true;
        }
      });
      axios.get("/api/profile/" + user.id).then((res) => {
        this.profile = res.data;
      });
    } else {
      this.bool = false;
    }
  },
};
</script>
<template>
  <v-app>
    <Drawer :profile="profile" :user="user" v-if="bool" />
    <HeaderApp :bool="bool" />
    <v-main>
      <router-view></router-view>
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
      profile: null,
      user: null,
      bool: null,
    };
  },
  components: {
    HeaderApp,
    Drawer,
  },
  updated() {
    if (this.$route.name != "home") this.headerShow = true;
  },
  created(){
        if (localStorage.getItem("auth")) {
     axios.get("/api/user").then((res) => {
        this.user = res.data;
        if (this.user) {this.bool = true;}
      })
    } else {
      this.bool = false;
    }
    

  },
  mounted() {
    if (localStorage.getItem("auth")) {
      axios.get("/api/profile/" + this.user.id).then((res) => {
      this.profile = res.data.response;
      console.log(res.data.response)
      });
      
    }

  },
};
</script>
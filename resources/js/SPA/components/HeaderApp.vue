<template>
  <v-app-bar
    light
    dense
    color="#D7E4F3"
    elevation="0"
    height="56px"
    absolute
    app
  >
    <v-container fluid>
      <v-row align="center">
        <!-- <v-app-bar-nav-icon v-if="!bool"></v-app-bar-nav-icon> -->

        <v-toolbar-title>
          <v-btn @click="refresh" dark>ProntoBool</v-btn>
        </v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn icon>
          <v-icon @click="searchPage()">mdi-magnify</v-icon>
        </v-btn>
        <button v-if="bool" @click.prevent="logout">Logout</button>
        <div v-else>
          <button @click.prevent="login">Sei un professionista?</button>
        </div>
      </v-row>
    </v-container>
  </v-app-bar>
</template>

<script>
export default {
  name: "HeaderApp",
  data() {
    return {
      home: "/",

      toggle_exclusive: 1,
      group: null,
    };
  },
  props: {
    bool: Boolean,
  },
  methods: {
    refresh() {
      window.location = "/";
    },
    searchPage() {
      this.$router.push({ path: "/results/ovunque" });
    },
    logout() {
      axios.post("/api/logout").then(() => {
        localStorage.removeItem("auth");
        window.location = "/login-spa";
      });
    },
    login() {
      localStorage.removeItem("auth");
      window.location = "/login-spa";
    },
  },
  created() {},
};
</script>




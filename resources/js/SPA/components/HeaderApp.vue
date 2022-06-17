<template>
  <v-app-bar light dense color="#D7E4F3" height="56px" app>
    <v-app-bar-nav-icon v-if="!bool"></v-app-bar-nav-icon>

    <v-toolbar-title>Title</v-toolbar-title>

    <v-spacer></v-spacer>

    <v-btn icon>
      <v-icon>mdi-magnify</v-icon>
    </v-btn>

    <button v-if="bool" @click.prevent="logout">Logout</button>
    <div v-else>
      <button @click.prevent="login">Sei un professionista?</button>
    </div>
  </v-app-bar>
</template>

<script>
export default {
  name: "HeaderApp",
  data() {
    return {
      toggle_exclusive: 1,
      group: null,
    };
  },
  props: {
    bool: Boolean,
  },
  mounted() {
    axios.get("/api/user").then((res) => {
      this.user = res.data;
    });
  },
  methods: {
    logout() {
      axios.post("/api/logout").then(() => {
        window.location = "/loginSpa";
      });
    },
    login() {
      this.$router.push({ name: "login" });
    },
  },
  created() {},
};
</script>




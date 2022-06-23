<template>
  <v-app-bar light dense color="#D7E4F3" elevation="0" height="56px" app>
    <v-app-bar-nav-icon v-if="!bool"></v-app-bar-nav-icon>

    <v-toolbar-title>ProntoBool</v-toolbar-title>

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
  data() {
    return {
      home: "/home",
      toggle_exclusive: 1,
      group: null,
    };
  },
  props: {
    bool: Boolean,
  },
  methods: {
    logout() {
      axios.post("/api/logout").then(() => {
        localStorage.removeItem("auth");
        window.location = "/auth";
      });
    },
    login() {
      localStorage.removeItem("auth");
      window.location = "/auth";
    },
  },
  created() {},
};
</script>




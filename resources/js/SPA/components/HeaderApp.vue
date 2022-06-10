<template>
  <v-app-bar color="deep-purple accent-4" dense dark app>
    <v-toolbar-title>ProntoPro</v-toolbar-title>
    <v-spacer></v-spacer>
    <div v-if="user">
      <button @click.prevent="logout">Logout</button>
    </div>
  </v-app-bar>
</template>


<script>
export default {
  name: "HeaderApp",
  data() {
    return {
      user: null,
      toggle_exclusive: 1,
      group: null,
    };
  },
  props: {
    user: Object,
  },
  mounted() {
    axios.get("/api/user").then((res) => {
      this.user = res.data;
    });
  },
  methods: {
    logout() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        // Login...
        axios.post("api/logout").then(() => {
          this.$router.push({ name: "Welcome" });
        });
      });
    },
  },
  created() {},
};
</script>




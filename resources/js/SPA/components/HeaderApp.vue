<template>
  <v-app-bar color="#D7E4F3" app>
    <v-toolbar-title>ProntoPro</v-toolbar-title>
    <v-spacer></v-spacer>
    <div v-if="user">
      <button @click.prevent="logout">Logout</button>
    </div>
    <div v-else>
      <button>Sei un professionista?</button>
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
    user: Object,
  },
  mounted() {
    axios.get("/api/user").then((res) => {
      this.user = res.data;
    });
  },
  methods: {
    logout() {
      axios.post("api/logout").then(() => {
        this.$router.push({ name: "Welcome" });
      });
    },
  },
  created() {},
};
</script>




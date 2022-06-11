<template>
  <v-app-bar elevation="0" color="#D7E4F3" light app>
    <v-toolbar-title>ProntoPro</v-toolbar-title>
    <v-spacer></v-spacer>
    <div v-if="bool">
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
    bool: Boolean,
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




<template>
  <v-app-bar color="deep-purple accent-4" dense dark app>
    <v-toolbar-title>ProntoPro</v-toolbar-title>
    <v-spacer></v-spacer>
    <div v-if="user">
      {{ user.name }} <br />
      <button @click.prevent="logout">Logout</button>
    </div>
    <div v-else>
      <v-btn-toggle v-model="toggle_exclusive" mandatory>
        <v-btn to="/signIn">
          <v-icon>mdi-login</v-icon>
        </v-btn>
        <v-btn to="/newAccount">
          <v-icon>mdi-person-plus</v-icon>
        </v-btn>
      </v-btn-toggle>
    </div>
  </v-app-bar>
</template>


<script>
export default {
  name: "HeaderApp",
  data() {
    return {
      toggle_exclusive: 1,
      user: null,
      group: null,
    };
  },
  mounted() {
    axios.get("/api/user").then((res) => {
      this.user = res.data;
    });
  },
  methods: {
    logout() {
      axios.post("/api/logout").then(() => {
        return view("/welcome");
      });
    },
  },
  created() {},
};
</script>




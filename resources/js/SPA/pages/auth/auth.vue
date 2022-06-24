<template>
  <v-container>
    <v-spacer></v-spacer>
    <v-row justify="space-around">
      <v-col cols="12" md="4">
        <v-sheet class="d-flex justify-center">
          <div></div>
          <v-sheet color="white" elevation="24" height="250" width="250">
            <v-btn :to="sheets[0].link">{{ sheets[0].title }}</v-btn>
          </v-sheet>
          <div></div>
        </v-sheet>
      </v-col>
      <v-col cols="12" md="4">
        <v-sheet class="d-flex justify-center">
          <div></div>
          <v-sheet color="white" elevation="24" height="250" width="250">
            <v-btn :to="sheets[1].link">{{ sheets[1].title }}</v-btn>
          </v-sheet>
          <div></div>
        </v-sheet>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
export default {
  name: "auth",
  data: () => ({
    sheets: [
      {
        title: "Login",
        link: "/loginSpa",
      },
      {
        title: "Register",
        link: "/registerSpa",
      },
    ],
  }),
};
</script>
<template>
  <v-container>
    <v-row justify="space-around">
      <v-col v-for="sheet in sheets" :key="sheet" cols="12" md="4">
        <v-sheet class="d-flex justify-center">
          <div></div>
          <v-sheet
            :key="sheet"
            color="white"
            elevation="24"
            height="250"
            width="250"
          >
            <v-btn :to="sheet.link">{{ sheet.title }}</v-btn>
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
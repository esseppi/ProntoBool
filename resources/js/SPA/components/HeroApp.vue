<template>
  <v-row align="left" no-gutters>
    <v-col cols="12">
      <v-card color="#D6E4F4" elevation="0" app>
        <v-app-bar flat color="rgba(0, 0, 0, 0)">
          <!-- <HeaderApp /> -->
        </v-app-bar>
        <v-container>
          <v-card-title class="black--text text-h2 mt-8">
            Find local dentists who take your insurance
          </v-card-title>
          <v-row>
            <v-col cols="12" md="4">ciao</v-col>
            <v-col cols="12" md="4">ciao</v-col>
            <v-col cols="12" md="4">ciao</v-col>
          </v-row>
        </v-container>
      </v-card>
    </v-col>
  </v-row>
</template>


<script>
import HeaderApp from "./HeaderApp.vue";
export default {
  name: "HeroApp",
  data: () => ({
    model: 0,
    colors: ["primary", "secondary", "yellow darken-2", "red", "orange"],
  }),
  components: {
    HeaderApp,
  },
};
</script>




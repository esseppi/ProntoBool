<template>
  <v-row align="left" no-gutters>
    <v-col cols="12">
      <v-card color="#D6E4F4" elevation="0" app>
        <v-container>
          <v-card-title class="black--text text-h2 mt-8">
            Find local dentists <br />
            who take your insurance
          </v-card-title>
          <v-card-actions>
            <Toolbar />
          </v-card-actions>
        </v-container>
      </v-card>
    </v-col>
  </v-row>
</template>


<script>
import Toolbar from "./ToolBar.vue";
export default {
  name: "HeroApp",
  data: () => ({
    model: 0,
    colors: ["primary", "secondary", "yellow darken-2", "red", "orange"],
  }),
  components: {
    Toolbar,
  },
};
</script>

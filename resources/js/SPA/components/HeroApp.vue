<template>
  <v-row justify="start" elevetion="24" no-gutters>
    <v-col cols="12">
      <v-card color="#D6E4F4">
        <v-container>
          <v-card-title class="black--text text-h2 mt-8">
            <p class="word-wrap brake-word overflow-wrap">
              Find local dentists <br />
              who take your insurance
            </p>
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

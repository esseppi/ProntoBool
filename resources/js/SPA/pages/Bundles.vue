<template>
  <v-row align="center" justify="center">
    <v-col
      v-for="bundle in bundles"
      :key="bundle.id"
      cols="12"
      md="4"
      align-self="center"
    >
      <v-hover v-slot="{ hover }">
        <v-card class="mx-auto" color="grey lighten-4" max-width="600">
          <v-img
            :aspect-ratio="16 / 9"
            src="https://cdn.vuetifyjs.com/images/cards/kitchen.png"
          >
            <v-expand-transition>
              <div
                v-if="hover"
                class="
                  d-flex
                  transition-fast-in-fast-out
                  orange
                  darken-2
                  v-card--reveal
                  text-h2
                  white--text
                "
                style="height: 100%"
              >
                {{ bundle.price }}
              </div>
            </v-expand-transition>
          </v-img>
          <v-card-text class="pt-6" style="position: relative">
            <v-row justify="space-around">
              <v-col cols="auto">
                <v-dialog transition="dialog-bottom-transition" max-width="600">
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn
                      :to="`/checkout2/${bundle.id}`"
                      v-bind="attrs"
                      v-on="on"
                      absolute
                      color="orange"
                      class="white--text"
                      fab
                      large
                      right
                      top
                    >
                      <v-icon>mdi-cart</v-icon>
                    </v-btn>
                  </template>
                  <template v-slot:default="dialog">
                    <v-card>
                      <v-toolbar elevation="0" color="primary" dark
                        >Opening from the bottom</v-toolbar
                      >
                      <v-card-text>
                        <div class="text-h2 pa-12">Hello world!</div>
                      </v-card-text>
                      <v-card-actions class="justify-end">
                        <v-btn text @click="dialog.value = false">Close</v-btn>
                      </v-card-actions>
                    </v-card>
                  </template>
                </v-dialog>
              </v-col>
            </v-row>
            <h3 class="text-h4 font-weight-light orange--text mb-2">
              {{ bundle.name }}
            </h3>
            <div class="font-weight-light text-h6 mb-2">
              {{ bundle.duration }}
            </div>
          </v-card-text>
        </v-card>
      </v-hover>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: "Bundles",
  data() {
    return {
      bundles: [],
    };
  },
  mounted() {
    axios.get("/api/sponsorship").then((res) => {
      this.bundles = res.data.data;
    });
  },
};
</script>

<style scoped>
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: 0.5;
  position: absolute;
  width: 100%;
}
</style>

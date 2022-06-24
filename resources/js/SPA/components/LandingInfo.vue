<template>
  <v-card color="#D7E4F3" elevation="24" width="100%">
    <v-container>
      <v-card-text>
        <div>Word of the Day</div>
        <p class="text-h4 text--primary">enlargement·of·the·service</p>
        <p>wait for your city</p>
        <div class="text--primary">
          If you need it, <br />
          Hire a professionist with Prontobool!
        </div>
      </v-card-text>
      <v-card-actions>
        <v-btn text color="teal accent-4" @click="reveal = true">
          Learn More
        </v-btn>
      </v-card-actions>
    </v-container>
    <v-expand-transition>
      <v-card
        v-if="reveal"
        class="transition-fast-in-fast-out v-card--reveal"
        style="height: 100%"
      >
        <v-container>
          <v-card-text class="pb-0">
            <p class="text-h4 text--primary">Origin</p>
            <p>
              late 16th century (as a noun denoting a place where alms were
              distributed): from medieval Latin eleemosynarius, from late Latin
              eleemosyna ‘alms’, from Greek eleēmosunē ‘compassion’
            </p>
          </v-card-text>
          <v-card-actions class="pt-0">
            <v-btn text color="teal accent-4" @click="reveal = false">
              Close
            </v-btn>
          </v-card-actions>
        </v-container>
      </v-card>
    </v-expand-transition>
  </v-card>
</template>
<script>
export default {
  data: () => ({
    reveal: false,
  }),
};
</script>
<style>
.v-card--reveal {
  bottom: 0;
  opacity: 1 !important;
  position: absolute;
  width: 100%;
}
</style>
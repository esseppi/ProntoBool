<template>
  <v-sheet>
    <HeroApp />
    <GroupBanner />
    <ProfBanner />
    <LandingInfo />
    <RoadTime />
    <Carousel />
  </v-sheet>
</template>

<script>
import HeroApp from "../components/HeroApp.vue";
import LandingInfo from "../components/LandingInfo.vue";
import RoadTime from "../components/RoadTime.vue";
import Carousel from "../components/Carousel.vue";
import ProfBanner from "../components/ProfBanner.vue";
import GroupBanner from "../components/GroupBanner.vue";
export default {
  name: "Home",
  components: {
    HeroApp,
    RoadTime,
    LandingInfo,
    Carousel,
    ProfBanner,
    GroupBanner,
  },
};
</script>
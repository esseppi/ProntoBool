<template>
  <v-sheet>
    <HeroApp />
    <ProfBanner />
    <Carousel />
    <LandingInfo />
    <RoadTime />
    <GroupBanner />
    <UserBanner />
    <Carousel2 />
  </v-sheet>
</template>

<script>
import HeroApp from "../components/HeroApp.vue";
import LandingInfo from "../components/LandingInfo.vue";
import RoadTime from "../components/RoadTime.vue";
import Carousel from "../components/Carousel.vue";
import Carousel2 from "../components/Carousel2.vue";
import ProfBanner from "../components/ProfBanner.vue";
import GroupBanner from "../components/GroupBanner.vue";
import UserBanner from "../components/UserBanner.vue";
export default {
  name: "Home",
  components: {
    HeroApp,
    RoadTime,
    LandingInfo,
    Carousel,
    Carousel2,
    ProfBanner,
    GroupBanner,
    UserBanner,
  },
};
</script>
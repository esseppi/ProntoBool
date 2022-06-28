<template>
  <div class="py-10">
    <v-bottom-navigation color="teal" grow>
      <v-btn>
        <span>Edit Profile</span>

        <v-icon>mdi-account-edit</v-icon>
      </v-btn>

      <v-btn>
        <span>Show Profile</span>

        <v-icon>mdi-eye</v-icon>
      </v-btn>

      <v-btn>
        <span>Show Messages</span>

        <v-icon>mdi-message</v-icon>
      </v-btn>
    </v-bottom-navigation>
    <v-container>
      <v-row>
        <v-col>
          <v-card class="" max-width="344">
            <v-img :src="this.profile.pic" height="200px"></v-img>

            <v-card-title> {{ this.user.name }} </v-card-title>

            <v-card-actions>
              <v-chip-group center-active class="align-self-end" show-arrows>
                <v-chip
                  center-active
                  v-for="item in this.profile.professions"
                  :key="item.id"
                  class="warning accent-4 white--text"
                >
                  {{ item.name }}
                </v-chip>
              </v-chip-group>
            </v-card-actions>

            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn icon @click="show = !show">
                <v-icon>{{
                  show ? "mdi-chevron-up" : "mdi-chevron-down"
                }}</v-icon>
              </v-btn>
            </v-card-actions>

            <v-expand-transition>
              <div v-show="show">
                <v-divider></v-divider>

                <v-card-text>
                  {{ this.profile.description }}
                  escape.
                </v-card-text>
              </div>
            </v-expand-transition>
          </v-card>
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <v-card>
            <v-card-title>General infos</v-card-title>
            <v-system-bar color="warning" height="10"> </v-system-bar>
            <v-btn-toggle
              class="d-flex justify-center"
              v-model="toggle_exclusive"
            >
              <v-btn>
                <v-icon>mdi-android-messages</v-icon>
              </v-btn>
              <v-btn>
                <v-icon>mdi-draw</v-icon>
              </v-btn>
              <v-btn>
                <v-icon>mdi-eye</v-icon>
              </v-btn>
              <v-btn>
                <v-icon>mdi-cash</v-icon>
              </v-btn>
            </v-btn-toggle>
            <v-card v-if="toggle_exclusive == 0"> <BarChart /></v-card>
            <v-card v-if="toggle_exclusive == 1"> <BarChart /> </v-card>
            <v-card v-if="toggle_exclusive == 2"> <BarChart /></v-card>
            <v-card v-if="toggle_exclusive == 3"> <BarChart /> </v-card>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import BarChart from "../../components/BarChart.vue";

export default {
  name: "mydashboard",
  data() {
    return {
      show: false,
      user: [],
      profile: [],
      toggle_exclusive: 0,
    };
  },

  components: { BarChart },

  created() {
    axios.get("/api/user").then((res) => {
      this.user = res.data;
      if (this.$route.params.id != this.user.id) {
        this.$router.push("/mydashboard/" + this.user.id);
      }
      axios.get("/api/dashinfo/" + this.user.id).then((res) => {
        this.profile = res.data.data;
      });
    });
  },
};
</script>

<style>
</style>

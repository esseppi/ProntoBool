<template>
  <v-navigation-drawer v-model="drawer" :mini-variant.sync="mini" permanent app>
    <v-list-item class="px-2">
      <v-list-item-avatar v-if="profile">
                <v-img v-if="profile.pic.includes('http')" :src="profile.pic" />
                <v-img v-else :src="'/storage/'+profile.pic" />
      </v-list-item-avatar>

      <v-list-item-title>{{ user.name }}</v-list-item-title>

      <v-btn icon @click.stop="mini = !mini">
        <v-icon>mdi-chevron-left</v-icon>
      </v-btn>
    </v-list-item>

    <v-divider></v-divider>

    <v-list dense>
        <v-list-item :key="profile" :to="'/doc/'+profile.id" link>
        <v-list-item-icon>
          <v-icon>mdi-account</v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <v-list-item-title>My Profile</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list-item v-for="item in items" :key="item.title" :to="item.name" link>
        <v-list-item-icon>
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>


<script>
export default {
  name: "Drawer",
  data() {
    return {
      profile: {
      pic: null,
      },
      drawer: true,
      items: [
        {
          title: "Home",
          name: "/",
          icon: "mdi-home",
        },
        {
          title: "Dashboard",
          name: "/mydashboard/" + this.user.id,
          icon: "mdi-finance",
        },
        {
          title: "Edit profile",
          name: "/edit",
          icon: "mdi-account-edit",
        },
        {
          title: "Messages",
          name: "/mymessages",
          icon: "mdi-message",
        },
        {
          title: "Reviews",
          name: "/myreviews",
          icon: "mdi-account-star",
        },
        {
          title: "Sponsorships",
          name: "/bundles",
          icon: "mdi-magnet-on",
        },
      ],
      mini: true,
    };
  },
  props: {
    user: Object,
  },
  mounted() {
    axios.get(`/api/profile/${this.user.id}`).then((res) => {
      console.log(res.data.response);
      this.profile = res.data.response;
    });
  },
};
</script>
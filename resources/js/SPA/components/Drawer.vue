<template>
  <v-navigation-drawer v-model="drawer" :mini-variant.sync="mini" permanent app>
    <v-list-item class="px-2">
      <v-list-item-avatar>
        <v-img :src="profile.pic"></v-img>
      </v-list-item-avatar>

      <v-list-item-title>{{ user.name }}</v-list-item-title>

      <v-btn icon @click.stop="mini = !mini">
        <v-icon>mdi-chevron-left</v-icon>
      </v-btn>
    </v-list-item>

    <v-divider></v-divider>

    <v-list dense>
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
          name: "/mydashboard",
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
  created() {
    axios.get("/api/profile/" + this.user.id).then((res) => {
      this.profile = res.data.response;
    });
  },
  methods: {},
};
</script>
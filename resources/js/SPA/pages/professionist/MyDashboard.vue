<template></template>

<script>
export default {
  name: "mydashboard",
  data() {
    return {
      profile: null,
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
};
</script>

<style>
</style>
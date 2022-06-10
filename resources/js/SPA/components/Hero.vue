<template></template>


<script>
export default {
  name: "HeroApp",
  data() {
    return {
      toggle_exclusive: 1,
      group: null,
    };
  },
  props: {
    user: Object,
  },
  mounted() {
    axios.get("/api/user").then((res) => {
      this.user = res.data;
    });
  },
  methods: {
    logout() {
      axios.post("api/logout").then(() => {
        this.$router.push({ name: "Welcome" });
      });
    },
  },
  created() {},
};
</script>




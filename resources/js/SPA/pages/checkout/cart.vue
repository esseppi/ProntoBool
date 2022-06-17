<template>
  <div class="flex flex-col mx-auto max-w-lg p-10 justify-middle">
    {{ form }}
    <div class="text-2xl"></div>
    <Payment
      v-if="!loadingPayment"
      ref="paymentRef"
      @loading="handleLoading"
      @onSuccess="paymentOnSuccess"
      @onError="paymentOnError"
    ></Payment>

    <button
      v-if="!disableBuyButton"
      class="
        w-full
        text-center
        px-4
        py-3
        bg-green-500
        rounded-md
        shadow-md
        text-white
        font-semibold
      "
      @click.prevent="beforeBuy"
    >
      Procedi con l'acquisto 🎉
    </button>
    <button
      v-else
      class="
        w-full
        text-center
        px-4
        py-3
        bg-green-300
        rounded-md
        shadow-md
        text-white
        font-semibold
        cursor-not-allowed
      "
    >
      {{ loadingPayment ? "Loading..." : "Procedi con l'acquisto 🎉" }}
    </button>
  </div>
</template>

<script>
import Payment from "../../components/Payment.vue";
export default {
  data() {
    return {
      tokenApi: "",
      disableBuyButton: true,
      loadingPayment: true,
      form: {
        token: "",
        product: "",
      },
    };
  },
  beforeCreate() {
    axios.get("api/orders/generate").then((res) => {
      console.log(res.data.token);
      this.tokenApi = res.data.token;
      this.loadingPayment = false;
    });
  },
  mounted() {
    this.form.product = this.$route.params.id;
  },
  methods: {
    handleLoading() {
      this.disableBuyButton = false;
    },
    paymentOnSuccess(nonce) {
      // alert(nonce);
      this.form.token = nonce;
      this.buy();
    },
    // eslint-disable-next-line node/handle-callback-err
    paymentOnError(error) {},
    beforeBuy() {
      this.$refs.paymentRef.$refs.paymentBtnRef.click();
    },
    async buy() {
      this.disableBuyButton = true;
      this.loadingPayment = true;
      try {
        await axios.post("/api/orders/makepayment", { ...this.form });
        // const message = response.message
        // alert(message)
        this.$router.push({ path: "/bundles" });
      } catch (error) {
        this.disableBuyButton = false;
        this.loadingPayment = false;
      }
    },
  },
  components: { Payment },
};
</script>

<style>
</style>

<template>
  <v-container>
    <div class="d-none">
      {{ form }}
    </div>
    <v-row align="center" justify="center">
      <v-col cols="6">
        <v-sheet elevation="24">
          <div class="px-6 pb-5">
            <Payment
              v-if="!loadingPayment"
              :authorization="tokenApi"
              ref="paymentRef"
              @loading="handleLoading"
              @onSuccess="paymentOnSuccess"
              @onError="paymentOnError"
            ></Payment>
          </div>
        </v-sheet>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Payment from "../../components/Payment.vue";
export default {
  data() {
    return {
      tokenApi: "",
      form: {
        token: "",
        product: "",
      },
    };
  },
  beforeCreate() {
    axios.get("http://127.0.0.1:8000/api/orders/generate").then((res) => {
      this.tokenApi = res.data.token;
      console.log(this.tokenApi);
      // this.loadingPayment = false;
    });
  },
  mounted() {
    this.form.product = this.$route.params.id;
  },
  methods: {
    handleLoading() {
      // this.disableBuyButton = false;
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
      // this.disableBuyButton = true;
      // this.loadingPayment = true;
      try {
        await axios.post("/api/orders/makepayment", { ...this.form });
        const message = response.message;
        // alert(message)
        this.$router.push({ path: "/bundles" });
      } catch (error) {
        // this.disableBuyButton = false;
        // this.loadingPayment = false;
      }
    },
  },
  components: { Payment },
};
</script>

<style>
</style>

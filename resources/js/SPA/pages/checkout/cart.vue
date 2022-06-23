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
              v-if="loadingPayment"
              :authorization="tokenApi"
              ref="paymentRef"
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
      loadingPayment: false,
      tokenApi: "",
      form: {
        token: "",
        product: "",
      },
    };
  },
  beforeCreate() {
    axios.get("api/orders/generate").then((res) => {
      this.tokenApi = res.data.token;
      this.loadingPayment = true;
    });
  },
  mounted() {
    this.form.product = this.$route.params.id;
  },
  methods: {
    paymentOnSuccess(nonce) {
      alert(nonce);
      this.form.token = nonce;
      this.buy();
    },
    // eslint-disable-next-line node/handle-callback-err
    paymentOnError(error) {},
    beforeBuy() {
      this.$refs.paymentRef.$refs.paymentBtnRef.click();
    },
    async buy() {
      this.loadingPayment = true;
      try {
        await axios
          .post("api/orders/makepayment", { ...this.form })
          .then(() => {
            this.$router.push({ path: "/bundles" });
          });
        const message = response.message;
        // alert(message)
      } catch (error) {
        this.loadingPayment = false;
      }
    },
  },
  components: { Payment },
};
</script>

<style>
</style>

<template>
  <v-container>
    <div class="d-none">
      {{ form }}
    </div>
    <div class="text-2xl"></div>
    <v-braintree
      v-if="!loadingPayment"
      ref="paymentRef"
      :authorization="tokenApi"
      @loading="handleLoading"
      @onSuccess="paymentOnSuccess"
      @onError="paymentOnError"
    >
      <template #button="slotProps">
        <v-row justify="center" class="py-3">
          <v-btn
            color="success"
            dark
            large
            ref="paymentBtnRef"
            @click="slotProps.submit"
            >BUY
          </v-btn>
        </v-row>
      </template>
    </v-braintree>
  </v-container>
</template>

<script>
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
    axios.get("http://127.0.0.1:8000/api/orders/generate").then((res) => {
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
        axios.post("api/orders/makepayment", {
          ...this.form,
        });
        // const message = response.message
        // alert(message)
        this.$router.push({ path: "/" });
      } catch (error) {
        this.disableBuyButton = false;
        this.loadingPayment = false;
      }
    },
  },
};
</script>

<style>
</style>

<template>
  <v-container>
    <v-braintree
      :authorization="authorization"
      locale="it_IT"
      @success="onSuccess"
      @error="onError"
      @load="onLoad"
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
    <div>
      <p v-if="error" class="text-red-500 mb-4">
        {{ error }}
      </p>
    </div>
  </v-container>
</template>

<script>
export default {
  props: {
    authorization: {
      required: true,
      type: String,
    },
  },
  data() {
    return {
      error: "",
    };
  },
  methods: {
    onLoad() {
      this.$emit("loading");
    },
    onSuccess(payload) {
      const token = payload.nonce;
      this.$emit("onSuccess", token);
      // const nonce = payload.nonce
      // Do something great with the nonce...
    },
    // eslint-disable-next-line node/handle-callback-err
    onError(error) {
      const message = error.message;
      if (message === "No payment method is available.") {
        this.error = "Seleziona un metodo di Pagamento";
      } else {
        this.error = message;
      }
      this.$emit("onError", message);
    },
  },
};
</script>

<style>
</style>

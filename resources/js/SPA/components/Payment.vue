<template>
  <div>
    <v-braintree
      authorization="eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiJleUowZVhBaU9pSktWMVFpTENKaGJHY2lPaUpGVXpJMU5pSXNJbXRwWkNJNklqSXdNVGd3TkRJMk1UWXRjMkZ1WkdKdmVDSXNJbWx6Y3lJNkltaDBkSEJ6T2k4dllYQnBMbk5oYm1SaWIzZ3VZbkpoYVc1MGNtVmxaMkYwWlhkaGVTNWpiMjBpZlEuZXlKbGVIQWlPakUyTlRVMU5qQTJNREFzSW1wMGFTSTZJakV6WVRJeE9XTXpMVEE1TXpNdE5EQmpZaTA0TXpZd0xXTmhOR0pqTkdSak0ySXdaQ0lzSW5OMVlpSTZJbmhtYWpaNVozTTNhbVo0ZUdJNVlqTWlMQ0pwYzNNaU9pSm9kSFJ3Y3pvdkwyRndhUzV6WVc1a1ltOTRMbUp5WVdsdWRISmxaV2RoZEdWM1lYa3VZMjl0SWl3aWJXVnlZMmhoYm5RaU9uc2ljSFZpYkdsalgybGtJam9pZUdacU5ubG5jemRxWm5oNFlqbGlNeUlzSW5abGNtbG1lVjlqWVhKa1gySjVYMlJsWm1GMWJIUWlPbVpoYkhObGZTd2ljbWxuYUhSeklqcGJJbTFoYm1GblpWOTJZWFZzZENKZExDSnpZMjl3WlNJNld5SkNjbUZwYm5SeVpXVTZWbUYxYkhRaVhTd2liM0IwYVc5dWN5STZlMzE5LmRpd0lucmNpMUpSa1hHZFpkOTJ1MGZ5NzJvT1Fma3htZlR5MFBaeXpjRzJ2OXhpUjVtSHFzcVhOUlQ1OFoteWVpNS0tZG5UaU9JaEl1UGUtSmNJU1FnIiwiY29uZmlnVXJsIjoiaHR0cHM6Ly9hcGkuc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbTo0NDMvbWVyY2hhbnRzL3hmajZ5Z3M3amZ4eGI5YjMvY2xpZW50X2FwaS92MS9jb25maWd1cmF0aW9uIiwiZ3JhcGhRTCI6eyJ1cmwiOiJodHRwczovL3BheW1lbnRzLnNhbmRib3guYnJhaW50cmVlLWFwaS5jb20vZ3JhcGhxbCIsImRhdGUiOiIyMDE4LTA1LTA4IiwiZmVhdHVyZXMiOlsidG9rZW5pemVfY3JlZGl0X2NhcmRzIl19LCJjbGllbnRBcGlVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMveGZqNnlnczdqZnh4YjliMy9jbGllbnRfYXBpIiwiZW52aXJvbm1lbnQiOiJzYW5kYm94IiwibWVyY2hhbnRJZCI6InhmajZ5Z3M3amZ4eGI5YjMiLCJhc3NldHNVcmwiOiJodHRwczovL2Fzc2V0cy5icmFpbnRyZWVnYXRld2F5LmNvbSIsImF1dGhVcmwiOiJodHRwczovL2F1dGgudmVubW8uc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbSIsInZlbm1vIjoib2ZmIiwiY2hhbGxlbmdlcyI6W10sInRocmVlRFNlY3VyZUVuYWJsZWQiOnRydWUsImFuYWx5dGljcyI6eyJ1cmwiOiJodHRwczovL29yaWdpbi1hbmFseXRpY3Mtc2FuZC5zYW5kYm94LmJyYWludHJlZS1hcGkuY29tL3hmajZ5Z3M3amZ4eGI5YjMifSwicGF5cGFsRW5hYmxlZCI6dHJ1ZSwicGF5cGFsIjp7ImJpbGxpbmdBZ3JlZW1lbnRzRW5hYmxlZCI6dHJ1ZSwiZW52aXJvbm1lbnROb05ldHdvcmsiOnRydWUsInVudmV0dGVkTWVyY2hhbnQiOmZhbHNlLCJhbGxvd0h0dHAiOnRydWUsImRpc3BsYXlOYW1lIjoiUHJvbnRvQm9vbCIsImNsaWVudElkIjpudWxsLCJwcml2YWN5VXJsIjoiaHR0cDovL2V4YW1wbGUuY29tL3BwIiwidXNlckFncmVlbWVudFVybCI6Imh0dHA6Ly9leGFtcGxlLmNvbS90b3MiLCJiYXNlVXJsIjoiaHR0cHM6Ly9hc3NldHMuYnJhaW50cmVlZ2F0ZXdheS5jb20iLCJhc3NldHNVcmwiOiJodHRwczovL2NoZWNrb3V0LnBheXBhbC5jb20iLCJkaXJlY3RCYXNlVXJsIjpudWxsLCJlbnZpcm9ubWVudCI6Im9mZmxpbmUiLCJicmFpbnRyZWVDbGllbnRJZCI6Im1hc3RlcmNsaWVudDMiLCJtZXJjaGFudEFjY291bnRJZCI6InByb250b2Jvb2wiLCJjdXJyZW5jeUlzb0NvZGUiOiJFVVIifX0="
      locale="it_IT"
      @success="onSuccess"
      @error="onError"
      @load="onLoad"
    >
      <template #button="slotProps">
        <v-btn ref="paymentBtnRef" @click="slotProps.submit" />
      </template>
    </v-braintree>
    <div>
      <p v-if="error" class="text-red-500 mb-4">
        {{ error }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    // authorization: {
    //   required: true,
    //   type: String,
    // },
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

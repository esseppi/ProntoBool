<template>
  <div class="background">
    <v-main class="d-flex justify-center align-center">
      <v-col cols="10" lg="4" class="mx-auto">
        <v-card class="pa-4">
          <div class="text-center">
            <v-avatar size="100" color="indigo lighten-4">
              <v-icon size="40" color="indigo">mdi-account</v-icon>
            </v-avatar>
            <h2 class="indigo--text">Vue login Page</h2>
          </div>
          <v-form @submit.prevent="submitHandler" ref="form">
            <v-card-text>
              <v-text-field
                :loading="loading"
                v-model="form.email"
                :rules="emailRules"
                type="email"
                label="Email"
                placeholder="Email"
                prepend-inner-icon="mdi-account"
                required
              />
              <v-text-field
                :loading="loading"
                v-model="form.password"
                :rules="passwordRules"
                :type="passwordShow ? 'text' : 'password'"
                label="Password"
                placeholder="Password"
                prepend-inner-icon="mdi-key"
                :append-icon="passwordShow ? 'mdi-eye' : 'mdi-eye-off'"
                @click:append="passwordShow = !passwordShow"
                required
              />
              <v-switch
                label="Remember me"
                color="indigo"
                v-model="form.remember"
              ></v-switch>
            </v-card-text>
            <v-card-actions class="justify-center">
              <v-btn
                :disabled="disableBtn"
                :loading="loading"
                type="submit"
                color="indigo"
              >
                <span class="white--text px-8">Login</span>
              </v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-col>
    </v-main>
    <v-snackbar top color="red" v-model="snackbar">
      Something went wrong
    </v-snackbar>
  </div>
</template>

<script>
import store from "../../../store";
export default {
  name: "App",

  data: () => ({
    form: {
      email: "",
      password: "",
      remember: false,
    },
    disableBtn: false,
    loading: false,
    snackbar: false,
    passwordShow: false,
    email: "",
    emailRules: [
      (v) => !!v || "E-mail is required",
      (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
    ],
    password: "",
    passwordRules: [
      (v) => !!v || "Password is required",
      (v) => (v && v.length >= 6) || "Password must be 6  characters or more!",
    ],
  }),
  methods: {
    remember_function() {
      this.remember = true;
    },
    submitHandler() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        setTimeout(() => {
          this.loading = false;
          this.snackbar = true;
        }, 3000);
        this.loginUser();
      }
    },
    loginUser() {
      axios
        .post("/api/login", this.form)
        .then(() => {
          localStorage.setItem("auth", true);
          window.location = "/home";
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>
<style>
.backgruond {
  background-image: url(./assets/Order-Banner.jpg) !important;
  height: 300px;
  width: 100%;
  display: block;
  position: absolute;
  top: 0;
  background-size: cover;
}
</style>
<template>
  <div class="background">
    <v-main class="d-flex justify-center align-center">
      <v-col cols="10" lg="4" class="mx-auto">
        <v-card class="pa-2">
          <div class="text-center">
            <v-avatar size="100" color="indigo lighten-4">
              <v-icon size="40" color="indigo">mdi-account</v-icon>
            </v-avatar>
            <h2 class="indigo--text">Register Prontobool</h2>
          </div>
          <v-form @submit.prevent="submitHandler" ref="form">
            <v-card-text>
              <v-text-field
                prepend-inner-icon="mdi-form-textbox"
                :loading="loading"
                v-model="form.name"
                :rules="nameRules"
                :counter="25"
                label="Name"
                required
              ></v-text-field>
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
              <v-text-field
                :loading="loading"
                v-model="form.password_confirmation"
                :rules="passwordRules"
                :type="passwordShow2 ? 'text' : 'password'"
                label="Check"
                placeholder="Confirm Password"
                prepend-inner-icon="mdi-lock"
                :append-icon="passwordShow ? 'mdi-eye' : 'mdi-eye-off'"
                @click:append="passwordShow2 = !passwordShow2"
                required
              />
              <v-switch label="Remember me" color="indigo"></v-switch>
            </v-card-text>
            <v-card-actions class="justify-center">
              <v-btn :loading="loading" type="submit" color="indigo">
                <span class="white--text px-8">Register</span>
              </v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-col>
    </v-main>
    <v-snackbar top color="red" v-model="snackbar">
      {{ errors }}
    </v-snackbar>
  </div>
</template>

<script>
export default {
  name: "App",

  data: () => ({
    form: {
      name: "",
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    },
    errors: [],
    valid: false,
    loading: false,
    snackbar: false,
    passwordShow: false,
    passwordShow2: false,
    nameRules: [
      (v) => !!v || "Name is required",
      (v) => v.length <= 25 || "Name must be less than 10 characters",
    ],
    emailRules: [
      (v) => !!v || "E-mail is required",
      (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
    ],
    passwordRules: [
      (v) => !!v || "Password is required",
      (v) => (v && v.length >= 7) || "Password must be 8  characters or more!",
    ],
  }),
  methods: {
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
        .post("/api/register", this.form)
        .then(() => {
          window.location = "/home";
        })
        .catch((error) => {
          this.errors = Object.values(error.response.data.errors);
        })
        .then(() => {
          console.log(this.errors);
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
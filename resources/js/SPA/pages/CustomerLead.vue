<template>
  <v-stepper v-model="e1">
    <!-- TITOLI -->
    <v-stepper-header>
      <v-stepper-step :complete="e1 > 1" step="1">
        Name of step 1
      </v-stepper-step>

      <v-divider></v-divider>

      <v-stepper-step :complete="e1 > 2" step="2">
        Name of step 2
      </v-stepper-step>

      <v-divider></v-divider>

      <v-stepper-step step="3"> Name of step 3 </v-stepper-step>
    </v-stepper-header>
    <!-- TRE STEPPER -->
    <v-stepper-items>
      <!-- STEPPER 1 -->
      <v-stepper-content step="1">
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-card class="mb-12" color="grey lighten-1">
            <v-card-title> Inserisci le tue informazioni </v-card-title>

            <v-card-text>
              <v-text-field
                v-model="name"
                :counter="10"
                :rules="nameRules"
                label="Name"
                required
              ></v-text-field>

              <v-text-field
                v-model="email"
                :rules="emailRules"
                label="E-mail"
                required
              ></v-text-field>

              <v-select
                v-model="select"
                :items="items"
                :rules="[(v) => !!v || 'Item is required']"
                label="Item"
                required
              ></v-select>

              <v-checkbox
                v-model="checkbox"
                :rules="[(v) => !!v || 'You must agree to continue!']"
                label="Do you agree?"
                required
              ></v-checkbox>

              <v-btn color="error" class="mr-4" @click="reset">
                Reset Form
              </v-btn>

              <v-btn color="warning" @click="resetValidation">
                Reset Validation
              </v-btn>
            </v-card-text>
          </v-card>

          <v-btn :disabled="!valid" @click="validate(2)" color="primary">
            Continue
          </v-btn>

          <v-btn text> Cancel </v-btn>
        </v-form>
      </v-stepper-content>
      <!-- STEPPER 2 -->

      <v-stepper-content step="2">
        <v-card class="mb-12" color="grey lighten-1" height="200px"> </v-card>

        <v-btn color="primary" @click="validate(3)"> Continue </v-btn>

        <v-btn text> Cancel </v-btn>
      </v-stepper-content>
      <!-- STEPPER 3 -->

      <v-stepper-content step="3">
        <v-card class="mb-12" color="grey lighten-1" height="200px"></v-card>

        <v-btn color="primary" @click="e1 = 1"> Continue </v-btn>

        <v-btn text> Cancel </v-btn>
      </v-stepper-content>
    </v-stepper-items>
  </v-stepper>
</template>

<script>
export default {
  data: () => ({
    e1: 1,
    valid: false,
    name: "",
    nameRules: [
      (v) => !!v || "Name is required",
      (v) => (v && v.length <= 10) || "Name must be less than 10 characters",
    ],
    email: "",
    emailRules: [
      (v) => !!v || "E-mail is required",
      (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
    ],
    select: null,
    items: ["Item 1", "Item 2", "Item 3", "Item 4"],
    checkbox: false,
  }),
  mounted() {
    this.form.product = this.$route.params.id;
  },
  methods: {
    validate($stepId) {
      this.$refs.form.validate();
      this.e1 = $stepId;
    },
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
  },
};
</script>
<template>
  <v-main>
    <div class="inner">
      <div class="stepper-container">
        <ul>
          <li>
            <div class="step-circle" :class="{ active: currentStep == 1 }">
              1
            </div>
          </li>
          <li class="line"></li>
          <li>
            <div class="step-circle" :class="{ active: currentStep == 2 }">
              2
            </div>
          </li>
          <li class="line"></li>
          <li>
            <div class="step-circle" :class="{ active: currentStep == 3 }">
              3
            </div>
          </li>
        </ul>
      </div>

      <!-- Step 1 -->
      <div class="form-container">
        <Step1 v-if="currentStep == 1" @nextStep="nextStep" />

        <!-- Step 2 -->
        <div class="step-view" v-show="currentStep == 2">
          <div>
            <label
              >Picture:
              <input
                type="file"
                id="pic"
                name="pic"
                accept="image/png, image/jpeg"
              />
            </label>
            <label
              >Phone:
              <input
                type="tel"
                v-model="phone"
                id="phone"
                name="phone"
                pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
              />
            </label>
          </div>
          <div>
            <label
              >Description:
              <textarea
                id="description"
                v-model="description"
                name="description"
              ></textarea>
            </label>
          </div>
          <div>
            <button class="btn" @click="currentStep--">Previous step</button>
            <button class="btn" @click="currentStep++">Next step</button>
          </div>
        </div>

        <!-- Step 3 -->
        <div class="step-view" v-show="currentStep == 3">
          <div>
            <label
              >Curriculum:
              <input type="file" name="curriculum" accept="application/pdf" />
            </label>
          </div>
          <div>
            <button class="btn" @click="currentStep--">Previous step</button>
            <button class="btn" @click="signupRequest">Signup</button>
          </div>
        </div>
      </div>
    </div>
  </v-main>
</template>

<script>
import Step1 from "../components/SignUp/Step1.vue";
import useVuelidate from "@vuelidate/core";
import {
  required,
  email,
  maxLength,
  minLength,
  sameAs,
  helpers,
} from "@vuelidate/validators";

const isEmailTaken = (value) => {
  if (value != "asd@asd.asd" || value === "") return true;
  return false;
}; //fetch(`/api/unique/${value}`).then(r => r.json()) check the email in the server

export default {
  components: {
    Step1,
  },
  setup: () => ({ v$: useVuelidate() }),
  data() {
    return {
      currentStep: 1,
      inputData: {},
    };
  },
  validations() {
    return {
      name: {
        required,
        maxLength: maxLength(30),
      },
      surname: {
        required,
        maxLength: maxLength(30),
      },
      email: {
        required,
        email,
        maxLength: maxLength(30),
        isUnique: helpers.withMessage(
          "This email is already taken",
          helpers.withAsync(isEmailTaken)
        ),
      },
      address: {
        required,
        minLength: minLength(5),
        maxLength: maxLength(30),
      },
      password: {
        required,
        minLength: minLength(6),
      },
      confirmPassword: {
        required,
        sameAs: sameAs(this.password),
      },
    };
  },
  methods: {
    signupRequest() {
      // AXIOS REQUEST
    },
    nextStep(inputData) {
      this.currentStep++;
      this.inputData = { ...this.inputData, ...inputData };
      console.log(this.inputData);
    },
    previousStep() {
      this.currentStep--;
    },
  },
};
</script>

<style scoped>
.inner {
  width: 70%;
  margin: 0 auto;
  gap: 70px;
  color: #00234b;
  font-family: "Anek Latin", sans-serif;
}
.stepper-container {
  width: 100%;
}

.error-message {
  height: 2rem;
  color: #ff6372;
  width: 100%;
}

.stepper-container ul {
  display: flex;
  list-style: none;
  justify-content: space-between;
  align-items: center;
  margin: 0;
  padding: 0;
}

.step-circle {
  width: 50px;
  height: 50px;
  border-radius: 30px;
  color: #00234b;
  border: 3px solid #00234b;
  font-size: 1.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
}

.step-circle.active {
  background-color: #00234b;
  color: white;
}

.form-container {
  padding: 40px 0;
}

.form-container .step-view {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 30px;
}

.form-container .step-view div {
  display: flex;
  gap: 40px;
}

.line {
  width: 100%;
  height: 2px;
  background-color: #f3f3f4;
  margin: 0 15px;
}

label {
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}

input[type="text"],
textarea,
input[type="password"],
input[type="tel"] {
  border: 1px solid #e1e1e4;
  background-color: white;
  margin-top: 5px;
}

.message-box textarea {
  height: 100px;
  resize: none;
}

.btn {
  width: 100%;
  padding-top: 10px;
  padding-bottom: 10px;
  font-size: 1.3rem;
  color: #00234b;
  background-color: #fde721;
}

.btn[disabled] {
  background-color: lightgrey;
}

.btn.outlined {
  background-color: transparent;
  border: 2px solid #00234b;
}

.btn:hover {
  color: white;
  background-color: #00234b;
}

.btn.outlined:hover {
  border: 2px solid #00234b;
}

@media screen and (max-width: 600px) {
  .inner {
    width: 100%;
    padding: 30px;
  }

  .form-container .step-view div {
    flex-direction: column;
    gap: 15px;
  }
}
</style>
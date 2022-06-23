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
      <step-1 v-show="currentStep == 1" @nextStep="nextStep"/>
      <step-2 v-show="currentStep == 2" @nextStep="nextStep"  @previousStep="previousStep"/>
      <step-3 v-show="currentStep == 3" @nextStep="nextStep"  @previousStep="previousStep"/>
    </div>
  </v-main>
</template>

<script>
import Step1 from "../components/SignUp/Step1.vue";
import Step2 from "../components/SignUp/Step2.vue";
import Step3 from '../components/SignUp/Step3.vue';
import useVuelidate from "@vuelidate/core";

export default {
  components: {
    Step1,
    Step2,
    Step3,
  },
  setup: () => ({ v$: useVuelidate() }),
  data() {
    return {
      currentStep: 1,
      inputData: {},
    };
  },
  methods: {
    signupRequest() {
      let userData = {
        name: this.inputData.name,
        email: this.inputData.email,
        password: this.inputData.password,
        password_confirmation: this.inputData.confirmPassword
      }
      
        axios.post("/api/register", userData).then(res => {
          console.log(res)
          localStorage.setItem("auth", true);
          window.location = "/";
        })
        
    },
    nextStep(inputData) {
      this.inputData = { ...this.inputData, ...inputData };
      if(this.currentStep == 3) {
        this.signupRequest()
      }else{
        this.currentStep++;
      }
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

.line {
  width: 100%;
  height: 2px;
  background-color: #f3f3f4;
  margin: 0 15px;
}

input[type="text"],
textarea,
input[type="password"],
input[type="tel"],
input[type="email"] {
  border: 1px solid #e1e1e4;
  background-color: white;
  margin-top: 5px;
  width: 100%;
}

@media screen and (max-width: 600px) {
  .inner {
    width: 100%;
    padding: 30px;
  }

  .input-group {
    flex-direction: column;
  }

  .input-elements {
    width: 100%;
  }
}
</style>
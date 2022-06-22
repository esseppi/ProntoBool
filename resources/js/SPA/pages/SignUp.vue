<template>
  <v-main>
    <div class="inner">
      <div class="stepper-container">
        <ul>
          <li>
            <div class="step-circle" :class="{ active: currentStep == 1 }">1</div>
          </li>
          <li class="line"></li>
          <li>
            <div class="step-circle" :class="{ active: currentStep == 2 }">2</div>
          </li>
          <li class="line"></li>
          <li>
            <div class="step-circle" :class="{ active: currentStep == 3 }">3</div>
          </li>
        </ul>
      </div>

      <!-- Step 1 -->
      <div class="form-container">
        <div class="step-view" v-show="currentStep == 1">
          <div>
            <label
              >Name:
              <input id="name" v-model.trim="$v.name" name="name" type="text" />
              <p
  v-for="error of v$.name.$errors"
  :key="error.$uid"
>
              <div v-if="!v$.name.$error" :class="{'is-invalid': true }">This field is required.</div>
            </label>

            <label
              >Surname:
              <input id="surname" v-model="surname" name="surname" type="text"/>
              <div class="error-message">{{ inputErrors.surname }}</div>
            </label>
          </div>
          <div>
            <label
              >Email:
              <input type="text" v-model="email" id="email" name="email" />
              <div class="error-message">{{ inputErrors.email }}</div>
            </label>
            <label
              >Address:
              <input id="address" v-model="address" name="address" type="text"/>
              <div class="error-message">{{ inputErrors.address }}</div>
            </label>
          </div>
          <div>
            <label
              >Password:
              <input id="password" v-model="password" name="password" type="password"/>
              <div class="error-message">{{ inputErrors.password }}</div>
            </label>
            <label
              >Confirm Password:
              <input id="confirmPassword" v-model="confirmPassword" name="confirmPassword" type="password"/>
              <div class="error-message">{{ inputErrors.confirmPassword }}</div>
            </label>
          </div>
          <div>
            <button class="btn" @click="currentStep++">Next step</button>
          </div>
        </div>

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
import useValidate from '@vuelidate/core'
import { required, email, maxLength, minLength} from '@vuelidate/validators'
export default {
  setup: () => ({ v$: useVuelidate() }),
  data() {
    return {
      currentStep: 1,
        name: "",
        surname: "",
        email: "",
        address: "",
        password: "",
        confirmPassword: "",
        phone: "",
        description: "",
        pic: "",
        curriculum: "",
        phone: "",
        description: "",
    };
  },
  validations() {
    return {
      name: {
        required,
        minLength: minLength(2),
      }
    }
  },
  methods: {
  },
    signupRequest() {
      // AXIOS REQUEST
    },
}
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
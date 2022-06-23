<template>
  <div class="step-view">
    <div>
      <label
        >Name:
        <input
          id="name"
          v-model.trim="inputData.name"
          @blur="v$.inputData.name.$touch()"
          name="name"
          type="text"
        />
        <div class="error-message">
          <span v-for="error of v$.inputData.name.$errors" :key="error.$uid">
            {{ error.$message }}
          </span>
        </div>
      </label>

      <label
        >Surname:
        <input
          id="surname"
          v-model="inputData.surname"
          @blur="v$.inputData.surname.$touch()"
          name="surname"
          type="text"
        />
        <div class="error-message">
          <span v-for="error of v$.inputData.surname.$errors" :key="error.$uid">
            {{ error.$message }}
          </span>
        </div>
      </label>
    </div>
    <div>
      <label
        >Email:
        <input
          type="text"
          v-model="inputData.email"
          id="email"
          @blur="v$.inputData.email.$touch()"
          name="email"
        />
        <div class="error-message">
          <span v-for="error of v$.inputData.email.$errors" :key="error.$uid">
            {{ error.$message }}
          </span>
        </div>
      </label>
      <label
        >Address:
        <input
          id="address"
          v-model="inputData.address"
          name="address"
          @blur="v$.inputData.address.$touch()"
          type="text"
        />
        <div class="error-message">
          <span v-for="error of v$.inputData.address.$errors" :key="error.$uid">
            {{ error.$message }}
          </span>
        </div>
      </label>
    </div>
    <div>
      <label
        >Password:
        <input
          id="password"
          v-model="inputData.password"
          name="password"
          @blur="v$.inputData.password.$touch()"
          type="password"
        />
        <div class="error-message">
          <span
            v-for="error of v$.inputData.password.$errors"
            :key="error.$uid"
          >
            {{ error.$message }}
          </span>
        </div>
      </label>
      <label
        >Confirm Password:
        <input
          id="confirmPassword"
          v-model="inputData.confirmPassword"
          @blur="v$.inputData.confirmPassword.$touch()"
          name="confirmPassword"
          type="password"
        />
        <div class="error-message">
          <span
            v-for="error of v$.inputData.confirmPassword.$errors"
            :key="error.$uid"
          >
            {{ error.$message }}
          </span>
        </div>
      </label>
    </div>
    <div>
      <button
        class="btn"
        :disabled="!(!v$.$error && v$.$dirty)"
        @click="$emit('nextStep', inputData)"
      >
        Next step
      </button>
    </div>
  </div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import {
  required,
  email,
  maxLength,
  minLength,
  sameAs,
  helpers,
} from "@vuelidate/validators";

function isUnique(value){
    console.log(value)
    return axios.get(`/api/unique`,{ params: { email: value } }).then(r => {
        return r.data.isUnique
        })
}

//fetch(`/api/unique/${value}`).then(r => r.json()) check the email in the server

export default {
  setup: () => ({ v$: useVuelidate() }),
  data() {
    return {
      inputData: {
        name: "",
        surname: "",
        email: "",
        address: "",
        password: "",
        confirmPassword: "",
      },
    };
  },
  validations() {
    return {
      inputData: {
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
            helpers.withAsync(isUnique)
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
          sameAs: sameAs(this.inputData.password),
        },
      },
    };
  },
  methods: {
    iEmailTaken(value){
        axios.get("/api/istaken",{ params: { email: value } }).then( res => {
            console.log(res.data.isTaken);
            return res.data.isTaken;
        })
    },
  }
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
<template>
  <div class="form-container">
    <div class="input-group">
      <div class="input-elements">
        <label for="name">Name</label>
        <input
          v-model="inputData.name"
          @blur="v$.inputData.name.$touch()"
          name="name"
          type="text"
        />
        <div class="error-message">
          <span v-for="error of v$.inputData.name.$errors" :key="error.$uid">
            {{ error.$message }}
          </span>
        </div>
      </div>
      <div class="input-elements">
        <label for="surname">Surname</label>
        <input
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
      </div>
    </div>
    <div class="input-group">
      <div class="input-elements">
        <label for="email">Email</label>
        <input
          v-model="inputData.email"
          @blur="v$.inputData.email.$touch()"
          name="email"
          type="email"
        />
        <div class="error-message">
          <span v-for="error of v$.inputData.email.$errors" :key="error.$uid">
            {{ error.$message }}
          </span>
        </div>
      </div>
      <div class="input-elements">
        <label for="address">City</label>
        <select
          v-model="inputData.address"
          @blur="v$.inputData.address.$touch()"
          name="address"
          type="text"
        >
        <option value=""> Select a city
        </option>
        <option v-for="item in locations" value="item.address" v:key="item.address"> {{ item.address}}
        </option>
        </select>
        <div class="error-message">
          <span v-for="error of v$.inputData.address.$errors" :key="error.$uid">
            {{ error.$message }}
          </span>
        </div>
      </div>
    </div>
    <div class="input-group">
      <div class="input-elements">
        <label for="password">Password</label>
        <input
          v-model="inputData.password"
          @blur="v$.inputData.password.$touch()"
          name="password"
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
      </div>
      <div class="input-elements">
        <label for="confirmPassword">Confirm Password</label>
        <input
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
      </div>
    </div>
    <div class="input-group">
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


export default {
  name: "Step1",
  setup: () => ({ v$: useVuelidate() }),
  data() {
    return {
      locations: null,
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
            helpers.withAsync(this.isUnique)
          ),
        },
        address: {
          required,
          maxLength: maxLength(30),
        },
        password: {
          required,
          minLength: minLength(8),
        },
        confirmPassword: {
          required,
          sameAs: sameAs(this.inputData.password),
        },
      },
    };
  },
  mounted(){
    axios.get("/api/getlocations").then(res => {
      console.log(res.data)
      this.locations = res.data.data;
    });
  },
  methods: {
    isUnique(value) {
    return axios
        .get("/api/unique", { params: { email: value } })
        .then((r) => {
          return r.data.isUnique;
        });
    },
  },
};
</script>

<style scoped>
.error-message {
  height: 2rem;
  color: #ff6372;
  width: 100%;
  word-break: break-all;
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

.form-container {
  width: 100%;
  padding: 40px 0;
}

.input-group {
  width: 100%;
  display: flex;
  gap: 20px;
}

.input-elements {
  width: 50%;
}

label {
  display: block;
}

input[type="text"],
textarea,
input[type="password"],
input[type="tel"],
input[type="email"],
select{
  border: 1px solid #e1e1e4;
  background-color: white;
  margin-top: 5px;
  width: 100%;
}
@media screen and (max-width: 600px) {
  .input-group {
    flex-direction: column;
  }

  .input-elements {
    width: 100%;
  }
}
</style>
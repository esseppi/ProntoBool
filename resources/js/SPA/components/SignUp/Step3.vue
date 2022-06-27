<template>
  <div class="form-container">
    <div class="input-group">
      <div class="input-elements">
        <label for="curriculum">Curriculum</label>
        <input v-on:change="onFileChange" type="file" name="curriculum" accept="application/pdf" />
        <!-- <div class="error-message">
          <span v-for="error of v$.inputData.curriculum.$errors" :key="error.$uid">
            {{ error.$message }}
          </span>
        </div> -->
      </div>
    </div>
    <div class="input-group">
      <div class="input-elements">
        <button class="btn" @click="$emit('previousStep')">
          Previous step
        </button>
      </div>
      <div class="input-elements">
        <button class="btn" @click="$emit('nextStep', inputData)">
          <!-- :disabled="!(!v$.$error && v$.$dirty)" --->

          Submit
        </button>
      </div>
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

function isUnique(value) {
  console.log(value);
  return axios.get(`/api/unique`, { params: { email: value } }).then((r) => {
    return r.data.isUnique;
  });
}


export default {
  name: "Step3",

  setup: () => ({ v$: useVuelidate() }),
  data() {
    return {
      inputData: {
        curriculum: null
      },
    };
  },
  methods: {
    onFileChange(e) {
      this.inputData.curriculum = e.target.files[0];
    },
  },
}
  // validations() {
  //   return {
  //     inputData: {
  //       cv: {
  //         required,
  //       },
  //     },
  //   };
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
input[type="email"] {
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
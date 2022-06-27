<template>
  <div class="form-container">
    <div class="input-group">
      <div class="input-elements">
        <!-- image v-model="inputData.pic"  -->
        <label for="pic">Picture</label>
        <input type="file" id="pic" name="pic" v-on:change="onFileChange" accept="image/png, image/jpeg" />
        <!-- <div class="error-message">
          <span v-for="error of v$.inputData.pic.$errors" :key="error.$uid">
            {{ error.$message }}
          </span> 
        </div> -->
      </div>

      <!-- phone -->
      <div class="input-elements">
        <label for="phone">Phone</label>
        <input v-model="inputData.phone" @blur="v$.inputData.phone.$touch()" name="phone" type="text" />
        <div class="error-message">
          <span v-for="error of v$.inputData.phone.$errors" :key="error.$uid">
            {{ error.$message }}
          </span>
        </div>
      </div>
    </div>

    <!-- description -->
    <div class="input-group">
      <div class="input-elements">
        <label for="description">Description</label>
        <textarea v-model="inputData.description" @blur="v$.inputData.description.$touch()" name="description"
          type="description">
        </textarea>
        <div class="error-message">
          <span v-for="error of v$.inputData.description.$errors" :key="error.$uid">
            {{ error.$message }}
          </span>
        </div>
      </div>
    </div>
    <div class="input-group">
      <div class="input-elements">
        <button class="btn" @click="$emit('previousStep')">
          Previous step
        </button>
      </div>
      <div class="input-elements">
        <button class="btn" :disabled="!(!v$.$error && v$.$dirty)" @click="$emit('nextStep', inputData)">
          Next step
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import { required, maxLength, minLength, numeric } from "@vuelidate/validators";

export default {
  name: "Step2",
  setup: () => ({ v$: useVuelidate() }),
  data() {
    return {
      inputData: {
        phone: "",
        description: "",
        pic: "",
      },
    };
  },
  validations() {
    return {
      inputData: {
        phone: {
          required,
          minLength: minLength(5),
          numeric,
          maxLength: maxLength(30),
        },
        description: {
          required,
          maxLength: maxLength(30),
        },
      },
    };
  },
  methods: {
    onFileChange(e) {
      this.inputData.pic = e.target.files[0];
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
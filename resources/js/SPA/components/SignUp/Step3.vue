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
      <div class="input-elements">
        <div class="professions-selector">
        <label for="curriculum">Professions (Max 3)</label>
        <div>
          <select v-model="selectedProfession"
          @blur=""
          name="professione"
          >
          <option value="">Select a profession</option>
          <option v-for="item in professions" :value="item" v:key="item.id"> {{ item.name}}
          </option>
        </select>
        <button @click="addProfession" class="btn outlined">+</button>
        </div>
        
        <div class="professions-box">
          <span v-for="item of inputData.professions" class="prof" :key="item.id">
            {{ item.name }}
            <div @click="professionDel(item.id)" class="del">x</div>
          </span>
        </div>
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
        <button class="btn" @click="$emit('nextStep', inputData)">
          <!-- :disabled="!(!v$.$error && v$.$dirty)" -->

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
      professions : [],
      selectedProfession: "",
      inputData: {
        curriculum: null,
        professions: [],
      },
    };
  },
  methods: {
    onFileChange(e) {
      this.inputData.curriculum = e.target.files[0];
    },
    addProfession(){
      if(this.inputData.professions.length < 3){
        this.inputData.professions.push(this.selectedProfession);
        this.professions = this.professions.filter(item => item.id !== this.selectedProfession.id);
      }
    },
    professionDel(id){
      this.inputData.professions = this.inputData.professions.filter(item => item.id !== id);
    }
  },
  mounted(){
    axios.get("/api/getprofessions").then(res => {
      console.log(res.data)
      this.professions = res.data.data;
    });
  },
  validations() {
    return {
      inputData: {
        professions: {
          required,
        },
      },
    };
  }
}

</script>

<style scoped>

.professions-box{
  height: 100px;
}
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
  color: #00234b;
  border: 1px solid #00234b;
  padding: 0;

  margin-left: 4px;
  width: 45px;
  height: 40px;
}

.prof{
  padding: 15px;
  display: inline-block;
  padding-right: 27px;
  background-color: #00234b;
  color: white;
  margin-right: 5px;
  border-radius: 2rem;
  font-size: 0.7rem;
  position: relative
}
.prof .del{
  position: absolute;
  right: 13px;
  top: 50%;
  font-weight: 600;
  transform: translateY(-50%);
  cursor: pointer;
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

.professions-selector{
  display: flex;
  flex-direction: column;
}

.professions-selector > div{
  display: flex;
  flex-direction: row;
  align-items: center;
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
<template>
  <div class="inner">
    <!-- Profile -->
    <div class="input-group">
      <div class="input-elements">
        <label for="name">Name:</label>
        <input
          v-model="profileInfo.name"
          @blur="v$.profileInfo.name.$touch()"
          name="name"
          type="text"
        />
        <div class="error-message">
          <span v-for="error of v$.profileInfo.name.$errors" :key="error.$uid">
            {{ error.$message }}
          </span>
        </div>
      </div>
      <div class="input-elements">
        <label for="address">Address:</label>
        <input
          v-model="profileInfo.address"
          @blur="v$.profileInfo.address.$touch()"
          name="address"
          type="text"
        />
        <div class="error-message">
          <span
            v-for="error of v$.profileInfo.address.$errors"
            :key="error.$uid"
          >
            {{ error.$message }}
          </span>
        </div>
      </div>
    </div>

    <div class="input-group">
      <div class="input-elements">
        <label for="email">Email:</label>
        <input
          v-model="profileInfo.email"
          @blur="v$.profileInfo.email.$touch()"
          name="email"
          type="email"
        />
        <div class="error-message">
          <span v-for="error of v$.profileInfo.email.$errors" :key="error.$uid">
            {{ error.$message }}
          </span>
        </div>
      </div>
      <div class="input-elements">
        <label for="phone">Phone:</label>
        <input
          v-model="profileInfo.phone"
          @blur="v$.profileInfo.phone.$touch()"
          name="phone"
          type="text"
        />
        <div class="error-message">
          <span v-for="error of v$.profileInfo.phone.$errors" :key="error.$uid">
            {{ error.$message }}
          </span>
        </div>
      </div>
    </div>

    <div class="input-group">
      <div class="input-elements">
        <label for="description">Description</label>
        <textarea
          v-model="profileInfo.description"
          @blur="v$.profileInfo.description.$touch()"
          name="description"
          type="description"
        >
        </textarea>
        <div class="error-message">
          <span
            v-for="error of v$.profileInfo.description.$errors"
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
        :disabled="v$.profileInfo.$invalid"
        @click="editProfile"
      >
        Edit profile
      </button>
    </div>
  </div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import {
  required,
  email,
  numeric,
  maxLength,
  minLength,
  helpers,
} from "@vuelidate/validators";
export default {
  name: "EditProfile",
  setup: () => ({ v$: useVuelidate() }),

  data() {
    return {
      profileInfo: {
        name: null,
        email: null,
        phone: null,
        address: null,
        professions: null,
        description: null,
        image: null,
        curriculum: null,
      },
      originalInfo: {},
    };
  },
  validations() {
    return {
      profileInfo: {
        name: {
          required,
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
        phone: {
          required,
          minLength: minLength(5),
          numeric,
          maxLength: maxLength(30),
        },
        description: {
          required,
          maxLength: maxLength(255),
        },
      },
    };
  },
  mounted() {
    if (localStorage.getItem("auth")) {
      axios.get("/api/user").then((res) => {
        this.profileInfo = res.data;
        this.originalInfo = res.data;
        axios.get(`api/profile/${this.profileInfo.id}`).then((res) => {
          this.profileInfo = { ...this.profileInfo, ...res.data.response };
          this.originalInfo = { ...this.originalInfo, ...res.data.response };
        });
      });
    }
    this.v$.profileInfo.$touch();
  },
  methods: {
    isUnique(value) {
      if (this.profileInfo.email.trim() == this.originalInfo.email.trim()) {
        return true;
      } else {
        return axios
          .get("/api/unique", { params: { email: value } })
          .then((r) => {
            return r.data.isUnique;
          });
      }
    },
    editProfile() {
      axios
        .post(`api/profile/${this.profileInfo.id}/update`, this.profileInfo)
        .then((res) => {
          console.log(res);
        });
      axios
        .post(`api/user/${this.profileInfo.id}/update`, this.profileInfo)
        .then((res) => {
          console.log(res);
        });
    },
  },
};
</script>

<style scoped>
.inner {
  width: 70%;
  margin: 0 auto;
  gap: 70px;
  padding: 40px 0 40px 0;
  color: #00234b;
  font-family: "Anek Latin", sans-serif;
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
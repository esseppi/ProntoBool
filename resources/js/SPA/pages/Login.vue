<template>
  <v-main>
		<div class="inner">
		
			<!-- email -->
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

			<!-- password -->
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

			<!-- button login -->
			<div class="input-group">
				<button
					class="btn"
					:disabled="!(!v$.$error && v$.$dirty)"
					@click="tryLogin"
				>
					Login
				</button>
                <div class="error-message">
                    <span v-if="error"> {{ error }}</span>
                </div>
			</div>
      <p>Non hai un account? <a @click.prevent="toSignup">Registrati ora</a>.</p>
		</div>
  </v-main>
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
  setup: () => ({ v$: useVuelidate() }),
  name: "Login",
  components: {
    
  },
  data(){
    return {
			inputData:{
				email: "",
				password: ""
			},
			error: "",
    }
  },
  validations() {
    return {
      inputData: {
        email: {
          required,
          email
        },
        password: {
          required
        },
      },
    };
  },
  methods : {
    tryLogin(){
			let userData = {
				email: this.inputData.email,
				password: this.inputData.password,
				remember: true
      }
			
			axios.post("/api/login", userData)
			.then(() => {
				localStorage.setItem("auth", true);
				window.location = "/home";
			})
			.catch((error) => {
				this.error = "Credenziali errate.";
			});
    },
    toSignup(){
      this.$router.push({ path: "/signup" });
    }
  }
};
</script>

<style scoped>
.inner {
  width: 30%;
  margin: 0 auto;
  gap: 70px;
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

.input-elements {
  width: 100%;
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

@media screen and (max-width: 800px) {

  .inner {
    width: 70%;
    padding: 40px;
  }
}

@media screen and (max-width: 450px) {

  .inner {
    width: 100%;
    padding: 40px;
  }
}
</style>
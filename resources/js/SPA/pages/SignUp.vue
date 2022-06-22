<template>
  <v-main>
    <div class="inner">
      <div class="stepper-container">
        <ul>
          <li><div class="step-circle" :class="{ active: currentStep == 1 }">1</div></li>
          <li class="line"></li>
          <li><div class="step-circle" :class="{ active: currentStep == 2 }">2</div></li>
          <li class="line"></li>
          <li><div class="step-circle" :class="{ active: currentStep == 3 }">3</div></li>
        </ul>
      </div>
      <div class="form-container">
        <form>
          <div>
            <label>Name:
              <input id="name" name="name" type="text" />
            </label>

            <label>Surname:
              <input id="Surname" name="Surname" type="text" />
            </label>
					
          </div>
					<div>
            <label>Email:
              <input id="email" name="email" type="text" />
            </label>
            <label>Address:
              <input id="email" name="address" type="text" />
            </label>
					</div>
          <div>
            <label>Password:
              <input id="password" name="password" type="password" />
            </label>

            <label>Confirm Password:
              <input id="password" name="password" type="password" />
            </label>
          </div>
          <input class="btn" type="submit" value="Confirm user" />
        </form>
      </div>
    </div>
  </v-main>
</template>

<script>
export default {
  data() {
    return {
      currentStep: 1,
    };
  },
};
</script>

<style scoped>
.inner {
  width: 90%;
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

.form-container {
  padding: 40px 0;
}

.form-container form {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 30px;
}

.form-container form div {
  display: flex;
  gap: 40px;
}

.line {
  width: 100%;
  height: 2px;
  background-color: #f3f3f4;
  margin: 0 15px;
}

label{
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}

input[type="text"],
textarea,
input[type="password"] {
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
</style>
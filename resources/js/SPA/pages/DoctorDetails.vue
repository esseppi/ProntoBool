<template>
  <div>
    <!-- pop up review -->
    <div v-if="showModal" class="backdrop">
      <div v-if="showModal" class="modal">
        <button @click="showModal = false" class="close">x</button>
        <div>
          <label>Name:
            <input id="name" v-model="reviewData.name" @blur="v$.reviewData.name.$touch()" name="name" type="text" />
          </label>
          <div class="error-message">
            <span v-for="error of v$.reviewData.name.$errors" :key="error.$uid">
              {{ error.$message }}
            </span>
          </div>
        </div>

        <div>
          <label>Email:
            <input id="email" v-model="reviewData.email" @blur="v$.reviewData.email.$touch()" name="email"
              type="text" />
          </label>
          <div class="error-message">
            <span v-for="error of v$.reviewData.email.$errors" :key="error.$uid">
              {{ error.$message }}
            </span>
          </div>
        </div>

        <div>
          <label>Vote:
            <select name="vote" v-model="reviewData.vote" @blur="v$.reviewData.vote.$touch()" id="vote">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <div class="error-message">
              <span v-for="error of v$.reviewData.vote.$errors" :key="error.$uid">
                {{ error.$message }}
              </span>
            </div>
          </label>
        </div>

        <div>
          <label>Review text:
            <textarea id="message" v-model="reviewData.message" @blur="v$.reviewData.message.$touch()"
              name="message"></textarea>
          </label>
          <div class="error-message">
            <span v-for="error of v$.reviewData.message.$errors" :key="error.$uid">
              {{ error.$message }}
            </span>
          </div>
        </div>

        <button class="btn" :disabled="!(!v$.reviewData.$error && v$.reviewData.$dirty)" @click="sendReview"
          type="submit">
          Send Review
        </button>
      </div>
    </div>

    <!-- STAR PAGE PROFILE -->
    <v-main>
      <div class="inner">
        <div class="profile-data">
          <!-- PROFILE -->
          <section>
            <div class="prof-flex">
              <div class="profile-image">
                <img :src="profileData.pic" :alt="userData.name" />
              </div>
              <div class="data-flex">
                <div class="profile-info">
                  <h1 class="profile-name">{{ userData.name }}</h1>
                  <p class="profile-address">{{ profileData.address }}</p>
                  <div class="badge-container">
                    <span class="badge" v-for="(item, index) in profileData.professions" :key="index">{{ item }}</span>
                  </div>
                </div>
              </div>
            </div>
            <ul class="ul-info">
              <li><a href="#">About</a></li>
              <li><a href="#">Curriculum</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Reviews</a></li>
            </ul>
          </section>

          <!-- ABOUT -->
          <section>
            <h2>About {{ userData.name }}</h2>
            <p>{{ profileData.description }}</p>
          </section>

          <!-- CURRICULUM -->
          <section class="curriculum">
            <!--questa classe non è usata in questo css -->
            <h2>Curriculum Vitae</h2>
            <div class="card"></div>
          </section>

          <!-- REVIEWS -->
          <section>
            <h2>{{ profileReviews.length }} Reviews</h2>
            <div class="banner">
              <div class="icon-container">
                <v-icon class="icon">mdi-information-outline</v-icon>
              </div>
              <p>
                Your trust is our top concern, so providers can't pay to alter
                or remove reviews. We also don't publish reviews that contain
                any private information.
              </p>
            </div>
            <div class="reviews-top-container">
              <div class="">
                <h4>Overall rating</h4>
                <div class="vote">{{ this.vote.toFixed(2) }}</div>
              </div>
              <div class="">
                <button @click="showModal = true" class="btn">
                  Write a review
                </button>
              </div>
            </div>
            <div class="reviews-bottom-container">
              <div v-for="(item, index) in profileReviews.slice(0, reviewsShowed)" :key="index" class="review">
                <div class="star">
                  <ul>
                    <li v-for="ind in Math.floor(item.vote)" :key="'star-' + index + '-' + ind">
                      <v-icon class="star-color">mdi-star</v-icon>
                    </li>
                    <li v-for="ind in 5 - Math.floor(item.vote)" :key="'star-void-' + index + '-' + ind">
                      <v-icon class="star-color">mdi-star-outline</v-icon>
                    </li>
                  </ul>
                </div>
                <p>{{ item.message }}</p>
                <div class="reviews-info">
                  <span>{{ item.name }}</span> •
                  <span>{{
                      new Date(item.created_at).toLocaleDateString("en-US")
                  }}</span>
                </div>
              </div>
              <button @click="reviewsShowed += 5" v-if="reviewsShowed <= profileReviews.length" class="btn outlined">
                See more
              </button>
            </div>
          </section>
        </div>

        <!-- MAP 
            <section>
                <h2>Office location</h2>
                <div class="map-flex">
                    <div>
                        <div class="map-container">
                            <div id="map"><img src="https://www.tremplin-numerique.org/wp-content/uploads/2021/03/1615212209_265_Comment-changer-lechelle-de-Google-Maps-de-miles-en-kilometres.png" alt="ciao"></div>
                        </div>
                    </div>
                    <div>
                        <div class="map-info">
                            <p>{{ profileData.address }}</p>
                            <p>{{ profileData.phone }}</p>
                            <p>{{ profileData.email }}</p>
                        </div>
                    </div>
                </div>
            </section>
            -->

        <!-- SECTION BOX MESSAGE -->
        <section class="message-box">
          <h2>Book an appointment for free</h2>
          <form v-on:submit.prevent>
            <label>Name:
              <input v-model="messageData.name" @blur="v$.messageData.name.$touch()" id="name" name="name"
                type="text" />
              <div class="error-message">
                <span v-for="error of v$.messageData.name.$errors" :key="error.$uid">
                  {{ error.$message }}
                </span>
              </div>
            </label>

            <label>Email:
              <input v-model="messageData.email" @blur="v$.messageData.email.$touch()" id="email" name="email"
                type="text" />
              <div class="error-message">
                <span v-for="error of v$.messageData.email.$errors" :key="error.$uid">
                  {{ error.$message }}
                </span>
              </div>
            </label>

            <label>Phone:
              <input v-model="messageData.phone" @blur="v$.messageData.phone.$touch()" id="phone" name="phone"
                type="text" />
              <div class="error-message">
                <span v-for="error of v$.messageData.phone.$errors" :key="error.$uid">
                  {{ error.$message }}
                </span>
              </div>
            </label>

            <label>Message:
              <textarea v-model="messageData.message" @blur="v$.messageData.message.$touch()" id="message"
                name="message"></textarea>
              <div class="error-message">
                <span v-for="error of v$.messageData.message.$errors" :key="error.$uid">
                  {{ error.$message }}
                </span>
              </div>
            </label>

            <input class="btn" :disabled="!(!v$.messageData.$error && v$.messageData.$dirty)" @click="sendMessage" type="submit" value="Send message" />
          </form>
        </section>
      </div>
    </v-main>
  </div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import {
  required,
  email,
  maxLength,
  minLength,
  numeric,
  sameAs,
  helpers,
} from "@vuelidate/validators";

export default {
  name: "Home",
  setup: () => ({ v$: useVuelidate() }),
  data() {
    return {
      showModal: false,
      vote: 0,
      profile_id: "",
      profileData: {
        name: "Luigi Bardella Gerbi",
        professions: ["Tuttologo", "Programmatore", "Marketer"],
        address: "Corso Savona 160, Asti, 14100",
        pic: "https://images.unsplash.com/photo-1536104968055-4d61aa56f46a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1480&q=80",
        description:
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquam purus quis lectus iaculis, vitae vestibulum orci dictum. In iaculis ipsum scelerisque sapien consectetur tempus. Maecenas volutpat risus leo, quis hendrerit nibh pretium bibendum. Etiam sed tempus enim. Maecenas eu ipsum non tortor malesuada tristique. In iaculis ipsum scelerisque sapien consectetur tempus. Maecenas volutpat risus leo, quis hendrerit nibh pretium bibendum. Etiam sed tempus enim. Maecenas eu ipsum non tortor malesuada tristique. In iaculis ipsum scelerisque sapien consectetur tempus. Maecenas volutpat risus leo, quis hendrerit nibh pretium bibendum. Etiam sed tempus enim. Maecenas eu ipsum non tortor malesuada tristique. In iaculis ipsum scelerisque sapien consectetur tempus. Maecenas volutpat risus leo, quis hendrerit nibh pretium bibendum. Etiam sed tempus enim. Maecenas eu ipsum non tortor malesuada tristique. ",
        vote: 4.5,
        phone: "3412345678",
        email: "twotimesgi@gmail.com",
      },
      userData: {},
      profileReviews: [
        {
          name: "Marco",
          vote: 1,
          message:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          date: "12/12/2019",
        },
        {
          name: "Antonio",
          vote: 2.4,
          message:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          date: "20/1/2020",
        },
        {
          name: "Sara",
          vote: 5,
          message:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          date: "12/6/2021",
        },
        {
          name: "Lorena",
          vote: 3.3,
          message:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          date: "23/3/2019",
        },
        {
          name: "Marco",
          vote: 1,
          message:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          date: "12/12/2019",
        },
        {
          name: "Antonio",
          vote: 2.4,
          message:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          date: "20/1/2020",
        },
        {
          name: "Sara",
          vote: 5,
          message:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          date: "12/6/2021",
        },
        {
          name: "Lorena",
          vote: 3.3,
          message:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          date: "23/3/2019",
        },
        {
          name: "Marco",
          vote: 1,
          message:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          date: "12/12/2019",
        },
        {
          name: "Antonio",
          vote: 2.4,
          message:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          date: "20/1/2020",
        },
        {
          name: "Sara",
          vote: 5,
          message:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          date: "12/6/2021",
        },
        {
          name: "Lorena",
          vote: 3.3,
          message:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.",
          date: "23/3/2019",
        },
      ],
      reviewsShowed: 5,
      reviewData: {
        name: "",
        email: "",
        message: "",
        vote: "",
      },
      messageData: {
        name: "",
        email: "",
        message: "",
        phone: "",
      },
    };
  },
  mounted() {
    this.profile_id = this.$route.params.id;
    axios.get(`api/profile/${this.profile_id}`).then((res) => {
      this.profileData = res.data.response;
      axios.get(`api/user/${this.profile_id}`).then((res) => {
        this.userData = res.data.response;
      });
      axios.get(`api/reviews/${this.profile_id}`).then((res) => {
        this.profileReviews = res.data.response.reverse();
        console.log(this.profileReviews);
        this.getAvg();
      });
    });
  },
  validations() {
    return {
      reviewData: {
        name: {
          required,
          maxLength: maxLength(30),
        },
        email: {
          required,
          email,
          maxLength: maxLength(30),
        },
        vote: {
          required,
        },
        message: {
          required,
          minLength: minLength(8),
          maxLength: maxLength(255),
        },
      },
      messageData: {
        name: {
          required,
          maxLength: maxLength(30),
        },
        email: {
          required,
          email,
          maxLength: maxLength(30),
        },
        message: {
          required,
          minLength: minLength(8),
          maxLength: maxLength(255),
        },
        phone: {
          required,
          numeric,
          maxLength: maxLength(30),
        },
      },
    };
  },
  methods: {
    sendMessage(){
        let data = {
        profile_id: this.profile_id,
        name: this.messageData.name,
        email: this.messageData.email,
        phone: this.messageData.phone,
        message: this.messageData.message,
      };
      axios.post("/api/sendmessage", data).then((res) => {
        console.log(res);  
      });
      this.messageData = {
        name: "",
        email: "",
        message: "",
        phone: "",
      };
    },
    sendReview() {
      let data = {
        profile_id: this.profile_id,
        name: this.reviewData.name,
        email: this.reviewData.email,
        vote: this.reviewData.vote,
        message: this.reviewData.message,
      };
      axios.post("/api/sendreview", data).then((res) => {
        console.log(res);
        axios.get(`api/reviews/${this.profile_id}`).then((res) => {
          this.profileReviews = res.data.response.reverse();
          console.log(this.profileReviews);
          this.getAvg();
        });
      });
      this.showModal = false;
    },
    getAvg() {
      let sum = 0;
      this.profileReviews.forEach((element) => {
        sum = sum + element.vote;
      });
      sum != 0
        ? (this.vote = sum / this.profileReviews.length)
        : (this.vote = 0);
    },
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Anek+Latin:wght@200;300;500&display=swap");

/* PROFILE -------
    ------------------
    ------------------*/
.error-message {
  height: 2rem;
  color: #ff6372;
  width: 100%;
  word-break: break-all;
}

.close {
  position: absolute;
  top: 10px;
  right: 15px;
  color: #00234b;
  font-size: 20px;
}

.backdrop {
  background-color: rgba(0, 0, 0, 0.8);
  position: fixed;
  inset: 0;
  z-index: 9998;
}

.modal {
  width: 40%;
  background-color: white;
  z-index: 9998;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 40px;
}

.inner {
  width: 90%;
  margin: 0 auto;
  display: flex;
  gap: 70px;
  color: #00234b;
  font-family: "Anek Latin", sans-serif;
}

.profile-data {
  width: 60%;
  flex-basis: 60%;
}

.prof-flex {
  display: flex;
}

.profile-image {
  width: 150px;
  height: 150px;
  border-radius: 200px;
  overflow: hidden;
  flex-shrink: 0;
}

.profile-image img {
  width: 100%;
  height: 100%;
}

.data-flex {
  display: flex;
  align-items: center;
}

.profile-info {
  margin-left: 30px;
}

.profile-name {
  font-size: 40px;
  font-weight: bold;
}

.profile-address {
  font-size: 18px;
  color: #a1a1a1;
}

.badge {
  border-radius: 1rem;
  padding: 5px 20px;
  background-color: #f7f8f9;
}

.badge-container {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}

.ul-info {
  padding: 0;
  list-style: none;
  display: flex;
  gap: 25px;
  margin-top: 25px;
  border-top: #e1e1e4 solid 1px;
  border-bottom: #e1e1e4 solid 1px;
  height: 70px;
  line-height: 70px;
}

.ul-info li {
  height: 100%;
  border-bottom: 3px solid transparent;
  vertical-align: middle;
}

.ul-info>li>a {
  font-size: 1.3rem;
  font-weight: 400;
  color: #00234b;
}

.ul-info li:hover {
  border-bottom: 3px solid #00234b;
}

/* CURRICULUM --------
    ----------------------
    ----------------------*/

.card {
  width: 190px;
  height: 254px;
  background: rgb(255, 255, 255);
  border-radius: 0.4em;
  transition: border 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  border: #e1e1e4 0.2em solid;
}

.card:hover {
  border: #00234b 0.2em solid;
}

/*REVIEW--------
    ----------------
    ----------------*/
.banner {
  width: 100%;
  padding: 10px 20px;
  background-color: #f3f3f4;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
}

.banner p {
  margin: 0;
}

.icon-container {
  padding: 15px 15px;
  display: flex;
}

.btn[disabled] {
  background-color: lightgrey;
}

.icon {
  color: #00234b;
  justify-content: center;
  align-items: center;
}

.reviews-top-container {
  display: flex;
  width: 100%;
}

.reviews-top-container div {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 50%;
  padding: 0 30px;
}

.reviews-top-container div:first-child {
  border-right: 1px solid #e1e1e4;
}

.vote {
  font-size: 5rem;
  margin-top: -30px;
}

.reviews-bottom-container {
  border-top: 1px solid #e1e1e4;
  display: flex;
  flex-direction: column;
  gap: 35px;
  padding-top: 20px;
}

.star ul li {
  display: inline-block;
}

.star ul {
  padding: 0;
  margin-bottom: 5px;
}

.star-color {
  color: #ff6372;
}

.reviews-info {
  font-size: 0.9rem;
  color: #a1a1a1;
}

.review {
  width: 100%;
}

.review>p {
  margin-bottom: 5px;
}

/* BOX MESSAGES -------
    -----------------------
    -----------------------*/
.message-box {
  width: 40%;
  background-color: #f7f8f9;
  border: 1px solid #e1e1e4;
  padding: 20px;
  align-self: flex-start;
}

.message-box form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

/* GENERICI-------
    ------------------
    ------------------*/

section {
  padding: 0 0 30px 0;
}

h2 {
  font-size: 1.8rem;
  font-weight: bold;
  margin-bottom: 20px;
}

h3 {
  font-size: 1.5rem;
  font-weight: bold;
  margin-bottom: 20px;
}

h4 {
  font-size: 1.5rem;
}

input[type="text"],
select,
textarea {
  width: 100%;
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

.map-flex {
  display: flex;
  gap: 25px;
}

@media screen and (max-width: 950px) {
  .inner {
    width: 100%;
    flex-direction: column;
    padding: 30px;
  }

  .message-box {
    width: 100%;
  }

  .profile-data {
    width: 100%;
  }

  .prof-flex {
    flex-direction: column;
    align-content: center;
  }

  .profile-image {
    margin-bottom: 20px;
    align-self: center;
  }

  .ul-info {
    overflow-x: scroll;
    overflow-y: hidden;
  }

  .data-flex {
    flex-direction: column;
    text-align: center;
    align-content: center;
  }

  .profile-info {
    margin-left: 0px;
  }

  .btn {
    font-size: 1.3rem;
  }

  .badge-container {
    justify-content: center;
  }
}
</style>
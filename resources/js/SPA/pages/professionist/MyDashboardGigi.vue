<template>
  <v-main>
    <div class="inner">
      <div class="profile-data">
        <!-- PROFILE -->
        <section>
          <div class="prof-flex">
            <div class="profile-image">
              <img :src="profileData.pic" :alt="profileData.name" />
            </div>
            <div class="data-flex">
              <div class="profile-info">
                <h1 class="profile-name">{{ profileData.name }}</h1>
                <p class="profile-address">{{ profileData.address }}</p>
                <div class="badge-container">
                  <span
                    class="badge"
                    v-for="(item, index) in profileData.professions"
                    :key="index"
                    >{{ item }}</span
                  >
                </div>
              </div>
            </div>
          </div>
          <ul class="ul-info">
            <li><a href="#">Reviews</a></li>
            <li><a href="#">sponsorship</a></li>
            <li><a href="#">Messages </a></li>
            <li><a href="#">Edit profile</a></li>
          </ul>
        </section>

        <!-- ABOUT  -->
        <section>
          <h2>About {{ profileData.name }}</h2>
          <p>{{ profileData.description }}</p>
        </section>

        <!-- CURRICULUM 
                <section class="curriculum">
                    <div class=""></div>
                    <h2>Curriculum Vitae</h2>
                </section>
                -->

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

        <!-- REVIEWS -->
        <section>
          <h2>Reviews</h2>
          <div class="banner">
            <div class="icon-container">
              <v-icon class="icon">mdi-information-outline</v-icon>
            </div>
            <p>
              Your trust is our top concern, so providers can't pay to alter or
              remove reviews. We also don't publish reviews that contain any
              private information.
            </p>
          </div>
          <div class="reviews-top-container">
            <h4>Overall rating</h4>
            <div class="vote">{{ profileData.vote }}</div>
          </div>
          <div class="reviews-bottom-container">
            <div class="filter-bar">
              <span>{{ profileReviews.length }} Reviews</span>
            </div>
            <div
              v-for="(item, index) in profileReviews.slice(0, reviewsShowed)"
              :key="index"
              class="review"
            >
              <div class="star">
                <ul>
                  <li
                    v-for="ind in Math.floor(item.vote)"
                    :key="'star-' + index + '-' + ind"
                  >
                    <v-icon class="star-color">mdi-star</v-icon>
                  </li>
                </ul>
              </div>
              <p>{{ item.message }}</p>
              <div class="reviews-info">
                <span>{{ item.name }}</span>
                <span>{{ item.date }}</span>
              </div>
            </div>
            <button
              @click="reviewsShowed += 5"
              v-if="reviewsShowed <= profileReviews.length"
              class="btn outlined"
            >
              See more
            </button>
          </div>
        </section>
      </div>
    </div>

    <div class="group-right">
      <!-- SECTION BOX MESSAGE -->
      <section class="message-box">
        <h2>Last messages recived</h2>
        <div>
          <span>oggetto messagio</span>
        </div>
        <div>
          <span>nome e cognome</span>
        </div>
        <div class="last">
          <span
            >Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam
            molestiae excepturi eos. Amet mollitia praesentium velit blanditiis
            ipsa qui, reprehenderit quidem eius eaque harum exercitationem illo
            magni quasi quaerat unde.</span
          >
        </div>
        <div class="text-center">
          <a class="btn" href="#"> messages list </a>
          <a class="btn" href="#"> show message </a>
        </div>
      </section>

      <!--sponsor-->
      <section class="message-box margin-top">
        <h2>your sponsorship</h2>
        <!-- TODO: aggiungere un v-if per distinguere chi ha gia una sponsorizzazione attiva e chi no -->
        <p>date start</p>
        <p>date end</p>
        <a href="#">buy now</a>
      </section>

      <!--grafico-->
      <section>
        <Bar
          :chart-options="chartOptions"
          :chart-data="chartData"
          :chart-id="chartId"
          :dataset-id-key="datasetIdKey"
          :plugins="plugins"
          :css-classes="cssClasses"
          :styles="styles"
          :width="width"
          :height="height"
        />
      </section>
    </div>
  </v-main>
</template>

<script>
import { Bar } from "vue-chartjs/legacy";
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
} from "chart.js";

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
);

export default {
  name: "mydashboard",
  data() {
    return {
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
      statistics: [
        {
          month: "January",
          views: "10",
          messages: "2",
        },
        {
          month: "February",
          views: "10",
          messages: "2",
        },
        {
          month: "March",
          views: "10",
          messages: "2",
        },
        {
          month: "April",
          views: "10",
          messages: "2",
        },
      ],
      reviewsShowed: 5,
    };
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Anek+Latin:wght@200;300;500&display=swap");

/* profile---------
    -------------------
    -------------------
     */
.profile-data {
  width: 60%;
  flex-basis: 60%;
}

.inner {
  width: 90%;
  margin: 0 auto;
  padding: 40px 0 40px 0;
  display: flex;
  gap: 70px;
  color: #00234b;
  font-family: "Anek Latin", sans-serif;
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

.badge-container {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}

.badge {
  border-radius: 1rem;
  padding: 5px 20px;
  background-color: #f7f8f9;
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

.ul-info > li > a {
  font-size: 1.3rem;
  font-weight: 400;
  color: #00234b;
}

.ul-info li:hover {
  border-bottom: 3px solid #00234b;
}

/*review--------
    ----------------
    ----------------    */

.review {
  width: 100%;
}

.review > p {
  margin-bottom: 5px;
}

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

.icon {
  color: #00234b;
  justify-content: center;
  align-items: center;
}

.reviews-top-container {
  text-align: center;
  width: 100%;
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
}

.reviews-bottom-container .filter-bar {
  display: flex;
  justify-content: flex-start;
  padding: 10px 0;
  font-size: 1.3rem;
  font-weight: 600;
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

/* BOX MESSAGE-------
    ---------------------
    --------------------- */

.group-right {
  width: 40%;
}

.message-box {
  width: 100%;
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

.message-box textarea {
  height: 100px;
  resize: none;
}

.margin-top {
  margin-top: 1rem;
}

.last {
  background-color: white;
  border: 1px solid black;
  margin: 1rem;
}

/* generici---------
    --------------------
    --------------------*/
section {
  padding: 30px 0;
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
textarea {
  width: 100%;
  border: 1px solid #e1e1e4;
  background-color: white;
  margin-top: 5px;
}

.btn {
  display: inline-block;
  width: 100%;
  padding-top: 10px;
  padding-bottom: 10px;
  margin-top: 1rem;
  font-size: 1.3rem;
  color: #00234b;
  background-color: #fde721;
  border: 1px solid transparent;
}

.btn:hover {
  color: white;
  background-color: #00234b;
  border: 1px solid #fde721;
}

.btn.outlined {
  background-color: transparent;
  border: 2px solid #00234b;
}

.btn.outlined:hover {
  border: 2px solid #00234b;
}

.text-center {
  text-align: center;
}

/* inutilizzato
    .map-flex{
        display: flex;
        gap: 25px;
    }
    */

@media screen and (max-width: 950px) {
  /* profile */
  .profile-image {
    margin-bottom: 20px;
    align-self: center;
  }

  .prof-flex {
    flex-direction: column;
  }

  .data-flex {
    flex-direction: column;
    text-align: center;
    align-content: center;
  }

  .ul-info {
    overflow-x: scroll;
    overflow-y: hidden;
    text-align: center;
  }

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

  .group-right {
    width: 100%;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
  }
}
</style>

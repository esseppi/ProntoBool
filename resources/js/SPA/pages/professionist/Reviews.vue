<template>
  <div>
    <div class="inner">
      <div class="reviews-top-container">
        <div>
          <h4>Average rating</h4>
          <div class="vote">{{ vote }}</div>
        </div>
        <div>
          <h4>Reviews</h4>
          <div class="vote">{{ profileReviews.length }}</div>
        </div>
        <div>
          <h4>Stats</h4>
          <div class="reviews-counter">
            <ul>
              <li v-for="(item, index) in reviewsCounter" :key="index">
                {{ index }} stars ({{ item }})
                <div class="bar">
                  <div v-if="profileReviews.length > 0"
                    :style="{
                      width: (item * 100) / profileReviews.length + '%',
                    }"
                    class="internal-bar"
                  ></div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="reviews-bottom-container">
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
              <li
                v-for="ind in 5 - Math.floor(item.vote)"
                :key="'star-void-' + index + '-' + ind"
              >
                <v-icon class="star-color">mdi-star-outline</v-icon>
              </li>
            </ul>
          </div>
          <p>{{ item.message }}</p>
          <div class="reviews-info">
            <span>{{ item.name }}</span> •
            <span>{{ item.created_at }}</span>
          </div>
        </div>
        <button
          @click="reviewsShowed += 10"
          v-if="reviewsShowed <= profileReviews.length"
          class="btn outlined"
        >
          See more
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Reviews",
  data() {
    return {
      user: null,
      profileReviews: [],
      reviewsShowed: 10,
      vote: null,
      reviewsCounter: {
        5: 0,
        4: 0,
        3: 0,
        2: 0,
        1: 0,
      },
    };
  },
  created() {
    if (localStorage.getItem("auth")) {
      axios.get("/api/user").then((res) => {
        this.user = res.data;
        axios.get(`api/reviews/${this.user.id}`).then((res) => {
      this.profileReviews = res.data.response.reverse();
      console.log(this.profileReviews);

      let sum = 0;
      this.profileReviews.forEach((item) => {
        sum += item.vote;
        this.reviewsCounter[item.vote]++;
      });
      this.profileReviews.length > 0 ? this.vote = (sum / this.profileReviews.length).toFixed(2) : this.vote = 0;
    });
      });
    }
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Anek+Latin:wght@200;300;500&display=swap");
.inner {
  width: 90%;
  max-width: 1300px;
  margin: 0 auto;
  padding: 40px 0 40px 0;
  display: flex;
  flex-direction: column;
  gap: 70px;
  color: #00234b;
  font-family: "Anek Latin", sans-serif;
}

.reviews-top-container {
  display: flex;
  width: 100%;
  flex-wrap: wrap;
}

.reviews-top-container > div {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  width: 33%;
  padding: 0 30px;
}

.reviews-top-container > div:first-child {
  border-right: 1px solid #e1e1e4;
}

.reviews-top-container > div:last-child {
  border-left: 1px solid #e1e1e4;
}

.reviews-top-container .reviews-counter > ul {
  display: flex;
  flex-direction: column;
  width: 100%;
  padding: 0;
}

.reviews-top-container li {
  width: 100%;
}

.vote {
  font-size: 5rem;
  margin-top: -30px;
}

h4 {
  font-size: 1.5rem;
}

.reviews-bottom-container {
  border-top: 1px solid #e1e1e4;
  display: flex;
  flex-direction: column;
  gap: 35px;
  padding-top: 20px;
}

.review {
  width: 100%;
  background: #fafafa;
  padding: 30px;
  border: 1px solid #e1e1e4;
}

.review > p {
  margin-bottom: 5px;
}

.reviews-info {
  font-size: 0.9rem;
  color: #a1a1a1;
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

.bar {
  width: 100%;
  height: 20px;
  background: #fafafa;
  border: 1px solid #e1e1e4;
}

.internal-bar {
  height: 100%;
  background-color: #ff6372;
}

.reviews-counter {
  width: 100%;
}

@media screen and (max-width: 800px) {
  .inner {
    width: 100%;
    padding: 20px;
  }

  .reviews-top-container > div {
    width: 50%;
  }

  .reviews-top-container > div:last-child {
    width: 100%;
    border: 0;
  }

  .reviews-top-container > div:last-child > h4 {
    display: none;
  }

  .vote {
    margin-top: -10px;
    font-size: 3.5rem;
  }

  h4 {
    text-align: center;
    font-size: 1rem;
  }

  .reviews-counter {
    margin-top: 30px;
  }
}
</style>

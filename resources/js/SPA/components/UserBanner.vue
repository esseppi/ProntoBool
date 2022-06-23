<template>
  <v-card height="680" :loading="loading1" class="py-10">
    <v-container>
      <v-row>
        <v-col
          v-for="card in cards"
          :key="card.title"
          :md="card.flex"
          cols="12"
        >
          <v-card>
            <v-img
              :loading="loading2"
              :src="card.src"
              class="white--text align-end"
              gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
              height="200px"
            >
              <v-card-title
                primary-title
                class="justify-center white--text"
                v-text="card.title"
              ></v-card-title>
              <v-chip-group class="align-self-end" show-arrows>
                <v-chip
                  center-active
                  v-for="item in card.profession"
                  :key="item"
                  class="warning accent-4 white--text"
                >
                  {{ item }}
                </v-chip>
              </v-chip-group>
              <!-- </v-card> -->
            </v-img>

            <v-card-actions class="justify-center">
              <v-btn v-if="card.flex == 3" icon>
                <v-icon>mdi-heart</v-icon>
              </v-btn>

              <v-spacer></v-spacer>
              <v-btn v-if="card.flex == 3" icon>
                <v-icon>mdi-eye</v-icon>
              </v-btn>
              <v-btn
                v-else
                class="ma-2"
                :loading="loading4"
                :disabled="loading4"
                color="info"
                @click="loader = 'loading4'"
              >
                Visita questa sezione
                <template v-slot:loader>
                  <span class="custom-loader">
                    <v-icon light>mdi-cached</v-icon>
                  </span>
                </template>
              </v-btn>
              <v-spacer></v-spacer>

              <v-btn v-if="card.flex == 3" icon>
                <v-icon>mdi-message</v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
    <v-pagination
      :length="15"
      :total-visible="7"
      v-model="page"
      @input="getData('/api/bannerUser/?page=' + page)"
    ></v-pagination>
  </v-card>
</template>
<script>
export default {
  data: () => ({
    page: 1,
    totalPages: 1,
    loading1: true,
    loading2: true,
    cards: [],
    pic: [
      "https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=1200",
      "https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=1200",
      "https://images.pexels.com/photos/1310522/pexels-photo-1310522.jpeg?auto=compress&cs=tinysrgb&w=1200",
      "https://images.pexels.com/photos/1043471/pexels-photo-1043471.jpeg?auto=compress&cs=tinysrgb&w=1200",
      "https://images.pexels.com/photos/697509/pexels-photo-697509.jpeg?auto=compress&cs=tinysrgb&w=1200",
      "https://images.pexels.com/photos/943084/pexels-photo-943084.jpeg?auto=compress&cs=tinysrgb&w=1200",
      "https://images.pexels.com/photos/432059/pexels-photo-432059.jpeg?auto=compress&cs=tinysrgb&w=1200",
      "https://images.pexels.com/photos/1542085/pexels-photo-1542085.jpeg?auto=compress&cs=tinysrgb&w=1200",
      "https://images.pexels.com/photos/1484794/pexels-photo-1484794.jpeg?auto=compress&cs=tinysrgb&w=1200",
    ],
  }),
  methods: {
    getData(url) {
      this.cards = [];
      axios.get(url).then((res) => {
        console.log(res.data.data);
        this.totalPages = res.data.data.data.total;

        // PUSH CURRENT PAGINATION CARD IN ARRAY
        res.data.data.data.forEach((element) => {
          let avg = [0];
          const average = (array) =>
            Number((array.reduce((a, b) => a + b) / array.length).toFixed(2));
          const randomPh =
            this.pic[Math.floor(Math.random() * this.pic.length)];
          let profession = [];
          if (element.professions) {
            element.professions.forEach((elemento) => {
              profession.push(elemento.name);
            });
            this.cards.push({
              title: element.name,
              review_avg: average(avg),
              count_review: avg.length,
              src: randomPh,
              flex: 3,
              profession: profession,
            });
          }
        });
        console.log(res.data.data.data);
        this.loading1 = false;
        this.loading2 = false;
      });
    },
  },
  created() {
    this.getData("/api/bannerUser");
  },
};
</script>
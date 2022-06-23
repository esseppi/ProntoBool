<template>
  <v-card class="py-7">
    <v-container>
      <v-row>
        <v-col
          v-for="card in cards"
          :key="card.title"
          :md="card.flex"
          cols="12"
        >
          <v-card color="#D7E4F3" :to="card.link" link>
            <v-img
              :src="card.src"
              class="white--text align-end"
              gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
              height="200px"
            >
              <v-card-title
                class="align-self-start"
                v-text="card.title"
              ></v-card-title>
              <v-chip dark> {{ card.profNumber }} Professionisti </v-chip>
            </v-img>

            <v-card-actions>
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
                color="warning"
                @click="loader = 'loading4'"
              >
                Assumi personale a {{ card.title }}
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
  </v-card>
</template>
<script>
export default {
  data: () => ({
    loading4: false,

    reggio: [],
    roma: [],
    milano: [],
    asti: [],
    cards: [
      {
        title: "Reggio",
        src: "https://images.unsplash.com/photo-1588417560067-35006789ce96?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2748&q=80",
        flex: 6,
        link: "/results/reggio",
        profNumber: 0,
      },
      {
        title: "Roma",
        src: "https://images.unsplash.com/photo-1529260830199-42c24126f198?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2676&q=80",
        flex: 6,
        link: "/results/roma",
        profNumber: 0,
      },
      {
        title: "Asti",
        src: "https://www.rai.it/dl/img/2021/01/29/1600x900_1611939398564_asti.jpg",
        flex: 6,
        link: "/results/asti",
        profNumber: 0,
      },
      {
        title: "Milano",
        src: "https://images.unsplash.com/photo-1617102827974-c3f440b2ed70?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2663&q=80",
        flex: 6,
        link: "/results/milano",
        profNumber: 0,
      },
    ],
  }),
  methods: {},
  created() {
    axios.get("/api/cityUser").then((res) => {
      this.reggio = res.data.cities.Reggio;
      this.cards[0].profNumber = res.data.cities.Reggio.length;
      this.roma = res.data.cities.Roma;
      this.cards[1].profNumber = res.data.cities.Roma.length;
      this.milano = res.data.cities.Milano;
      this.cards[3].profNumber = res.data.cities.Milano.length;
      this.asti = res.data.cities.Asti;
      this.cards[2].profNumber = res.data.cities.Asti.length;
    });
  },
};
</script>
<template>
  <v-card color="white" class="py-7">
    <v-container>
      <v-row>
        <v-col
          v-for="card in cards"
          :key="card.title"
          :md="card.flex"
          cols="12"
        >
          <v-card :to="card.link" link>
            <v-img
              :src="card.src"
              gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
              height="200px"
            >
              <v-card
                height="200px"
                color="transparent"
                class="d-flex flex-col"
              >
                <v-spacer></v-spacer>

                <v-card-title
                  class="align-self-center white--text font-weight-black"
                  v-text="card.title"
                ></v-card-title>
                <v-spacer></v-spacer>
                <v-btn dark> {{ card.profNumber }} Professionisti </v-btn>
              </v-card>
            </v-img>
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
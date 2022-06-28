<template>
  <div>
    <v-btn-toggle
      class="d-flex justify-center"
      :onchange="changeChart()"
      v-model="toggle_exclusive"
    >
      <v-btn>
        <v-icon>mdi-android-messages</v-icon>
      </v-btn>
      <v-btn>
        <v-icon>mdi-draw</v-icon>
      </v-btn>
    </v-btn-toggle>
    <Bar
      :chart-options="chartOptions"
      :chart-data="chartData"
      :chart-id="chartId"
      :dataset-id-key="datasetIdKey"
      :plugins="plugins"
      :css-classes="cssClasses"
      :styles="styles"
      :width="width"
      :height="150"
    />
  </div>
</template>

<script>
import { Bar } from "vue-chartjs/legacy";
import "chartjs-adapter-luxon";
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
  name: "BarChart",
  components: { Bar },
  props: {
    chartId: {
      type: String,
      default: "bar-chart",
    },
    datasetIdKey: {
      type: String,
      default: "label",
    },
    width: {
      type: Number,
      default: 400,
    },
    height: {
      type: Number,
      default: 400,
    },
    cssClasses: {
      default: "",
      type: String,
    },
    styles: {
      type: Object,
      default: () => {},
    },
    plugins: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      urlData: ["api/dashleads/", "api/dashreviews/"],
      toggle_exclusive: 0,
      chartData: {
        availableYears: [],
        labels: [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "Agoust",
          "September",
          "October",
          "November",
          "December",
        ],
        datasets: [{ data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0] }],
      },
      chartOptions: {
        responsive: true,
      },
    };
  },
  methods: {
    changeChart() {
      console.log(this.toggle_exclusive);
      axios
        .get(this.urlData[this.toggle_exclusive] + this.$route.params.id)
        .then((res) => {
          console.log(res.data[0]);
          this.chartData.datasets[0].data = [
            0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
          ];
          res.data[0].forEach((element) => {
            this.chartData.datasets[0].data.splice(
              this.chartData.labels.indexOf(element["month"]),
              1,
              element["COUNT(id)"]
            );
            if (this.chartData.availableYears.includes(element["year"])) {
              this.chartData.availableYears.push(element["year"]);
            }
            this.chartData;
          });
        });
    },
  },
  created() {
    axios
      .get(this.urlData[this.toggle_exclusive] + this.$route.params.id)
      .then((res) => {
        res.data[0].forEach((element) => {
          this.chartData.datasets[0].data.splice(
            this.chartData.labels.indexOf(element["month"]),
            1,
            element["COUNT(id)"]
          );
          if (this.chartData.availableYears.includes(element["year"])) {
            this.chartData.availableYears.push(element["year"]);
          }
          this.chartData;
        });
      });
  },
};
</script>
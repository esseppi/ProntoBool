window.Vue = require("vue").default;
import App from "./SPA/App.vue";
import Vuetify from "../plugins/vuetify";
import Braintree from "vue-braintree";
import routes from "./SPA/routes";
import store from "./store";
import axios from "axios";
import VueCompositionAPI from '@vue/composition-api';

// import { vue } from "laravel-mix";


axios.defaults.baseURL = "http://127.0.0.1:8000";
window.axios = axios;
Vue.use(Braintree, VueCompositionAPI);


const app = new Vue({
    router: routes,
    store: store,
    vuetify: Vuetify,
    braintree: Braintree,
    el: "#app",

    render: (h) => h(App),
});

import "./bootstrap";
window.Vue = require("vue").default;
import App from "./SPA/App.vue";
import Vuetify from "../plugins/vuetify";
import Braintree from "vue-braintree";
import routes from "./SPA/routes";
import VueRouter from "vue-router";
// import axios from "axios";
// axios.defaults.baseURL = "http://127.0.0.1:8000";
Vue.use(VueRouter);
Vue.use(Braintree);
const app = new Vue({
    router: new VueRouter(routes),
    base: "/",
    vuetify: Vuetify,

    braintree: Braintree,
    el: "#app",
    render: (h) => h(App),
});

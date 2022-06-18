import "./bootstrap";
window.Vue = require("vue").default;
import App from "./SPA/App.vue";
import Vuetify from "../plugins/vuetify";
import Braintree from "vue-braintree";
import routes from "./SPA/routes";

import VueRouter from "vue-router";
Vue.use(VueRouter);
Vue.use(Braintree);

const app = new Vue({
    router: new VueRouter(routes),
    vuetify: Vuetify,
    braintree: Braintree,
    el: "#app",
    render: (h) => h(App),
});

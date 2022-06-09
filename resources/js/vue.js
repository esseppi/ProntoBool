import "./bootstrap";
window.Vue = require("vue").default;
import App from "./SPA/App.vue";
import Vuetify from "../plugins/vuetify";
import routes from "./SPA/routes";

import VueRouter from "vue-router";
Vue.use(VueRouter);

const app = new Vue({
    router: new VueRouter(routes),
    vuetify: Vuetify,
    el: "#app",
    render: (h) => h(App),
});

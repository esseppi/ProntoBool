import Vuex from "vuex";
import Vue from "vue";

Vue.use(Vuex);
const store = new Vuex.Store({
    state: {
        currentUser: false,
    },
    mutations: {
        setAuth(state, res) {
            state.currentUser = localStorage.getItem("auth");
        },
    },
});
export default store;

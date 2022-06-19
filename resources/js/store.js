import Vuex from "vuex";
import Vue from "vue";

Vue.use(Vuex);
const store = new Vuex.Store({
    state: {
        currentUser: false,
    },
    mutations: {
        setAuth(state, res) {
            state.currentUser = res;
            console.log(store.state.currentUser);
        },
    },
});
export default store;

import Vue from "vue";
import Login from "./pages/Login.vue";
import Dashboard from "./pages/professionist/MyDashboard.vue";
import CustomerLead from "./pages/CustomerLead.vue";
import Auth from "./pages/auth/auth.vue";
import Register from "./pages/auth/Register.vue";
import Home from "./pages/Home.vue";
import Cart from "./pages/checkout/cart.vue";
import Bundles from "./pages/professionist/Bundles.vue";
import Router from "vue-router";
import DoctorDetails from "./pages/DoctorDetails.vue";
import SignUp from "./pages/SignUp.vue";
import Reviews from "./pages/professionist/Reviews.vue";
import Messages from "./pages/professionist/Messages.vue";


Vue.use(Router);
let check = true;

const router = new Router({
    mode: "history",
    linkActiveClass: "font-semibold",
    base: process.env.BASE_URL,
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
        },
        {
            path: "/mydashboard",
            name: "dashboard",
            component: Dashboard,
        },
        {
            path: "/reviews",
            name: "reviews",
            component: Reviews,
        },
        {
            path: "/messages",
            name: "messages",
            component: Messages,
        },
        {
            path: "/auth",
            name: "auth",
            component: Auth,
            meta: {
                requiresGuest: true,
            },
        },
        {
            path: "/signup",
            name: "signup",
            component: SignUp,
        },
        {
            path: "/register2",
            name: "register",
            component: Register,
            meta: {
                requiresGuest: true,
            },
        },
        {
            path: "/loginprof",
            name: "login",
            component: Login,
        },
        {
            path: "/checkout/:id",
            name: "cart",
            component: Cart,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: "/sendlead/:id",
            name: "sendlead",
            component: CustomerLead,
        },
        {
            path: "/bundles",
            name: "bundles",
            component: Bundles,
            meta: {
                requiresAuth: true,
            },
        },
        {
            // /search/screens -> /search?q=screens
            path: "/*",
            redirect: (to) => {
                // the function receives the target route as the argument
                // we return a redirect path/location here.
                return { path: "/" };
            },
            // },        {
            //     // /search/screens -> /search?q=screens
            //     path: "/search/:searchText",
            //     redirect: (to) => {
            //         // the function receives the target route as the argument
            //         // we return a redirect path/location here.
            //         return { path: "/search", query: { q: to.params.searchText } };
            //     },
        },
    ],
});
router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some((record) => to.meta.requiresAuth);
    const requiresGuest = to.matched.some((record) => to.meta.requiresGuest);
    if (requiresGuest && localStorage.auth) {
        next("/loginSpa");
    } else if (requiresAuth && !localStorage.auth) {
        next("/");
    } else {
        next();
    }
});

export default router;

import Vue from "vue";
import Login from "./pages/auth/Login.vue";
import Dashboard from "./pages/professionist/MyDashboard.vue";
import CustomerLead from "./pages/CustomerLead.vue";
import Auth from "./pages/auth/auth.vue";
import Register from "./pages/auth/Register.vue";
import Home from "./pages/Home.vue";
import Cart from "./pages/checkout/cart.vue";
import Bundles from "./pages/professionist/Bundles.vue";
import Router from "vue-router";

Vue.use(Router);
let check = true;

const router = new Router({
    mode: "history",
    linkActiveClass: "font-semibold",
    base: process.env.BASE_URL,
    routes: [
        {
            path: "/home",
            name: "home",
            component: Home,
        },
        {
            path: "/mydashboard",
            name: "dashboard",
            component: Dashboard,
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
            path: "/registerSpa",
            name: "register",
            component: Register,
            meta: {
                requiresGuest: true,
            },
        },
        {
            path: "/loginSpa",
            name: "login",
            component: Login,
            meta: {
                requiresGuest: true,
            },
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
    ],
});
router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some((record) => to.meta.requiresAuth);
    const requiresGuest = to.matched.some((record) => to.meta.requiresGuest);
    if (requiresGuest && localStorage.auth) {
        next("/loginSpa");
    } else if (requiresAuth && !localStorage.auth) {
        next("/home");
    } else {
        next();
    }
});

export default router;

import Vue from "vue";
import Login from "./pages/auth/Login.vue";
import Dashboard from "./pages/professionist/MyDashboard.vue";
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

// router.beforeEach((to, from, next) => {
//     // Allow finishing callback url for logging in
//     if (to.matched.some((record) => record.path == "/auth0callback")) {
//         console.log("router.beforeEach found /auth0callback url");
//         Store.dispatch("auth0HandleAuthentication");
//         next(false);
//     }

//     // check if user is logged in (start assuming the user is not logged in = false)
//     let routerAuthCheck = false;
//     // Verify all the proper access variables are present for proper authorization
//     if (
//         localStorage.getItem("access_token") &&
//         localStorage.getItem("id_token") &&
//         localStorage.getItem("expires_at")
//     ) {
//         console.log("found local storage tokens");
//         // Check whether the current time is past the Access Token's expiry time
//         let expiresAt = JSON.parse(localStorage.getItem("expires_at"));
//         // set localAuthTokenCheck true if unexpired / false if expired
//         routerAuthCheck = new Date().getTime() < expiresAt;
//     }

//     // set global ui understanding of authentication
//     Store.commit("setUserIsAuthenticated", routerAuthCheck);

//     // check if the route to be accessed requires authorizaton
//     if (to.matched.some((record) => record.meta.requiresAuth)) {
//         // Check if user is Authenticated
//         if (routerAuthCheck) {
//             // user is Authenticated - allow access
//             next();
//         } else {
//             // user is not authenticated - redirect to login
//             router.replace("/login");
//         }
//     }
//     // Allow page to load
//     else {
//         next();
//     }
// });

export default router;

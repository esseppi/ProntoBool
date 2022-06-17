import Home from "./pages/Home.vue";
import Cart from "./pages/checkout/cart.vue";
import Thankyou from "./pages/checkout/thankyou.vue";
import Bundles from "./pages/Bundles";
import Settings from "./pages/Settings.vue";
import MyDashboard from "./pages/MyDashboard.vue";
import Login from "./pages/auth/Login.vue";
import Register from "./pages/auth/Register.vue";

export default {
    mode: "history",
    linkActiveClass: "font-semibold",

    routes: [
        {
            path: "/home",
            name: "home",
            component: Home,
        },
        {
            path: "/bundles",
            name: "bundles",
            component: Bundles,
        },
        {
            path: "/registerSpa",
            name: "register",
            component: Register,
        },
        {
            path: "/loginSpa",
            name: "login",
            component: Login,
        },
        {
            path: "/checkout",
            name: "cart",
            component: Cart,
        },
        {
            path: "/ThankYou",
            name: "thankyou",
            component: Thankyou,
        },
        // {
        //     path: "/settings",
        //     name: "settings",
        //     component: Settings,
        // },
        // {
        //     path: "/mydashboard",
        //     name: "MyDashboard",
        //     component: MyDashboard,
        // },
    ],
};

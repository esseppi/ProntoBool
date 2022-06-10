// import Home from "./pages/Home.vue";
import Settings from "./pages/Settings.vue";
import Benvenuto from "./pages/Benvenuto.vue";
import MyDashboard from "./pages/MyDashboard.vue";
// import Login from "./pages/auth/Login.vue";
// import Register from "./pages/auth/Register.vue";

export default {
    mode: "history",
    linkActiveClass: "font-semibold",

    routes: [
        {
            path: "/login",
            name: "login",
            component: Login,
        },
        {
            path: "/settings",
            name: "settings",
            component: Settings,
        },
        {
            path: "/mydashboard",
            name: "MyDashboard",
            component: MyDashboard,
        },
        {
            path: "/benvenuto",
            name: "benvenuto",
            component: Benvenuto,
        },
    ],
};

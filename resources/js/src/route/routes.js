import Home from "../Pages/User/index.vue";

import NotFound from "../Pages/NotFound/index.vue";
import Login from "../Pages/Auth/login.vue";
import Register from "../Pages/Auth/register.vue";
import Forget from "../Pages/Auth/forget.vue";

const routes = [

    {

        path: '/404',
        component: NotFound,
        name: 'NotFound',

    },
    {

        path: "/:catchAll(.*)",
        name: "NotFound",
        component: NotFound,

    },

    {

        path: '/:template?/:action?/:params?',
        component: Home,
        name: 'home',
        props:true,

    },
    // {
    //
    //     path: '/forget',
    //     component: Forget,
    //     name: 'forget',
    //
    //
    // },
    // {
    //
    //     path: '/login',
    //     component: Login,
    //     name: 'login',
    //
    //
    // },
    // {
    //
    //     path: '/register',
    //     component: Register,
    //     name: 'register',
    //
    //
    // },





];


export default routes;

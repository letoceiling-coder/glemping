
import Home from "../pages/Admin/index.vue";



import NotFound from "../pages/NotFound/index.vue";

const routes = [



    {

        path: '/admin/:template?/:action?/:params?/:id?',
        component: Home,
        name:'admin',
        props:true,

    },
    {

        path:'/404',
        component: NotFound,
        name:'NotFound',


    }, {

        path: "/:catchAll(.*)",
        name: "NotFound",
        component: NotFound,

    },



];



export default routes;

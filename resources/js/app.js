import './bootstrap';
import {createApp} from 'vue';
import store from "./src/store";
import Router from "./src/route/router.js";
import App from "./src/App.vue";
import '../../public/css/main.css'
import {autoAnimatePlugin} from '@formkit/auto-animate/vue'
import Notifications from '@kyvg/vue3-notification'
import {notify} from "@kyvg/vue3-notification";
import VueTelInput from 'vue-tel-input';
import 'vue-tel-input/vue-tel-input.css';



import 'swiper/css/pagination';
const app = createApp(App);

import Helper from './Helper';

app.config.globalProperties.Helper = new Helper()


app.use(VueTelInput);
app.use(Notifications);
app.use(Router)
app.use(autoAnimatePlugin)

//  import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
// //
//  app.use(ElementPlus);
app.use(store)
import registerComponents from "/resources/js/src/UI/register.js";

for (const [key, value] of Object.entries(registerComponents)) {

    app.component(key, value);
}
import registerComponentsIndex from "/resources/js/src/Pages/User/components.js";

for (const [key, value] of Object.entries(registerComponentsIndex)) {

    app.component(key, value);
}






axios.interceptors.request.use(function (config) {
    store.state.errors = [];

    return config;
});

const modalClose = (e) => {

    $(e.target).closest('.modal').modal('hide')
}
app.config.globalProperties.modalClose = modalClose


axios.interceptors.response.use((response) => response, (error) => {

    store.state.errors = [];
    console.log(error)
    if (error.status == 422) {
        for (const [key, value] of Object.entries(error.response.data.errors)) {

            store.state.errors.push({name: key, message: value})
        }

        if (error.response.data.errors.alert != undefined) {
            notify({
                title: "Отказано в доступе",
                text: error.response.data.errors.message[0],
                type: "error",
            });

        }
    }

    if (error.status == 500) {
        notify({
            title: "Уведомление",
            text: "Ошибка сервера",
            type: "error",
        });

    }

    if (error.response.data.notify != undefined) {

        notify(error.response.data.notify);

    }

});

const appendClass = (data) => {

    return `${data.marginBottom} ${data.marginTop} `


}
app.config.globalProperties.appendClass = appendClass

const storage = store.state
app.config.globalProperties.storage = storage
store.state.settings = settingsSite
console.log(store.state.settings)


store.state.width = $(window).width()
$(window).resize(function() {
    store.state.width = $(window).width()
});
axios.defaults.headers.common['Authorization'] = `Bearer ${store.state.settings.accessToken}`;

app.mount('#app');


$(document).on('keypress', function (e) {

    if (e.which == 13) {

        $('.btn-keypress').trigger('click')
    }
});



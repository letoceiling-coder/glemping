import './bootstrap';
import {createApp} from 'vue';
import store from "./src/store";
import Router from "./src/route/router-lte.js";
import '../../public/css/lte.css'
import App from "./src/Lte.vue";
import VueTelInput from 'vue-tel-input';
import 'vue-tel-input/vue-tel-input.css';
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import { autoAnimatePlugin } from '@formkit/auto-animate/vue'
import Notifications from '@kyvg/vue3-notification'
import { notify } from "@kyvg/vue3-notification";
import copyText from "@meforma/vue-copy-to-clipboard";

import VueSortable from "vue3-sortablejs";
const app = createApp(App);

import Helper from './Helper';

import Vue3ColorPicker from "vue3-colorpicker";
import "vue3-colorpicker/style.css";

app.config.globalProperties.Helper = new Helper()

app.use(copyText);
app.use(Vue3ColorPicker);
app.use(ElementPlus);
app.use(Notifications);
app.use(Router)
app.use(autoAnimatePlugin)
app.use(store)
app.use(VueSortable);
app.use(VueTelInput, {
    mode: 'auto',
});
import registerComponents from "/resources/js/src/UI/register.js";
for (const [key, value] of Object.entries(registerComponents)) {

    app.component(key, value);
}


const notyCopyLink = (image) => {

    app.config.globalProperties.$copyText(window.location.origin + image.src)
        .then(() => {
            notify({
                title: "Скопировано в буффер",
                text: window.location.origin + image.src,
                type: 'success',
            })
        })
        .catch(() => {
            console.log(`can't copy`);
        });
}
app.config.globalProperties.notyCopyLink = notyCopyLink

const modalShow = (e) => {

     $(e).modal('show')
}
app.config.globalProperties.modalShow = modalShow

const modalClose = (e) => {

     $(e.target).closest('.modal').modal('hide')
}
app.config.globalProperties.modalClose = modalClose

const checkModal = () => {

    if (store.state.modal.on){
        $(store.state.modal.name).modal('show')
        store.state.modal.on = false
        store.state.modal.name = ''
    }
}
app.config.globalProperties.checkModal = checkModal

const downloadItem = (url, label) => {
    $('#modal-image-info').modal('hide')
    axios.get(url, {responseType: 'blob'})
        .then(response => {
            const blob = new Blob([response.data], {type: 'application/pdf'})
            const link = document.createElement('a')
            link.href = URL.createObjectURL(blob)
            link.download = label
            link.click()
            URL.revokeObjectURL(link.href)
        }).catch(console.error)
}
app.config.globalProperties.downloadItem = downloadItem


axios.interceptors.request.use(function (config) {
    store.state.errors = [];

    return config;
});


axios.interceptors.response.use((response) => response, (error) => {
    $('.error-block').slideDown()
    store.state.errors = [];
    console.log(error)


    if (error.status == 422){
        for (const [key, value] of Object.entries(error.response.data.errors)) {

            store.state.errors.push({name: key, message: value})
        }

        if (error.response.data.errors.alert != undefined){
            console.log(error.response.data.errors.alert)
            notify(error.response.data.errors.alert);

        }
        if (error.response.data.errors.system != undefined){

            notify({
                title: "Уведомление",
                text: error.response.data.errors.system[0],
                type: "error",
            });
        }

    }

    if (error.status == 500){
        notify({
            title: "Уведомление",
            text: "Ошибка сервера",
            type: "error",
        });

    }

    if (error.response.data.notify != undefined){

        notify(error.response.data.notify);

    }

});
const storage = store.state
app.config.globalProperties.storage = storage
store.state.settings = settingsSite
console.log(store.state.settings)



axios.defaults.headers.common['Authorization'] = `Bearer ${store.state.settings.accessToken}`;


import mitt from 'mitt'
const eventBus = mitt()


const getIdRandom = ( ) => {

    let id = Math.random().toString(16).slice(2)
    if (store.state.ids.find(item => item === id)) {
        return getIdRandom()
    }
    store.state.ids.push(id)
    return id;
}

app.config.globalProperties.getIdRandom = getIdRandom

app.config.globalProperties.eventBus = eventBus
app.mount('#app');


$(document).on('keypress', function (e) {

    if (e.which == 13) {

        $('.btn-keypress').trigger('click')
    }
});

$(document).on('click', '.down-toggle', function () {
    $(this).next().slideToggle()
})




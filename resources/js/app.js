import Vue from 'vue'
import router from './router'
import store from './store'
import BootstrapVue from 'bootstrap-vue'
import VueSidebarMenu from 'vue-sidebar-menu'
import VueAxios from 'vue-axios'

import mixins from './mixins.js';
Vue.mixin(mixins);

import VuejsDialog from 'vuejs-dialog';
import 'vuejs-dialog/dist/vuejs-dialog.min.css';
import VueHtmlToPaper from 'vue-html-to-paper';
import VueNavigationBar from "vue-navigation-bar";
import SelectAjax from "./components/SelectAjax";
import RadioAjax from "./components/RadioAjax";
import MyDatePicker from "./components/MyDatePicker";
import MyMoney from "./components/MyMoneyr";

require('./bootstrap');
Vue.use(BootstrapVue);

Vue.use(VueSidebarMenu);

let axiosInstance = axios.create();

axiosInstance.interceptors.request.use(function (config) {
    NProgress.start();
    if (store.state.auth) {
        if (store.state.auth.status && store.state.auth.data) {
            let token = store.state.auth.token;
            if (token) {
                // config.headers['Authorization'] = `Bearer ${token}`
            }
        }
    }
    return config;
}, function (error) {
    NProgress.done(true)
    // Do something with request error
    // console.log(error);
    return Promise.reject(error);
});

axiosInstance.interceptors.response.use(function (response) {
    NProgress.done(true)
    // console.log(response);
    return response;
}, function (error) {
    NProgress.done(true)
    // console.error(error);
    alert(error.response.data.message);
    if (error.response.status == 401 || error.response.status == 419) {
        var data = {
            "status": false,
            "token": "",
            "data": {
                "id": "",
                "name": "",
                "username": "",
                "password": "",
                "password_confirmation": "",
                "avatar": "",
                "role": "",
                "links": {
                    "update": "",
                    "edit": "",
                    "avatar": ""
                }
            }
        };
        store.commit("setAuth", data);
        router.push("/pages/login");
    }
    return Promise.reject(error);
});

Vue.use(VueAxios, axiosInstance);

import * as LocationPicker from 'vue2-location-picker'
Vue.use(LocationPicker, {
    installComponents: false, // If true, create it globally
})

Vue.use(VuejsDialog);

const options = {
    name: '_blank',
    specs: [
        'fullscreen=yes',
        'titlebar=yes',
        'scrollbars=yes'
    ],
    styles: [
        '/css/app.css',
    ]
};
Vue.use(VueHtmlToPaper, options);

Vue.component("vue-navigation-bar", VueNavigationBar);

Vue.component('select-ajax', SelectAjax);
Vue.component('my-date-picker', MyDatePicker);
Vue.component('my-money', MyMoney);
Vue.component('radio-ajax', RadioAjax);

require('chartjs-plugin-datalabels');

new Vue({
    router,
    store
}).$mount('#app');

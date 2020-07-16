import Vue from 'vue'
require('./bootstrap');

import BootstrapVue from 'bootstrap-vue'
import router from './router'
import store from './store'

Vue.use(BootstrapVue);

import VueSidebarMenu from 'vue-sidebar-menu'
// import 'vue-sidebar-menu/dist/vue-sidebar-menu.css'
Vue.use(VueSidebarMenu)

// import axios from 'axios'
var axiosInstance = axios.create();

axiosInstance.interceptors.request.use(function (config) {
    NProgress.start();
    if(store.state.auth){
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

import mixins from './mixins.js';

Vue.mixin(mixins);

import VueAxios from 'vue-axios'
Vue.use(VueAxios, axiosInstance);

import VuejsDialog from 'vuejs-dialog';
// import VuejsDialogMixin from 'vuejs-dialog/dist/vuejs-dialog-mixin.min.js'; // only needed in custom components
// include the default style
import 'vuejs-dialog/dist/vuejs-dialog.min.css';
Vue.use(VuejsDialog);

import VueHtmlToPaper from 'vue-html-to-paper';
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
}
Vue.use(VueHtmlToPaper,options);

import SelectAjax from "./components/SelectAjax";
import RadioAjax from "./components/RadioAjax";
import MyDatePicker from "./components/MyDatePicker";
import MyMoney from "./components/MyMoneyr";

Vue.component('select-ajax', SelectAjax);
Vue.component('my-date-picker', MyDatePicker);
Vue.component('my-money', MyMoney);
Vue.component('radio-ajax', RadioAjax);

new Vue({
    router,
    store
}).$mount('#app')

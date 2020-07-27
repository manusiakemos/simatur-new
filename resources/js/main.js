import Vue from 'vue'
require('./bootstrap');

import BootstrapVue from 'bootstrap-vue'
import store from './store'

Vue.use(BootstrapVue);

import mixins from './mixins.js';
Vue.mixin(mixins);

import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios);

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

const originalPush = VueRouter.prototype.push
VueRouter.prototype.push = function push(location, onResolve, onReject) {
    if (onResolve || onReject) return originalPush.call(this, location, onResolve, onReject)
    return originalPush.call(this, location).catch(err => err)
}

import VueRouter from 'vue-router'
Vue.use(VueRouter);

import WebLayout from "./screens/web/WebLayout.vue"
import Home from "./screens/web/Home.vue"
import TowerMap from "./screens/web/TowerMap.vue"
import ZonaMap from "./screens/web/ZonaMap.vue"
import Statistik from "./screens/web/Statistik.vue"
import DataTower from "./screens/web/DataTower.vue"

const routes = [
    {
        path: '/',
        redirect: '/home',
        name: 'WebLayout',
        component: WebLayout,
        children: [
            {
                path: '/home',
                name: 'Home',
                component: Home,
            },
            {
                path: '/towermap',
                name: 'TowerMap',
                component: TowerMap,
            },
            {
                path: '/zonamap',
                name: 'ZonaMap',
                component: ZonaMap,
            },
            {
                path: '/statistik',
                name: 'Statistik',
                component: Statistik,
            },
            {
                path: '/datatower',
                name: 'DataTower',
                component: DataTower,
            }
        ]
    },
]

const router = new VueRouter({
    mode: 'hash', // https://router.vuejs.org/api/#mode
    linkActiveClass: 'open active',
    scrollBehavior: () => ({y: 0}),
    routes: routes
});

import SelectAjax from "./components/SelectAjax";
import RadioAjax from "./components/RadioAjax";
import MyDatePicker from "./components/MyDatePicker";
import MyMoney from "./components/MyMoneyr";

import 'vue-search-select/dist/VueSearchSelect.css'
Vue.component('select-ajax', SelectAjax);
Vue.component('my-date-picker', MyDatePicker);
Vue.component('my-money', MyMoney);
Vue.component('radio-ajax', RadioAjax);

require('chartjs-plugin-datalabels');

window.NProgress = require('nprogress');

new Vue({
    router,
    store
}).$mount('#app')

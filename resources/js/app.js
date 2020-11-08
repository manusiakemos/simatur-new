import Vue from 'vue';
require('./bootstrap');

import axiosInstance from './axiosclient';
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axiosInstance);

require('./component');

import router from './router'
import store from './store'

new Vue({
    router,
    store
}).$mount('#app');

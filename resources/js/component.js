import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue'
import VueSidebarMenu from 'vue-sidebar-menu'

import mixins from './mixins.js';
Vue.mixin(mixins);


Vue.use(BootstrapVue);
Vue.use(VueSidebarMenu);

import VuejsDialog from 'vuejs-dialog';
import 'vuejs-dialog/dist/vuejs-dialog.min.css';
Vue.use(VuejsDialog);

import * as LocationPicker from 'vue2-location-picker'
Vue.use(LocationPicker, {
    installComponents: false, // If true, create it globally
});

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
};
Vue.use(VueHtmlToPaper, options);

import VueNavigationBar from "vue-navigation-bar";
Vue.component("vue-navigation-bar", VueNavigationBar);

import SelectAjax from "./components/SelectAjax";
Vue.component('select-ajax', SelectAjax);

import MyDatePicker from "./components/MyDatePicker";
Vue.component('my-date-picker', MyDatePicker);

import MyMoney from "./components/MyMoneyr";
Vue.component('my-money', MyMoney);

import ReportHeading from "./components/ReportHeading";
Vue.component('report-heading', ReportHeading);

import RadioAjax from "./components/RadioAjax";
Vue.component('radio-ajax', RadioAjax);

import Fragment from 'vue-fragment';
Vue.use(Fragment.Plugin);

require('chartjs-plugin-datalabels');


import VueKonva from 'vue-konva';
Vue.use(VueKonva);

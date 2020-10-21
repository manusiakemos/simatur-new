import Vue from "vue"
import Vuex from 'vuex';
import VuexPersistence from 'vuex-persist'

const vuexLocal = new VuexPersistence({
    storage: window.localStorage,
    key:'master-project',
});

Vue.use(Vuex);
const store = new Vuex.Store({
    state: {
        accessToken:"pk.eyJ1IjoibWFudXNpYWtlbW9zIiwiYSI6ImNrN3l4MTJuYTAwZGEzbXBiNzUyaTM1N3EifQ.KP9R6VRtfvsoXZgcaTYacw",
        appName:"SIMATUR",
        refresh: 1,
        showSidebar:true,
        auth: {
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
        },
    },
    mutations: {
        setAuth(state, value) {
            state.auth = value;
        },
        setAuthData(state, value) {
            state.auth.data = value;
        },
        setRefresh(state) {
            state.refresh++;
        },
        resetRefresh(state) {
            state.refresh = 1;
        },
        setShowSideBar(state, value){
            state.showSidebar = value;
        },
        toggleSideBar(state){
            state.showSidebar = !state.showSidebar;
        }
    },
    plugins: [vuexLocal.plugin]
});

export default store;

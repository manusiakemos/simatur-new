import Zona from './screens/zona/ZonaIndex.vue'
import Kunjungan from './screens/kunjungan/KunjunganIndex.vue'
import TowerProvider from './screens/tower_provider/TowerProviderIndex.vue'
import Provider from './screens/provider/ProviderIndex.vue'
import Tower from './screens/tower/TowerIndex.vue'
// Main Views
import User from './screens/user/UserIndex.vue'
import Kategori from './screens/kategori/KategoriIndex.vue'
import Crud from "./screens/dashboard/Crud";
import TowerDashboard from "./screens/dashboard/TowerDashboard";
import ZonaDashboard from "./screens/dashboard/ZonaDashboard";
import ChartDashboard from "./screens/dashboard/ChartDashboard";
import Pages from "./screens/Pages";
import Login from "./screens/pages/Login";
import Profile from "./screens/profile/ProfileIndex";
// vuex
import store from './store'
// Containers
import MainApp from "./screens/MainApp"

import Vue from 'vue'
import VueRouter from 'vue-router'

//end generated views

window.NProgress = require('nprogress');

const originalPush = VueRouter.prototype.push
VueRouter.prototype.push = function push(location, onResolve, onReject) {
    if (onResolve || onReject) return originalPush.call(this, location, onResolve, onReject)
    return originalPush.call(this, location).catch(err => err)
}

Vue.use(VueRouter);

const routes = [
    {
        path: '/mainapp',
        redirect: '/mainapp/dashboard',
        name: 'MainApp',
        component: MainApp,
        children: [
            {
                path: '/mainapp/kunjungan',
                name: 'Kunjungan',
                component: Kunjungan,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/mainapp/provider',
                name: 'Provider',
                component: Provider,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/mainapp/zona',
                name: 'Zona',
                component: Zona,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/mainapp/towerprovider/:tower_id',
                name: 'TowerProvider',
                component: TowerProvider,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/mainapp/tower',
                name: 'Tower',
                component: Tower,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/mainapp/kategori',
                name: 'Kategori',
                component: Kategori,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/mainapp/dashboard',
                name: 'Dashboard',
                component: TowerDashboard,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/mainapp/dashboardchart',
                name: 'ChartDashboard',
                component: ChartDashboard,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/mainapp/dashboardzona',
                name: 'ZonaDashboard',
                component: ZonaDashboard,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/mainapp/crud',
                name: 'Crud',
                component: Crud,
                meta: {
                    requiresAuth: true,
                    role: 'super-admin'
                }
            },
            {
                path: '/mainapp/user',
                name: 'User',
                component: User,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/mainapp/profile',
                name: 'Profile',
                component: Profile,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
        ],
    },
    {
        path: '/',
        redirect: '/pages/login',
        name: 'Pages',
        component: Pages,
        children: [
            {
                path: '/pages/login',
                name: 'Login',
                component: Login,
            }
        ]
    }
];

const router = new VueRouter({
    mode: 'hash', // https://router.vuejs.org/api/#mode
    linkActiveClass: 'open active',
    scrollBehavior: () => ({y: 0}),
    routes: routes
});

router.beforeResolve((to, from, next) => {
    if (to.name) {
        NProgress.start()
    }
    next()
});

router.afterEach((to, from) => {
    NProgress.done()
});

router.beforeEach((to, from, next) => {
    // this.$Progress.start()
    // let w = screen.width;
    // let mobile = w < 600;
    // if (mobile) {
    //     store.commit("toggleSideBar");
    // }
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // console.log(store.state);
        axios.get('/api/profile').then(res => {
        }).catch(err => {
            alert('session kadaluarsa');
            next({path: '/pages/login',})
        });

        if (!store.state.auth) {
            next({path: '/pages/login',})
        } else {
            let auth = store.state.auth;
            if (auth.status == false) {
                // alert('session kadaluarsa');
                next({path: '/pages/login'})
            } else {
                if (to.matched.some(record => record.meta.role)) {
                    let userRole = auth.data.role;
                    let metaRole = to.meta.role;
                    let splitMetaRole = metaRole.split('|');
                    if (splitMetaRole.indexOf(userRole) > -1) {
                        next()
                    } else {
                        next({path: '/pages/404'});
                    }
                }
                next();
            }
        }
    }
    else if (to.matched.some(record => record.meta.redirectIfAuth)) {
        if (store.state.auth) {
            if (store.state.auth.status) {
                next({
                    path: '/mainapp/dashboard',
                    // params: { nextUrl: to.fullPath }
                })
            }
        } else {
            next()
        }
    } else {
        next();
    }
});

export default router;

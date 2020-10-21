import Permohonan from './screens/permohonan/PermohonanIndex.vue'
import Arsip from './screens/arsip/ArsipIndex.vue'
import Zona from './screens/zona/ZonaIndex.vue'
import Kunjungan from './screens/kunjungan/KunjunganIndex.vue'
import TowerProvider from './screens/tower_provider/TowerProviderIndex.vue'
import Provider from './screens/provider/ProviderIndex.vue'
import Tower from './screens/tower/TowerIndex.vue'
import User from './screens/user/UserIndex.vue'
import Kategori from './screens/kategori/KategoriIndex.vue'
import Crud from "./screens/dashboard/Crud";
import TowerDashboard from "./screens/dashboard/TowerDashboard";
import ZonaDashboard from "./screens/dashboard/ZonaDashboard";
import ChartDashboard from "./screens/dashboard/ChartDashboard";
import Pages from "./screens/Pages";
import NotFound from "./screens/pages/404";
import WebSuccessRegister from "./screens/pages/WebSuccessRegister.vue"
import Login from "./screens/pages/Login";
import Register from "./screens/pages/Register";
import Profile from "./screens/profile/ProfileIndex";
//web user

import WebLayout from "./screens/web/WebLayout.vue"
import WebHome from "./screens/web/Home.vue"
import WebTowerMap from "./screens/web/TowerMap.vue"
import WebZonaMap from "./screens/web/ZonaMap.vue"
import WebStatistik from "./screens/web/Statistik.vue"
import WebDataTower from "./screens/web/DataTower.vue"
import WebListPermohonan from "./screens/web/ListPermohonan.vue"
import WebArsip from "./screens/web/WebArsip.vue"


// vuex
import store from './store'
// Containers
import AdminApp from "./screens/AdminApp"

import Vue from 'vue'
import VueRouter from 'vue-router'

//end generated views

window.NProgress = require('nprogress');

const originalPush = VueRouter.prototype.push
VueRouter.prototype.push = function push(location, onResolve, onReject) {
    if (onResolve || onReject) return originalPush.call(this, location, onResolve, onReject)
    return originalPush.call(this, location).catch(err => err)
};

Vue.use(VueRouter);

const routes = [
    {
        path: '/admin',
        redirect: '/admin/dashboard',
        name: 'AdminApp',
        component: AdminApp,
        children: [
            {
                path: '/admin/arsip',
                name: 'Arsip',
                component: Arsip,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/admin/permohonan',
                name: 'Permohonan',
                component: Permohonan,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/admin/kunjungan',
                name: 'Kunjungan',
                component: Kunjungan,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/admin/provider',
                name: 'Provider',
                component: Provider,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/admin/zona',
                name: 'Zona',
                component: Zona,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/admin/towerprovider/:tower_id',
                name: 'TowerProvider',
                component: TowerProvider,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/admin/tower',
                name: 'Tower',
                component: Tower,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/admin/kategori',
                name: 'Kategori',
                component: Kategori,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/admin/dashboard',
                name: 'Dashboard',
                component: TowerDashboard,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/admin/dashboardchart',
                name: 'ChartDashboard',
                component: ChartDashboard,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/admin/dashboardzona',
                name: 'ZonaDashboard',
                component: ZonaDashboard,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/admin/crud',
                name: 'Crud',
                component: Crud,
                meta: {
                    requiresAuth: true,
                    role: 'super-admin'
                }
            },
            {
                path: '/admin/user',
                name: 'User',
                component: User,
                meta: {
                    requiresAuth: true,
                    role: 'admin|super-admin'
                }
            },
            {
                path: '/admin/profile',
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
        redirect: '/home',
        name: 'WebLayout',
        component: WebLayout,
        children: [
            {
                path: '/home',
                name: 'Home',
                component: WebHome,
                meta: {
                    requiresAuth: false,
                }
            },
            {
                path: '/weblistpermohanan',
                name: 'WebListPermohonan',
                component: WebListPermohonan,
                meta: {
                    requiresAuth: true,
                    role: 'user'
                }
            },
            {
                path: '/webarsip',
                name: 'WebArsip',
                component: WebArsip,
                meta: {
                    requiresAuth: true,
                    role: 'user'
                }
            },
            {
                path: '/towermap',
                name: 'TowerMap',
                component: WebTowerMap,
                meta: {
                    requiresAuth: false,
                }
            },
            {
                path: '/zonamap',
                name: 'ZonaMap',
                component: WebZonaMap,
                meta: {
                    requiresAuth: false,
                }
            },
            {
                path: '/statistik',
                name: 'Statistik',
                component: WebStatistik,
                meta: {
                    requiresAuth: false,
                }
            },
            {
                path: '/datatower',
                name: 'DataTower',
                component: WebDataTower,
                meta: {
                    requiresAuth: false,
                }
            }
        ]
    },
    {
        path: '*',
        redirect: '/pages/404',
        name: 'Pages',
        component: Pages,
        children: [
            {
                path: '/pages/successregister',
                name: 'WebSuccessRegister',
                component: WebSuccessRegister,
                meta: {
                    requiresAuth: false,
                }
            },
            {
                path: '/pages/404',
                name: '404',
                component: NotFound,
            },
            {
                path: '/pages/login',
                name: 'Login',
                component: Login,
            },
            {
                path: '/pages/register',
                name: 'Register',
                component: Register,
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
                    path: '/admin/dashboard',
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

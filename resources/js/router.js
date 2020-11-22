// vuex
import store from './store'

import Vue from 'vue'
import VueRouter from 'vue-router'
//web user
const routes = [
        {
            path: '/admin',
            redirect: '/admin/dashboard',
            name: 'AdminApp',
            component: () => import('./screens/AdminApp'),
            children: [
                {
                    path: '/admin/skpd',
                    name: 'Skpd',
                    component: () => import('./screens/skpd/SkpdIndex.vue'),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
                {
                    path: '/admin/arsip',
                    name: 'Arsip',
                    component: () => import('./screens/arsip/ArsipIndex.vue'),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
                {
                    path: '/admin/permohonan',
                    name: 'Permohonan',
                    component: () => import('./screens/permohonan/PermohonanIndex.vue'),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
                {
                    path: '/admin/kunjungan',
                    name: 'Kunjungan',
                    component: () => import('./screens/kunjungan/KunjunganIndex.vue'),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
                {
                    path: '/admin/provider',
                    name: 'Provider',
                    component: () => import('./screens/provider/ProviderIndex.vue'),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
                {
                    path: '/admin/zona',
                    name: 'Zona',
                    component: () => import('./screens/zona/ZonaIndex.vue'),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
                {
                    path: '/admin/towerprovider/:tower_id',
                    name: 'TowerProvider',
                    component: () => import('./screens/tower_provider/TowerProviderIndex.vue'),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
                {
                    path: '/admin/tower',
                    name: 'Tower',
                    component: () => import('./screens/tower/TowerIndex.vue'),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
                {
                    path: '/admin/kategori',
                    name: 'Kategori',
                    component: () => import('./screens/kategori/KategoriIndex.vue'),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
                {
                    path: '/admin/dashboard',
                    name: 'Dashboard',
                    component: () => import('./screens/dashboard/TowerDashboard'),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
                {
                    path: '/admin/dashboardchart',
                    name: 'ChartDashboard',
                    component: () => import('./screens/dashboard/ChartDashboard'),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
                {
                    path: '/admin/dashboardzona',
                    name: 'ZonaDashboard',
                    component: () => import("./screens/dashboard/ZonaDashboard"),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
                {
                    path: '/admin/dashboardhotspot',
                    name: 'HotspotDashboard',
                    component: () => import("./screens/dashboard/HotspotDashboard"),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
                {
                    path: '/admin/crud',
                    name: 'Crud',
                    component: () => import( "./screens/dashboard/Crud"),
                    meta: {
                        requiresAuth: true,
                        role: 'super-admin'
                    }
                },
                {
                    path: '/admin/user',
                    name: 'User',
                    component: () => import('./screens/user/UserIndex.vue'),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
                {
                    path: '/admin/backbone',
                    name: 'Backbone',
                    component: () => import("./screens/backbone/Backbone"),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
                {
                    path: '/admin/profile',
                    name: 'Profile',
                    component: () => import("./screens/profile/ProfileIndex"),
                    meta: {
                        requiresAuth: true,
                        role: 'admin|super-admin'
                    }
                },
            ],
        },
        {
            path: '/',
            redirect: '/webhome',
            name: 'WebLayout',
            component: () => import("./screens/web/WebLayout.vue"),
            children: [
                {
                    path: '/webhome',
                    name: 'WebHome',
                    component: () => import("./screens/web/WebHome.vue"),
                    meta: {
                        requiresAuth: false,
                        redirectIfAuth: true,
                    }
                },
                {
                    path: '/weblistpermohanan',
                    name: 'WebListPermohonan',
                    component: () => import("./screens/web/ListPermohonan.vue"),
                    meta: {
                        requiresAuth: true,
                        role: 'user'
                    }
                },
                {
                    path: '/webarsip',
                    name: 'WebArsip',
                    component: () => import("./screens/web/WebArsip.vue"),
                    meta: {
                        requiresAuth: false,
                        // role: 'user'
                    }
                },
                {
                    path: '/towermap',
                    name: 'TowerMap',
                    component: () => import("./screens/web/TowerMap.vue"),
                    meta: {
                        requiresAuth: false,
                    }
                },
                {
                    path: '/zonamap',
                    name: 'ZonaMap',
                    component: () => import("./screens/web/ZonaMap.vue"),
                    meta: {
                        requiresAuth: false,
                    }
                },
                {
                    path: '/statistik',
                    name: 'Statistik',
                    component: () => import("./screens/web/Statistik.vue"),
                    meta: {
                        requiresAuth: false,
                    }
                },
                {
                    path: '/datatower',
                    name: 'DataTower',
                    component: () => import( "./screens/web/DataTower.vue"),
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
            component: () => import( "./screens/Pages"),
            children: [
                {
                    path: '/pages/successregister',
                    name: 'WebSuccessRegister',
                    component: () => import("./screens/pages/WebSuccessRegister.vue"),
                    meta: {
                        requiresAuth: false,
                    }
                },
                {
                    path: '/pages/404',
                    name: '404',
                    component: () => import("./screens/pages/404"),
                },
                {
                    path: '/pages/login',
                    name: 'Login',
                    component: () => import( "./screens/pages/Login"),
                },
                {
                    path: '/pages/register',
                    name: 'Register',
                    component: () => import("./screens/pages/Register"),
                }
            ]
        }
    ]
;

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
        if (store.state.auth.status) {
            if (store.state.auth.status && store.state.auth.data.role == 'super-admin') {
                next({
                    path: '/admin/dashboard',
                })
            } else {
                next();
            }
        } else {
            next()
        }
    } else {
        next();
    }
});


//end generated views

window.NProgress = require('nprogress');

const originalPush = VueRouter.prototype.push;
VueRouter.prototype.push = function push(location, onResolve, onReject) {
    if (onResolve || onReject) return originalPush.call(this, location, onResolve, onReject)
    return originalPush.call(this, location).catch(err => err)
};

Vue.use(VueRouter);

export default router;

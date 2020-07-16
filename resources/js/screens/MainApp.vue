<template>
    <div class="main-wrapper">
        <aside v-show="showSidebar" class="main-sidebar">
            <sidebar ref="sidebarRef"></sidebar>
        </aside>
        <section :class="showSidebar ? 'main-content margin-sidebar' : 'main-content'">
            <div class="d-flex align-items-center p-2 m-2">
                <a href="#" class="mr-3 d-none d-lg-block"  @click.prevent="toggleSidebar">
                    <i class="fa fa-bars" style="font-size: 18px;" aria-hidden="true"></i>
                </a>
                <div class="ml-auto d-flex align-items-center d-inline-block">
                    <a href="#" class="mr-3 d-lg-none"  @click.prevent="toggleSidebar">
                        <i class="fa fa-bars" style="font-size: 18px;" aria-hidden="true"></i>
                    </a>
                    <div id="profile-target">
                        <b-dropdown size="lg" menu-class="border-none shadow-sm" variant="transparent" right text="Right align" :no-caret="true">
                            <template slot="button-content">
                                <b-img :src="auth.data.avatar" v-bind="mainPropsImg" rounded="circle"
                                       alt="Circle image"></b-img>
                            </template>
                            <b-dropdown-item variant="dark" @click.prevent="pushRoute('/mainapp/profile')">
                                <span class="fa fa-user-circle"></span> Profil
                            </b-dropdown-item>
                            <b-dropdown-divider></b-dropdown-divider>
                            <b-dropdown-item variant="dark" @click.prevent="logout">
                                <span class="fa fa-lock"></span> Logout
                            </b-dropdown-item>
                        </b-dropdown>
                    </div>
                </div>
            </div>
            <div class="container-fluid content-wrap">
                <transition name="fade" mode="out-in">
                    <router-view></router-view>
                </transition>
            </div>
        </section>
    </div>
</template>

<script>
    import Sidebar from "../components/Sidebar.vue";

    export default {
        components: {
            'sidebar': Sidebar,
        },
        computed: {
            showSidebar() {
                return this.$store.state.showSidebar;
            },
            auth() {
                return this.$store.state.auth;
            }
        },
        created: function () {
            let w = screen.width;
            let varShowSidebar = w > 600;
            this.$store.commit("setShowSideBar", varShowSidebar);
            this.mobile = w < 600;
        },
        data: function () {
            return {
                collapsed: true,
                mainPropsImg: {blank: false, blankColor: '#777', width: 35, height: 35, class: 'm1'},
                showNotification: false,
                mobile: false,
            }
        },
        methods: {
            toggleNotif() {
                this.showNotification = !this.showNotification;
            },
            toggleSidebar() {
                this.$store.commit("toggleSideBar");
            },
            logout() {
                this.$refs.sidebarRef.logout();
            },
            pushRoute(url) {
                this.$router.push(url);
            },
        },
    }
</script>

<template>
    <div id="sidebar">
        <sidebar-menu :hide-toggle="true" theme="white-theme" width="250px" :menu="menu" >
            <div slot="header" class="mb-3 mt-3">
                <div class="d-flex align-items-center">
                    <img src="/images/tab.png" alt="logo" height="60" class="img pl-4 pr-4">
                    <h4>{{$store.state.appName}}</h4>
                </div>
            </div>
            <div slot="footer">
                <b-btn class="p-3" variant="primary" @click="logout" block>Logout <span class="fa fa-lock"></span></b-btn>
            </div>
        </sidebar-menu>
    </div>
</template>

<script>
    export default {
        computed: {
            role() {
                if (this.$store.state.auth) {
                    return this.$store.state.auth.data.role;
                } else {
                    return "user";
                }
            }
        },
        created: function () {
            // let w = screen.width;
            // this.mobile = w < 600;
            this.getData();
        },
        data: function () {
            return {
                mobile: false,
                initialShow: true,
                menu: []
            }
        },
        methods: {
            logout() {
                this.$dialog.confirm('Apakah Kamu Yakin?')
                    .then(() => {
                        this.axios.post('/logout');
                        this.makeToast("Logout");
                        this.$store.commit('setAuth', {
                            "status": false,
                            "token": "",
                            "data": {
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
                        });
                        this.$router.push({path: '/'});
                    });
            },
            getData() {
                this.axios.get('/api/select/menu').then(res=>{
                    this.menu = res.data;
                })
            },
        },
    }
</script>

<template>
    <div class="d-flex align-items-center justify-content-center h100vh">
        <b-card class="w-lg-50 p-4">
            <div class="login-forms">
                <div class="d-flex justify-content-center">
                    <router-link to="/">
                        <img src="/images/tab.png" alt="" height="100px">
                    </router-link>
                </div>
                <h4 class="mb-3 mt-1 text-center text-uppercase">
                    {{$store.state.appName}} Kabupaten Tabalong
                </h4>
                <form action="/api/login" type="POST" v-on:submit.prevent="login">
                    <b-form-group
                        placeholder="username"
                        label-for="username"
                        :invalid-feedback="invalidFeedback('username')"
                    >
                        <b-input
                            placeholder="username"
                            :state="inputState('username')"
                            autocomplete="username"
                            type="text"
                            id="username"
                            v-model="data.username"
                        ></b-input>
                    </b-form-group>

                    <b-form-group
                        placeholder="password"
                        label-for="password"
                        :invalid-feedback="invalidFeedback('password')"
                    >
                        <b-input
                            placeholder="password"
                            :state="inputState('password')"
                            type="password"
                            id="password"
                            autocomplete="new-password"
                            v-model="data.password"
                        ></b-input>
                    </b-form-group>
<!--                    <p>Belum punya akun? <router-link :to="{name:'Register'}">Daftar Sekarang</router-link></p>-->
                    <b-button variant="primary" class="shadow btn-block mt-3" type="submit">LOGIN</b-button>
                </form>
            </div>
        </b-card>
    </div>
</template>

<script>
    export default {
        name: 'Login',
        data() {
            return {
                errors: [],
                data: {
                    username: "",
                    password: "",
                    // device_name: navigator.userAgent,
                },
                authdata: {
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
                }
            }
        },
        methods: {
            login() {
                this.axios.get('/sanctum/csrf-cookie').then(res => {
                    this.axios.post('/login', this.data).then(res => {
                        if(res.status == 204){
                            this.authdata.status = true;
                            this.axios.get('/api/profile').then(res => {
                                this.authdata.data = res.data;
                                this.authdata.status = true;
                                // this.authdata.token = token;
                                this.makeToast("Success","Login Success");
                                this.$nextTick(()=>{
                                    this.$store.commit("setAuth", this.authdata);
                                    this.$store.commit("resetRefresh");
                                    if(this.authdata.data.role != 'user'){
                                        this.$router.push({path: "/admin/dashboard"});
                                    }else{
                                        this.$router.push({path: "/"});
                                    }
                                });
                            });
                        }
                    }).catch(error => {
                        if (error.response) {
                            this.errors = error.response.data.errors;
                        }
                        this.$message.error(error.response.data.message)
                    });
                })
            },
            invalidFeedback(key) {
                return this.errors[key] ? this.errors[key].join() : ''
            },
            inputState(key) {
                return this.errors[key] ? false : null
            },
        }
    }
</script>


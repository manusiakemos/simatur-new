<template>
    <div class="d-flex align-items-center justify-content-center h100vh">
        <div class="center-content login-bg">
            <div class="login-form">
                <form action="/api/login" type="POST" v-on:submit.prevent="auth">
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

                    <b-button variant="primary" class="shadow btn-block mt-3" type="submit">LOGIN</b-button>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .form-control{
        border-radius: 30px !important;
    }
</style>

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
            auth() {
                this.axios.get('/airlock/csrf-cookie').then(res => {
                    this.axios.post('/login', this.data).then(res => {
                        if(res.status == 204){
                            this.authdata.status = true;
                            this.$router.push({path: "/mainapp/dashboard"});
                            this.axios.get('/api/profile').then(res => {
                                this.authdata.data = res.data;
                                this.authdata.status = true;
                                // this.authdata.token = token;
                                this.$nextTick(()=>{
                                    this.$store.commit("setAuth", this.authdata);
                                    this.$store.commit("resetRefresh");
                                    this.$router.push({path: "/mainapp/dashboard"});
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


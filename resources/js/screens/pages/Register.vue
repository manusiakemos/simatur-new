<template>
    <div class="d-flex align-items-center justify-content-center h100vh">
        <b-card class="w-lg-50 p-4">
            <div>
                <div class="d-flex justify-content-center">
                    <router-link to="/">
                        <img src="/images/tab.png" alt="" height="100px">
                    </router-link>
                </div>
                <h4 class="mb-3 mt-1 text-center text-uppercase">
                    {{$store.state.appName}} Kabupaten Tabalong
                </h4>
                <form action="/api/login" type="POST" v-on:submit.prevent="register">
                    <b-form-group
                        placeholder="name"
                        label-for="name"
                        :invalid-feedback="invalidFeedback('name')"
                    >
                        <b-input
                            placeholder="name"
                            :state="inputState('name')"
                            autocomplete="name"
                            type="text"
                            id="name"
                            v-model="data.name"
                        ></b-input>
                    </b-form-group>

                    <b-form-group
                        placeholder="email"
                        label-for="email"
                        :invalid-feedback="invalidFeedback('email')"
                    >
                        <b-input
                            placeholder="email"
                            :state="inputState('email')"
                            autocomplete="email"
                            type="email"
                            id="email"
                            v-model="data.email"
                        ></b-input>
                    </b-form-group>

                    <b-form-group
                        placeholder="phone"
                        label-for="phone"
                        :invalid-feedback="invalidFeedback('phone')"
                    >
                        <b-input
                            placeholder="phone"
                            :state="inputState('phone')"
                            autocomplete="phone"
                            type="text"
                            id="phone"
                            v-model="data.phone"
                        ></b-input>
                    </b-form-group>

                    <b-form-group
                        placeholder="provider"
                        label-for="provider_id"
                        :invalid-feedback="invalidFeedback('provider_id')"
                    >
                        <select-ajax
                            api-url="/api/select/provider"
                            option-text="provider_name"
                            option-value="provider_id"
                            id="provider_id"
                            v-model="data.provider_id"
                        ></select-ajax>
                        <small class="text-danger">{{invalidFeedback('provider_id')}}</small>
                    </b-form-group>

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
                    <b-form-group
                        label-for="password_confirmation"
                        :invalid-feedback="invalidFeedback('password_confirmation')"
                    >
                        <b-input
                            placeholder="password confirmation"
                            :state="inputState('password_confirmation')"
                            type="password"
                            id="password_confirmation"
                            autocomplete="new-password_confirmation"
                            v-model="data.password_confirmation"
                        ></b-input>
                    </b-form-group>
                    <p>Sudah punya akun? <router-link :to="{name:'Login'}">Login Sekarang</router-link></p>
                    <b-button variant="primary" class="shadow btn-block mt-3" type="submit">DAFTAR</b-button>
                </form>
            </div>
        </b-card>
    </div>
</template>

<script>
    export default {
        name: 'Register',
        data() {
            return {
                errors: [],
                data: {
                    username: "",
                    password: "",
                    // device_name: navigator.userAgent,
                },
                hasRegistered: false,
            }
        },
        methods: {
            invalidFeedback(key) {
                return this.errors[key] ? this.errors[key].join() : ''
            },
            inputState(key) {
                return this.errors[key] ? false : null
            },
            register() {
                this.axios.post('/api/register', this.data).then(res => {
                    this.makeToast(res.data.text, res.data.message);
                    this.$nextTick(() => {
                        setTimeout(() =>this.$router.push('/'),1000);
                    });
                }).catch(error => {
                    if (error.response) {
                        this.errors = error.response.data.errors;
                    }
                    this.$message.error(error.response.data.message)
                });
            },
        }
    }
</script>


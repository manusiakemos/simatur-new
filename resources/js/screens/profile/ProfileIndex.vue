<template>
    <div class="row">
        <div class="col-12">
            <b-breadcrumb class="bg-white shadow-sm" :items="items"></b-breadcrumb>

            <b-card class="shadow" border-variant="light">
                <div class="d-lg-flex d-lg-inline-block">
                    <div class="d-block mb-2 p-4 d-flex justify-content-center" @click="showModalUpload">
                        <div class="wrapper-avatar">
                            <b-img-lazy :src="userData.avatar" width="300" height="300"></b-img-lazy>
                            <div class="avatar-overlay d-flex justify-content-center align-items-center">
                                <span class="fa fa-plus fa-4x text-white"></span>
                            </div>
                        </div>
                    </div>

                    <div class="d-block ml-3 w-100 pr-4">
                        <b-form-group
                            id="username-group"
                            label="Username"
                            label-for="username"
                            :invalid-feedback="this.errors && this.errors.username ? this.errors.username.join() : ''"
                            :state="this.errors && this.errors.username ? false : true"
                        >
                            <b-form-input id="username"
                                          v-model="user.username"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="name-group"
                            label="Name"
                            label-for="name"
                            :invalid-feedback="this.errors && this.errors.name ? this.errors.name.join() : ''"
                            :state="this.errors && this.errors.name ? false : true"
                        >
                            <b-form-input id="name"
                                          v-model="user.name"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="phone-group"
                            label="Phone"
                            label-for="phone"
                            :invalid-feedback="this.errors && this.errors.phone ? this.errors.phone.join() : ''"
                            :state="this.errors && this.errors.phone ? false : true"
                        >
                            <b-form-input id="phone"
                                          v-model="user.phone"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="email-group"
                            label="Email"
                            label-for="email"
                            :invalid-feedback="this.errors && this.errors.email ? this.errors.email.join() : ''"
                            :state="this.errors && this.errors.email ? false : true"
                        >
                            <b-form-input id="email"
                                          type="email"
                                          v-model="user.email"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="password-group"
                            label="Password"
                            label-for="password"
                            :invalid-feedback="this.errors && this.errors.password ? this.errors.password.join() : ''"
                            :state="this.errors && this.errors.password ? false : true"
                        >
                            <b-form-input id="password"
                                          type="password"
                                          autocomplete="new-password"
                                          v-model="user.password"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="password_confirmation-group"
                            label="Password Confirmation"
                            label-for="password_confirmation"
                            :invalid-feedback="this.errors && this.errors.password_confirmation ? this.errors.password_confirmation.join() : ''"
                            :state="this.errors && this.errors.password_confirmation ? false : true"
                        >
                            <b-form-input id="password_confirmation"
                                          type="password"
                                          v-model="user.password_confirmation"
                            ></b-form-input>
                        </b-form-group>

                        <div class="mt-5">
                            <b-btn
                                @click="updateProfile"
                                class="float-right"
                                variant="primary">Update Profile
                            </b-btn>
                        </div>
                    </div>
                </div>
            </b-card>

            <b-modal v-model="show_modal" no-header>
                <upload-file v-model="file"></upload-file>
                <template v-slot:modal-footer="{ ok, cancel, hide }">
                    <b-button variant="primary" @click="show_modal = false">
                        Tutup
                    </b-button>
                    <b-button variant="primary" @click="submitFile()">
                        Upload
                    </b-button>
                </template>
            </b-modal>
        </div>
    </div>
</template>

<script>
    import UploadFile from "../../components/UploadFile";

    export default {
        components: {
            UploadFile
        },
        computed: {
            userData() {
                return this.$store.state.auth.data;
            }
        },
        mounted() {
            this.user = this.userData
        },
        methods: {
            updateProfile() {
                this.loading = true;
                this.axios.put(this.user.links.update, this.user).then(res => {
                    var d = res.data;
                    if (res.data.status) {
                        this.$store.commit("setAuthData", d);
                        this.loading = false;
                        this.errors = [];
                        this.$message({
                            type: res.data.text,
                            message: res.data.message
                        });
                    }
                }).catch(err => {
                    this.errors = err.response.data.errors;
                });
                this.loading = false;
            },
            onSuccessUpload() {
                this.axios.get('/api/profile').then(res => {
                    this.$store.commit("setAuthData", res.data);
                    this.makeToast('Avatar berhasil diupdate');
                });
            },
            showModalUpload() {
                this.show_modal = true;
            },
            submitFile() {
                let formData = new FormData();
                formData.append('file', this.file);
                this.axios.post('/api/profile/avatar', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(res => {
                    this.onSuccessUpload();
                }).catch(err => {
                    this.makeToast(err);
                });
            },
        },
        data() {
            return {
                items: [
                    {
                        text: 'Admin',
                        href: '#'
                    },
                    {
                        text: 'Manage',
                        href: '#'
                    },
                    {
                        text: 'Library',
                        active: true
                    }
                ],
                user: '',
                errors: [],
                loading: false,
                modal_title: "Change Avatar",
                show_modal: false,
                headers: {
                    // 'Authorization': 'Bearer ' + this.$store.state.auth.token,
                    'X-XSRF-TOKEN': getCookie('XSRF-TOKEN')
                },
                file: "",
            }
        },
    }
</script>

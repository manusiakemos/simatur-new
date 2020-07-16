<template>
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item">
                        <router-link :to="{name:'Dashboard'}">Dashboard</router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">user</li>
                </ol>
            </nav>
            <b-card class="shadow-sm" border-variant="light">
                <div class="mb-3">
                    <b-btn variant="primary" @click="create">
                        <span class="fa fa-plus"></span>
                        Tambah
                    </b-btn>

                    <b-btn variant="primary" @click="refreshDt">
                        <span class="fa fa-recycle"></span>
                        Refresh
                    </b-btn>
                </div>
                <datatables
                    :config-dt="configDt"
                    selector="dt-user"
                    ref="dt">
                </datatables>
            </b-card>
        </div>
        <div class="col-12">
            <b-modal :title="modal_title"
                     header-bg-variant="primary"
                     header-text-variant="light"
                     size="xl"
                     v-model="show_modal"
                     @ok="show_modal = false">
                <b-form-group
                    label="Nama"
                    label-for="name"
                    :invalid-feedback="this.errors && this.errors.name ? this.errors.name.join() : ''"
                    :state="this.errors && this.errors.name ? false : true"
                >
                    <b-form-input id="name"
                                  v-model="data.name"
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    label="Email"
                    label-for="email"
                    :invalid-feedback="this.errors && this.errors.email ? this.errors.email.join() : ''"
                    :state="this.errors && this.errors.email ? false : true"
                >
                    <b-form-input id="email"
                                  v-model="data.email"
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    label="Username"
                    label-for="username"
                    :invalid-feedback="this.errors && this.errors.username ? this.errors.username.join() : ''"
                    :state="this.errors && this.errors.username ? false : true"
                >
                    <b-form-input id="username"
                                  v-model="data.username"
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    label="Avatar"
                    label-for="avatar"
                    :invalid-feedback="this.errors && this.errors.avatar ? this.errors.avatar.join() : ''"
                    :state="this.errors && this.errors.avatar ? false : true"
                >
                    <b-form-file v-model="file"></b-form-file>
                </b-form-group>
                <b-form-group
                    label="Phone"
                    label-for="phone"
                    :invalid-feedback="this.errors && this.errors.phone ? this.errors.phone.join() : ''"
                    :state="this.errors && this.errors.phone ? false : true"
                >
                    <b-form-input id="phone"
                                  v-model="data.phone"
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    label="Role Level"
                    label-for="role"
                    :invalid-feedback="this.errors && this.errors.role ? this.errors.role.join() : ''"
                    :state="this.errors && this.errors.role ? false : true"
                >
                    <radio-ajax v-model="data.role"
                                api-url="/api/select/role"
                                option-text="text"
                                option-value="value">
                    </radio-ajax>
                </b-form-group>
                <b-form-group
                    label="Password"
                    label-for="password"
                    :invalid-feedback="this.errors && this.errors.password ? this.errors.password.join() : ''"
                    :state="this.errors && this.errors.password ? false : true"
                >
                    <b-form-input id="password"
                                  v-model="data.password"
                    ></b-form-input>
                </b-form-group>


                <template v-slot:modal-footer>
                    <div class="w-100">
                        <div class="d-flex">
                            <b-button
                                variant="secondary"
                                class="ml-auto"
                                @click="show_modal=false"
                            >
                                Tutup
                            </b-button>
                            <b-button v-if="action == 'store'"
                                      variant="primary"
                                      class="ml-1"
                                      @click="store"
                            >
                                Simpan
                            </b-button>
                            <b-button v-else
                                      variant="primary"
                                      class="ml-1"
                                      @click="update"
                            >
                                Simpan
                            </b-button>
                        </div>
                    </div>
                </template>
            </b-modal>
        </div>
    </div>
</template>

<script>
    import RemoteDataTables from '../../components/RemoteDataTables.vue';

    export default {
        components: {
            'datatables': RemoteDataTables,
        },
        created() {
            this.data2 = this.data;
        },
        mounted() {
            this.setDt();
        },
        watch: {
            show_modal: function (value) {
                value == false ? this.errors = [] : '';
            }
        },
        data: function () {
            return {
                title: 'User Datatable',
                action: 'store',
                show_modal: false,
                modal_title: 'Tambah User',
                data: {
                    id: "",
                    name: "",
                    email: "",
                    username: "",
                    avatar: "",
                    phone: "",
                    role: "",
                    password: "",
                    api_token: "",
                    remember_token: "",
                    email_verified_at: "",
                    links: {
                        store: "/api/user",
                        update: "/api/user",
                        show: "/api/user",
                        destroy: "/api/user",
                    }
                },
                data2: null,
                errors: [],
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                upload: true,
                configDt: {
                    ajax: {
                        type: "GET",
                        url: "/api/user",
                    },
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    language: {
                        "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                        "sProcessing": "Sedang memproses...",
                        "sLengthMenu": "Tampilkan _MENU_ entri",
                        "sZeroRecords": "Tidak ditemukan data yang sesuai",
                        "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                        "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                        "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                        "sInfoPostFix": "",
                        "sSearch": "Cari:",
                        "sUrl": "",
                        "oPaginate": {
                            "sFirst": "Pertama",
                            "sPrevious": "Sebelumnya",
                            "sNext": "Selanjutnya",
                            "sLast": "Terakhir"
                        },
                        lengthMenu: 'Menampilkan <select class="form-control">' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">All</option>' +
                        '</select> Data Perhalaman',
                    },
                    columns: [
                        {title: "Nama", data: "name", class: "auto"},
                        {title: "Email", data: "email", class: "auto"},
                        {title: "Username", data: "username", class: "auto"},
                        {title: "Avatar", data: "avatar", class: "auto"},
                        {title: "Phone", data: "phone", class: "auto"},
                        {title: "Role Level", data: "role", class: "auto"},
                        {title: "Action", data: "action", class: "text-center w-25 all"}
                    ]
                },
                file: null,
            }
        },
        methods: {
            setDt() {
                var vm = this;
                var el = this.$refs.dt.$el
                $(el).find("#dt-user").on("click", ".btn-edit", function (e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    vm.edit(url);
                }).on("click", ".btn-destroy", function (e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    vm.destroy(url);
                })
            },
            refreshDt() {
                this.$refs.dt.refresh();
            },
            create() {
                this.data = _.cloneDeep(this.data2);
                this.action = 'store';
                this.modal_title = 'Tambah User';
                this.show_modal = true;
            },
            edit(url) {
                this.modal_title = 'Edit User';
                this.action = 'update';
                this.axios.get(url).then(res => {
                    this.data = _.cloneDeep(res.data);
                });
                this.show_modal = true;
            },
            store() {
                var data = this.makeFormData(this.data);
                if (this.upload) {
                    data.append('file', this.file);
                }
                var url = this.data.links.store;
                this.handleRequest(url, data);
            },
            update() {
                var data = this.makeFormData(this.data);
                data.append('_method', 'PUT');
                if (this.upload) {
                    data.append('file', this.file);
                }
                var url = this.data.links.update;
                this.handleRequest(url, data);
            },
            handleRequest(url, data) {
                if (this.upload) {
                    this.axios.post(url, data, this.headers).then(res => {
                        if (res.data.status) {
                            this.makeToast(res.data.text, res.data.message)
                            this.show_modal = false;
                            this.refreshDt();
                        }
                    }).catch(error => {
                        if (error.response) {
                            this.errors = error.response.data.errors;
                        }
                    });
                } else {
                    this.axios.post(url, data).then(res => {
                        if (res.data.status) {
                            this.makeToast(res.data.text, res.data.message)
                            this.show_modal = false;
                            this.refreshDt();
                        }
                    }).catch(error => {
                        if (error.response) {
                            this.errors = error.response.data.errors;
                        }
                    });
                }
            },
            destroy(url) {
                this.$dialog.confirm('Apakah Kamu Yakin?').then(() => {
                    this.axios.delete(url).then(res => {
                        this.makeToast(res.data.text, res.data.message)
                        if (res.data.status) {
                            this.refreshDt();
                        }
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: 'User batal dihapus'
                    });
                    this.refreshDt();
                });
            }
        }
    }
</script>

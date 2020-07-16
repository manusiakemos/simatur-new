<template>
    <div class="row">
        <div class="col-12">
            <b-breadcrumb class="bg-white shadow-sm" :items="items"></b-breadcrumb>
            <b-card class="shadow" border-variant="light">
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
                    :url="configDt.url"
                    :columns="configDt.columns"
                    selector="dt-brand"
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
                    label="Brand"
                    label-for="brand_name"
                    :invalid-feedback="this.errors && this.errors.brand_name ? this.errors.brand_name.join() : ''"
                    :state="this.errors && this.errors.brand_name ? false : true"
                >
                    <b-form-input id="brand_name"
                                  v-model="data.brand_name"
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    label="Status"
                    label-for="brand_status"
                    :invalid-feedback="this.errors && this.errors.brand_status ? this.errors.brand_status.join() : ''"
                    :state="this.errors && this.errors.brand_status ? false : true"
                >
                    <radio-ajax v-model="data.brand_status"
                                api-url="/api/select/status"
                                option-text="text"
                                option-value="value">
                    </radio-ajax>
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
    import MyDataTables from '../../components/MyDataTables.vue';

    export default {
        components: {
            'datatables': MyDataTables,
        },
        created() {
            this.data2 = this.data;
        },
        mounted() {
            this.setDt();
        },
        data: function () {
            return {
                title: 'Brand Datatable',
                action: 'store',
                show_modal: false,
                modal_title: 'Tambah Brand',
                data: {
                    brand_id: "",
                    brand_name: "",
                    brand_status: "",
                    links: {
                        store: "/api/brand",
                        update: "/api/brand",
                        show: "/api/brand",
                        destroy: "/api/brand",
                    }
                },
                data2: null,
                errors: [],
                items: [
                    {
                        text: 'Dashboard',
                        href: '#mainapp/dashboard'
                    },
                    {
                        text: 'Brand Datatable',
                        active: true
                    }
                ],
                configDt: {
                    url: "/api/brand",
                    columns: [
                        {title: "Brand", data: "brand_name", class: "all"},
                        {title: "Status", data: "brand_status", class: "all"},
                        {title: "Action", data: "action", class: "text-center w-25 all"}
                    ]
                },
            }
        },
        methods: {
            setDt() {
                var vm = this;
                $(document).find("#dt-brand").on("click", ".btn-edit", function (e) {
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
                this.modal_title = 'Tambah Brand';
                this.show_modal = true;
            },
            edit(url) {
                this.modal_title = 'Edit Brand';
                this.action = 'update';
                this.axios.get(url).then(res => {
                    this.data = _.cloneDeep(res.data);
                });
                this.show_modal = true;
            },
            store() {
                var data = this.makeFormData(this.data);
                var url = this.data.links.store;
                this.handleRequest(url, data);
            },
            update() {
                var data = this.makeFormData(this.data);
                data.append('_method', 'PUT');
                var url = this.data.links.update;
                this.handleRequest(url, data);
            },
            handleRequest(url, data, upload = false) {
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
                        message: 'Brand batal dihapus'
                    });
                    this.refreshDt();
                });
            }
        }
    }
</script>

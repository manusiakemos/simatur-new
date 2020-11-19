<template>
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item">
                        <router-link :to="{name:'Dashboard'}">Dashboard</router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Provider</li>
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

                    <b-btn variant="primary" @click="generatePdf">
                        <span class="fa fa-file-pdf"></span>
                        Generate PDF
                    </b-btn>
                </div>
                <div v-if="data_print" id="print" class="d-none d-print-block">
                    <h4 class="text-center text-capitalize">Laporan provider</h4>
                    <table class="table table-bordered">
                        <thead class="bg-primary text-white">
                        <tr>
                            <th v-for="(v,i) in configDt.columns" v-if="v.print" :class="v.class">
                                {{ v.title }}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(value,index) in data_print.data">
                            <td v-for="(v,i) in configDt.columns" v-if="v.print" :class="v.class">
                                <span v-html="value[v.data]"></span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <datatables
                    :config-dt="configDt"
                    selector="dt-provider"
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
                    label="Nama Provider"
                    label-for="provider_name"
                    :invalid-feedback="this.errors && this.errors.provider_name ? this.errors.provider_name.join() : ''"
                    :state="this.errors && this.errors.provider_name ? false : true"
                >
                    <b-form-input id="provider_name"
                                  v-model="data.provider_name"
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                    label="Komersil"
                    label-for="is_komersil"
                    :invalid-feedback="this.errors && this.errors.is_komersil ? this.errors.is_komersil.join() : ''"
                    :state="this.errors && this.errors.is_komersil ? false : true"
                >
                    <select-ajax
                        api-url="/api/select/boolean"
                        id="is_komersil"
                        v-model="data.is_komersil"
                    ></select-ajax>
                </b-form-group>

                <b-form-group
                    label="Warna"
                    label-for="provider_color"
                    :invalid-feedback="this.errors && this.errors.provider_color ? this.errors.provider_color.join() : ''"
                    :state="this.errors && this.errors.provider_color ? false : true"
                >
                    <b-form-input id="provider_color"
                                  type="color"
                                  v-model="data.provider_color"
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                    label="Provider Tipe"
                    label-for="provider_type"
                    :invalid-feedback="this.errors && this.errors.provider_type ? this.errors.provider_type.join() : ''"
                    :state="this.errors && this.errors.provider_type ? false : true"
                >
                    <select-ajax v-model="data.provider_type"
                                 api-url="/api/select/provider_type"
                                 option-text="text"
                                 option-value="value">
                    </select-ajax>
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
    data: function () {
        return {
            title: 'Provider Datatable',
            action: 'store',
            show_modal: false,
            modal_title: 'Tambah Provider',
            data: {
                provider_id: "",
                provider_name: "",
                provider_color: "",
                is_komersil: "",
                provider_type: "provider",
                links: {
                    store: "/api/provider",
                    update: "/api/provider",
                    show: "/api/provider",
                    destroy: "/api/provider",
                }
            },
            data2: null,
            data_print: null,
            errors: [],
            headers: {
                'Content-Type': 'multipart/form-data'
            },
            upload: false,
            configDt: {
                ajax: {
                    type: "GET",
                    url: "/api/provider",
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
                    {
                        name: "provider_name",
                        print: true,
                        title: "Nama Provider",
                        data: "provider_name",
                        class: "auto"
                    },
                    {name: "is_komersil", print: true, title: "Komersil", data: "is_komersil", class: "auto"},
                    {name: "provider_color", print: false, title: "Warna", data: "provider_color", class: "auto"},
                    {
                        name: "provider_type",
                        print: true,
                        title: "Tipe Provider",
                        data: "provider_type",
                        class: "auto"
                    },
                    {title: "Action", data: "action", class: "text-center w-25 all"}
                ]
            },
            file: null,
        }
    },
    methods: {
        async generatePdf() {
            var res = await this.axios.get('/api/provider?print=true');
            this.data_print = res.data;
            this.$nextTick(() => {
                this.printPdf('portrait')
            })
        },
        setDt() {
            var vm = this;
            var el = this.$refs.dt.$el
            $(el).find("#dt-provider").on("click", ".btn-edit", function (e) {
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
            this.modal_title = 'Tambah Provider';
            this.show_modal = true;
        },
        edit(url) {
            this.modal_title = 'Edit Provider';
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
                    message: 'Provider batal dihapus'
                });
                this.refreshDt();
            });
        }
    }
}
</script>

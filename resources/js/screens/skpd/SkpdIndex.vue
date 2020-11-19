<template>
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item">
                        <router-link :to="{name:'Dashboard'}">Dashboard</router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">skpd</li>
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
                    <h4 class="text-center text-capitalize">Laporan skpd</h4>
                    <table class="table table-bordered">
                        <thead class="bg-primary text-white">
                        <tr>
                            <th v-for="(v,i) in configDt.columns" v-if="v.print" :class="v.class">
                                {{v.title}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(value,index) in data_print.data">
                            <td v-for="(v,i) in configDt.columns" v-if="v.print" :class="v.class">
                                {{value[v.data]}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <datatables
                    :config-dt="configDt"
                    selector="dt-skpd"
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
                    label="Nama SKPD"
                    label-for="skpd_nama"
                    :invalid-feedback="this.errors && this.errors.skpd_nama ? this.errors.skpd_nama.join() : ''"
                    :state="this.errors && this.errors.skpd_nama ? false : true"
                >
                    <b-form-input id="skpd_nama"
                                  v-model="data.skpd_nama"
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    label="Aktif"
                    label-for="skpd_status"
                    :invalid-feedback="this.errors && this.errors.skpd_status ? this.errors.skpd_status.join() : ''"
                    :state="this.errors && this.errors.skpd_status ? false : true"
                >
                    <radio-ajax v-model="data.skpd_status"
                                api-url="/api/select/boolean"
                                option-text="text"
                                option-value="value">
                    </radio-ajax>
                </b-form-group>
                <b-form-group
                    label="IP"
                    label-for="skpd_ip"
                    :invalid-feedback="this.errors && this.errors.skpd_ip ? this.errors.skpd_ip.join() : ''"
                    :state="this.errors && this.errors.skpd_ip ? false : true"
                >
                    <b-form-input id="skpd_ip"
                                  v-model="data.skpd_ip"
                    ></b-form-input>
                </b-form-group>
                <!--  <b-form-group
                      label="Tipe"
                      label-for="skpd_tipe"
                      :invalid-feedback="this.errors && this.errors.skpd_tipe ? this.errors.skpd_tipe.join() : ''"
                      :state="this.errors && this.errors.skpd_tipe ? false : true"
                  >
                      <select-ajax id="skpd_tipe"
                                   api-url="/api/select/skpd_tipe"
                                   option-text="text"
                                   option-value="value"
                                   v-model="data.skpd_tipe"
                      ></select-ajax>
                  </b-form-group>-->
                <b-form-group
                    label="Kode"
                    label-for="skpd_kode"
                    :invalid-feedback="this.errors && this.errors.skpd_kode ? this.errors.skpd_kode.join() : ''"
                    :state="this.errors && this.errors.skpd_kode ? false : true"
                >
                    <b-form-input id="skpd_kode"
                                  v-model="data.skpd_kode"
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    label="Keterangan"
                    label-for="skpd_keterangan"
                    :invalid-feedback="this.errors && this.errors.skpd_keterangan ? this.errors.skpd_keterangan.join() : ''"
                    :state="this.errors && this.errors.skpd_keterangan ? false : true"
                >
                    <b-form-textarea id="skpd_keterangan"
                                     rows="3"
                                     max-rows="6"
                                     v-model="data.skpd_keterangan"
                    ></b-form-textarea>
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
                title: 'Skpd Datatable',
                action: 'store',
                show_modal: false,
                modal_title: 'Tambah Skpd',
                data: {
                    skpd_id: "",
                    skpd_nama: "",
                    skpd_status: 1,
                    skpd_ip: "",
                    skpd_tipe: "",
                    skpd_kode: "",
                    skpd_keterangan: "",
                    links: {
                        store: "/api/skpd",
                        update: "/api/skpd",
                        show: "/api/skpd",
                        destroy: "/api/skpd",
                    }
                },
                data2: null, data_print: null,
                errors: [],
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                upload: false,
                configDt: {
                    ajax: {
                        type: "GET",
                        url: "/api/skpd",
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
                        {name: "skpd_nama", print: true, title: "Nama SKPD", data: "skpd_nama", class: "auto"},
                        {name: "skpd_status", print: true, title: "Status", data: "skpd_status", class: "auto"},
                        {name: "skpd_ip", print: true, title: "IP", data: "skpd_ip", class: "auto"},
                        {name: "skpd_tipe", print: true, title: "Tipe", data: "skpd_tipe", class: "auto"},
                        {name: "skpd_kode", print: true, title: "Kode", data: "skpd_kode", class: "auto"},
                        {
                            name: "skpd_keterangan",
                            print: true,
                            title: "Keterangan",
                            data: "skpd_keterangan",
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
                var res = await this.axios.get('/api/skpd?print=true');
                this.data_print = res.data;
                this.$nextTick(() => {
                    this.printPdf('portrait')
                })
            },
            setDt() {
                var vm = this;
                var el = this.$refs.dt.$el
                $(el).find("#dt-skpd").on("click", ".btn-edit", function (e) {
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
                this.modal_title = 'Tambah Skpd';
                this.show_modal = true;
            },
            edit(url) {
                this.modal_title = 'Edit Skpd';
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
                        message: 'Skpd batal dihapus'
                    });
                    this.refreshDt();
                });
            }
        }
    }
</script>

<template>
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item">
                        <router-link :to="{name:'Dashboard'}">Dashboard</router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Kunjungan</li>
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

                <div class="mt-3 mb-3">
                    <b-form-group>
                        <my-date-picker placeholder="Tahun" type="year" v-model="tahun" format="YYYY"></my-date-picker>
                    </b-form-group>
                </div>
                <datatables
                    :config-dt="configDt"
                    selector="dt-kunjungan"
                    ref="dt">
                </datatables>
            </b-card>
        </div>

        <div class="col-12">
            <div v-if="data_print" id="print" class="d-none d-print-block">
                <div class="text-center">
                    <report-heading></report-heading>
                    <h4 class="text-center text-uppercase">Laporan kunjungan</h4>
                </div>
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
        </div>

        <div class="col-12">
            <b-modal :title="modal_title"
                     header-bg-variant="primary"
                     header-text-variant="light"
                     size="xl"
                     v-model="show_modal"
                     @ok="show_modal = false">
                <b-form-group
                    label="Tanggal"
                    label-for="kunjungan_tanggal"
                    :invalid-feedback="this.errors && this.errors.kunjungan_tanggal ? this.errors.kunjungan_tanggal.join() : ''"
                    :state="this.errors && this.errors.kunjungan_tanggal ? false : true"
                >
                    <my-date-picker type="date" id="kunjungan_tanggal"
                                    format="YYYY-MM-DD"
                                    v-model="data.kunjungan_tanggal"
                    ></my-date-picker>
                </b-form-group>
                <b-form-group
                    label="Tower"
                    label-for="tower_id"
                    :invalid-feedback="this.errors && this.errors.tower_id ? this.errors.tower_id.join() : ''"
                    :state="this.errors && this.errors.tower_id ? false : true"
                >
                    <select-ajax id="tower_id"
                                 api-url="/api/select/tower"
                                 option-text="tower_label"
                                 option-value="tower_id"
                                 v-model="data.tower_id"
                    ></select-ajax>
                </b-form-group>
                <b-form-group
                    label="Gambar"
                    label-for="kunjungan_gambar"
                    :invalid-feedback="this.errors && this.errors.kunjungan_gambar ? this.errors.kunjungan_gambar.join() : ''"
                    :state="this.errors && this.errors.kunjungan_gambar ? false : true"
                >
                    <b-form-file v-model="file"></b-form-file>
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
        watch:{
            tahun(value){
                this.$refs.dt.destroy();
                this.configDt.ajax.data.filter_tahun = value;
                this.$nextTick(() => {
                    this.$refs.dt.initDt();
                })
            }
        },
        data: function () {
            return {
                title: 'Kunjungan Datatable',
                action: 'store',
                show_modal: false,
                modal_title: 'Tambah Kunjungan',
                data: {
                    kunjungan_id: "",
                    kunjungan_tanggal: "",
                    tower_id: "",
                    kunjungan_gambar: "",
                    links: {
                        store: "/api/kunjungan",
                        update: "/api/kunjungan",
                        show: "/api/kunjungan",
                        destroy: "/api/kunjungan",
                    }
                },
                data2: null, data_print: null,
                errors: [],
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                upload: true,
                configDt: {
                    ajax: {
                        type: "GET",
                        url: "/api/kunjungan",
                        data:{
                            filter_tahun:""
                        }
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
                            name: "kunjungan_tanggal",
                            print: true,
                            title: "Tanggal",
                            data: "kunjungan_tanggal",
                            class: "auto"
                        },
                        {name: "tb_tower.tower_kode", print: true, title: "Tower", data: "tower_kode", class: "auto"},
                        {name: "tb_provider.provider_name", print: true, title: "Provider", data: "provider_name", class: "auto"},
                        {name: "tb_kecamatan.kecamatan_nama", print: true, title: "Kecamatan", data: "kecamatan_nama", class: "auto"},
                        {name: "tb_kelurahan.kelurahan_nama", print: true, title: "Desa/Kelurahan", data: "kelurahan_nama", class: "auto"},
                        {
                            name: "kunjungan_gambar",
                            print: false,
                            title: "Gambar",
                            data: "kunjungan_gambar",
                            class: "auto"
                        },
                        {title: "Action", data: "action", class: "text-center w-25 all"}
                    ]
                },
                file: null,
                tahun: this.currentYear(),
            }
        },
        methods: {
            async generatePdf() {
                var res = await this.axios.get(`/api/kunjungan?print=true&filter_tahun=${this.tahun}`);
                this.data_print = res.data;
                this.$nextTick(() => {
                    this.printPdf('portrait')
                })
            },
            setDt() {
                var vm = this;
                var el = this.$refs.dt.$el
                $(el).find("#dt-kunjungan").on("click", ".btn-edit", function (e) {
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
                this.modal_title = 'Tambah Kunjungan';
                this.show_modal = true;
            },
            edit(url) {
                this.modal_title = 'Edit Kunjungan';
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
                        message: 'Kunjungan batal dihapus'
                    });
                    this.refreshDt();
                });
            }
        }
    }
</script>

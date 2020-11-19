<template>
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item">
                        <router-link :to="{name:'Dashboard'}">Dashboard</router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Zona</li>
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

                <div class="mb-3">
                    <b-form-group
                        label="Tipe Zona"
                        label-for="fzona_type"
                        :invalid-feedback="this.errors && this.errors.zona_type ? this.errors.zona_type.join() : ''"
                        :state="this.errors && this.errors.zona_type ? false : true"
                    >
                        <select-ajax
                            id="fzona_type"
                            v-model="filter.zona_type"
                            api-url="/api/select/zona_type"
                            placeholder-text="Semua Tipe Zona"
                            option-text="text"
                            option-value="value">
                        </select-ajax>
                    </b-form-group>

                    <b-form-group
                        label="Kecamatan"
                        label-for="fkecamatan_id"
                        :invalid-feedback="this.errors && this.errors.kecamatan_id ? this.errors.kecamatan_id.join() : ''"
                        :state="this.errors && this.errors.kecamatan_id ? false : true"
                    >
                        <select-ajax id="fkecamatan_id"
                                     placeholder-text="Semua Kecamatan"
                                     api-url="/api/select/kecamatan"
                                     option-text="kecamatan_nama"
                                     option-value="kecamatan_id"
                                     v-model="filter.kecamatan_id"
                        ></select-ajax>
                    </b-form-group>
                </div>
                <div v-if="data_print" id="print" class="d-none d-print-block">
                    <h4 class="text-center text-capitalize">Laporan zona</h4>
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
                    selector="dt-zona"
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
                    label="Tipe Zona"
                    label-for="zona_type"
                    :invalid-feedback="this.errors && this.errors.zona_type ? this.errors.zona_type.join() : ''"
                    :state="this.errors && this.errors.zona_type ? false : true"
                >
                    <radio-ajax v-model="data.zona_type"
                                api-url="/api/select/zona_type"
                                option-text="text"
                                option-value="value">
                    </radio-ajax>
                </b-form-group>

                <b-form-group
                    label="Kelurahan"
                    label-for="kelurahan_id"
                    :invalid-feedback="this.errors && this.errors.kelurahan_id ? this.errors.kelurahan_id.join() : ''"
                    :state="this.errors && this.errors.kelurahan_id ? false : true"
                >
                    <select-ajax id="kelurahan_id"
                                 api-url="/api/select/kelurahan"
                                 option-text="kelurahan_nama"
                                 option-value="kelurahan_id"
                                 v-model="data.kelurahan_id"
                    ></select-ajax>
                </b-form-group>

                <b-form-group
                    label="Latitude"
                    label-for="zona_lat"
                    :invalid-feedback="this.errors && this.errors.zona_lat ? this.errors.zona_lat.join() : ''"
                    :state="this.errors && this.errors.zona_lat ? false : true"
                >
                    <b-form-input id="zona_lat"
                                  v-model="data.zona_lat"
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                    label="Longitude"
                    label-for="zona_lng"
                    :invalid-feedback="this.errors && this.errors.zona_lng ? this.errors.zona_lng.join() : ''"
                    :state="this.errors && this.errors.zona_lng ? false : true"
                >
                    <b-form-input id="zona_lng"
                                  v-model="data.zona_lng"
                    ></b-form-input>
                </b-form-group>

                <div v-if="data.zona_type == 'sub_urban'">
                    <b-form-group
                        label="Sub Urban 1"
                        label-for="zona_sub_1"
                        :invalid-feedback="this.errors && this.errors.zona_sub_1 ? this.errors.zona_sub_1.join() : ''"
                        :state="this.errors && this.errors.zona_sub_1 ? false : true"
                    >
                        <b-form-input id="zona_sub_1"
                                      v-model="data.zona_sub_1"
                        ></b-form-input>
                    </b-form-group>
                    <b-form-group
                        label="Sub Urban 2"
                        label-for="zona_sub_2"
                        :invalid-feedback="this.errors && this.errors.zona_sub_2 ? this.errors.zona_sub_2.join() : ''"
                        :state="this.errors && this.errors.zona_sub_2 ? false : true"
                    >
                        <b-form-input id="zona_sub_2"
                                      v-model="data.zona_sub_2"
                        ></b-form-input>
                    </b-form-group>
                </div>

                <div v-else>
                    <b-form-group
                        label="Radius Zona Rural"
                        label-for="zona_rural"
                        :invalid-feedback="this.errors && this.errors.zona_rural ? this.errors.zona_rural.join() : ''"
                        :state="this.errors && this.errors.zona_rural ? false : true"
                    >
                        <b-form-input id="zona_rural"
                                      v-model="data.zona_rural"
                        ></b-form-input>
                    </b-form-group>
                </div>


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
            "filter.zona_type": function (value) {
                this.$refs.dt.destroy();
                this.configDt.ajax.data.zona_type = value;
                this.$nextTick(() => {
                    this.$refs.dt.initDt();
                })
            },
            "filter.kecamatan_id": function (value) {
                this.$refs.dt.destroy();
                this.configDt.ajax.data.kecamatan_id = value;
                this.$nextTick(() => {
                    this.$refs.dt.initDt();
                })
            }
        },
        data: function () {
            return {
                filter: {
                    kecamatan_id: "",
                    zona_type: ""
                },
                title: 'Zona Datatable',
                action: 'store',
                show_modal: false,
                modal_title: 'Tambah Zona',
                data: {
                    zona_id: "",
                    zona_type: "rural",
                    kelurahan_id: null,
                    zona_lat: null,
                    zona_lng: null,
                    zona_sub_1: null,
                    zona_sub_2: null,
                    zona_rural: null,
                    links: {
                        store: "/api/zona",
                        update: "/api/zona",
                        show: "/api/zona",
                        destroy: "/api/zona",
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
                        url: "/api/zona",
                        data: {
                            kelurahan_id: "",
                            kecamatan_id: ""
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
                            name: "zona_type",
                            print: true,
                            title: "Tipe Zona",
                            data: "zona_type",
                            class: "auto text-capitalize"
                        },
                        {
                            name: "tb_kelurahan.kelurahan_nama",
                            print: true,
                            title: "Kelurahan",
                            data: "kelurahan_nama",
                            class: "auto text-capitalize"
                        },
                        {
                            name: "tb_kecamatan.kecamatan_nama",
                            print: true,
                            title: "Kecamatan",
                            data: "kecamatan_nama",
                            class: "auto text-capitalize"
                        },
                        {
                            name: "zona_lat",
                            print: true,
                            title: "Latitude",
                            data: "zona_lat",
                            class: "auto text-capitalize"
                        },
                        {
                            name: "zona_lng",
                            print: true,
                            title: "Longitude",
                            data: "zona_lng",
                            class: "auto text-capitalize"
                        },
                        {
                            name: "zona_sub_1",
                            print: true,
                            title: "Sub Urban 1",
                            data: "zona_sub_1",
                            class: "auto text-capitalize"
                        },
                        {
                            name: "zona_sub_2",
                            print: true,
                            title: "Sub Urban 2",
                            data: "zona_sub_2",
                            class: "auto text-capitalize"
                        },
                        {
                            name: "zona_rural",
                            print: true,
                            title: "Radius Zona Rural",
                            data: "zona_rural",
                            class: "auto"
                        },
                        {title: "Action", data: "action", class: "text-center w-25 all"}
                    ]
                },
                file: null
            }
        },
        methods: {
            async generatePdf() {
                var url ='/api/zona?print=true';
                var arr = [];
                for (var key in this.filter) {
                    arr.push(`&${key}=${this.filter[key]}`);
                }
                arr.forEach(function(val, key){
                    url = url + val;
                });
                var res = await this.axios.get(url);
                this.data_print = res.data;
                this.$nextTick(() => {
                    this.printPdf('portrait')
                })
            },
            setDt() {
                var vm = this;
                var el = this.$refs.dt.$el
                $(el).find("#dt-zona").on("click", ".btn-edit", function (e) {
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
                this.modal_title = 'Tambah Zona';
                this.show_modal = true;
            },
            edit(url) {
                this.modal_title = 'Edit Zona';
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
                        message: 'Zona batal dihapus'
                    });
                    this.refreshDt();
                });
            }
        }
    }
</script>

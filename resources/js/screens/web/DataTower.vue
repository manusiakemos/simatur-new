<template>
    <div class="container">
       <div class="row">

           <div class="col-12">
               <div class="py-4">
                   <b-card>
                       <div class="mb-3">

                           <b-btn variant="primary" @click="refreshDt">
                               <span class="fa fa-recycle"></span>
                               Refresh
                           </b-btn>

                           <b-btn variant="primary" @click="generatePdf">
                               <span class="fa fa-file-pdf"></span>
                               Generate PDF
                           </b-btn>
                       </div>

                       <div class="mb-3 mt-3">
                           <select-ajax api-url="/api/select/provider"
                                        v-model="filter.provider_id"
                                        placeholder-text="Filter Provider"
                                        option-text="provider_name"
                                        option-value="provider_id"/>
                       </div>

                       <div class="mb-3 mt-3">
                           <select-ajax api-url="/api/select/kecamatan"
                                        v-model="filter.kecamatan_id"
                                        placeholder-text="Filter Kecamatan"
                                        option-text="kecamatan_nama"
                                        option-value="kecamatan_id"/>
                       </div>


                       <div v-if="data_print" id="print" class="d-none d-print-block">
                           <h4 class="text-center text-capitalize">Report tower</h4>
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
                           selector="dt-tower"
                           ref="dt">
                       </datatables>
                   </b-card>
               </div>
           </div>
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
            "filter.provider_id" : function(value){
                this.$refs.dt.destroy();
                this.configDt.ajax.data.filter_provider = value;
                this.$nextTick(() => {
                    this.$refs.dt.initDt();
                })
            },
            "filter.kecamatan_id" : function(value){
                this.$refs.dt.destroy();
                this.configDt.ajax.data.filter_kecamatan = value;
                this.$nextTick(() => {
                    this.$refs.dt.initDt();
                })
            }
        },
        data: function () {
            return {
                filter: {
                    provider_id:"",
                    kecamatan_id:"",
                },
                title: 'Tower Datatable',
                action: 'store',
                show_modal: false,
                modal_title: 'Tambah Tower',
                data: {
                    tower_id: "",
                    provider_id: "",
                    kelurahan_id: "",
                    tower_address: "",
                    tower_kode: "",
                    tower_lng: "",
                    tower_lat: "",
                    tower_status: "",
                    tower_size_type: "",
                    tower_year: "",
                    tower_is_active: 1,
                    tower_height: "",
                    links: {
                        store: "/api/tower",
                        update: "/api/tower",
                        show: "/api/tower",
                        destroy: "/api/tower",
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
                        url: "/api/tower",
                        data: {
                            filter_provider: null,
                            filter_kecamatan: null,
                        }
                    },
                    processing: true,
                    serverSide: true,
                    responsive: false,
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
                        {name: "tower_kode", print: true, title: "Kode", data: "tower_kode", class: "all"},
                        {
                            name: "tb_provider.provider_name",
                            print: true,
                            title: "Provider",
                            data: "provider_name",
                            class: "auto"
                        },
                        {
                            name: "tb_kelurahan.kelurahan_nama",
                            print: true,
                            title: "Kelurahan",
                            data: "kelurahan_nama",
                            class: "auto"
                        },
                        {
                            name: "tb_kecamatan.kecamatan_nama",
                            print: true,
                            title: "Kecamatan",
                            data: "kecamatan_nama",
                            class: "auto"
                        },
                        {name: "tower_address", print: true, title: "Alamat", data: "tower_address", class: "auto"},
                        {name: "tower_lng", print: true, title: "Longitude", data: "tower_lng", class: "auto"},
                        {name: "tower_lat", print: true, title: "Latitude", data: "tower_lat", class: "auto"},
                        // {name: "tower_status", print: true, title: "Status", data: "tower_status", class: "auto"},
                        {
                            name: "tower_size_type",
                            print: true,
                            title: "Tipe Ukuran",
                            data: "tower_size_type",
                            class: "auto"
                        },
                        // {name: "tower_year", print: true, title: "Tahun", data: "tower_year", class: "auto"},
                        {name: "tower_is_active", print: true, title: "Aktif", data: "tower_is_active", class: "auto"},
                        {name: "tower_height", print: true, title: "Tinggi Tower", data: "tower_height", class: "auto"},
                    ]
                },
                file: null,
            }
        },
        methods: {
            async generatePdf() {
                var url = `/api/tower?print=true&filter_provider=${this.filter.provider_id}&filter_kecamatan=${this.filter.kecamatan_id}`;
                var res = await this.axios.get(url);
                this.data_print = res.data;
                this.$nextTick(() => {
                    this.printPdf('landscape')
                })
            },
            setDt() {
                var vm = this;
                var el = this.$refs.dt.$el
                $(el).find("#dt-tower").on("click", ".btn-edit", function (e) {
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
                this.modal_title = 'Tambah Tower';
                this.show_modal = true;
            },
            edit(url) {
                this.modal_title = 'Edit Tower';
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
                        message: 'Tower batal dihapus'
                    });
                    this.refreshDt();
                });
            }
        }
    }
</script>

<style scoped>

</style>

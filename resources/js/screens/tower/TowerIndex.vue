<template>
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item">
                        <router-link :to="{ name: 'Dashboard' }">Dashboard</router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">tower</li>
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

                <div class="mb-3 mt-3">
                    <select-ajax
                        api-url="/api/select/provider"
                        v-model="filter.provider_id"
                        placeholder-text="Filter Provider"
                        option-text="provider_name"
                        option-value="provider_id"
                    />
                </div>

                <div class="mb-3 mt-3">
                    <select-ajax
                        api-url="/api/select/kecamatan"
                        v-model="filter.kecamatan_id"
                        placeholder-text="Filter Kecamatan"
                        option-text="kecamatan_nama"
                        option-value="kecamatan_id"
                    />
                </div>
                <datatables :config-dt="configDt" selector="dt-tower" ref="dt">
                </datatables>
            </b-card>
        </div>
        <div class="col-12">
            <div v-if="data_print" id="print" class="d-none d-print-block">
                <div class="text-center">
                    <report-heading></report-heading>
                    <h4 class="text-center text-uppercase mt-3">Laporan Data tower</h4>
                </div>
                <table class="table table-bordered">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th>Kode</th>
                        <th>Provider</th>
                        <th>Kelurahan</th>
                        <th>Kecamatan</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Status</th>
                        <th>Tipe</th>
                        <th>Tahun</th>
                        <th>Aktif</th>
                        <th>Tinggi</th>
<!--                        11-->
                    </tr>
                    </thead>
                    <tbody>
                    <fragment v-for="(value, index) in data_print.data" :key="index">
                        <tr>
                            <td>{{value.tower_kode}}</td>
                            <td>{{value.provider_name}}</td>
                            <td>{{value.kelurahan_nama}}</td>
                            <td>{{value.kecamatan_nama}}</td>
                            <td>{{value.tower_lat}}</td>
                            <td>{{value.tower_lng}}</td>
                            <td>{{value.tower_status}}</td>
                            <td>{{value.tower_size_type}}</td>
                            <td>{{value.tower_year}}</td>
                            <td>{{value.tower_is_active}}</td>
                            <td>{{value.tower_height}}</td>
                        </tr>
                        <tr>
                            <td class="text-right">Alamat : </td>
                            <td colspan="10">{{value.tower_address}}</td>
                        </tr>
                    </fragment>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12">
            <b-modal
                :title="modal_title"
                header-bg-variant="primary"
                header-text-variant="light"
                size="xl"
                v-model="show_modal"
                @ok="show_modal = false"
            >
                <b-form-group
                    label="Provider"
                    label-for="provider_id"
                    :invalid-feedback="
            this.errors && this.errors.provider_id
              ? this.errors.provider_id.join()
              : ''
          "
                    :state="this.errors && this.errors.provider_id ? false : true"
                >
                    <select-ajax
                        id="provider_id"
                        api-url="/api/select/provider"
                        option-text="provider_name"
                        option-value="provider_id"
                        v-model="data.provider_id"
                    ></select-ajax>
                </b-form-group>
                <b-form-group
                    label="Kelurahan"
                    label-for="kelurahan_id"
                    :invalid-feedback="
            this.errors && this.errors.kelurahan_id
              ? this.errors.kelurahan_id.join()
              : ''
          "
                    :state="this.errors && this.errors.kelurahan_id ? false : true"
                >
                    <select-ajax
                        id="kelurahan_id"
                        api-url="/api/select/kelurahan"
                        option-text="kelurahan_nama"
                        option-value="kelurahan_id"
                        v-model="data.kelurahan_id"
                    ></select-ajax>
                </b-form-group>
                <b-form-group
                    label="Alamat"
                    label-for="tower_address"
                    :invalid-feedback="
            this.errors && this.errors.tower_address
              ? this.errors.tower_address.join()
              : ''
          "
                    :state="this.errors && this.errors.tower_address ? false : true"
                >
                    <b-form-input
                        id="tower_address"
                        v-model="data.tower_address"
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    label="Deskripsi"
                    label-for="tower_desc"
                    :invalid-feedback="
            this.errors && this.errors.tower_desc
              ? this.errors.tower_desc.join()
              : ''
          "
                    :state="this.errors && this.errors.tower_desc ? false : true"
                >
                    <b-form-input
                        id="tower_desc"
                        v-model="data.tower_desc"
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    label="Longitude"
                    label-for="tower_lng"
                    :invalid-feedback="
            this.errors && this.errors.tower_lng
              ? this.errors.tower_lng.join()
              : ''
          "
                    :state="this.errors && this.errors.tower_lng ? false : true"
                >
                    <b-form-input id="tower_lng" v-model="data.tower_lng"></b-form-input>
                </b-form-group>
                <b-form-group
                    label="Latitude"
                    label-for="tower_lat"
                    :invalid-feedback="
            this.errors && this.errors.tower_lat
              ? this.errors.tower_lat.join()
              : ''
          "
                    :state="this.errors && this.errors.tower_lat ? false : true"
                >
                    <b-form-input id="tower_lat" v-model="data.tower_lat"></b-form-input>
                </b-form-group>
                <b-form-group
                    label="Status"
                    label-for="tower_status"
                    :invalid-feedback="
            this.errors && this.errors.tower_status
              ? this.errors.tower_status.join()
              : ''
          "
                    :state="this.errors && this.errors.tower_status ? false : true"
                >
                    <select-ajax
                        id="tower_status"
                        api-url="/api/select/tower_status"
                        option-text="text"
                        option-value="value"
                        v-model="data.tower_status"
                    ></select-ajax>
                </b-form-group>
                <b-form-group
                    label="Tipe Ukuran"
                    label-for="tower_size_type"
                    :invalid-feedback="
            this.errors && this.errors.tower_size_type
              ? this.errors.tower_size_type.join()
              : ''
          "
                    :state="this.errors && this.errors.tower_size_type ? false : true"
                >
                    <select-ajax
                        id="tower_size_type"
                        api-url="/api/select/tower_size_type"
                        option-text="text"
                        option-value="value"
                        v-model="data.tower_size_type"
                    ></select-ajax>
                </b-form-group>

                <b-form-group
                    label="Tahun"
                    label-for="tower_year"
                    :invalid-feedback="
            this.errors && this.errors.tower_year
              ? this.errors.tower_year.join()
              : ''
          "
                    :state="this.errors && this.errors.tower_year ? false : true"
                >
                    <my-date-picker
                        type="year"
                        id="tower_year"
                        format="YYYY"
                        v-model="data.tower_year"
                    ></my-date-picker>
                </b-form-group>
                <b-form-group
                    label="Aktif"
                    label-for="tower_is_active"
                    :invalid-feedback="
            this.errors && this.errors.tower_is_active
              ? this.errors.tower_is_active.join()
              : ''
          "
                    :state="this.errors && this.errors.tower_is_active ? false : true"
                >
                    <radio-ajax
                        v-model="data.tower_is_active"
                        api-url="/api/select/boolean"
                        option-text="text"
                        option-value="value"
                    >
                    </radio-ajax>
                </b-form-group>
                <b-form-group
                    label="Tinggi Tower"
                    label-for="tower_height"
                    :invalid-feedback="
            this.errors && this.errors.tower_height
              ? this.errors.tower_height.join()
              : ''
          "
                    :state="this.errors && this.errors.tower_height ? false : true"
                >
                    <b-form-input
                        id="tower_height"
                        v-model="data.tower_height"
                    ></b-form-input>
                </b-form-group>

                <template v-slot:modal-footer>
                    <div class="w-100">
                        <div class="d-flex">
                            <b-button
                                variant="secondary"
                                class="ml-auto"
                                @click="show_modal = false"
                            >
                                Tutup
                            </b-button>
                            <b-button
                                v-if="action == 'store'"
                                variant="primary"
                                class="ml-1"
                                @click="store"
                            >
                                Simpan
                            </b-button>
                            <b-button v-else variant="primary" class="ml-1" @click="update">
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
import RemoteDataTables from "../../components/RemoteDataTables.vue";

export default {
    components: {
        datatables: RemoteDataTables,
    },
    created() {
        this.data2 = this.data;
    },
    mounted() {
        this.setDt();
    },
    watch: {
        "filter.provider_id": function (value) {
            this.$refs.dt.destroy();
            this.configDt.ajax.data.filter_provider = value;
            this.$nextTick(() => {
                this.$refs.dt.initDt();
            });
        },
        "filter.kecamatan_id": function (value) {
            this.$refs.dt.destroy();
            this.configDt.ajax.data.filter_kecamatan = value;
            this.$nextTick(() => {
                this.$refs.dt.initDt();
            });
        },
    },
    data: function () {
        return {
            filter: {
                provider_id: "",
                kecamatan_id: "",
            },
            title: "Tower Datatable",
            action: "store",
            show_modal: false,
            modal_title: "Tambah Tower",
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
                },
            },
            data2: null,
            data_print: null,
            errors: [],
            headers: {
                "Content-Type": "multipart/form-data",
            },
            upload: false,
            configDt: {
                ajax: {
                    type: "GET",
                    url: "/api/tower",
                    data: {
                        filter_provider: null,
                        filter_kecamatan: null,
                    },
                },
                processing: true,
                serverSide: true,
                responsive: true,
                language: {
                    sEmptyTable: "Tidak ada data yang tersedia pada tabel ini",
                    sProcessing: "Sedang memproses...",
                    sLengthMenu: "Tampilkan _MENU_ entri",
                    sZeroRecords: "Tidak ditemukan data yang sesuai",
                    sInfo: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    sInfoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                    sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
                    sInfoPostFix: "",
                    sSearch: "Cari:",
                    sUrl: "",
                    oPaginate: {
                        sFirst: "Pertama",
                        sPrevious: "Sebelumnya",
                        sNext: "Selanjutnya",
                        sLast: "Terakhir",
                    },
                    lengthMenu:
                        'Menampilkan <select class="form-control">' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">All</option>' +
                        "</select> Data Perhalaman",
                },
                columns: [
                    {
                        name: "tower_kode",
                        print: true,
                        title: "Kode",
                        data: "tower_kode",
                        class: "all",
                    },
                    {
                        name: "tb_provider.provider_name",
                        print: true,
                        title: "Provider",
                        data: "provider_name",
                        class: "auto",
                    },
                    {
                        name: "tb_kelurahan.kelurahan_nama",
                        print: true,
                        title: "Kelurahan",
                        data: "kelurahan_nama",
                        class: "auto",
                    },
                    {
                        name: "tb_kecamatan.kecamatan_nama",
                        print: true,
                        title: "Kecamatan",
                        data: "kecamatan_nama",
                        class: "auto",
                    },
                    {
                        name: "tower_address",
                        print: true,
                        title: "Alamat",
                        data: "tower_address",
                        class: "auto",
                    },
                    {
                        name: "tower_lng",
                        print: true,
                        title: "Longitude",
                        data: "tower_lng",
                        class: "auto",
                    },
                    {
                        name: "tower_lat",
                        print: true,
                        title: "Latitude",
                        data: "tower_lat",
                        class: "auto",
                    },
                    {
                        name: "tower_status",
                        print: true,
                        title: "Status",
                        data: "tower_status",
                        class: "auto",
                    },
                    {
                        name: "tower_size_type",
                        print: true,
                        title: "Tipe Ukuran",
                        data: "tower_size_type",
                        class: "auto",
                    },
                    {
                        name: "tower_year",
                        print: true,
                        title: "Tahun",
                        data: "tower_year",
                        class: "auto",
                    },
                    {
                        name: "tower_is_active",
                        print: true,
                        title: "Aktif",
                        data: "tower_is_active",
                        class: "auto",
                    },
                    {
                        name: "tower_height",
                        print: true,
                        title: "Tinggi Tower",
                        data: "tower_height",
                        class: "auto",
                    },
                    {title: "Action", data: "action", class: "text-center w-25 all"},
                ],
            },
            file: null,
        };
    },
    methods: {
        async generatePdf() {
            var url = `/api/tower?print=true&filter_provider=${this.filter.provider_id}&filter_kecamatan=${this.filter.kecamatan_id}`;
            var res = await this.axios.get(url);
            this.data_print = res.data;
            this.$nextTick(() => {
                this.printPdf("landscape");
            });
        },
        setDt() {
            var vm = this;
            var el = this.$refs.dt.$el;
            $(el)
                .find("#dt-tower")
                .on("click", ".btn-edit", function (e) {
                    e.preventDefault();
                    var url = $(this).attr("href");
                    vm.edit(url);
                })
                .on("click", ".btn-destroy", function (e) {
                    e.preventDefault();
                    var url = $(this).attr("href");
                    vm.destroy(url);
                });
        },
        refreshDt() {
            this.$refs.dt.refresh();
        },
        create() {
            this.data = _.cloneDeep(this.data2);
            this.action = "store";
            this.modal_title = "Tambah Tower";
            this.show_modal = true;
        },
        edit(url) {
            this.modal_title = "Edit Tower";
            this.action = "update";
            this.axios.get(url).then((res) => {
                this.data = _.cloneDeep(res.data);
            });
            this.show_modal = true;
        },
        store() {
            var data = this.makeFormData(this.data);
            if (this.upload) {
                data.append("file", this.file);
            }
            var url = this.data.links.store;
            this.handleRequest(url, data);
        },
        update() {
            var data = this.makeFormData(this.data);
            data.append("_method", "PUT");
            if (this.upload) {
                data.append("file", this.file);
            }
            var url = this.data.links.update;
            this.handleRequest(url, data);
        },
        handleRequest(url, data) {
            if (this.upload) {
                this.axios
                    .post(url, data, this.headers)
                    .then((res) => {
                        if (res.data.status) {
                            this.makeToast(res.data.text, res.data.message);
                            this.show_modal = false;
                            this.refreshDt();
                        }
                    })
                    .catch((error) => {
                        if (error.response) {
                            this.errors = error.response.data.errors;
                        }
                    });
            } else {
                this.axios
                    .post(url, data)
                    .then((res) => {
                        if (res.data.status) {
                            this.makeToast(res.data.text, res.data.message);
                            this.show_modal = false;
                            this.refreshDt();
                        }
                    })
                    .catch((error) => {
                        if (error.response) {
                            this.errors = error.response.data.errors;
                        }
                    });
            }
        },
        destroy(url) {
            this.$dialog
                .confirm("Apakah Kamu Yakin?")
                .then(() => {
                    this.axios.delete(url).then((res) => {
                        this.makeToast(res.data.text, res.data.message);
                        if (res.data.status) {
                            this.refreshDt();
                        }
                    });
                })
                .catch(() => {
                    this.$message({
                        type: "info",
                        message: "Tower batal dihapus",
                    });
                    this.refreshDt();
                });
        },
    },
};
</script>

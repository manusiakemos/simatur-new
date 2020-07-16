<template>
    <div class="table-responsive">
        <table class="table table-hover w-100 dt-responsive nowrap" :id="selector">
            <thead class="bg-primary text-white">
            <tr>
                <th v-for="(v, i) in configDt.columns" :key="i" class="text-dark-all">{{ v.title }}</th>
            </tr>
            </thead>
            <slot></slot>
        </table>

    </div>
</template>


<script>
    export default {
        props: ["selector", "url", "columns"],
        data() {
            return {
                dataTablesVue: "",
                configDt: {
                    ajax: {
                        // url: "/api/pemilih"
                        url: this.url
                    },
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    columns: this.columns,
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
                    }
                }
            };
        },
        mounted() {
            this.initDt();
        },
        beforeDestroy() {
            this.dataTablesVue.clear().destroy();
        },
        methods: {
            initDt() {
                var me = this;
                me.dataTablesVue = $(document)
                    .find(`#${me.selector}`)
                    .DataTable(me.configDt);
            },
            refresh() {
                var me = this;
                me.dataTablesVue.ajax.reload();
            }
        }
    };
</script>

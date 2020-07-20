export default {
    data(){
      return{
          header_upload:{ headers: { 'Content-Type': 'multipart/form-data' } }
      }
    },
    watch: {
        show_modal: function (value) {
            value == false ? this.errors = [] : '';
            this.file = null;
        }
    },
    methods: {
        printPdf(orientation='portrait', target='print') {
            if(orientation == 'landscape'){
                var localOptions = {
                    styles: [
                        '/css/app.css',
                        '/css/landscape.css'
                    ]
                };
            }else{
                var localOptions = {
                    styles: [
                        '/css/app.css',
                    ]
                };
            }
            this.$htmlToPaper(`${target}`, localOptions);
        },
        rupiah(value) {
            var number = parseFloat(value);
            var r = new Intl.NumberFormat().format(number);
            return "Rp. " + r;
        },
        objectLength(obj) {
            var key, len = 0;
            for (key in obj) {
                len += Number(obj.hasOwnProperty(key));
            }
            return len;
        },
        tanggal(tanggal) {
            var date = new Date(tanggal);
            var tahun = date.getFullYear();
            var bulan = date.getMonth();
            var tanggal = date.getDate();
            var hari = date.getDay();
            var jam = date.getHours();
            var menit = date.getMinutes();
            var detik = date.getSeconds();
            switch (hari) {
                case 0:
                    hari = "Minggu";
                    break;
                case 1:
                    hari = "Senin";
                    break;
                case 2:
                    hari = "Selasa";
                    break;
                case 3:
                    hari = "Rabu";
                    break;
                case 4:
                    hari = "Kamis";
                    break;
                case 5:
                    hari = "Jum'at";
                    break;
                case 6:
                    hari = "Sabtu";
                    break;
            }
            switch (bulan) {
                case 0:
                    bulan = "Januari";
                    break;
                case 1:
                    bulan = "Februari";
                    break;
                case 2:
                    bulan = "Maret";
                    break;
                case 3:
                    bulan = "April";
                    break;
                case 4:
                    bulan = "Mei";
                    break;
                case 5:
                    bulan = "Juni";
                    break;
                case 6:
                    bulan = "Juli";
                    break;
                case 7:
                    bulan = "Agustus";
                    break;
                case 8:
                    bulan = "September";
                    break;
                case 9:
                    bulan = "Oktober";
                    break;
                case 10:
                    bulan = "November";
                    break;
                case 11:
                    bulan = "Desember";
                    break;
            }
            var tampilTanggal = tanggal + " " + bulan + " " + tahun;
            // var tampilWaktu = "Jam: " + jam + ":" + menit + ":" + detik;
            return tampilTanggal
        },
        makeFormData(data){
            // Object.entries(a)
            var form_data = new FormData();

            for ( var key in data ) {
                var d = data[key];
                if(d == 'null'){
                    d = "";
                }
                form_data.append(key, d);
            }
            return form_data;
        },
        makeToast(message='success',title='success',variant='primary',append = false) {
            this.toastCount++
            this.$bvToast.toast(message, {
                title: title,
                autoHideDelay: 1200,
                variant: variant,
                appendToast: append
            })
        }
    },
};

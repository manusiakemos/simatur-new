(window.webpackJsonp=window.webpackJsonp||[]).push([[17],{220:function(t,e,a){var r=function(t){"use strict";var e=Object.prototype,a=e.hasOwnProperty,r="function"==typeof Symbol?Symbol:{},n=r.iterator||"@@iterator",o=r.asyncIterator||"@@asyncIterator",i=r.toStringTag||"@@toStringTag";function s(t,e,a,r){var n=e&&e.prototype instanceof u?e:u,o=Object.create(n.prototype),i=new w(r||[]);return o._invoke=function(t,e,a){var r="suspendedStart";return function(n,o){if("executing"===r)throw new Error("Generator is already running");if("completed"===r){if("throw"===n)throw o;return L()}for(a.method=n,a.arg=o;;){var i=a.delegate;if(i){var s=y(i,a);if(s){if(s===c)continue;return s}}if("next"===a.method)a.sent=a._sent=a.arg;else if("throw"===a.method){if("suspendedStart"===r)throw r="completed",a.arg;a.dispatchException(a.arg)}else"return"===a.method&&a.abrupt("return",a.arg);r="executing";var u=l(t,e,a);if("normal"===u.type){if(r=a.done?"completed":"suspendedYield",u.arg===c)continue;return{value:u.arg,done:a.done}}"throw"===u.type&&(r="completed",a.method="throw",a.arg=u.arg)}}}(t,a,i),o}function l(t,e,a){try{return{type:"normal",arg:t.call(e,a)}}catch(t){return{type:"throw",arg:t}}}t.wrap=s;var c={};function u(){}function p(){}function h(){}var d={};d[n]=function(){return this};var f=Object.getPrototypeOf,m=f&&f(f(x([])));m&&m!==e&&a.call(m,n)&&(d=m);var v=h.prototype=u.prototype=Object.create(d);function _(t){["next","throw","return"].forEach((function(e){t[e]=function(t){return this._invoke(e,t)}}))}function g(t,e){var r;this._invoke=function(n,o){function i(){return new e((function(r,i){!function r(n,o,i,s){var c=l(t[n],t,o);if("throw"!==c.type){var u=c.arg,p=u.value;return p&&"object"==typeof p&&a.call(p,"__await")?e.resolve(p.__await).then((function(t){r("next",t,i,s)}),(function(t){r("throw",t,i,s)})):e.resolve(p).then((function(t){u.value=t,i(u)}),(function(t){return r("throw",t,i,s)}))}s(c.arg)}(n,o,r,i)}))}return r=r?r.then(i,i):i()}}function y(t,e){var a=t.iterator[e.method];if(void 0===a){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,y(t,e),"throw"===e.method))return c;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return c}var r=l(a,t.iterator,e.arg);if("throw"===r.type)return e.method="throw",e.arg=r.arg,e.delegate=null,c;var n=r.arg;return n?n.done?(e[t.resultName]=n.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,c):n:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,c)}function b(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function k(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function w(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(b,this),this.reset(!0)}function x(t){if(t){var e=t[n];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var r=-1,o=function e(){for(;++r<t.length;)if(a.call(t,r))return e.value=t[r],e.done=!1,e;return e.value=void 0,e.done=!0,e};return o.next=o}}return{next:L}}function L(){return{value:void 0,done:!0}}return p.prototype=v.constructor=h,h.constructor=p,h[i]=p.displayName="GeneratorFunction",t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===p||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,h):(t.__proto__=h,i in t||(t[i]="GeneratorFunction")),t.prototype=Object.create(v),t},t.awrap=function(t){return{__await:t}},_(g.prototype),g.prototype[o]=function(){return this},t.AsyncIterator=g,t.async=function(e,a,r,n,o){void 0===o&&(o=Promise);var i=new g(s(e,a,r,n),o);return t.isGeneratorFunction(a)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},_(v),v[i]="Generator",v[n]=function(){return this},v.toString=function(){return"[object Generator]"},t.keys=function(t){var e=[];for(var a in t)e.push(a);return e.reverse(),function a(){for(;e.length;){var r=e.pop();if(r in t)return a.value=r,a.done=!1,a}return a.done=!0,a}},t.values=x,w.prototype={constructor:w,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(k),!t)for(var e in this)"t"===e.charAt(0)&&a.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function r(a,r){return i.type="throw",i.arg=t,e.next=a,r&&(e.method="next",e.arg=void 0),!!r}for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n],i=o.completion;if("root"===o.tryLoc)return r("end");if(o.tryLoc<=this.prev){var s=a.call(o,"catchLoc"),l=a.call(o,"finallyLoc");if(s&&l){if(this.prev<o.catchLoc)return r(o.catchLoc,!0);if(this.prev<o.finallyLoc)return r(o.finallyLoc)}else if(s){if(this.prev<o.catchLoc)return r(o.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<o.finallyLoc)return r(o.finallyLoc)}}}},abrupt:function(t,e){for(var r=this.tryEntries.length-1;r>=0;--r){var n=this.tryEntries[r];if(n.tryLoc<=this.prev&&a.call(n,"finallyLoc")&&this.prev<n.finallyLoc){var o=n;break}}o&&("break"===t||"continue"===t)&&o.tryLoc<=e&&e<=o.finallyLoc&&(o=null);var i=o?o.completion:{};return i.type=t,i.arg=e,o?(this.method="next",this.next=o.finallyLoc,c):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),c},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var a=this.tryEntries[e];if(a.finallyLoc===t)return this.complete(a.completion,a.afterLoc),k(a),c}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var a=this.tryEntries[e];if(a.tryLoc===t){var r=a.completion;if("throw"===r.type){var n=r.arg;k(a)}return n}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,a){return this.delegate={iterator:x(t),resultName:e,nextLoc:a},"next"===this.method&&(this.arg=void 0),c}},t}(t.exports);try{regeneratorRuntime=r}catch(t){Function("r","regeneratorRuntime = r")(r)}},3:function(t,e,a){t.exports=a(220)},325:function(t,e,a){"use strict";a.r(e);var r=a(3),n=a.n(r),o={name:"App",components:{LocationPicker:a(45).LocationPicker},props:["value"],created:function(){},computed:{propModel:{get:function(){return this.value},set:function(t){this.$emit("input",t)}}},data:function(){return{location:{lat:-2.173738,lng:115.398434},options:{map:{fontFamily:"Poppins"},marker:{fontFamily:"Poppins"},autocomplete:{}}}}},i=a(1),s=Object(i.a)(o,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return t.propModel?a("div",[a("location-picker",{attrs:{options:t.options},model:{value:t.propModel,callback:function(e){t.propModel=e},expression:"propModel"}})],1):t._e()}),[],!1,null,null,null).exports;function l(t,e,a,r,n,o,i){try{var s=t[o](i),l=s.value}catch(t){return void a(t)}s.done?e(l):Promise.resolve(l).then(r,n)}var c={components:{datatables:a(9).a,"map-picker":s},created:function(){this.data2=this.data},mounted:function(){this.setDt()},watch:{latlng:function(t){this.data.p_lat=t.lat,this.data.p_lng=t.lng}},data:function(){return{title:"Permohonan Rekomendasi",latlng:{lat:-2.173738,lng:115.398434},action:"store",show_modal:!1,modal_title:"Tambah Permohonan Rekomendasi",data:{p_id:"",p_keterangan:"",p_alamat:"",p_status:"",p_alasan:"",kelurahan_id:"",user_id:"",p_lat:-2.173738,p_lng:115.398434,links:{store:"/api/permohonan",update:"/api/permohonan",show:"/api/permohonan",destroy:"/api/permohonan"}},data2:null,data_print:null,errors:[],headers:{"Content-Type":"multipart/form-data"},upload:!0,configDt:{ajax:{type:"GET",url:"/api/permohonan"},processing:!0,serverSide:!0,responsive:!0,language:{sEmptyTable:"Tidak ada data yang tersedia pada tabel ini",sProcessing:"Sedang memproses...",sLengthMenu:"Tampilkan _MENU_ entri",sZeroRecords:"Tidak ditemukan data yang sesuai",sInfo:"Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",sInfoEmpty:"Menampilkan 0 sampai 0 dari 0 entri",sInfoFiltered:"(disaring dari _MAX_ entri keseluruhan)",sInfoPostFix:"",sSearch:"Cari:",sUrl:"",oPaginate:{sFirst:"Pertama",sPrevious:"Sebelumnya",sNext:"Selanjutnya",sLast:"Terakhir"},lengthMenu:'Menampilkan <select class="form-control"><option value="10">10</option><option value="20">20</option><option value="30">30</option><option value="40">40</option><option value="50">50</option><option value="-1">All</option></select> Data Perhalaman'},columns:[{name:"p_keterangan",print:!0,title:"Keterangan",data:"p_keterangan",class:"auto"},{name:"p_status",print:!0,title:"Status",data:"p_status",class:"auto"},{name:"p_alasan",print:!0,title:"Keterangan Dari Admin",data:"p_alasan",class:"auto"},{name:"tb_kelurahan.kelurahan_nama",print:!0,title:"Kelurahan",data:"kelurahan_nama",class:"auto"},{name:"users.name",print:!0,title:"Nama Pemohon",data:"name",class:"auto"},{name:"p_lat",print:!0,title:"Lat",data:"p_lat",class:"auto"},{name:"p_lng",print:!0,title:"Long",data:"p_lng",class:"auto"},{title:"Action",data:"action",class:"text-center w-25 all"}]},file:null}},methods:{generatePdf:function(){var t,e=this;return(t=n.a.mark((function t(){var a;return n.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.axios.get("/api/permohonan?print=true");case 2:a=t.sent,e.data_print=a.data,e.$nextTick((function(){e.printPdf("portrait")}));case 5:case"end":return t.stop()}}),t)})),function(){var e=this,a=arguments;return new Promise((function(r,n){var o=t.apply(e,a);function i(t){l(o,r,n,i,s,"next",t)}function s(t){l(o,r,n,i,s,"throw",t)}i(void 0)}))})()},setDt:function(){var t=this,e=this.$refs.dt.$el;$(e).find("#dt-permohonan").on("click",".btn-edit",(function(e){e.preventDefault();var a=$(this).attr("href");t.edit(a)})).on("click",".btn-destroy",(function(e){e.preventDefault();var a=$(this).attr("href");t.destroy(a)}))},refreshDt:function(){this.$refs.dt.refresh()},create:function(){this.latlng={lat:_.cloneDeep(this.data2.p_lat),lng:_.cloneDeep(this.data2.p_lng)},this.data=_.cloneDeep(this.data2),this.action="store",this.modal_title="Tambah Permohonan",this.show_modal=!0},edit:function(t){var e=this;this.modal_title="Edit Permohonan",this.action="update",this.axios.get(t).then((function(t){e.data=_.cloneDeep(t.data),e.latlng={lat:_.cloneDeep(e.data.p_lat),lng:_.cloneDeep(e.data.p_lng)}})),this.show_modal=!0},store:function(){var t=this.makeFormData(this.data);this.upload&&t.append("file",this.file);var e=this.data.links.store;this.handleRequest(e,t)},update:function(){var t=this.makeFormData(this.data);t.append("_method","PUT"),this.upload&&t.append("file",this.file);var e=this.data.links.update;this.handleRequest(e,t)},handleRequest:function(t,e){var a=this;this.upload?this.axios.post(t,e,this.headers).then((function(t){t.data.status&&(a.makeToast(t.data.text,t.data.message),a.show_modal=!1,a.refreshDt())})).catch((function(t){t.response&&(a.errors=t.response.data.errors)})):this.axios.post(t,e).then((function(t){t.data.status&&(a.makeToast(t.data.text,t.data.message),a.show_modal=!1,a.refreshDt())})).catch((function(t){t.response&&(a.errors=t.response.data.errors)}))},destroy:function(t){var e=this;this.$dialog.confirm("Apakah Kamu Yakin?").then((function(){e.axios.delete(t).then((function(t){e.makeToast(t.data.text,t.data.message),t.data.status&&e.refreshDt()}))})).catch((function(){e.$message({type:"info",message:"Permohonan batal dihapus"}),e.refreshDt()}))}}},u=Object(i.a)(c,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"py-5",attrs:{id:"section-one"}},[a("div",{staticClass:"container"},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-12"},[a("b-card",{staticClass:"shadow-sm",attrs:{"border-variant":"light"}},[a("div",{staticClass:"mb-3"},[a("b-btn",{attrs:{variant:"primary"},on:{click:t.create}},[a("span",{staticClass:"fa fa-plus"}),t._v("\n                            Tambah\n                        ")]),t._v(" "),a("b-btn",{attrs:{variant:"primary"},on:{click:t.refreshDt}},[a("span",{staticClass:"fa fa-recycle"}),t._v("\n                            Refresh\n                        ")])],1),t._v(" "),t.data_print?a("div",{staticClass:"d-none d-print-block",attrs:{id:"print"}},[a("h4",{staticClass:"text-center text-capitalize"},[t._v("Report permohonan")]),t._v(" "),a("table",{staticClass:"table table-bordered"},[a("thead",{staticClass:"bg-primary text-white"},[a("tr",t._l(t.configDt.columns,(function(e,r){return e.print?a("th",{class:e.class},[t._v("\n                                    "+t._s(e.title)+"\n                                ")]):t._e()})),0)]),t._v(" "),a("tbody",t._l(t.data_print.data,(function(e,r){return a("tr",t._l(t.configDt.columns,(function(r,n){return r.print?a("td",{class:r.class},[t._v("\n                                    "+t._s(e[r.data])+"\n                                ")]):t._e()})),0)})),0)])]):t._e(),t._v(" "),a("datatables",{ref:"dt",attrs:{"config-dt":t.configDt,selector:"dt-permohonan"}})],1)],1),t._v(" "),a("div",{staticClass:"col-12"},[a("b-modal",{attrs:{title:t.modal_title,"header-bg-variant":"primary","header-text-variant":"light",size:"xl"},on:{ok:function(e){t.show_modal=!1}},scopedSlots:t._u([{key:"modal-footer",fn:function(){return[a("div",{staticClass:"w-100"},[a("div",{staticClass:"d-flex"},[a("b-button",{staticClass:"ml-auto",attrs:{variant:"secondary"},on:{click:function(e){t.show_modal=!1}}},[t._v("\n                                    Tutup\n                                ")]),t._v(" "),"store"==t.action?a("b-button",{staticClass:"ml-1",attrs:{variant:"primary"},on:{click:t.store}},[t._v("\n                                    Simpan\n                                ")]):a("b-button",{staticClass:"ml-1",attrs:{variant:"primary"},on:{click:t.update}},[t._v("\n                                    Simpan\n                                ")])],1)])]},proxy:!0}]),model:{value:t.show_modal,callback:function(e){t.show_modal=e},expression:"show_modal"}},[a("b-form-group",{attrs:{label:"Keterangan","label-for":"p_keterangan","invalid-feedback":this.errors&&this.errors.p_keterangan?this.errors.p_keterangan.join():"",state:!this.errors||!this.errors.p_keterangan}},[a("b-form-input",{attrs:{id:"p_keterangan"},model:{value:t.data.p_keterangan,callback:function(e){t.$set(t.data,"p_keterangan",e)},expression:"data.p_keterangan"}})],1),t._v(" "),a("b-form-group",{attrs:{label:"Kelurahan","label-for":"kelurahan_id","invalid-feedback":this.errors&&this.errors.kelurahan_id?this.errors.kelurahan_id.join():"",state:!this.errors||!this.errors.kelurahan_id}},[a("select-ajax",{attrs:{id:"kelurahan_id","api-url":"/api/select/kelurahan","option-text":"kelurahan_nama","option-value":"kelurahan_id"},model:{value:t.data.kelurahan_id,callback:function(e){t.$set(t.data,"kelurahan_id",e)},expression:"data.kelurahan_id"}})],1),t._v(" "),a("b-form-group",{attrs:{label:"Alamat","label-for":"p_alamat","invalid-feedback":this.errors&&this.errors.p_alamat?this.errors.p_alamat.join():"",state:!this.errors||!this.errors.p_alamat}},[a("b-form-input",{attrs:{id:"p_alamat"},model:{value:t.data.p_alamat,callback:function(e){t.$set(t.data,"p_alamat",e)},expression:"data.p_alamat"}})],1),t._v(" "),a("map-picker",{model:{value:t.latlng,callback:function(e){t.latlng=e},expression:"latlng"}}),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-lg-6"},[a("b-form-group",{attrs:{label:"Lat","label-for":"p_lat","invalid-feedback":this.errors&&this.errors.p_lat?this.errors.p_lat.join():"",state:!this.errors||!this.errors.p_lat}},[a("b-form-input",{attrs:{id:"p_lat"},model:{value:t.data.p_lat,callback:function(e){t.$set(t.data,"p_lat",e)},expression:"data.p_lat"}})],1)],1),t._v(" "),a("div",{staticClass:"col-lg-6"},[a("b-form-group",{attrs:{label:"Long","label-for":"p_lng","invalid-feedback":this.errors&&this.errors.p_lng?this.errors.p_lng.join():"",state:!this.errors||!this.errors.p_lng}},[a("b-form-input",{attrs:{id:"p_lng"},model:{value:t.data.p_lng,callback:function(e){t.$set(t.data,"p_lng",e)},expression:"data.p_lng"}})],1)],1)]),t._v(" "),a("b-form-group",{attrs:{label:"File (Zip)","label-for":"file","invalid-feedback":this.errors&&this.errors.p_file?this.errors.p_file.join():"",state:!this.errors||!this.errors.p_file}},[a("b-form-file",{attrs:{id:"file"},model:{value:t.file,callback:function(e){t.file=e},expression:"file"}})],1)],1)],1)])])])}),[],!1,null,null,null);e.default=u.exports},9:function(t,e,a){"use strict";var r={props:["configDt","selector"],data:function(){return{dataTablesVue:null}},mounted:function(){this.initDt()},beforeDestroy:function(){this.dataTablesVue.clear().destroy()},methods:{initDt:function(){this.dataTablesVue=$(document).find("#".concat(this.selector)).DataTable(this.configDt)},refresh:function(){this.dataTablesVue.ajax.reload()},destroy:function(){this.dataTablesVue.clear().destroy()}}},n=a(1),o=Object(n.a)(r,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"table-responsive"},[a("table",{staticClass:"table table-hover w-100 dt-responsive nowrap",attrs:{id:t.selector}},[a("thead",{staticClass:"bg-primary text-white"},[a("tr",t._l(t.configDt.columns,(function(e,r){return a("th",{key:r,staticClass:"text-dark-all"},[t._v(t._s(e.title))])})),0)]),t._v(" "),t._t("default")],2)])}),[],!1,null,null,null);e.a=o.exports}}]);
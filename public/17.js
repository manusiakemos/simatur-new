(window.webpackJsonp=window.webpackJsonp||[]).push([[17],{217:function(t,a,e){var r=function(t){"use strict";var a=Object.prototype,e=a.hasOwnProperty,r="function"==typeof Symbol?Symbol:{},n=r.iterator||"@@iterator",o=r.asyncIterator||"@@asyncIterator",i=r.toStringTag||"@@toStringTag";function s(t,a,e){return Object.defineProperty(t,a,{value:e,enumerable:!0,configurable:!0,writable:!0}),t[a]}try{s({},"")}catch(t){s=function(t,a,e){return t[a]=e}}function l(t,a,e,r){var n=a&&a.prototype instanceof d?a:d,o=Object.create(n.prototype),i=new x(r||[]);return o._invoke=function(t,a,e){var r="suspendedStart";return function(n,o){if("executing"===r)throw new Error("Generator is already running");if("completed"===r){if("throw"===n)throw o;return T()}for(e.method=n,e.arg=o;;){var i=e.delegate;if(i){var s=g(i,e);if(s){if(s===u)continue;return s}}if("next"===e.method)e.sent=e._sent=e.arg;else if("throw"===e.method){if("suspendedStart"===r)throw r="completed",e.arg;e.dispatchException(e.arg)}else"return"===e.method&&e.abrupt("return",e.arg);r="executing";var l=c(t,a,e);if("normal"===l.type){if(r=e.done?"completed":"suspendedYield",l.arg===u)continue;return{value:l.arg,done:e.done}}"throw"===l.type&&(r="completed",e.method="throw",e.arg=l.arg)}}}(t,e,i),o}function c(t,a,e){try{return{type:"normal",arg:t.call(a,e)}}catch(t){return{type:"throw",arg:t}}}t.wrap=l;var u={};function d(){}function h(){}function f(){}var p={};p[n]=function(){return this};var _=Object.getPrototypeOf,m=_&&_(_(w([])));m&&m!==a&&e.call(m,n)&&(p=m);var v=f.prototype=d.prototype=Object.create(p);function b(t){["next","throw","return"].forEach((function(a){s(t,a,(function(t){return this._invoke(a,t)}))}))}function y(t,a){var r;this._invoke=function(n,o){function i(){return new a((function(r,i){!function r(n,o,i,s){var l=c(t[n],t,o);if("throw"!==l.type){var u=l.arg,d=u.value;return d&&"object"==typeof d&&e.call(d,"__await")?a.resolve(d.__await).then((function(t){r("next",t,i,s)}),(function(t){r("throw",t,i,s)})):a.resolve(d).then((function(t){u.value=t,i(u)}),(function(t){return r("throw",t,i,s)}))}s(l.arg)}(n,o,r,i)}))}return r=r?r.then(i,i):i()}}function g(t,a){var e=t.iterator[a.method];if(void 0===e){if(a.delegate=null,"throw"===a.method){if(t.iterator.return&&(a.method="return",a.arg=void 0,g(t,a),"throw"===a.method))return u;a.method="throw",a.arg=new TypeError("The iterator does not provide a 'throw' method")}return u}var r=c(e,t.iterator,a.arg);if("throw"===r.type)return a.method="throw",a.arg=r.arg,a.delegate=null,u;var n=r.arg;return n?n.done?(a[t.resultName]=n.value,a.next=t.nextLoc,"return"!==a.method&&(a.method="next",a.arg=void 0),a.delegate=null,u):n:(a.method="throw",a.arg=new TypeError("iterator result is not an object"),a.delegate=null,u)}function k(t){var a={tryLoc:t[0]};1 in t&&(a.catchLoc=t[1]),2 in t&&(a.finallyLoc=t[2],a.afterLoc=t[3]),this.tryEntries.push(a)}function z(t){var a=t.completion||{};a.type="normal",delete a.arg,t.completion=a}function x(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(k,this),this.reset(!0)}function w(t){if(t){var a=t[n];if(a)return a.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var r=-1,o=function a(){for(;++r<t.length;)if(e.call(t,r))return a.value=t[r],a.done=!1,a;return a.value=void 0,a.done=!0,a};return o.next=o}}return{next:T}}function T(){return{value:void 0,done:!0}}return h.prototype=v.constructor=f,f.constructor=h,h.displayName=s(f,i,"GeneratorFunction"),t.isGeneratorFunction=function(t){var a="function"==typeof t&&t.constructor;return!!a&&(a===h||"GeneratorFunction"===(a.displayName||a.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,f):(t.__proto__=f,s(t,i,"GeneratorFunction")),t.prototype=Object.create(v),t},t.awrap=function(t){return{__await:t}},b(y.prototype),y.prototype[o]=function(){return this},t.AsyncIterator=y,t.async=function(a,e,r,n,o){void 0===o&&(o=Promise);var i=new y(l(a,e,r,n),o);return t.isGeneratorFunction(e)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},b(v),s(v,i,"Generator"),v[n]=function(){return this},v.toString=function(){return"[object Generator]"},t.keys=function(t){var a=[];for(var e in t)a.push(e);return a.reverse(),function e(){for(;a.length;){var r=a.pop();if(r in t)return e.value=r,e.done=!1,e}return e.done=!0,e}},t.values=w,x.prototype={constructor:x,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(z),!t)for(var a in this)"t"===a.charAt(0)&&e.call(this,a)&&!isNaN(+a.slice(1))&&(this[a]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var a=this;function r(e,r){return i.type="throw",i.arg=t,a.next=e,r&&(a.method="next",a.arg=void 0),!!r}for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n],i=o.completion;if("root"===o.tryLoc)return r("end");if(o.tryLoc<=this.prev){var s=e.call(o,"catchLoc"),l=e.call(o,"finallyLoc");if(s&&l){if(this.prev<o.catchLoc)return r(o.catchLoc,!0);if(this.prev<o.finallyLoc)return r(o.finallyLoc)}else if(s){if(this.prev<o.catchLoc)return r(o.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<o.finallyLoc)return r(o.finallyLoc)}}}},abrupt:function(t,a){for(var r=this.tryEntries.length-1;r>=0;--r){var n=this.tryEntries[r];if(n.tryLoc<=this.prev&&e.call(n,"finallyLoc")&&this.prev<n.finallyLoc){var o=n;break}}o&&("break"===t||"continue"===t)&&o.tryLoc<=a&&a<=o.finallyLoc&&(o=null);var i=o?o.completion:{};return i.type=t,i.arg=a,o?(this.method="next",this.next=o.finallyLoc,u):this.complete(i)},complete:function(t,a){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&a&&(this.next=a),u},finish:function(t){for(var a=this.tryEntries.length-1;a>=0;--a){var e=this.tryEntries[a];if(e.finallyLoc===t)return this.complete(e.completion,e.afterLoc),z(e),u}},catch:function(t){for(var a=this.tryEntries.length-1;a>=0;--a){var e=this.tryEntries[a];if(e.tryLoc===t){var r=e.completion;if("throw"===r.type){var n=r.arg;z(e)}return n}}throw new Error("illegal catch attempt")},delegateYield:function(t,a,e){return this.delegate={iterator:w(t),resultName:a,nextLoc:e},"next"===this.method&&(this.arg=void 0),u}},t}(t.exports);try{regeneratorRuntime=r}catch(t){Function("r","regeneratorRuntime = r")(r)}},3:function(t,a,e){t.exports=e(217)},316:function(t,a,e){"use strict";e.r(a);var r=e(3),n=e.n(r);function o(t,a,e,r,n,o,i){try{var s=t[o](i),l=s.value}catch(t){return void e(t)}s.done?a(l):Promise.resolve(l).then(r,n)}var i={components:{datatables:e(9).a},created:function(){this.data2=this.data},mounted:function(){this.setDt()},watch:{"filter.zona_type":function(t){var a=this;this.$refs.dt.destroy(),this.configDt.ajax.data.zona_type=t,this.$nextTick((function(){a.$refs.dt.initDt()}))},"filter.kecamatan_id":function(t){var a=this;this.$refs.dt.destroy(),this.configDt.ajax.data.kecamatan_id=t,this.$nextTick((function(){a.$refs.dt.initDt()}))}},data:function(){return{filter:{kecamatan_id:"",zona_type:""},title:"Zona Datatable",action:"store",show_modal:!1,modal_title:"Tambah Zona",data:{zona_id:"",zona_type:"rural",kelurahan_id:null,zona_lat:null,zona_lng:null,zona_sub_1:null,zona_sub_2:null,zona_rural:null,links:{store:"/api/zona",update:"/api/zona",show:"/api/zona",destroy:"/api/zona"}},data2:null,data_print:null,errors:[],headers:{"Content-Type":"multipart/form-data"},upload:!1,configDt:{ajax:{type:"GET",url:"/api/zona",data:{kelurahan_id:"",kecamatan_id:""}},processing:!0,serverSide:!0,responsive:!0,language:{sEmptyTable:"Tidak ada data yang tersedia pada tabel ini",sProcessing:"Sedang memproses...",sLengthMenu:"Tampilkan _MENU_ entri",sZeroRecords:"Tidak ditemukan data yang sesuai",sInfo:"Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",sInfoEmpty:"Menampilkan 0 sampai 0 dari 0 entri",sInfoFiltered:"(disaring dari _MAX_ entri keseluruhan)",sInfoPostFix:"",sSearch:"Cari:",sUrl:"",oPaginate:{sFirst:"Pertama",sPrevious:"Sebelumnya",sNext:"Selanjutnya",sLast:"Terakhir"},lengthMenu:'Menampilkan <select class="form-control"><option value="10">10</option><option value="20">20</option><option value="30">30</option><option value="40">40</option><option value="50">50</option><option value="-1">All</option></select> Data Perhalaman'},columns:[{name:"zona_type",print:!0,title:"Tipe Zona",data:"zona_type",class:"auto text-capitalize"},{name:"tb_kelurahan.kelurahan_nama",print:!0,title:"Kelurahan",data:"kelurahan_nama",class:"auto text-capitalize"},{name:"tb_kecamatan.kecamatan_nama",print:!0,title:"Kecamatan",data:"kecamatan_nama",class:"auto text-capitalize"},{name:"zona_lat",print:!0,title:"Latitude",data:"zona_lat",class:"auto text-capitalize"},{name:"zona_lng",print:!0,title:"Longitude",data:"zona_lng",class:"auto text-capitalize"},{name:"zona_sub_1",print:!0,title:"Sub Urban 1",data:"zona_sub_1",class:"auto text-capitalize"},{name:"zona_sub_2",print:!0,title:"Sub Urban 2",data:"zona_sub_2",class:"auto text-capitalize"},{name:"zona_rural",print:!0,title:"Radius Zona Rural",data:"zona_rural",class:"auto"},{title:"Action",data:"action",class:"text-center w-25 all"}]},file:null}},methods:{generatePdf:function(){var t,a=this;return(t=n.a.mark((function t(){var e,r,o,i;return n.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:for(o in e="/api/zona?print=true",r=[],a.filter)r.push("&".concat(o,"=").concat(a.filter[o]));return r.forEach((function(t,a){e+=t})),t.next=6,a.axios.get(e);case 6:i=t.sent,a.data_print=i.data,a.$nextTick((function(){a.printPdf("portrait")}));case 9:case"end":return t.stop()}}),t)})),function(){var a=this,e=arguments;return new Promise((function(r,n){var i=t.apply(a,e);function s(t){o(i,r,n,s,l,"next",t)}function l(t){o(i,r,n,s,l,"throw",t)}s(void 0)}))})()},setDt:function(){var t=this,a=this.$refs.dt.$el;$(a).find("#dt-zona").on("click",".btn-edit",(function(a){a.preventDefault();var e=$(this).attr("href");t.edit(e)})).on("click",".btn-destroy",(function(a){a.preventDefault();var e=$(this).attr("href");t.destroy(e)}))},refreshDt:function(){this.$refs.dt.refresh()},create:function(){this.data=_.cloneDeep(this.data2),this.action="store",this.modal_title="Tambah Zona",this.show_modal=!0},edit:function(t){var a=this;this.modal_title="Edit Zona",this.action="update",this.axios.get(t).then((function(t){a.data=_.cloneDeep(t.data)})),this.show_modal=!0},store:function(){var t=this.makeFormData(this.data);this.upload&&t.append("file",this.file);var a=this.data.links.store;this.handleRequest(a,t)},update:function(){var t=this.makeFormData(this.data);t.append("_method","PUT"),this.upload&&t.append("file",this.file);var a=this.data.links.update;this.handleRequest(a,t)},handleRequest:function(t,a){var e=this;this.upload?this.axios.post(t,a,this.headers).then((function(t){t.data.status&&(e.makeToast(t.data.text,t.data.message),e.show_modal=!1,e.refreshDt())})).catch((function(t){t.response&&(e.errors=t.response.data.errors)})):this.axios.post(t,a).then((function(t){t.data.status&&(e.makeToast(t.data.text,t.data.message),e.show_modal=!1,e.refreshDt())})).catch((function(t){t.response&&(e.errors=t.response.data.errors)}))},destroy:function(t){var a=this;this.$dialog.confirm("Apakah Kamu Yakin?").then((function(){a.axios.delete(t).then((function(t){a.makeToast(t.data.text,t.data.message),t.data.status&&a.refreshDt()}))})).catch((function(){a.$message({type:"info",message:"Zona batal dihapus"}),a.refreshDt()}))}}},s=e(1),l=Object(s.a)(i,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"row"},[e("div",{staticClass:"col-12"},[e("nav",{attrs:{"aria-label":"breadcrumb"}},[e("ol",{staticClass:"breadcrumb shadow-sm"},[e("li",{staticClass:"breadcrumb-item"},[e("router-link",{attrs:{to:{name:"Dashboard"}}},[t._v("Dashboard")])],1),t._v(" "),e("li",{staticClass:"breadcrumb-item active",attrs:{"aria-current":"page"}},[t._v("Zona")])])]),t._v(" "),e("b-card",{staticClass:"shadow-sm",attrs:{"border-variant":"light"}},[e("div",{staticClass:"mb-3"},[e("b-btn",{attrs:{variant:"primary"},on:{click:t.create}},[e("span",{staticClass:"fa fa-plus"}),t._v("\n                    Tambah\n                ")]),t._v(" "),e("b-btn",{attrs:{variant:"primary"},on:{click:t.refreshDt}},[e("span",{staticClass:"fa fa-recycle"}),t._v("\n                    Refresh\n                ")]),t._v(" "),e("b-btn",{attrs:{variant:"primary"},on:{click:t.generatePdf}},[e("span",{staticClass:"fa fa-file-pdf"}),t._v("\n                    Generate PDF\n                ")])],1),t._v(" "),e("div",{staticClass:"mb-3"},[e("b-form-group",{attrs:{label:"Tipe Zona","label-for":"fzona_type","invalid-feedback":this.errors&&this.errors.zona_type?this.errors.zona_type.join():"",state:!this.errors||!this.errors.zona_type}},[e("select-ajax",{attrs:{id:"fzona_type","api-url":"/api/select/zona_type","placeholder-text":"Semua Tipe Zona","option-text":"text","option-value":"value"},model:{value:t.filter.zona_type,callback:function(a){t.$set(t.filter,"zona_type",a)},expression:"filter.zona_type"}})],1),t._v(" "),e("b-form-group",{attrs:{label:"Kecamatan","label-for":"fkecamatan_id","invalid-feedback":this.errors&&this.errors.kecamatan_id?this.errors.kecamatan_id.join():"",state:!this.errors||!this.errors.kecamatan_id}},[e("select-ajax",{attrs:{id:"fkecamatan_id","placeholder-text":"Semua Kecamatan","api-url":"/api/select/kecamatan","option-text":"kecamatan_nama","option-value":"kecamatan_id"},model:{value:t.filter.kecamatan_id,callback:function(a){t.$set(t.filter,"kecamatan_id",a)},expression:"filter.kecamatan_id"}})],1)],1),t._v(" "),t.data_print?e("div",{staticClass:"d-none d-print-block",attrs:{id:"print"}},[e("h4",{staticClass:"text-center text-capitalize"},[t._v("Laporan zona")]),t._v(" "),e("table",{staticClass:"table table-bordered"},[e("thead",{staticClass:"bg-primary text-white"},[e("tr",t._l(t.configDt.columns,(function(a,r){return a.print?e("th",{class:a.class},[t._v("\n                            "+t._s(a.title)+"\n                        ")]):t._e()})),0)]),t._v(" "),e("tbody",t._l(t.data_print.data,(function(a,r){return e("tr",t._l(t.configDt.columns,(function(r,n){return r.print?e("td",{class:r.class},[t._v("\n                            "+t._s(a[r.data])+"\n                        ")]):t._e()})),0)})),0)])]):t._e(),t._v(" "),e("datatables",{ref:"dt",attrs:{"config-dt":t.configDt,selector:"dt-zona"}})],1)],1),t._v(" "),e("div",{staticClass:"col-12"},[e("b-modal",{attrs:{title:t.modal_title,"header-bg-variant":"primary","header-text-variant":"light",size:"xl"},on:{ok:function(a){t.show_modal=!1}},scopedSlots:t._u([{key:"modal-footer",fn:function(){return[e("div",{staticClass:"w-100"},[e("div",{staticClass:"d-flex"},[e("b-button",{staticClass:"ml-auto",attrs:{variant:"secondary"},on:{click:function(a){t.show_modal=!1}}},[t._v("\n                            Tutup\n                        ")]),t._v(" "),"store"==t.action?e("b-button",{staticClass:"ml-1",attrs:{variant:"primary"},on:{click:t.store}},[t._v("\n                            Simpan\n                        ")]):e("b-button",{staticClass:"ml-1",attrs:{variant:"primary"},on:{click:t.update}},[t._v("\n                            Simpan\n                        ")])],1)])]},proxy:!0}]),model:{value:t.show_modal,callback:function(a){t.show_modal=a},expression:"show_modal"}},[e("b-form-group",{attrs:{label:"Tipe Zona","label-for":"zona_type","invalid-feedback":this.errors&&this.errors.zona_type?this.errors.zona_type.join():"",state:!this.errors||!this.errors.zona_type}},[e("radio-ajax",{attrs:{"api-url":"/api/select/zona_type","option-text":"text","option-value":"value"},model:{value:t.data.zona_type,callback:function(a){t.$set(t.data,"zona_type",a)},expression:"data.zona_type"}})],1),t._v(" "),e("b-form-group",{attrs:{label:"Kelurahan","label-for":"kelurahan_id","invalid-feedback":this.errors&&this.errors.kelurahan_id?this.errors.kelurahan_id.join():"",state:!this.errors||!this.errors.kelurahan_id}},[e("select-ajax",{attrs:{id:"kelurahan_id","api-url":"/api/select/kelurahan","option-text":"kelurahan_nama","option-value":"kelurahan_id"},model:{value:t.data.kelurahan_id,callback:function(a){t.$set(t.data,"kelurahan_id",a)},expression:"data.kelurahan_id"}})],1),t._v(" "),e("b-form-group",{attrs:{label:"Latitude","label-for":"zona_lat","invalid-feedback":this.errors&&this.errors.zona_lat?this.errors.zona_lat.join():"",state:!this.errors||!this.errors.zona_lat}},[e("b-form-input",{attrs:{id:"zona_lat"},model:{value:t.data.zona_lat,callback:function(a){t.$set(t.data,"zona_lat",a)},expression:"data.zona_lat"}})],1),t._v(" "),e("b-form-group",{attrs:{label:"Longitude","label-for":"zona_lng","invalid-feedback":this.errors&&this.errors.zona_lng?this.errors.zona_lng.join():"",state:!this.errors||!this.errors.zona_lng}},[e("b-form-input",{attrs:{id:"zona_lng"},model:{value:t.data.zona_lng,callback:function(a){t.$set(t.data,"zona_lng",a)},expression:"data.zona_lng"}})],1),t._v(" "),"sub_urban"==t.data.zona_type?e("div",[e("b-form-group",{attrs:{label:"Sub Urban 1","label-for":"zona_sub_1","invalid-feedback":this.errors&&this.errors.zona_sub_1?this.errors.zona_sub_1.join():"",state:!this.errors||!this.errors.zona_sub_1}},[e("b-form-input",{attrs:{id:"zona_sub_1"},model:{value:t.data.zona_sub_1,callback:function(a){t.$set(t.data,"zona_sub_1",a)},expression:"data.zona_sub_1"}})],1),t._v(" "),e("b-form-group",{attrs:{label:"Sub Urban 2","label-for":"zona_sub_2","invalid-feedback":this.errors&&this.errors.zona_sub_2?this.errors.zona_sub_2.join():"",state:!this.errors||!this.errors.zona_sub_2}},[e("b-form-input",{attrs:{id:"zona_sub_2"},model:{value:t.data.zona_sub_2,callback:function(a){t.$set(t.data,"zona_sub_2",a)},expression:"data.zona_sub_2"}})],1)],1):e("div",[e("b-form-group",{attrs:{label:"Radius Zona Rural","label-for":"zona_rural","invalid-feedback":this.errors&&this.errors.zona_rural?this.errors.zona_rural.join():"",state:!this.errors||!this.errors.zona_rural}},[e("b-form-input",{attrs:{id:"zona_rural"},model:{value:t.data.zona_rural,callback:function(a){t.$set(t.data,"zona_rural",a)},expression:"data.zona_rural"}})],1)],1)],1)],1)])}),[],!1,null,null,null);a.default=l.exports},9:function(t,a,e){"use strict";var r={props:["configDt","selector"],data:function(){return{dataTablesVue:null}},mounted:function(){this.initDt()},beforeDestroy:function(){this.dataTablesVue.clear().destroy()},methods:{initDt:function(){this.dataTablesVue=$(document).find("#".concat(this.selector)).DataTable(this.configDt)},refresh:function(){this.dataTablesVue.ajax.reload()},destroy:function(){this.dataTablesVue.clear().destroy()}}},n=e(1),o=Object(n.a)(r,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"table-responsive"},[e("table",{staticClass:"table table-hover w-100 dt-responsive nowrap",attrs:{id:t.selector}},[e("thead",{staticClass:"bg-primary text-white"},[e("tr",t._l(t.configDt.columns,(function(a,r){return e("th",{key:r,staticClass:"text-dark-all"},[t._v(t._s(a.title))])})),0)]),t._v(" "),t._t("default")],2)])}),[],!1,null,null,null);a.a=o.exports}}]);
(window.webpackJsonp=window.webpackJsonp||[]).push([[25],{333:function(a,t,e){"use strict";e.r(t);var s={components:{datatables:e(9).a},created:function(){this.data2=this.data},mounted:function(){this.setDt()},watch:{show_modal:function(a){0==a&&(this.errors=[])}},data:function(){return{title:"User Datatable",action:"store",show_modal:!1,modal_title:"Tambah User",data:{id:"",provider_id:"",name:"",email:"",username:"",avatar:"",phone:"",role:"",password:"",api_token:"",remember_token:"",email_verified_at:"",links:{store:"/api/user",update:"/api/user",show:"/api/user",destroy:"/api/user"}},data2:null,errors:[],headers:{"Content-Type":"multipart/form-data"},upload:!0,configDt:{ajax:{type:"GET",url:"/api/user"},processing:!0,serverSide:!0,responsive:!0,language:{sEmptyTable:"Tidak ada data yang tersedia pada tabel ini",sProcessing:"Sedang memproses...",sLengthMenu:"Tampilkan _MENU_ entri",sZeroRecords:"Tidak ditemukan data yang sesuai",sInfo:"Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",sInfoEmpty:"Menampilkan 0 sampai 0 dari 0 entri",sInfoFiltered:"(disaring dari _MAX_ entri keseluruhan)",sInfoPostFix:"",sSearch:"Cari:",sUrl:"",oPaginate:{sFirst:"Pertama",sPrevious:"Sebelumnya",sNext:"Selanjutnya",sLast:"Terakhir"},lengthMenu:'Menampilkan <select class="form-control"><option value="10">10</option><option value="20">20</option><option value="30">30</option><option value="40">40</option><option value="50">50</option><option value="-1">All</option></select> Data Perhalaman'},columns:[{title:"Nama",data:"name",class:"auto"},{title:"Email",data:"email",class:"auto"},{title:"Username",data:"username",class:"auto"},{title:"Avatar",data:"avatar",class:"auto"},{title:"Phone",data:"phone",class:"auto"},{title:"Role Level",data:"role",class:"auto"},{title:"Action",data:"action",class:"text-center w-25 all"}]},file:null}},methods:{setDt:function(){var a=this,t=this.$refs.dt.$el;$(t).find("#dt-user").on("click",".btn-edit",(function(t){t.preventDefault();var e=$(this).attr("href");a.edit(e)})).on("click",".btn-destroy",(function(t){t.preventDefault();var e=$(this).attr("href");a.destroy(e)}))},refreshDt:function(){this.$refs.dt.refresh()},create:function(){this.data=_.cloneDeep(this.data2),this.action="store",this.modal_title="Tambah User",this.show_modal=!0},edit:function(a){var t=this;this.modal_title="Edit User",this.action="update",this.axios.get(a).then((function(a){t.data=_.cloneDeep(a.data)})),this.show_modal=!0},store:function(){var a=this.makeFormData(this.data);this.upload&&a.append("file",this.file);var t=this.data.links.store;this.handleRequest(t,a)},update:function(){var a=this.makeFormData(this.data);a.append("_method","PUT"),this.upload&&a.append("file",this.file);var t=this.data.links.update;this.handleRequest(t,a)},handleRequest:function(a,t){var e=this;this.upload?this.axios.post(a,t,this.headers).then((function(a){a.data.status&&(e.makeToast(a.data.text,a.data.message),e.show_modal=!1,e.refreshDt())})).catch((function(a){a.response&&(e.errors=a.response.data.errors)})):this.axios.post(a,t).then((function(a){a.data.status&&(e.makeToast(a.data.text,a.data.message),e.show_modal=!1,e.refreshDt())})).catch((function(a){a.response&&(e.errors=a.response.data.errors)}))},destroy:function(a){var t=this;this.$dialog.confirm("Apakah Kamu Yakin?").then((function(){t.axios.delete(a).then((function(a){t.makeToast(a.data.text,a.data.message),a.data.status&&t.refreshDt()}))})).catch((function(){t.$message({type:"info",message:"User batal dihapus"}),t.refreshDt()}))}}},r=e(1),i=Object(r.a)(s,(function(){var a=this,t=a.$createElement,e=a._self._c||t;return e("div",{staticClass:"row"},[e("div",{staticClass:"col-12"},[e("nav",{attrs:{"aria-label":"breadcrumb"}},[e("ol",{staticClass:"breadcrumb shadow-sm"},[e("li",{staticClass:"breadcrumb-item"},[e("router-link",{attrs:{to:{name:"Dashboard"}}},[a._v("Dashboard")])],1),a._v(" "),e("li",{staticClass:"breadcrumb-item active",attrs:{"aria-current":"page"}},[a._v("user")])])]),a._v(" "),e("b-card",{staticClass:"shadow-sm",attrs:{"border-variant":"light"}},[e("div",{staticClass:"mb-3"},[e("b-btn",{attrs:{variant:"primary"},on:{click:a.create}},[e("span",{staticClass:"fa fa-plus"}),a._v("\n                    Tambah\n                ")]),a._v(" "),e("b-btn",{attrs:{variant:"primary"},on:{click:a.refreshDt}},[e("span",{staticClass:"fa fa-recycle"}),a._v("\n                    Refresh\n                ")])],1),a._v(" "),e("datatables",{ref:"dt",attrs:{"config-dt":a.configDt,selector:"dt-user"}})],1)],1),a._v(" "),e("div",{staticClass:"col-12"},[e("b-modal",{attrs:{title:a.modal_title,"header-bg-variant":"primary","header-text-variant":"light",size:"xl"},on:{ok:function(t){a.show_modal=!1}},scopedSlots:a._u([{key:"modal-footer",fn:function(){return[e("div",{staticClass:"w-100"},[e("div",{staticClass:"d-flex"},[e("b-button",{staticClass:"ml-auto",attrs:{variant:"secondary"},on:{click:function(t){a.show_modal=!1}}},[a._v("\n                            Tutup\n                        ")]),a._v(" "),"store"==a.action?e("b-button",{staticClass:"ml-1",attrs:{variant:"primary"},on:{click:a.store}},[a._v("\n                            Simpan\n                        ")]):e("b-button",{staticClass:"ml-1",attrs:{variant:"primary"},on:{click:a.update}},[a._v("\n                            Simpan\n                        ")])],1)])]},proxy:!0}]),model:{value:a.show_modal,callback:function(t){a.show_modal=t},expression:"show_modal"}},[e("b-form-group",{attrs:{label:"Nama","label-for":"name","invalid-feedback":this.errors&&this.errors.name?this.errors.name.join():"",state:!this.errors||!this.errors.name}},[e("b-form-input",{attrs:{id:"name"},model:{value:a.data.name,callback:function(t){a.$set(a.data,"name",t)},expression:"data.name"}})],1),a._v(" "),e("b-form-group",{attrs:{label:"Email","label-for":"email","invalid-feedback":this.errors&&this.errors.email?this.errors.email.join():"",state:!this.errors||!this.errors.email}},[e("b-form-input",{attrs:{id:"email"},model:{value:a.data.email,callback:function(t){a.$set(a.data,"email",t)},expression:"data.email"}})],1),a._v(" "),e("b-form-group",{attrs:{label:"Username","label-for":"username","invalid-feedback":this.errors&&this.errors.username?this.errors.username.join():"",state:!this.errors||!this.errors.username}},[e("b-form-input",{attrs:{id:"username"},model:{value:a.data.username,callback:function(t){a.$set(a.data,"username",t)},expression:"data.username"}})],1),a._v(" "),e("b-form-group",{attrs:{label:"Avatar","label-for":"avatar","invalid-feedback":this.errors&&this.errors.avatar?this.errors.avatar.join():"",state:!this.errors||!this.errors.avatar}},[e("b-form-file",{model:{value:a.file,callback:function(t){a.file=t},expression:"file"}})],1),a._v(" "),e("b-form-group",{attrs:{label:"Phone","label-for":"phone","invalid-feedback":this.errors&&this.errors.phone?this.errors.phone.join():"",state:!this.errors||!this.errors.phone}},[e("b-form-input",{attrs:{id:"phone"},model:{value:a.data.phone,callback:function(t){a.$set(a.data,"phone",t)},expression:"data.phone"}})],1),a._v(" "),e("b-form-group",{attrs:{label:"Role Level","label-for":"role","invalid-feedback":this.errors&&this.errors.role?this.errors.role.join():"",state:!this.errors||!this.errors.role}},[e("radio-ajax",{attrs:{"api-url":"/api/select/role","option-text":"text","option-value":"value"},model:{value:a.data.role,callback:function(t){a.$set(a.data,"role",t)},expression:"data.role"}})],1),a._v(" "),"user"==a.data.role?e("b-form-group",{attrs:{label:"Provider","label-for":"provider_id","invalid-feedback":this.errors&&this.errors.provider_id?this.errors.provider_id.join():"",state:!this.errors||!this.errors.provider_id}},[e("select-ajax",{attrs:{"api-url":"/api/select/provider","option-text":"provider_name","option-value":"provider_id"},model:{value:a.data.provider_id,callback:function(t){a.$set(a.data,"provider_id",t)},expression:"data.provider_id"}})],1):a._e(),a._v(" "),e("b-form-group",{attrs:{label:"Password","label-for":"password","invalid-feedback":this.errors&&this.errors.password?this.errors.password.join():"",state:!this.errors||!this.errors.password}},[e("b-form-input",{attrs:{id:"password",type:"password"},model:{value:a.data.password,callback:function(t){a.$set(a.data,"password",t)},expression:"data.password"}})],1)],1)],1)])}),[],!1,null,null,null);t.default=i.exports},9:function(a,t,e){"use strict";var s={props:["configDt","selector"],data:function(){return{dataTablesVue:null}},mounted:function(){this.initDt()},beforeDestroy:function(){this.dataTablesVue.clear().destroy()},methods:{initDt:function(){this.dataTablesVue=$(document).find("#".concat(this.selector)).DataTable(this.configDt)},refresh:function(){this.dataTablesVue.ajax.reload()},destroy:function(){this.dataTablesVue.clear().destroy()}}},r=e(1),i=Object(r.a)(s,(function(){var a=this,t=a.$createElement,e=a._self._c||t;return e("div",{staticClass:"table-responsive"},[e("table",{staticClass:"table table-hover w-100 dt-responsive nowrap",attrs:{id:a.selector}},[e("thead",{staticClass:"bg-primary text-white"},[e("tr",a._l(a.configDt.columns,(function(t,s){return e("th",{key:s,staticClass:"text-dark-all"},[a._v(a._s(t.title))])})),0)]),a._v(" "),a._t("default")],2)])}),[],!1,null,null,null);t.a=i.exports}}]);
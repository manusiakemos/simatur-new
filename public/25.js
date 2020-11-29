(window.webpackJsonp=window.webpackJsonp||[]).push([[25],{322:function(a,t,e){"use strict";e.r(t);var s=e(50),r={components:{draggable:e.n(s).a},computed:{auth:function(){return this.$store.state.auth}},created:function(){this.data2=this.data,this.getData()},data:function(){return{action:"store",data:{prefix:"",class_name:"",table_name:"",generate:{model:!0,controller:!0,vue:!0,router:!0},view:!0,relationships:[],root_namespace:"App",migrate_immediately:!0,migrate_fresh:!1,fields:[{name:"",text:"",type:"",form_type:"text",length:190,nullable:!1,primary:!1}]},data2:{},data_types:["increments","string","integer","boolean","enum","date","text","longText","double","float","year","timestamp","json"],input_types:["text","money","file","radio","image","select","date","time"],items:[{text:"Admin",href:"#"},{text:"Crud Generator",active:!0}],show_modal:!1,show_modal_order:!1,cruds:[]}},methods:{addRelationship:function(){this.data.relationships.push("")},removeRelationship:function(a){this.data.relationships.splice(a,1)},addField:function(){var a={name:this.data.prefix,text:this.data.text,type:this.data.type,length:this.data.length,nullable:!0,primary:!1};this.data.fields.push(a)},removeField:function(a){this.data.fields.splice(a,1)},generateCrud:function(){var a=this,t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];t&&"store"==this.action&&this.cruds.push(this.data),this.axios.post("/api/crudgenerator",{data:this.data,cruds:this.cruds}).then((function(t){a.makeToast("success",t.data.message)})),this.show_modal=!1},create:function(){this.data=_.cloneDeep(this.data2),this.action,this.show_modal=!0},edit:function(a,t){this.action,this.data=_.cloneDeep(a),this.cruds.splice(t,1),this.show_modal=!0},getData:function(){var a=this;this.axios.get("/api/crudgenerator").then((function(t){a.cruds=t.data}))},emptyCrud:function(){var a=this;this.cruds=[],this.axios.post("/api/crudgenerator",{empty:!0}).then((function(t){a.$message.info(t.data.message)}))},destroy:function(a){var t=this;this.cruds.splice(a,1),this.axios.post("/api/crudgenerator",{cruds:this.cruds}).then((function(a){t.makeToast("success",a.data.message)}))},reorder:function(a,t){this.data=a,this.show_modal_order=!0}},watch:{show_modal:function(a){0==a&&this.getData()}}},i=e(1),l=Object(i.a)(r,(function(){var a=this,t=a.$createElement,e=a._self._c||t;return e("div",{staticClass:"row"},[e("div",{staticClass:"col-12"},[e("b-breadcrumb",{staticClass:"bg-white shadow-sm",attrs:{items:a.items}})],1),a._v(" "),e("div",{staticClass:"col-12"},[e("b-button",{attrs:{variant:"primary"},on:{click:a.create}},[e("span",{staticClass:"fa fa-plus"}),a._v(" Tambah CRUD\n        ")]),a._v(" "),e("b-button",{attrs:{variant:"danger"},on:{click:a.emptyCrud}},[e("span",{staticClass:"fa fa-trash"}),a._v(" Kosongkan CRUD\n        ")]),a._v(" "),e("b-card",{staticClass:"mt-3 shadow-sm",attrs:{"border-variant":"light"}},[e("table",{staticClass:"table"},[e("thead",[e("tr",[e("th",[a._v("Class Name")]),a._v(" "),e("th",[a._v("Table Name")]),a._v(" "),e("th",{staticClass:"text-center"},[a._v("Action")])])]),a._v(" "),e("tbody",a._l(a.cruds,(function(t,s){return e("tr",{key:s},[e("td",[a._v("\n                        "+a._s(t.class_name)+"\n                    ")]),a._v(" "),e("td",[a._v("\n                        "+a._s(t.table_name)+"\n                    ")]),a._v(" "),e("td",{staticClass:"text-center"},[e("b-btn",{attrs:{variant:"primary",size:"sm"},on:{click:function(e){return a.edit(t,s)}}},[e("div",{staticClass:"fa fa-pencil-alt"}),a._v("\n                            Edit\n                        ")]),a._v(" "),e("b-btn",{attrs:{variant:"success",size:"sm"},on:{click:function(e){return a.reorder(t,s)}}},[e("div",{staticClass:"fa fa-list-ul"}),a._v("\n                            Reorder Field\n                        ")]),a._v(" "),e("b-btn",{attrs:{variant:"danger",size:"sm"},on:{click:function(t){return a.destroy(s)}}},[e("div",{staticClass:"fa fa-trash-o"}),a._v("\n                            Hapus\n                        ")])],1)])})),0)])])],1),a._v(" "),e("b-modal",{attrs:{size:"xl","hide-footer":!0},model:{value:a.show_modal,callback:function(t){a.show_modal=t},expression:"show_modal"}},[e("div",{staticClass:"row"},["super-admin"==a.auth.data.role?e("div",{staticClass:"col-12"},[e("b-card",{staticClass:"shadow mb-3",attrs:{"border-variant":"light"}},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-3"},[e("b-form-group",{attrs:{id:"model-group",label:"Model","label-for":"model"}},[e("b-form-radio",{attrs:{value:!0},model:{value:a.data.generate.model,callback:function(t){a.$set(a.data.generate,"model",t)},expression:"data.generate.model"}},[a._v("Ya")]),a._v(" "),e("b-form-radio",{attrs:{value:!1},model:{value:a.data.generate.model,callback:function(t){a.$set(a.data.generate,"model",t)},expression:"data.generate.model"}},[a._v("Tidak")])],1)],1),a._v(" "),e("div",{staticClass:"col-md-3"},[e("b-form-group",{attrs:{id:"model-group",label:"Controller","label-for":"controller"}},[e("b-form-radio",{attrs:{value:!0},model:{value:a.data.generate.controller,callback:function(t){a.$set(a.data.generate,"controller",t)},expression:"data.generate.controller"}},[a._v("Ya")]),a._v(" "),e("b-form-radio",{attrs:{value:!1},model:{value:a.data.generate.controller,callback:function(t){a.$set(a.data.generate,"controller",t)},expression:"data.generate.controller"}},[a._v("Tidak")])],1)],1),a._v(" "),e("div",{staticClass:"col-md-3"},[e("b-form-group",{attrs:{id:"model-group",label:"Vue","label-for":"vue"}},[e("b-form-radio",{attrs:{value:!0},model:{value:a.data.generate.vue,callback:function(t){a.$set(a.data.generate,"vue",t)},expression:"data.generate.vue"}},[a._v("Ya")]),a._v(" "),e("b-form-radio",{attrs:{value:!1},model:{value:a.data.generate.vue,callback:function(t){a.$set(a.data.generate,"vue",t)},expression:"data.generate.vue"}},[a._v("Tidak")])],1)],1),a._v(" "),e("div",{staticClass:"col-md-3"},[e("b-form-group",{attrs:{id:"model-group",label:"Router","label-for":"router"}},[e("b-form-radio",{attrs:{value:!0},model:{value:a.data.generate.router,callback:function(t){a.$set(a.data.generate,"router",t)},expression:"data.generate.router"}},[a._v("Ya")]),a._v(" "),e("b-form-radio",{attrs:{value:!1},model:{value:a.data.generate.router,callback:function(t){a.$set(a.data.generate,"router",t)},expression:"data.generate.router"}},[a._v("Tidak")])],1)],1)]),a._v(" "),e("b-form-group",{attrs:{id:"prefix-group",label:"Prefix","label-for":"prefix"}},[e("b-form-input",{attrs:{id:"prefix"},model:{value:a.data.prefix,callback:function(t){a.$set(a.data,"prefix",t)},expression:"data.prefix"}})],1),a._v(" "),e("b-form-group",{attrs:{id:"classname-group",label:"class name","label-for":"classname"}},[e("b-form-input",{attrs:{id:"classname"},model:{value:a.data.class_name,callback:function(t){a.$set(a.data,"class_name",t)},expression:"data.class_name"}})],1),a._v(" "),e("b-form-group",{attrs:{id:"table_name-group",label:"table name","label-for":"table_name"}},[e("b-form-input",{attrs:{id:"table_name"},model:{value:a.data.table_name,callback:function(t){a.$set(a.data,"table_name",t)},expression:"data.table_name"}})],1),a._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"mb-3 col-md-4"},[e("b-form-group",{attrs:{label:"migrate immediately"}},[e("b-form-radio",{attrs:{value:!0},model:{value:a.data.migrate_immediately,callback:function(t){a.$set(a.data,"migrate_immediately",t)},expression:"data.migrate_immediately"}},[a._v("true")]),a._v(" "),e("b-form-radio",{attrs:{value:!1},model:{value:a.data.migrate_immediately,callback:function(t){a.$set(a.data,"migrate_immediately",t)},expression:"data.migrate_immediately"}},[a._v("false")])],1)],1),a._v(" "),e("div",{staticClass:"mb-3 col-md-4"},[e("b-form-group",{attrs:{label:"migrate_fresh"}},[e("b-form-radio",{attrs:{value:!0},model:{value:a.data.migrate_fresh,callback:function(t){a.$set(a.data,"migrate_fresh",t)},expression:"data.migrate_fresh"}},[a._v("true")]),a._v(" "),e("b-form-radio",{attrs:{value:!1},model:{value:a.data.migrate_fresh,callback:function(t){a.$set(a.data,"migrate_fresh",t)},expression:"data.migrate_fresh"}},[a._v("false")])],1)],1)])],1),a._v(" "),e("b-card",{staticClass:"shadow mb-3",attrs:{"border-variant":"light"}},[e("div",{staticClass:"d-flex justify-content-between"},[e("h4",[a._v("Relasi")]),a._v(" "),e("b-button",{attrs:{variant:"primary"},on:{click:a.addRelationship}},[e("span",{staticClass:"fa fa-plus"}),a._v(" Tambah Relasi\n                        ")])],1),a._v(" "),e("hr",{staticClass:"dashed"}),a._v(" "),a._l(a.data.relationships,(function(t,s){return e("div",{key:s},[e("b-form-group",{attrs:{id:"relasi-group-"+s}},[e("b-input-group",{staticClass:"mt-3"},[e("b-form-input",{attrs:{id:"relasi-"+s},model:{value:a.data.relationships[s],callback:function(t){a.$set(a.data.relationships,s,t)},expression:"data.relationships[index]"}}),a._v(" "),e("b-input-group-append",[e("b-button",{attrs:{variant:"primary"},on:{click:a.addRelationship}},[e("div",{staticClass:"fa fa-plus"})]),a._v(" "),a.data.relationships.length>0?e("b-button",{attrs:{variant:"danger"},on:{click:function(t){return a.removeRelationship(s)}}},[e("div",{staticClass:"fa fa-minus"})]):a._e()],1)],1)],1)],1)}))],2),a._v(" "),e("b-card",{staticClass:"shadow mb-3",attrs:{"border-variant":"light"}},[e("div",{staticClass:"d-flex justify-content-between"},[e("h4",[a._v("Fields")]),a._v(" "),e("b-button",{attrs:{variant:"primary"},on:{click:a.addField}},[e("span",{staticClass:"fa fa-plus"}),a._v(" Tambah Field\n                        ")])],1),a._v(" "),e("hr",{staticClass:"dashed"}),a._v(" "),a._l(a.data.fields,(function(t,s){return e("div",{key:s},[e("div",{staticClass:"row"},[e("div",{staticClass:"mb-3 col-md-3"},[e("b-input",{attrs:{placeholder:"name"},model:{value:t.name,callback:function(e){a.$set(t,"name",e)},expression:"item.name"}})],1),a._v(" "),e("div",{staticClass:"mb-3 col-md-3"},[e("b-input",{attrs:{placeholder:"text"},model:{value:t.text,callback:function(e){a.$set(t,"text",e)},expression:"item.text"}})],1),a._v(" "),e("div",{staticClass:"mb-3 col-md-2"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.type,expression:"item.type"}],staticClass:"form-control",on:{change:function(e){var s=Array.prototype.filter.call(e.target.options,(function(a){return a.selected})).map((function(a){return"_value"in a?a._value:a.value}));a.$set(t,"type",e.target.multiple?s:s[0])}}},[e("option",{attrs:{value:"",selected:""}},[a._v("Pilih Tipe")]),a._v(" "),a._l(a.data_types,(function(t,s){return e("option",{key:s,attrs:{selected:""},domProps:{value:t}},[a._v(a._s(t))])}))],2)]),a._v(" "),e("div",{staticClass:"mb-3 col-md-2"},[e("b-input",{attrs:{placeholder:"length"},model:{value:t.length,callback:function(e){a.$set(t,"length",e)},expression:"item.length"}})],1),a._v(" "),e("div",{staticClass:"mb-3 col-md-2"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.form_type,expression:"item.form_type"}],staticClass:"form-control",on:{change:function(e){var s=Array.prototype.filter.call(e.target.options,(function(a){return a.selected})).map((function(a){return"_value"in a?a._value:a.value}));a.$set(t,"form_type",e.target.multiple?s:s[0])}}},[e("option",{attrs:{value:"",selected:""}},[a._v("Pilih Tipe Form")]),a._v(" "),a._l(a.input_types,(function(t,s){return e("option",{key:s,attrs:{selected:""},domProps:{value:t}},[a._v(a._s(t))])}))],2)])]),a._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"mb-3 col-md-3"},[e("b-form-group",{attrs:{label:"nullable"}},[e("b-form-radio",{attrs:{value:!0},model:{value:t.nullable,callback:function(e){a.$set(t,"nullable",e)},expression:"item.nullable"}},[a._v("true")]),a._v(" "),e("b-form-radio",{attrs:{value:!1},model:{value:t.nullable,callback:function(e){a.$set(t,"nullable",e)},expression:"item.nullable"}},[a._v("false")])],1)],1),a._v(" "),e("div",{staticClass:"mb-3 col-md-3"},[e("b-form-group",{attrs:{label:"primary"}},[e("b-form-radio",{attrs:{value:!0},model:{value:t.primary,callback:function(e){a.$set(t,"primary",e)},expression:"item.primary"}},[a._v("true")]),a._v(" "),e("b-form-radio",{attrs:{value:!1},model:{value:t.primary,callback:function(e){a.$set(t,"primary",e)},expression:"item.primary"}},[a._v("false")])],1)],1)]),a._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-12"},[e("b-button",{attrs:{variant:"primary"},on:{click:a.addField}},[e("div",{staticClass:"fa fa-plus"})]),a._v(" "),e("b-button",{attrs:{variant:"danger"},on:{click:function(t){return a.removeField(s)}}},[e("div",{staticClass:"fa fa-minus"})])],1)]),a._v(" "),e("hr",{staticClass:"dashed"})])}))],2),a._v(" "),e("b-button",{attrs:{variant:"primary"},on:{click:a.generateCrud}},[a._v("Generate!")])],1):a._e()])]),a._v(" "),e("b-modal",{attrs:{size:"xl","hide-footer":!0},model:{value:a.show_modal_order,callback:function(t){a.show_modal_order=t},expression:"show_modal_order"}},[e("draggable",{staticClass:"list-group",attrs:{list:a.data.fields,"ghost-class":"ghost"}},[a._l(a.data.fields,(function(t,s){return e("div",{key:s,staticClass:"list-group-item"},[a._v("\n                "+a._s(t)+"\n            ")])})),a._v(" "),e("b-btn",{attrs:{variant:"primary"},on:{click:function(t){return a.generateCrud(!1)}}},[a._v("Simpan")])],2)],1)],1)}),[],!1,null,null,null);t.default=l.exports}}]);
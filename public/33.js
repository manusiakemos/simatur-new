(window.webpackJsonp=window.webpackJsonp||[]).push([[33],{323:function(t,a,n){"use strict";n.r(a);var i={name:"WebArsip",created:function(){this.getArsip()},methods:{getArsip:function(){var t=this;this.axios.get("/api/mobile/arsip").then((function(a){t.data=_.chunk(a.data,3)}))}},data:function(){return{data:null}}},s=n(1),e=Object(s.a)(i,(function(){var t=this,a=t.$createElement,n=t._self._c||a;return t.data?n("div",{staticClass:"container py-5"},t._l(t.data,(function(a){return n("div",{staticClass:"row"},t._l(a,(function(a){return n("div",{staticClass:"col-lg-4"},[n("b-card",{staticClass:"mb-3",attrs:{title:a.arsip_name}},[n("a",{staticClass:"btn btn-outline-primary",attrs:{href:a.arsip_file_path,target:"_blank"}},[n("span",{staticClass:"fa fa-file-pdf text-danger"}),t._v(" Download File\n                ")])])],1)})),0)})),0):t._e()}),[],!1,null,null,null);a.default=e.exports}}]);
(window.webpackJsonp=window.webpackJsonp||[]).push([[31],{340:function(e,a,t){"use strict";t.r(a);var r={name:"Register",data:function(){return{errors:[],data:{username:"",password:""},hasRegistered:!1}},methods:{invalidFeedback:function(e){return this.errors[e]?this.errors[e].join():""},inputState:function(e){return!this.errors[e]&&null},register:function(){var e=this;this.axios.post("/api/register",this.data).then((function(a){e.makeToast(a.data.text,a.data.message),e.$nextTick((function(){setTimeout((function(){return e.$router.push("/")}),1e3)}))})).catch((function(a){a.response&&(e.errors=a.response.data.errors),e.$message.error(a.response.data.message)}))}}},o=t(1),n=Object(o.a)(r,(function(){var e=this,a=e.$createElement,t=e._self._c||a;return t("div",{staticClass:"d-flex align-items-center justify-content-center h100vh"},[t("b-card",{staticClass:"w-lg-50 p-4"},[t("div",[t("div",{staticClass:"d-flex justify-content-center"},[t("router-link",{attrs:{to:"/"}},[t("img",{attrs:{src:"/images/tab.png",alt:"",height:"100px"}})])],1),e._v(" "),t("h4",{staticClass:"mb-3 mt-1 text-center text-uppercase"},[e._v("\n                "+e._s(e.$store.state.appName)+" Kabupaten Tabalong\n            ")]),e._v(" "),t("form",{attrs:{action:"/api/login",type:"POST"},on:{submit:function(a){return a.preventDefault(),e.register(a)}}},[t("b-form-group",{attrs:{placeholder:"name","label-for":"name","invalid-feedback":e.invalidFeedback("name")}},[t("b-input",{attrs:{placeholder:"name",state:e.inputState("name"),autocomplete:"name",type:"text",id:"name"},model:{value:e.data.name,callback:function(a){e.$set(e.data,"name",a)},expression:"data.name"}})],1),e._v(" "),t("b-form-group",{attrs:{placeholder:"email","label-for":"email","invalid-feedback":e.invalidFeedback("email")}},[t("b-input",{attrs:{placeholder:"email",state:e.inputState("email"),autocomplete:"email",type:"email",id:"email"},model:{value:e.data.email,callback:function(a){e.$set(e.data,"email",a)},expression:"data.email"}})],1),e._v(" "),t("b-form-group",{attrs:{placeholder:"phone","label-for":"phone","invalid-feedback":e.invalidFeedback("phone")}},[t("b-input",{attrs:{placeholder:"phone",state:e.inputState("phone"),autocomplete:"phone",type:"text",id:"phone"},model:{value:e.data.phone,callback:function(a){e.$set(e.data,"phone",a)},expression:"data.phone"}})],1),e._v(" "),t("b-form-group",{attrs:{placeholder:"provider","label-for":"provider_id","invalid-feedback":e.invalidFeedback("provider_id")}},[t("select-ajax",{attrs:{"api-url":"/api/select/provider","option-text":"provider_name","option-value":"provider_id",id:"provider_id"},model:{value:e.data.provider_id,callback:function(a){e.$set(e.data,"provider_id",a)},expression:"data.provider_id"}}),e._v(" "),t("small",{staticClass:"text-danger"},[e._v(e._s(e.invalidFeedback("provider_id")))])],1),e._v(" "),t("b-form-group",{attrs:{placeholder:"username","label-for":"username","invalid-feedback":e.invalidFeedback("username")}},[t("b-input",{attrs:{placeholder:"username",state:e.inputState("username"),autocomplete:"username",type:"text",id:"username"},model:{value:e.data.username,callback:function(a){e.$set(e.data,"username",a)},expression:"data.username"}})],1),e._v(" "),t("b-form-group",{attrs:{"label-for":"password","invalid-feedback":e.invalidFeedback("password")}},[t("b-input",{attrs:{placeholder:"password",state:e.inputState("password"),type:"password",id:"password",autocomplete:"new-password"},model:{value:e.data.password,callback:function(a){e.$set(e.data,"password",a)},expression:"data.password"}})],1),e._v(" "),t("b-form-group",{attrs:{"label-for":"password_confirmation","invalid-feedback":e.invalidFeedback("password_confirmation")}},[t("b-input",{attrs:{placeholder:"password confirmation",state:e.inputState("password_confirmation"),type:"password",id:"password_confirmation",autocomplete:"new-password_confirmation"},model:{value:e.data.password_confirmation,callback:function(a){e.$set(e.data,"password_confirmation",a)},expression:"data.password_confirmation"}})],1),e._v(" "),t("p",[e._v("Sudah punya akun? "),t("router-link",{attrs:{to:{name:"Login"}}},[e._v("Login Sekarang")])],1),e._v(" "),t("b-button",{staticClass:"shadow btn-block mt-3",attrs:{variant:"primary",type:"submit"}},[e._v("DAFTAR")])],1)])])],1)}),[],!1,null,null,null);a.default=n.exports}}]);
(window.webpackJsonp=window.webpackJsonp||[]).push([[22],{307:function(t,a,e){"use strict";e.r(a);var i={computed:{role:function(){return this.$store.state.auth?this.$store.state.auth.data.role:"user"}},created:function(){this.getData()},data:function(){return{mobile:!1,initialShow:!0,menu:[]}},methods:{logout:function(){var t=this;this.$dialog.confirm("Apakah Kamu Yakin?").then((function(){t.axios.post("/logout"),t.makeToast("Logout"),t.$store.commit("setAuth",{status:!1,token:"",data:{name:"",username:"",password:"",password_confirmation:"",avatar:"",role:"",links:{update:"",edit:"",avatar:""}}}),t.$router.push({path:"/"})}))},getData:function(){var t=this;this.axios.get("/api/select/menu").then((function(a){t.menu=a.data}))}}},s=e(1),o={components:{sidebar:Object(s.a)(i,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{attrs:{id:"sidebar"}},[e("sidebar-menu",{attrs:{"hide-toggle":!0,theme:"white-theme",width:"250px",menu:t.menu}},[e("div",{staticClass:"mb-3 mt-3",attrs:{slot:"header"},slot:"header"},[e("div",{staticClass:"d-flex align-items-center"},[e("img",{staticClass:"img pl-4 pr-4",attrs:{src:"/images/tab.png",alt:"logo",height:"60"}}),t._v(" "),e("h4",[t._v(t._s(t.$store.state.appName))])])]),t._v(" "),e("div",{attrs:{slot:"footer"},slot:"footer"},[e("b-btn",{staticClass:"p-3",attrs:{variant:"primary",block:""},on:{click:t.logout}},[t._v("Logout "),e("span",{staticClass:"fa fa-lock"})])],1)])],1)}),[],!1,null,null,null).exports},computed:{showSidebar:function(){return this.$store.state.showSidebar},auth:function(){return this.$store.state.auth}},created:function(){var t=screen.width,a=t>600;this.$store.commit("setShowSideBar",a),this.mobile=t<600},data:function(){return{collapsed:!0,mainPropsImg:{blank:!1,blankColor:"#777",width:35,height:35,class:"m1"},showNotification:!1,mobile:!1}},methods:{toggleNotif:function(){this.showNotification=!this.showNotification},toggleSidebar:function(){this.$store.commit("toggleSideBar")},logout:function(){this.$refs.sidebarRef.logout()},pushRoute:function(t){this.$router.push(t)}}},n=Object(s.a)(o,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"main-wrapper"},[e("aside",{directives:[{name:"show",rawName:"v-show",value:t.showSidebar,expression:"showSidebar"}],staticClass:"main-sidebar"},[e("sidebar",{ref:"sidebarRef"})],1),t._v(" "),e("section",{class:t.showSidebar?"main-content margin-sidebar":"main-content"},[e("div",{staticClass:"d-flex align-items-center p-2 m-2"},[e("a",{staticClass:"mr-3 d-none d-lg-block",attrs:{href:"#"},on:{click:function(a){return a.preventDefault(),t.toggleSidebar(a)}}},[e("i",{staticClass:"fa fa-bars",staticStyle:{"font-size":"18px"},attrs:{"aria-hidden":"true"}})]),t._v(" "),e("div",{staticClass:"ml-auto d-flex align-items-center d-inline-block"},[e("a",{staticClass:"mr-3 d-lg-none",attrs:{href:"#"},on:{click:function(a){return a.preventDefault(),t.toggleSidebar(a)}}},[e("i",{staticClass:"fa fa-bars",staticStyle:{"font-size":"18px"},attrs:{"aria-hidden":"true"}})]),t._v(" "),e("div",{attrs:{id:"profile-target"}},[e("b-dropdown",{attrs:{size:"lg","menu-class":"border-none shadow-sm",variant:"transparent",right:"",text:"Right align","no-caret":!0}},[e("template",{slot:"button-content"},[e("b-img",t._b({attrs:{src:t.auth.data.avatar,rounded:"circle",alt:"Circle image"}},"b-img",t.mainPropsImg,!1))],1),t._v(" "),e("b-dropdown-item",{attrs:{variant:"dark"},on:{click:function(a){return a.preventDefault(),t.pushRoute("/admin/profile")}}},[e("span",{staticClass:"fa fa-user-circle"}),t._v(" Profil\n                        ")]),t._v(" "),e("b-dropdown-divider"),t._v(" "),e("b-dropdown-item",{attrs:{variant:"dark"},on:{click:function(a){return a.preventDefault(),t.logout(a)}}},[e("span",{staticClass:"fa fa-lock"}),t._v(" Logout\n                        ")])],2)],1)])]),t._v(" "),e("div",{staticClass:"container-fluid content-wrap"},[e("router-view")],1)])])}),[],!1,null,null,null);a.default=n.exports}}]);
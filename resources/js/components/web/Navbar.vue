<template>
    <b-navbar toggleable="md" variant="transparent">
       <div class="container-fluid pt-3">
           <b-navbar-brand>
               <img src="/images/tabalong.png" alt="tabalong" class="logo">
               <img src="/images/kominfo.png" alt="kominfo" class="logo">
               <h4 class="d-inline-block d-sm-none">SIMATUR</h4>
           </b-navbar-brand>
           <b-navbar-toggle target="navbar-toggle-collapse">
               <template v-slot:default="{ expanded }">
                   <span v-if="expanded" class="fa fa-expanded"></span>
                   <span v-else class="fa fa-bars"></span>
               </template>
           </b-navbar-toggle>
           <b-collapse id="navbar-toggle-collapse" is-nav v-model="isOpen" :class="isOpen ? 'bg-white' : ''">
               <b-navbar-nav class="p-4">
                   <b-nav-item :to="{name:'WebHome'}">Beranda</b-nav-item>
                   <b-nav-item :to="{name:'WebHotspot'}">Hotspot</b-nav-item>
<!--                   <b-nav-item v-if="auth.status" :to="{name:'WebListPermohonan'}">Permohanan Rekomendasi</b-nav-item>-->
                   <b-nav-item :to="{name:'WebArsip'}">Arsip</b-nav-item>
                   <b-nav-item :to="{name:'TowerMap'}">Peta Tower</b-nav-item>
                   <b-nav-item :to="{name:'DataTower'}">Tabel Data Tower</b-nav-item>
                   <b-nav-item :to="{name:'ZonaMap'}">Peta Zona</b-nav-item>
                   <b-nav-item :to="{name:'Statistik'}">Grafik Statistik</b-nav-item>
               </b-navbar-nav>
               <b-navbar-nav class="ml-auto p-4" v-if="auth.status == false">
                   <b-nav-item :to="{name:'Login'}">Login</b-nav-item>
<!--                   <b-nav-item :to="{name:'Register'}">Daftar</b-nav-item>-->
               </b-navbar-nav>
               <b-navbar-nav class="ml-auto p-4" v-else>
                  <div>
                      <b-nav-item @click="logout">Logout</b-nav-item>
                  </div>
               </b-navbar-nav>
           </b-collapse>
       </div>
    </b-navbar>
</template>

<style scoped>
    .nav-item{
        text-transform: uppercase;
    }
    .logo {
        min-height:40px;
        max-height:calc(100vw / 25);
        padding:3px;
        margin: 0px;
    }

    @media(max-width:600px) {
        #navbar-toggle-collapse{
            z-index:99999999;
        }
    }

</style>

<script>
  export default {
      data: function () {
          return {isOpen: false,}
      },
  }
</script>

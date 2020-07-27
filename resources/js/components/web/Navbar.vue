<template>
    <div>
        <b-navbar toggleable="md" type="light" variant="light" class="pl-sm-5 pr-sm-5">
            <b-navbar-brand :to="{name:'Home'}">
                <img src="/images/tabalong.png" alt="tabalong" class="logo">
            </b-navbar-brand>
            <h1 class="d-inline-block d-sm-none">SIMATUR</h1>

            <b-navbar-toggle target="navbar-toggle-collapse">
                <template v-slot:default="{ expanded }">
                    <span v-if="expanded" class="fa fa-2x fa-expanded"></span>
                    <span v-else class="fa fa-2x fa-bars"></span>
                </template>
            </b-navbar-toggle>
            <b-collapse id="navbar-toggle-collapse" is-nav>
                <b-navbar-nav>
                    <b-nav-item :to="{name:'Home'}">Home</b-nav-item>
                    <b-nav-item :to="{name:'TowerMap'}">Peta Tower</b-nav-item>
                    <b-nav-item :to="{name:'DataTower'}">Tabel Data Tower</b-nav-item>
                    <b-nav-item :to="{name:'ZonaMap'}">Peta Zona</b-nav-item>
                    <b-nav-item :to="{name:'Statistik'}">Grafik Statistik</b-nav-item>
                </b-navbar-nav>
            </b-collapse>

            <b-navbar-brand href="#" class="ml-auto d-none d-sm-block">
                <img src="/images/kominfo.png" alt="kominfo" class="logo">
            </b-navbar-brand>
        </b-navbar>
    </div>
</template>

<script>
    export default {
        name: "Navbar"
    }
</script>

<style scoped>
    .logo {
        min-height:60px;
        max-height:calc(100vw / 25);
        padding:3px;
        margin: 0px;
    }
</style>

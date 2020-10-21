<template>
    <div id="weblayout">
        <navbar></navbar>
        <router-view></router-view>
    </div>
</template>

<script>
    import Navbar from "../../components/web/Navbar";
    export default {
        components: {
            Navbar
        }
    }
</script>

<style scoped>
    #weblayout{
        background-image: url('../../../images/Artboard.svg') !important;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        min-height:calc(100vh - 0px)!important;
    }

</style>

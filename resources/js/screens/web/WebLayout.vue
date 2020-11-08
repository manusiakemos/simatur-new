<template>
    <div id="weblayout">
        <my-navbar></my-navbar>
        <router-view></router-view>
    </div>
</template>

<script>
    import Navbar from "../../components/web/Navbar";
    export default {
        components: {
           "my-navbar" : Navbar
        }
    }
</script>

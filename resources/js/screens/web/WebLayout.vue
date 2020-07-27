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

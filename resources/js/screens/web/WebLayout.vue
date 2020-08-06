<template>
    <div id="weblayout">
        <navbar></navbar>
        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
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

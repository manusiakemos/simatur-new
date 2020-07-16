<template>
    <VuePerfectScrollbar class="scroll-area" :settings="settings">
        <slot></slot>
    </VuePerfectScrollbar>
</template>

<script>
    import VuePerfectScrollbar from 'vue-perfect-scrollbar'

    export default {
        components: {
            VuePerfectScrollbar
        },
        name: 'app',
        data() {
            return {
                settings: {
                    maxScrollbarLength: 100
                }
            }
        },
        methods: {
            scrollHandle(evt) {
                console.log(evt)
            }
        }
    }

</script>
<style lang="scss">
    .scroll-area {
        height: 100vh;
    }
</style>

<template>
    <vue-numeric currency="Rp." separator="." v-model="propModel"></vue-numeric>
</template>

<script>
    import VueNumeric from 'vue-numeric'

    export default {
        components: {
            VueNumeric
        },
        computed: {
            propModel: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit("input", value);
                }
            }
        },
        props: {
            value: {default: null, required: true},
        },
    }
</script>

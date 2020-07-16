<template>
    <date-picker v-model="propModel"></date-picker>
</template>

<script>
    import DatePicker from 'vue2-datepicker';

    export default {
        components: {
            DatePicker
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

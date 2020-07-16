<template>
    <date-picker :placeholder="placeholder" v-model="propModel" value-type="format" :format="format" :type="type"></date-picker>
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
            type: {type: String, default: "date", required: false},
            format: {type: String, default: "YYYY-mm-dd", required: false},
            placeholder: {type: String, default: "Pilih Tanggal", required: false},
        },
    }
</script>

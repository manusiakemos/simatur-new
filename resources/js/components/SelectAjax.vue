<template>
    <model-list-select :list="options"
                       v-model="propModel"
                       :option-value="optionValue"
                       :option-text="optionText"
                       :placeholder="placeholderText">
    </model-list-select>
</template>

<script>
    import {ModelListSelect} from 'vue-search-select'

    export default {
        components: {
            ModelListSelect
        },
        created() {
            this.axios.post(this.apiUrl).then(res => {
                this.options = res.data;
            });
        },
        data() {
            return {
                options: [],
            };
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
            optionText: {default: "text", required: false},
            optionValue: {default: "value", required: false},
            placeholderText: {default: "Pilih Salah Satu", required: false},
            apiUrl: {type: String, default: "/api/select/status", required: false},
        },
    }
</script>

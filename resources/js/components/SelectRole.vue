<template>
    <select-ajax url="api/select/role" v-model="propModel"></select-ajax>
</template>

<script>
    export default {
        props:['value'],
        data () {
            return {
                options: [
                    {
                        value:'super-admin',
                        text: 'Super Admin'
                    },
                    {
                        value:'admin',
                        text: 'Admin'
                    },
                    {
                        value:'user',
                        text: 'User'
                    }
                ],
            };
        },
        computed: {
            propModel: {
                get() {
                    return this.value.toString();
                },
                set(value) {
                    this.$emit("input", value);
                }
            }
        }
    }
</script>

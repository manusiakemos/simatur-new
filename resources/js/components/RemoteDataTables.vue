<template>
    <div class="table-responsive">
        <table class="table table-hover w-100 dt-responsive nowrap" :id="selector">
            <thead class="bg-primary text-white">
            <tr>
                <th v-for="(v, i) in configDt.columns" :key="i" class="text-dark-all">{{ v.title }}</th>
            </tr>
            </thead>
            <slot></slot>
        </table>
    </div>
</template>


<script>
    export default {
        props: ["configDt", "selector"],
        data() {
            return {
                dataTablesVue: null,
            };
        },
        mounted() {
            this.initDt();
        },
        beforeDestroy() {
            this.dataTablesVue.clear().destroy();
        },
        methods: {
            initDt() {
                var me = this;
                me.dataTablesVue = $(document)
                    .find(`#${me.selector}`)
                    .DataTable(me.configDt);
            },
            refresh() {
                var me = this;
                me.dataTablesVue.ajax.reload();
            }
        }
    };
</script>

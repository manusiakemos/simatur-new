<template>
    <div class="container py-5" v-if="data">
        <div v-for="x in data" class="row justify-content-center" style="flex:1">
            <div class="col-md-4 d-flex" v-for="y in x">
                <b-card class="mb-3" :title="y.arsip_name" style="flex-grow: 1">
                    <a :href="y.arsip_file_path" target="_blank" class="btn btn-outline-dark">
                        <span class="fa fa-file-pdf text-danger"></span> Download File
                    </a>
                </b-card>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "WebArsip",
        created(){
            this.getArsip()
        },
        methods: {
            getArsip() {
                this.axios.get('/api/mobile/arsip').then(res=>{
                    this.data = _.chunk(res.data, 3)
                })
            },
        },
        data: function () {
            return {data: null,}
        },
    }
</script>

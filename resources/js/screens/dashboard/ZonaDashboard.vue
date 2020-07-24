<template>
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                    <li class="breadcrumb-item active" aria-current="page">Zona</li>
                </ol>
            </nav>
            <b-card class="shadow-sm" border-variant="light">
                <zonamap></zonamap>
            </b-card>
        </div>
    </div>
</template>

<script>
    import ZonaMapApi from "../../components/ZonaMapApi.vue";
    export default {
        components: {
            'zonamap':ZonaMapApi
        }
    }
</script>

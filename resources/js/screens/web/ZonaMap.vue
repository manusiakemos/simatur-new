<template>
    <div>
        <div id="section-one" class="py-5">
            <!--wrapper d-flex align-items-center-->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <b-card class="shadow-sm" border-variant="light" title="Peta Zona">
                            <zona-map-api class="mt-3"></zona-map-api>
                        </b-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ZonaMapApi from '../../components/ZonaMapApi';
    export default {
        name: "TowerMap",
        components: {ZonaMapApi}
    }
</script>

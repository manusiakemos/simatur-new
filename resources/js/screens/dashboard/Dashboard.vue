<template>
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                </ol>
            </nav>
            <b-card class="shadow-sm" border-variant="light">
                <tower-map-api></tower-map-api>
            </b-card>
        </div>
    </div>
</template>

<script>
    import TowerMapApi from '../../components/TowerMapApi';
    export default {
        components: {TowerMapApi}
    }
</script>

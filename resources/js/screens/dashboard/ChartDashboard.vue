<template>
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-12">
                    <b-card class="shadow-sm mb-3" border-variant="light">
                        <chart-provider url="/api/chart/provider"
                                        type="horizontal-bar"></chart-provider>
                    </b-card>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <b-card class="shadow-sm mb-3" border-variant="light">
                        <chart-provider url="/api/chart/tipe_koneksi"
                                        type="bar"></chart-provider>
                    </b-card>
                </div>
                <div class="col-lg-6">
                    <b-card class="shadow-sm mb-3" border-variant="light">
                        <chart-provider url="/api/chart/operator"
                                        type="bar"></chart-provider>
                    </b-card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MySingleChart from '../../components/MySingleChart';
    import MyChartProvider from '../../components/MyChartProvider';
    export default {
        components: {
            'single-chart':MySingleChart,
            'chart-provider':MyChartProvider,
        }
    }
</script>

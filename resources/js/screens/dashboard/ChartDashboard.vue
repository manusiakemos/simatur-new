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
                        <b-tabs content-class="mt-3" justified lazy>
                            <b-tab title="Chart Pemilik Tower" active>
                                <chart-provider url="/api/chart/provider"
                                                type="horizontal-bar"></chart-provider>
                            </b-tab>
                            <b-tab title="Chart Tipe Koneksi">
                                <chart-provider url="/api/chart/tipe_koneksi"
                                                type="pie"></chart-provider>
                            </b-tab>

                            <b-tab title="Chart Operator">
                                <chart-provider url="/api/chart/operator"
                                                type="horizontal-bar"></chart-provider>
                            </b-tab>
                        </b-tabs>
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
            'single-chart': MySingleChart,
            'chart-provider': MyChartProvider,
        }
    }
</script>

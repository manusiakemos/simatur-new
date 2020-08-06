<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <b-form-group
                    id="kecamatan_id"
                    label-for="kecamatan_id"
                >
                    <select-ajax id="kecamatan_id"
                                 api-url="/api/select/kecamatan"
                                 placeholder-text="Semua Kecamatan"
                                 option-value="kecamatan_id"
                                 option-text="kecamatan_nama"
                                 v-model="data.kecamatan_id"></select-ajax>
                </b-form-group>
            </div>
            <div class="col-12">
                <h4 class="text-capitalize">{{message}}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p class="text-uppercase d-block d-sm-none d-print-block">{{chartdata.datasets[0].label}}</p>
            </div>
            <div class="col-lg-12">
                <bar-chart
                    class="bar-chart"
                    v-if="loaded && type == 'bar'"
                    :chartdata="chartdata"
                    :options="options"/>
                <pie-chart
                    class="pie-chart"
                    v-if="loaded && type == 'pie'"
                    :chartdata="chartdata"
                    :options="options"/>
                <line-chart
                    class="line-chart"
                    v-else-if="loaded && type == 'line'"
                    :chartdata="chartdata"
                    :options="options"/>
                <horizontal-bar-chart
                    class="horizontal-bar-chart"
                    v-else-if="loaded && type == 'horizontal-bar'"
                    :chartdata="chartdata"
                    :options="options"/>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .small {
        max-height: 500px;
    }
</style>


<script>
    import BarChart from './BarChart.vue'
    import LineChart from './LineChart.vue'
    import PieChart from './PieChart.vue'
    import HorizontalBarChart from "./HorizontalBarChart";

    export default {
        watch: {
            "data.kecamatan_id": function (value) {
                this.loaded = false;
                this.initDataChart();
                this.getData();
            }
        },
        props: {
            url: {
                type: String,
                default: ''
            },
            type: {
                type: String,
                default: 'bar'
            }
        },
        name: 'MyChartProvider',
        components: {HorizontalBarChart, BarChart, LineChart, PieChart},
        methods: {
            random_bg_color() {
                var x = Math.floor(Math.random() * 256);
                var y = Math.floor(Math.random() * 256);
                var z = Math.floor(Math.random() * 256);
                var bgColor = "rgb(" + x + "," + y + "," + z + ")";
                return bgColor;
            },
            initDataChart() {
                this.chartdata = {
                    labels: [],
                    datasets: [
                        {
                            label: '',
                            data: [],
                            backgroundColor: [
                                '#6363e0',
                                '#eb831e',
                                '#c55a5f',
                                '#4089fa',
                                '#bae05b',
                                '#3593db',
                                '#272adb',
                                '#db2940',
                                '#3bdb84',
                                '#72db1f',
                                '#193b45',
                            ],
                            borderWidth: 5
                        },
                    ],
                    responsive: true,
                };
                this.options = {};

                for (var i = 0; i < 100; i++) {
                    this.chartdata.datasets[0].backgroundColor.push(this.random_bg_color());
                }
                if (this.type == 'pie') {
                    this.options = {
                        responsive: true,
                        plugins: {
                            datalabels: {
                                color: 'black',
                                labels: {
                                    title: {
                                        font: {
                                            weight: 'bold'
                                        }
                                    },
                                    value: {
                                        color: 'green'
                                    }
                                },
                                formatter: (value, ctx) => {
                                    let sum = 0;
                                    let dataArr = ctx.chart.data.datasets[0].data;
                                    dataArr.map(data => {
                                        sum += data;
                                    });
                                    let percentage = (value * 100 / sum).toFixed(2) + "%";
                                    return `${percentage} (${value})`;
                                },
                            }
                        },
                        maintainAspectRatio: false,
                    }
                } else {
                    this.options = {
                        plugins: {
                            datalabels: {
                                align: 'end',
                                offset: 2,
                                color: 'black',
                                labels: {
                                    title: {
                                        font: {
                                            weight: 'bold'
                                        }
                                    },
                                    value: {
                                        color: 'green'
                                    }
                                },
                                formatter: (value, ctx) => {
                                    let sum = 0;
                                    let dataArr = ctx.chart.data.datasets[0].data;
                                    dataArr.map(data => {
                                        sum += data;
                                    });
                                    let percentage = ((value / sum) * 100).toFixed(2) + "%";
                                    return `${percentage} (${value})`;
                                },
                            }
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        maintainAspectRatio: false
                    }
                }
            },
            async getData() {
                this.loaded = false
                try {
                    const res = await axios.post(this.url, this.data);
                    this.message = res.data.message;
                    res.data.data.forEach((v, i) => {
                        this.chartdata.labels.push(v.label);
                        this.chartdata.datasets[0].data.push(v.value);
                        if (v.color) {
                            if (i == 0) {
                                this.chartdata.datasets[0].backgroundColor = [];
                            }
                            this.chartdata.datasets[0].backgroundColor.push(v.color);
                        }
                    });
                    this.chartdata.datasets[0].label = res.data.message;
                    this.$nextTick(() => {
                        // console.log(this.chartdata.datasets[0].backgroundColor);
                        this.loaded = true;
                    })
                } catch (e) {
                    console.error(e)
                }
            },
        },
        data: () => ({
            loaded: false,
            chartdata: {
                labels: [],
                datasets: [
                    {
                        label: '',
                        data: [],
                        backgroundColor: [
                            '#6363e0',
                            '#eb831e',
                            '#c55a5f',
                            '#4089fa',
                            '#bae05b',
                            '#3593db',
                            '#272adb',
                            '#db2940',
                            '#3bdb84',
                            '#72db1f',
                            '#193b45',
                        ],
                        borderWidth: 5
                    },
                ],
                responsive: true,
            },
            options: {},
            height: 500,
            message: "",
            data: {
                provider_id: "",
                kecamatan_id: "",
            },
        }),
        created() {
            this.initDataChart();
        },
        computed: {
            myStyles() {
                return {
                    height: `${this.height}px`,
                    position: 'relative'
                }
            }
        },
        mounted() {
            this.getData();
        }
    }
</script>

<template>
    <div>
        <nav aria-label="breadcrumb" v-if="auth.status && auth.data.role == 'super_admin'">
            <ol class="breadcrumb shadow-sm">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Hotspot</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-12" v-if="auth.status && auth.data.role == 'super_admin'">
                <div class="mb-3">
                    <b-btn @click="refresh">Refresh</b-btn>
                </div>
            </div>
            <div class="col-12">
                <b-tabs content-class="mt-3">
                    <b-tab title="Ping Monitoring" active lazy>
                        <div class="row">
                            <div class="col-lg-3 mb-3 d-flex" v-for="(v,i) in hotspot.data" :key="i">
                                <b-card no-title class="shadow-sm" style="flex:1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="display-6 text-primary">{{ v.skpd_ip }}</h6>
                                        <b-badge :variant="v.skpd_status ?'success' : 'danger'"
                                                 class="d-flex align-items-center">
                                            {{ v.skpd_status ? "connected" : "disconnected" }}
                                        </b-badge>
                                    </div>

                                    <span class="display-6 d-block">{{ v.skpd_nama }}</span>
                                    <span class="display-6 d-block">{{ v.skpd_tipe }}</span>
                                    <span class="display-6 d-block" v-if="v.data_ping.data.latency">{{ v.data_ping.data.latency }}</span>
                                    <span class="display-6 d-block" v-else>~ ms</span>
                                </b-card>
                            </div>
                        </div>
                    </b-tab>
                    <b-tab title="Peta Hotspot" lazy>
                        <hotspot-map></hotspot-map>
                    </b-tab>
                </b-tabs>
            </div>

        </div>
    </div>
</template>

<script>
var myInterval;
import HotspotMapApi from "../../components/HotspotMapApi";

export default {
    name: "HotspotDashboard",
    components: {
        'hotspot-map': HotspotMapApi
    },
    created() {
        this.getData();
    },
    mounted() {
        this.mySetInterval();
        clearInterval(myInterval);
    },
    beforeDestroy() {
        clearInterval(myInterval);
    },
    destroyed() {
        clearInterval(myInterval);
    },
    beforeCreate() {
        clearInterval(myInterval);
    },
    data() {
        return {
            myInterval: '',
            indexInterval: 0,
            dataLength: 0,
            hotspot: {
                'message': '',
                'data': []
            }
        }
    },
    methods: {
        getData() {
            clearInterval(myInterval);
            this.axios.post('/api/dashboard/hotspot').then(res => {
                this.hotspot = res.data;
                this.dataLength = res.data.data.length;
            });

            this.$nextTick(() => {
                this.mySetInterval();
            });
        },
        mySetInterval() {
            myInterval = setInterval(() => {
                setTimeout(() => {
                    this.pingData();
                }, 10000)
            }, 10000)
        },
        pingData() {
            var vm = this;
            if (this.hotspot.data.length > 0) {
                var data = this.hotspot.data[this.indexInterval];
                if (data) {
                    if (data.hasOwnProperty("skpd_ip")) {
                        var parameters = {url: data.skpd_ip};
                        this.axios.post('/api/dashboard/ping', parameters).then(res => {
                            data.data_ping = res.data.data.data_ping;
                            data.skpd_status = res.data.data.skpd_status;
                        }).catch((err) => {
                            data.skpd_status = 0;
                        });
                    }
                }
                if (this.indexInterval > this.dataLength) {
                    this.indexInterval = 0;
                } else {
                    this.indexInterval++;
                }
            }
        },
        refresh() {
            clearInterval(myInterval);
            this.getData();
            this.mySetInterval();
        }
    }
}
</script>

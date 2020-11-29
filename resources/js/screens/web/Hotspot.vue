<template>
    <div class="container" id="datatower">
        <div class="row">
            <div class="col-12">
                <div class="py-4">
                    <hotspot-dashboard></hotspot-dashboard>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import HotspotDashboard from "../dashboard/HotspotDashboard";
export default {
    name: "Hotspot",
    components:{HotspotDashboard}
}
</script>

<style scoped>

</style>

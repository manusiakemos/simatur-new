<template>
    <div v-if="propModel">
        <location-picker
            v-model="propModel"
            :options="options">
        </location-picker>
    </div>
</template>


<script>
    import {LocationPicker} from 'vue2-location-picker' // if installComponents is false

    export default {
        name: 'App',
        components: {LocationPicker}, // if installComponents is false
        props: ['value'],
        created() {
            // this.location = this.propModel;
        },
        computed: {
            propModel: {
                get() {
                    return this.value
                },
                set(value) {
                    this.$emit("input", value);
                }
            }
        },
        data: function () {
            return {
                location: {
                    lat: -2.173738,
                    lng: 115.398434
                },
                options: { // is not required
                    map: {
                        fontFamily: 'Poppins'
                    },
                    marker: {
                        fontFamily: 'Poppins'
                    },
                    autocomplete: {/** autocomplete options **/}
                },
            }
        }
    }
</script>

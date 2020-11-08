<template>
    <div class="row">
        <div class="col-12">
            <b-form-group>
                <select-ajax v-model="shape" api-url="/api/select/shape"></select-ajax>
            </b-form-group>
            <div class="mt-3 mb-3">
                <b-btn @click="add">Tambah</b-btn>
            </div>
        </div>
        <div class="col-12">
            <b-card class="shadow" no-border>
                <div class="table-responsive" v-if="show">
                    <v-stage ref="stage" :config="stageSize">
                        <v-layer>
                            <template :ref="`layer${i}`" v-for="(v,i) in listData">
                                <v-circle v-if="v.shape == 'circle'"
                                          @dragstart="handleDragStart"
                                          @dragend="handleDragEnd"
                                          :config="v"
                                ></v-circle>
                                <v-text v-else-if="v.shape == 'text'"
                                        @dragstart="handleDragStart"
                                        @dragend="handleDragEnd"
                                        :config="v"
                                ></v-text>
                                <v-line v-else-if="v.shape == 'line'"
                                        @dragstart="handleDragStart"
                                        @dragend="handleDragEnd"
                                        :config="v"
                                ></v-line>
                                <v-rect v-else-if="v.shape == 'rect'"
                                        @dragstart="handleDragStart"
                                        @dragend="handleDragEnd"
                                        :config="v"
                                ></v-rect>
                            </template>
                        </v-layer>
                    </v-stage>
                </div>
            </b-card>
        </div>
    </div>
</template>

<script>
    const width = window.innerWidth;
    const height = window.innerHeight;

    export default {
        name: "Backbone",
        created() {
            this.getData();
        },
        data() {
            return {
                shape: 'circle',
                stageSize: {
                    width: width,
                    height: height
                },
                isDragging: false,
                listData: [],
                show: false,
            };
        },
        methods: {
            handleDragStart(e) {
                this.isDragging = true;
            },
            handleDragEnd(e) {
                let x = e.target.attrs;
                let index = _.findIndex(this.listData, function (o) {
                    return o.id == x.id;
                });
                this.listData[index] = x;
                this.isDragging = false;
            },
            add() {
                let x = null;
                let id = 1;
                switch (this.shape) {
                    case 'circle':
                        x = {
                            "id": id,
                            "text": "lorem ipsum dolor sit",
                            "shape": this.shape,
                            "x": 50,
                            "y": 50,
                            "radius": 70,
                            "fill": 'red',
                            "stroke": 'black',
                            "strokeWidth": 4,
                            "draggable": true,
                        };
                        break;
                    case 'text':
                        x = {
                            "id": id,
                            "text": "lorem ipsum dolor sit",
                            "shape": this.shape,
                            "x": 50,
                            "y": 50,
                            "draggable": true
                        };
                        break;
                    case 'rect':
                        x = {
                            "shape": this.shape,
                            "id": id,
                            "x": 20,
                            "y": 50,
                            "width": 100,
                            "height": 100,
                            "fill": "red",
                            "stroke": "black",
                            "shadowBlur": 10,
                            "draggable": true
                        };
                        break;
                    case 'line':
                        x = {
                            "shape": this.shape,
                            "id": id,
                            "x": 20,
                            "y": 200,
                            "tension": 0.5,
                            "closed": true,
                            "stroke": "black",
                            "draggable": true
                        };
                        break;
                }

                if (x) {
                    this.listData.push(x);
                }
            },
            getData() {
                this.axios.get('/api/backbone').then(res => {
                    this.listData = res.data;
                    this.show = true;
                });
            },
        }
    }
</script>

<template>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <b-breadcrumb>
                        <b-breadcrumb-item to="/admin/dashboard">
                            Home
                        </b-breadcrumb-item>
                        <b-breadcrumb-item active>Backbone</b-breadcrumb-item>
                    </b-breadcrumb>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="py-3 pr-3 pl-3 shadow">
                        <b-btn class="m-1" @click="simpan">Simpan</b-btn>
                        <b-btn class="m-1" @click="getData">Refresh</b-btn>
                        <b-input type="number" class="m-1" v-model="stageSize.height" placeholder="height"></b-input>
                        <b-input type="number" class="m-1" v-model="stageSize.width" placeholder="width"></b-input>
                        <b-btn class="m-1" @click="add('circle')">Lingkaran</b-btn>
                        <b-btn class="m-1" @click="add('rect')">Persegi</b-btn>
                        <b-btn class="m-1" @click="add('line')">Garis</b-btn>
                        <b-btn class="m-1" @click="add('text')">Text</b-btn>
                        <b-card
                            no-title
                            class="shadow-sm mb-3"
                            v-for="(item, index) in stageSize.rectangles"
                            :key="index">
                            <div class="d-flex align-text-bottom justify-content-between">
                                <span class="display-5">{{ item.shape }}{{ item.id }}</span>
                                <div class="d-flex">
                                    <b-btn @click="deleteShape(index)" variant="danger" size="sm">
                                        <span class="fa fa-trash-alt"></span>
                                    </b-btn>
                                    <b-btn @click="copyShape(index)" variant="primary" size="sm" class="ml-1">
                                        <span class="fa fa-copy"></span>
                                    </b-btn>
                                </div>
                            </div>
                            <b-form-group v-if="item.shape == 'text'" class="mt-3">
                                <b-input v-model="item.text"></b-input>
                            </b-form-group>
                            <b-form-group>
                                <b-input type="color" v-model="item.fill"></b-input>
                            </b-form-group>
                        </b-card>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="py-3">
                        <v-stage
                            id="stage"
                            v-if="show"
                            ref="stage"
                            :config="stageSize"
                            @mousedown="handleStageMouseDown"
                            @touchstart="handleStageMouseDown"
                        >
                            <v-layer ref="layer">
                                <component
                                    v-for="item in stageSize.rectangles"
                                    :is="`v-${item.shape}`"
                                    :key="item.id"
                                    :config="item"
                                    @dragend="handleDragEnd"
                                    @transformend="handleTransformEnd"
                                ></component>
                                <v-transformer ref="transformer"></v-transformer>
                            </v-layer>
                        </v-stage>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// const width = window.innerWidth;
// const height = window.innerHeight;

export default {
    name: "Backbone",
    watch: {
        "stageSize.width": function (newValue) {
            this.stageSize.width = parseInt(newValue);
        },
        "stageSize.height": function (newValue) {
            this.stageSize.height = parseInt(newValue);
        }
    },
    created() {
        this.getData();
    },
    data() {
        return {
            stageSize: {
                width: 0,
                height: 0,
                scaleX: 0.1,
                scaleY: 0.1,
                rectangles: [],
            },
            selectedShapeName: '',
            show: false,
        };
    },
    methods: {
        handleTransformEnd(e) {
            const rect = this.stageSize.rectangles.find(
                (r) => r.name === this.selectedShapeName
            );
            // update the state
            rect.x = e.target.x();
            rect.y = e.target.y();
            rect.rotation = e.target.rotation();
            rect.scaleX = e.target.scaleX();
            rect.scaleY = e.target.scaleY();
        },
        handleStageMouseDown(e) {
            console.log("handleStageMouseDown");
            // clicked on stage - clear selection
            if (e.target === e.target.getStage()) {
                this.selectedShapeName = '';
                this.updateTransformer();
                return;
            }

            // clicked on transformer - do nothing
            const clickedOnTransformer =
                e.target.getParent().className === 'Transformer';
            if (clickedOnTransformer) {
                return;
            }

            // find clicked rect by its name
            const name = e.target.name();
            const rect = this.stageSize.rectangles.find((r) => r.name === name);
            if (rect) {
                this.selectedShapeName = name;
            } else {
                this.selectedShapeName = '';
            }
            this.updateTransformer();
            this.updateData(e.target);
        },
        updateTransformer() {
            console.log("updateTransformer");
            // here we need to manually attach or detach Transformer node
            const transformerNode = this.$refs.transformer.getNode();
            const stage = transformerNode.getStage();
            const {selectedShapeName} = this;

            const selectedNode = stage.findOne('.' + selectedShapeName);
            // do nothing if selected node is already attached
            if (selectedNode === transformerNode.node()) {
                return;
            }

            if (selectedNode) {
                // attach to another node
                transformerNode.nodes([selectedNode]);
            } else {
                // remove transformer
                transformerNode.nodes([]);
            }
            transformerNode.getLayer().batchDraw();
        },
        getData() {
            this.axios.get('/api/backbone').then(res => {
                this.stageSize = res.data;
                this.show = true;
            });
        },
        updateData(eventTarget) {
            let x = eventTarget.attrs;
            x.draggable = true;
            let index = _.findIndex(this.stageSize.rectangles, function (o) {
                return o.name == x.name;
            });
            this.stageSize.rectangles[index] = x;
        },
        handleDragEnd(e) {
            let x = e.target.attrs;
            x.draggable = true;
            let rect = this.stageSize.rectangles.find(
                (r) => r.name === x.name
            );
            rect = x;
        },
        simpan() {
            this.axios.post('/api/backbone', {
                'json': this.stageSize
            }).then(res => {
                this.makeToast(res.data.text, res.data.message)
            });
        },
        add: function (type) {
            let x;
            if (this.stageSize.rectangles.length == 0) {
                var y = 1;
                var id = y;
            } else {
                var y = _.maxBy(this.stageSize.rectangles, function (o) {
                    return o.id;
                });
                var id = y.id + 1;
            }

            let name = "shape-" + id;
            switch (type) {
                case 'circle':
                    x = {
                        "id": id,
                        "name": name,
                        "shape": type,
                        "rotation": 0,
                        "x": 10,
                        "y": 10,
                        "width": 100,
                        "height": 100,
                        "scaleX": 1,
                        "scaleY": 1,
                        "fill": "#5d6ce0",
                        "draggable": true,
                        "offsetX": 0,
                        "offsetY": 0,
                        "skewX": 0,
                        "skewY": 0
                    };
                    break;
                case 'text':
                    x = {
                        "id": id,
                        "z-index": 666,
                        "name": name,
                        "fill": "#333333",
                        "shape": type,
                        "rotation": 0,
                        "x": 10,
                        "y": 10,
                        "draggable": true,
                        "text": 'Some text on canvas',
                        "fontSize": 15
                    };
                    break;
                case 'rect':
                    x = {
                        "id": id,
                        "name": name,
                        "shape": type,
                        "draggable": true,
                        "fill": "#dc266e",
                        "rotation": 0,
                        "x": 10,
                        "y": 10,
                        "width": 100,
                        "height": 100,
                        "scaleX": 1,
                        "scaleY": 1,
                        "offsetX": 0,
                        "offsetY": 0,
                        "skewX": 0,
                        "skewY": 0
                    };
                    break;
                case 'line':
                    x = {
                        "id": id,
                        "name": name,
                        "shape": type,
                        "draggable": true,
                        "x": 20,
                        "y": 200,
                        "points": [0, 0, 100, 0],
                        "tension": 0,
                        "closed": true,
                        "stroke": "black",
                        "fill": "#333333",
                    };
                    break;
            }

            if (x) {
                this.stageSize.rectangles.push(x);
            } else {
                console.log("x is not defined");
            }
        },
        deleteShape(index) {
            this.stageSize.rectangles.splice(index, 1);
        },
        copyShape(index) {
            var y = _.maxBy(this.stageSize.rectangles, function (o) {
                return o.id;
            });
            var id = y.id + 1;
            var copyData = _.cloneDeep(this.stageSize.rectangles[index]);
            // let name = "shape-" + id;
            copyData.id = id;
            copyData.name = `shape-${id}`;
            copyData.x = copyData.x + 30;
            copyData.y = copyData.y + 30;
            console.log(copyData, y);
            this.stageSize.rectangles.push(copyData);
        }
    },
};
</script>

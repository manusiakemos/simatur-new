<template>
    <div class="row">
        <div class="col-12">
            <b-breadcrumb class="bg-white shadow-sm" :items="items"></b-breadcrumb>
        </div>
        <div class="col-12">
            <b-button variant="primary" @click="create"><span class="fa fa-plus"></span> Tambah CRUD
            </b-button>
            <b-button variant="danger" @click="emptyCrud"><span class="fa fa-trash"></span> Kosongkan CRUD
            </b-button>
            <b-card class="mt-3 shadow-sm" border-variant="light">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Class Name</th>
                        <th>Table Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(v, i) in cruds" :key="i">
                        <td>
                            {{v.class_name}}
                        </td>
                        <td>
                            {{v.table_name}}
                        </td>
                        <td class="text-center">
                            <b-btn @click="edit(v,i)" variant="primary" size="sm">
                                <div class="fa fa-pencil-alt"></div>
                                Edit
                            </b-btn>
                            <b-btn @click="reorder(v,i)" variant="success" size="sm">
                                <div class="fa fa-list-ul"></div>
                                Reorder Field
                            </b-btn>
                            <b-btn @click="destroy(i)" variant="danger" size="sm">
                                <div class="fa fa-trash-o"></div>
                                Hapus
                            </b-btn>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </b-card>
        </div>
        <b-modal v-model="show_modal" size="xl" :hide-footer="true">
            <div class="row">
                <div class="col-12" v-if="auth.data.role == 'super-admin'">
                    <b-card border-variant="light" class="shadow mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <b-form-group
                                    id="model-group"
                                    label="Model"
                                    label-for="model"
                                >
                                    <b-form-radio v-model="data.generate.model" :value="true">Ya</b-form-radio>
                                    <b-form-radio v-model="data.generate.model" :value="false">Tidak</b-form-radio>
                                </b-form-group>
                            </div>
                            <div class="col-md-3">
                                <b-form-group
                                    id="model-group"
                                    label="Controller"
                                    label-for="controller"
                                >
                                    <b-form-radio v-model="data.generate.controller" :value="true">Ya</b-form-radio>
                                    <b-form-radio v-model="data.generate.controller" :value="false">Tidak</b-form-radio>
                                </b-form-group>
                            </div>

                            <div class="col-md-3">
                                <b-form-group
                                    id="model-group"
                                    label="Vue"
                                    label-for="vue"
                                >
                                    <b-form-radio v-model="data.generate.vue" :value="true">Ya</b-form-radio>
                                    <b-form-radio v-model="data.generate.vue" :value="false">Tidak</b-form-radio>
                                </b-form-group>
                            </div>

                            <div class="col-md-3">
                                <b-form-group
                                    id="model-group"
                                    label="Router"
                                    label-for="router"
                                >
                                    <b-form-radio v-model="data.generate.router" :value="true">Ya</b-form-radio>
                                    <b-form-radio v-model="data.generate.router" :value="false">Tidak</b-form-radio>
                                </b-form-group>
                            </div>
                        </div>

                        <b-form-group
                            id="prefix-group"
                            label="Prefix"
                            label-for="prefix"
                        >
                            <b-form-input id="prefix" v-model="data.prefix"></b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="classname-group"
                            label="class name"
                            label-for="classname"
                        >
                            <b-form-input id="classname" v-model="data.class_name"></b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="table_name-group"
                            label="table name"
                            label-for="table_name"
                        >
                            <b-form-input id="table_name" v-model="data.table_name"></b-form-input>
                        </b-form-group>

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <b-form-group label="migrate immediately">
                                    <b-form-radio v-model="data.migrate_immediately" :value="true">true</b-form-radio>
                                    <b-form-radio v-model="data.migrate_immediately" :value="false">false</b-form-radio>
                                </b-form-group>
                            </div>
                            <div class="mb-3 col-md-4">
                                <b-form-group label="migrate_fresh">
                                    <b-form-radio v-model="data.migrate_fresh" :value="true">true</b-form-radio>
                                    <b-form-radio v-model="data.migrate_fresh" :value="false">false</b-form-radio>
                                </b-form-group>
                            </div>
                        </div>
                    </b-card>

                    <b-card border-variant="light" class="shadow mb-3">
                        <div class="d-flex justify-content-between">
                            <h4>Relasi</h4>
                            <b-button variant="primary" @click="addRelationship">
                                <span class="fa fa-plus"></span> Tambah Relasi
                            </b-button>
                        </div>
                        <hr class="dashed">
                        <div :key="index" v-for="(item, index) in data.relationships">
                            <b-form-group
                                :id="`relasi-group-${index}`"
                            >
                                <b-input-group class="mt-3">
                                    <b-form-input :id="`relasi-${index}`"
                                                  v-model="data.relationships[index]"></b-form-input>
                                    <b-input-group-append>
                                        <b-button variant="primary" @click="addRelationship">
                                            <div class="fa fa-plus"></div>
                                        </b-button>
                                        <b-button v-if="data.relationships.length > 0" variant="danger"
                                                  @click="removeRelationship(index)">
                                            <div class="fa fa-minus"></div>
                                        </b-button>
                                    </b-input-group-append>
                                </b-input-group>
                            </b-form-group>
                        </div>
                    </b-card>

                    <b-card border-variant="light" class="shadow mb-3">
                        <div class="d-flex justify-content-between">
                            <h4>Fields</h4>
                            <b-button variant="primary" @click="addField">
                                <span class="fa fa-plus"></span> Tambah Field
                            </b-button>
                        </div>
                        <hr class="dashed">
                        <div :key="index" v-for="(item, index) in data.fields">
                            <div class="row">
                                <div class="mb-3 col-md-3">
                                    <b-input placeholder="name" v-model="item.name"></b-input>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <b-input placeholder="text" v-model="item.text"></b-input>
                                </div>
                                <div class="mb-3 col-md-2">
                                    <select class="form-control" v-model="item.type">
                                        <option value="" selected>Pilih Tipe</option>
                                        <option :key="i" v-for="(v,i) in data_types" :value="v" selected>{{v}}</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-2">
                                    <b-input placeholder="length" v-model="item.length"></b-input>
                                </div>
                                <div class="mb-3 col-md-2">
                                    <select class="form-control" v-model="item.form_type">
                                        <option value="" selected>Pilih Tipe Form</option>
                                        <option :key="i" v-for="(v,i) in input_types" :value="v" selected>{{v}}</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-3">
                                    <b-form-group label="nullable">
                                        <b-form-radio v-model="item.nullable" :value="true">true</b-form-radio>
                                        <b-form-radio v-model="item.nullable" :value="false">false</b-form-radio>
                                    </b-form-group>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <b-form-group label="primary">
                                        <b-form-radio v-model="item.primary" :value="true">true</b-form-radio>
                                        <b-form-radio v-model="item.primary" :value="false">false</b-form-radio>
                                    </b-form-group>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <b-button @click="addField" variant="primary">
                                        <div class="fa fa-plus"></div>
                                    </b-button>
                                    <b-button @click="removeField(index)" variant="danger">
                                        <div class="fa fa-minus"></div>
                                    </b-button>
                                </div>
                            </div>
                            <hr class="dashed">
                        </div>
                    </b-card>

                    <b-button variant="primary" @click="generateCrud">Generate!</b-button>
                </div>
            </div>
        </b-modal>

        <b-modal v-model="show_modal_order" size="xl" :hide-footer="true">
            <draggable
                :list="data.fields"
                class="list-group"
                ghost-class="ghost"
            >
                <div
                    class="list-group-item"
                    v-for="(element,index) in data.fields"
                    :key="index"
                >
                    {{ element }}
                </div>

                <b-btn variant="primary" @click="generateCrud(false)">Simpan</b-btn>
            </draggable>
        </b-modal>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'

    export default {
        components: {
            draggable
        },
        computed: {
            auth() {
                return this.$store.state.auth;
            }
        },
        created() {
            this.data2 = this.data;
            this.getData();
        },
        data: function () {
            return {
                action: 'store',
                data: {
                    prefix: "",
                    class_name: "",
                    table_name: "",
                    "generate": {
                        "model": true,
                        "controller": true,
                        "vue": true,
                        "router": true,
                    },
                    view: true,
                    relationships: [],
                    root_namespace: "App",
                    migrate_immediately: true,
                    migrate_fresh: false,
                    fields: [
                        {
                            "name": "",
                            "text": "",
                            "type": "",
                            "form_type": "text",
                            "length": 190,
                            "nullable": false,
                            "primary": false
                        },
                    ]
                },
                data2: {},
                data_types: [
                    'increments',
                    'string',
                    'integer',
                    'boolean',
                    'enum',
                    'date',
                    'text',
                    'longText',
                    'double',
                    'float',
                    'year',
                    'timestamp',
                    'json'
                ],
                input_types: [
                    'text',
                    'money',
                    'file',
                    'radio',
                    'image',
                    'select',
                    'date',
                    'time',
                ],
                items: [
                    {
                        text: 'Admin',
                        href: '#'
                    },
                    {
                        text: 'Crud Generator',
                        active: true
                    }
                ],
                show_modal: false,
                show_modal_order: false,
                cruds: [],
            }
        },
        methods: {
            addRelationship() {
                this.data.relationships.push("");
            },
            removeRelationship(index) {
                this.data.relationships.splice(index, 1);
            },
            addField() {
                let data = {
                    "name": this.data.prefix,
                    "text": this.data.text,
                    "type": this.data.type,
                    "length": this.data.length,
                    "nullable": true,
                    "primary": false
                };
                this.data.fields.push(data);
            },
            removeField(index) {
                this.data.fields.splice(index, 1);
            },
            generateCrud(push = true) {
                if (push && this.action == 'store') {
                    this.cruds.push(this.data);
                }
                this.axios.post('/api/crudgenerator', {
                    data: this.data,
                    cruds: this.cruds
                }).then(res => {
                    this.makeToast('success', res.data.message);
                });
                this.show_modal = false;
            },
            create() {
                this.data = _.cloneDeep(this.data2);
                this.action == 'store';
                this.show_modal = true;
            },
            edit(v, i) {
                this.action == 'update';
                this.data = _.cloneDeep(v);
                this.cruds.splice(i, 1);
                this.show_modal = true;
            },
            getData() {
                this.axios.get('/api/crudgenerator').then(res => {
                    this.cruds = res.data;
                });
            },
            emptyCrud() {
                this.cruds = [];
                this.axios.post('/api/crudgenerator', {empty: true}).then(res => {
                    this.$message.info(res.data.message);
                })
            },
            destroy(i) {
                this.cruds.splice(i, 1);
                this.axios.post('/api/crudgenerator', {
                    cruds: this.cruds
                }).then(res => {
                    this.makeToast('success', res.data.message);
                })
            },
            reorder(v, i) {
                this.data = v;
                this.show_modal_order = true;
            },

        },
        watch: {
            show_modal(v) {
                if (v == false) {
                    this.getData();
                }
            }
        }
    }
</script>

<style scoped>
    .buttons {
        margin-top: 35px;
    }

    .ghost {
        opacity: 0.5;
        background: #c8ebfb;
    }
</style>

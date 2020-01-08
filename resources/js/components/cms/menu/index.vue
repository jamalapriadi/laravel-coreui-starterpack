<template>
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-default">
                <div class="card-header">Add New Menu</div>
                <div class="card-body">
                    <vue-loading v-if="loading2" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                    <div v-if="message" v-bind:class="pesankelas">
                        {{ message }}
                    </div>

                    <form @submit.prevent="store" action="data/menu" method="post">
                        <div class="form-group">
                            <label for="" class="control-label">Menu Name</label>
                            <input type="text" class="form-control" v-model="state.name">
                        </div>

                        <div class="form-group">
                            <label for="" class="control-label">Menu URL</label>
                            <input type="text" class="form-control" v-model="state.url">
                        </div>

                        <div class="form-group">
                            <label for="" class="control-label">Parent</label>
                            <select name="parent" id="parent" class="form-control" v-model="state.parent">
                                <option value="" disabled selected>--Parent--</option>
                                <option v-for="(l,index) in menus" v-bind:key="index" v-bind:value="l.id">{{l.menu}}</option>
                            </select>
                        </div>

                        <hr>
                        <div class="form-group">
                            <button class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                Tambah
                            </button>   

                            <a href="#" @click="kosong()" class="btn btn-default">
                                Batal    
                            </a>           
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card card-default">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label for="" class="control-label col-lg-4">FILTER:</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="q" id="q" placeholder="Type and Enter" v-model="pencarian">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-7">
                            <div class="form-group float-right">
                                <select name="page" id="page" class="form-control" v-model="halaman" @change="ubahHalaman">
                                    <option v-for="(l,index) in pages" :key="index" :value="l">{{l}}</option>    
                                </select>     
                            </div>
                        </div>
                    </div>

                    <br>
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th>Menu Name</th>
                                    <th>URL</th>
                                    <th>Slug</th>
                                    <th>Parent</th>
                                    <th>Active</th>
                                    <th width="17%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(l, index) in list.data" v-bind:key="index">
                                    <td>{{index+1}}</td>
                                    <td>{{l.menu}}</td>
                                    <td>{{l.menu_url}}</td>
                                    <td>{{l.slug}}</td>
                                    <td v-if="l.parent==null">-</td>
                                    <td v-if="l.parent!=null">{{l.parent.menu}}</td>
                                    <td>
                                        <!-- {{l.active}} -->
                                        <span v-show="l.active == 'Y'">
                                            <toggle-button :value="true"
                                                :sync="true"
                                                name="phone"
                                                :labels="{checked: 'Ya', unchecked: 'No'}"
                                                :color="{checked: '#7DCE94', unchecked: '#82C7EB'}"
                                                @change="nonAktifMenu(l.id)"/>
                                        </span>

                                        <span v-show="l.active == 'N'">
                                            <toggle-button :value="false"
                                                name="phone"
                                                :sync="false"
                                                :labels="{checked: 'Ya', unchecked: 'No'}"
                                                :color="{checked: '#7DCE94', unchecked: '#82C7EB'}"
                                                @change="aktifMenu(l.id)"/>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-warning" @click="updateMenu(l.id)">
                                                <i class="fa fa-edit text-white"></i>
                                            </a>

                                            <a class="btn btn-danger" v-on:click="hapus(l.id, index)" v-bind:id="'delete'+l.id">
                                                <i class="fa fa-trash text-white"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                    <div align="right">
                        <pagination :data="listData" @pagination-change-page="showData" :show-disabled="true"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { VueLoading } from 'vue-loading-template'
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        components: {
            VueLoading
        },
        data(){
            return {
                state:{
                    kode:'',
                    name:'',
                    parent:'',
                    url:'#'
                },
                list:[],
                menus:[],
                listData:{},
                pencarian:'',
                pesankelas:'',
                message:'',
                loading:true,
                loading2:false,
                editor: ClassicEditor,
                editorConfig: {
                    // The configuration of the editor.
                    height:400
                },
                halaman:10,
                pages:[5,10,15,20,25,50,100]
            }
        },
        mounted() {
            this.showData();
            this.getCategory();
        },
        watch: {
            pencarian: function(q) {
                if (q != ''){
                    this.cariData();
                }else{
                    this.showData();
                }
            }
        },
        methods: {
            nonAktifMenu(id){
                this.$swal({
                    title: 'Non Aktif menu?',
                    text: 'Apakah anda yakin ingin menonaktifkan menu ini!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Lanjutkan!',
                    cancelButtonText: 'Tidak',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                })
                .then((result) => {
                    if(result.value) {
                        axios.get('data/status-menu/'+id+'?status=N')
                            .then(response => {
                                if(response.data.success==true){
                                    this.$swal('Non Aktif', 'Non Aktif menu berhasil' , 'success');
                                }else{
                                    this.$swal('Non Aktif', 'Non aktif menu gagal' , 'error');
                                }

                                this.list=[]
                                this.showData();
                            })
                    } else {
                        this.$swal('Cancelled', 'Menu tidak di non aktifkan', 'info')
                        this.list=[]
                        this.showData();
                    }
                })
            },

            aktifMenu(id){
                this.$swal({
                    title: 'Aktif Menu?',
                    text: 'Apakah anda yakin ingin mengaktifkan Menu ini!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Lanjutkan!',
                    cancelButtonText: 'Tidak',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                })
                .then((result) => {
                    if(result.value) {
                        axios.get('data/status-menu/'+id+'?status=Y')
                            .then(response => {
                                if(response.data.success==true){
                                    this.$swal('Aktif', 'Aktif Menu berhasil' , 'success');
                                }else{
                                    this.$swal('Aktif', 'aktif Menu gagal' , 'error');
                                }

                                this.list=[]
                                this.showData();
                            })
                    } else {
                        this.$swal('Cancelled', 'Menu tidak di aktifkan', 'info')

                        this.list=[]
                        this.showData();
                    }
                })
            },

            emptyEditor() {
                this.state.desc = '';
            },

            ubahHalaman(){
                this.showData()
            },

            getCategory(){
                axios.get('data/list-menu')
                    .then(response => {
                        this.menus=response.data
                    })
            },

            paginate(url){
                axios.get(url)
                    .then(response => {
                        this.list = response.data;
                    })
            },

            showData(page){
                if(typeof page === 'undefined'){
                    page = 1;
                }

                axios.get('data/menu?page='+page+'&halaman='+this.halaman)
                    .then(response => {
                        this.loading=false;
                        this.list = response.data;
                        this.listData = response.data;
                    })
            },

            cariData(page){
                if(typeof page === 'undefined'){
                    page = 1;
                }

                axios.get('data/menu?q='+this.pencarian+'&halaman='+this.halaman)
                    .then(response => {
                        this.list = response.data;
                    })
                    .catch( errors => {
                        alert('pencarian tidak ditemukan');
                    })
            },

            hapus(id,index,name){
                this.$swal({
                    title: 'Are you sure?',
                    text: 'You can\'t revert your action',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes Delete it!',
                    cancelButtonText: 'No, Keep it!',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                })
                .then((result) => {
                    if(result.value) {
                        axios.delete('data/menu/'+id)
                            .then(response => {
                                if(response.data.success==true){
                                    this.message="";
                                    this.$swal('Deleted', response.data.pesan , 'success');
                                    this.showData();
                                    this.getCategory();
                                }else{
                                    this.$swal('Deleted', response.data.pesan , 'error');
                                }
                            })
                        
                    } else {
                        this.$swal('Cancelled', 'Your file is still intact', 'info')
                    }
                })
            },

            store(e) {
                this.loading2=true;
                axios.post(e.target.action, this.state).then(response => {
                    this.loading2=false;
                    if(response.data.success==true){
                        this.errors = [];
                        this.state = {
                            kode:'',
                            name:'',
                            desc:'',
                            parent:'',
                            url:'#'
                        }
                        this.message = 'Data berhasil disimpan';
                        this.pesankelas='alert alert-success';
                        this.showData();
                        this.getCategory();
                    }else{
                        this.pesankelas='alert alert-danger';
                        this.message = response.data.errors;
                        this.errors.nama=true;
                    }
                }).catch(error => {
                    if (! _.isEmpty(error.response)) {
                        if (error.response.status = 422) {
                            this.errors = error.response.data;
                            console.log(this.errors);
                        }
                    }
                });
            },

            updateMenu(id){
                this.state.kode=id;
                this.message='';

                axios.get('data/menu/'+id)
                    .then(response => {
                        this.state.kode = response.data.id;
                        this.state.name = response.data.menu;
                        this.state.parent = response.data.parent_id;
                        this.state.url = response.data.menu_url;
                    })
                    .catch( error => {
                        alert('data tidak dapat di load');
                    })
            },

            kosong(){
                this.state={
                    kode:'',
                    name:'',
                    parent:'',
                    url:'#'
                },
                this.message=''
            },
        }
    }
</script>

<style>
    .ck-editor__editable {
        min-height: 200px;
    }
</style>

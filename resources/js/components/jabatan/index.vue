<template>
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-default">
                <div class="card-header">Add New Jabatan</div>
                <div class="card-body">
                    <vue-loading v-if="loading2" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                    <div v-if="message" v-bind:class="pesankelas">
                        {{ message }}
                    </div>

                    <form @submit.prevent="store" action="/data/jabatan" method="post">
                        <div class="form-group">
                            <label for="" class="control-label">Name</label>
                            <input type="text" class="form-control" v-model="state.name">
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
                    </div>

                    <br>
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th>Name</th>
                                    <th width="17%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(l, index) in list.data" v-bind:key="index">
                                    <td>{{index+1}}</td>
                                    <td>{{l.name}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-warning" @click="updateKategori(l.id)">
                                                <i class="fa fa-edit text-white"></i>
                                            </a>

                                            <a class="btn btn-danger" v-on:click="hapus(l.id, index, l.nm)" v-bind:id="'delete'+l.id">
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
                    name:''
                },
                list:[],
                categories:[],
                listData:{},
                pencarian:'',
                pesankelas:'',
                message:'',
                loading:true,
                loading2:false,
                editor: ClassicEditor,
                editorConfig: {
                    height:400
                }
            }
        },
        mounted() {
            this.showData();
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
            emptyEditor() {
                this.state.desc = '';
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

                axios.get('data/jabatan?page='+page)
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

                axios.get('/data/jabatan?q='+this.pencarian)
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
                        axios.delete('/data/jabatan/'+id)
                            .then(response => {
                                if(response.data.success==true){
                                    this.message="";
                                    this.$swal('Deleted', response.data.pesan , 'success');
                                    this.showData();
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
                            name:''
                        }
                        this.message = 'Data berhasil disimpan';
                        this.pesankelas='alert alert-success';
                        this.showData();
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

            updateKategori(id){
                this.state.kode=id;
                this.message='';

                axios.get('/data/jabatan/'+id)
                    .then(response => {
                        this.state.kode = response.data.id;
                        this.state.name = response.data.name;
                    })
                    .catch( error => {
                        alert('data tidak dapat di load');
                    })
            },

            kosong(){
                this.state={
                    kode:'',
                    name:''
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

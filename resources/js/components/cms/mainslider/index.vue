<template>
    <div>
        <div class="card card-default">
            <div class="card-header">Slide Overlay</div>
            <div class="card-body">
                <form @submit.prevent="storeOverlay" action="data/carousel-overlay" method="post">
                    <vue-loading v-if="loading3" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                    <div v-if="messageoverlay" v-bind:class="pesankelasoverlay">
                        {{ messageoverlay }}
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Text Overlay</label>
                        <trumbowyg v-model="overlay.desc" :config="config" class="form-control" name="content"></trumbowyg>
                    </div>

                    <hr>
                    <div class="form-group">
                        <button class="btn btn-primary">
                            <i class="fa fa-save"></i>
                            Save
                        </button>   
                    </div>
                </form>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-header">Slide Carousel</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card card-default">
                            <div class="card-header">Add New Carousel</div>
                            <div class="card-body">
                                <vue-loading v-if="loading2" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                                <div v-if="message" v-bind:class="pesankelas">
                                    {{ message }}
                                </div>

                                <form @submit.prevent="store" action="data/carousel" method="post">
                                    <div class="form-group">
                                        <label for="" class="control-label">Caption</label>
                                        <input type="text" class="form-control" v-model="state.caption">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="control-label">Text</label>
                                        <input type="text" class="form-control" v-model="state.text">
                                    </div>  

                                    <div class="form-group">
                                        <label class="control-label">Choose File</label><br>
                                            <img v-bind:src="state.filepreview" v-show="showPreview" class="img-fluid"/>
                                        <br><br>
                                        <div class="input-group">
                                            <input type="file" id="file" ref="file" accept="image/*" v-on:change="onFileChange" class="form-control"/>
                                            <span class="input-group-addon" id="removeFeaturedImage">
                                                <i class=" icon-cross3"></i>
                                            </span>
                                        </div>
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
                                                <th>No.</th>
                                                <th>Image</th>
                                                <th>Caption</th>
                                                <th>Text</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(l, index) in list.data" v-bind:key="index">
                                                <td>{{index+1}}</td>
                                                <td>
                                                    <img :src="l.image_url" alt="" class="img-fluid" style="height:120px;">
                                                </td>
                                                <td>{{l.caption}}</td>
                                                <td>
                                                    <div v-html="l.text"></div>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-warning" @click="updateCarousel(l.id)">
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
            </div>
        </div>
    </div>
</template>

<script>
    import { VueLoading } from 'vue-loading-template'
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    import Trumbowyg from 'vue-trumbowyg';
  
    // Import editor css
    import 'trumbowyg/dist/ui/trumbowyg.css';

    export default {
        components: {
            VueLoading,
            Trumbowyg
        },
        data(){
            return {
                state:{
                    caption:'',
                    text:'',
                    file:'',
                    filepreview:'',
                },
                overlay:{
                    desc:'',
                    kode:''
                },
                list:[],
                categories:[],
                listData:{},
                pencarian:'',
                pesankelas:'',
                message:'',
                loading:true,
                loading2:false,
                loading3:false,
                messageoverlay:'',
                pesankelasoverlay:'',
                editor: ClassicEditor,
                editorConfig: {
                    // The configuration of the editor.
                },
                showPreview:false,
                config: {
                    // Get options from 
                    // https://alex-d.github.io/Trumbowyg/documentation
                }   
            }
        },
        mounted() {
            this.showData();
            this.getCategory();
            this.getOverlay();
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

            getOverlay(){
                axios.get('data/carousel-overlay')
                    .then(response => {
                        if(response.data!=null){
                            this.overlay.kode = response.data.id
                            this.overlay.desc = response.data.text
                        }
                        
                    })
            },

            getCategory(){
                axios.get('data/list-category')
                    .then(response => {
                        this.categories=response.data
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

                axios.get('data/carousel?page='+page)
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

                axios.get('data/carousel?q='+this.pencarian)
                    .then(response => {
                        this.list = response.data;
                    })
                    .catch( errors => {
                        alert('pencarian tidak ditemukan');
                    })
            },

            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.state.file = e.target.result;
                    vm.state.filepreview = e.target.result;
                    vm.showPreview = true;
                };
                reader.readAsDataURL(file);
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
                        axios.delete('data/carousel/'+id)
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
                        this.state={
                            caption:'',
                            text:'',
                            file:'',
                            filepreview:''
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

            updateCarousel(id){
                this.state.kode=id;
                this.message='';

                axios.get('data/carousel/'+id)
                    .then(response => {
                        this.state.kode = response.data.id;
                        this.state.caption = response.data.caption;
                        this.state.text=response.data.text;
                        
                        if(response.data.image!=null){
                            this.state.filepreview=response.data.image_url;
                            this.showPreview=true;
                        }
                    })
                    .catch( error => {
                        alert('data tidak dapat di load');
                    })
            },

            kosong(){
                this.state={
                    kode:'',
                    name:'',
                    desc:'',
                    parent:''
                },
                this.message=''
            },

            storeOverlay(e) {
                this.loading3=true;
                axios.post(e.target.action, this.overlay).then(response => {
                    this.loading3=false;
                    if(response.data.success==true){
                        this.messageoverlay = 'Data berhasil disimpan';
                        this.pesankelasoverlay='alert alert-success';
                        this.getOverlay();
                    }else{
                        this.messageoverlay='alert alert-danger';
                        this.pesankelasoverlay = response.data.errors;
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
        }
    }
</script>

<style>
    .ck-editor__editable {
        min-height: 200px;
    }
</style>

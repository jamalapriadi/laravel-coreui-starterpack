<template>
    <div class="card card-default">
        <div class="card-header">Profile Instansi</div>
        <div class="card-body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-controls="home">Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile">Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#messages" role="tab" aria-controls="messages">Video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#contact" role="tab" aria-controls="messages">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#sosmed" role="tab" aria-controls="messages">Social Media</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <form @submit.prevent="store" action="/data/info" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class="control-label">Nama Instansi</label>
                            <input type="text" class="form-control" v-model="state.nama_instansi">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Nama Lengkap Instansi</label>
                            <input type="text" class="form-control" v-model="state.nama_lengkap_instansi">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Tagline</label>
                            <input type="text" class="form-control" v-model="state.tagline">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Teaser Instansi</label>
                            <ckeditor :editor="editor" v-model="state.teaser" :config="editorConfig"></ckeditor>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Tentang Instansi</label>
                            <ckeditor :editor="editor" v-model="state.tentang" :config="editorConfig"></ckeditor>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Visi Instansi</label>
                            <ckeditor :editor="editor" v-model="state.visi" :config="editorConfig"></ckeditor>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Misi Instansi</label>
                            <ckeditor :editor="editor" v-model="state.misi" :config="editorConfig"></ckeditor>
                        </div>
                        <div class="form-group">
                            <label for="" class="control">Alamat</label>
                            <input type="text" class="form-control" v-model="state.alamat">
                        </div>
                        <div class="form-group">
                            <label for="" class="control">Telp</label>
                            <input type="text" class="form-control" v-model="state.telp">
                        </div>
                        <div class="form-group">
                            <label for="" class="control">Email</label>
                            <input type="text" class="form-control" v-model="state.email">
                        </div>
                        <div class="form-group">
                            <label for="" class="control">Website</label>
                            <input type="text" class="form-control" v-model="state.website">
                        </div>
                        <div class="form-group">
                            <label for="" class="control">Fax</label>
                            <input type="text" class="form-control" v-model="state.fax">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Lat</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" v-model="state.lat">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-map-marker"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>  
                            </div>    

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Lng</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" v-model="state.lng">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-map-marker"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Logo</label>
                            <img v-bind:src="state.logo" v-show="tampilLogo" class="img-fluid"/>
                            <img v-bind:src="state.tmplogo" v-show="tmptampilLogo" class="img-fluid"/>
                            <input type="file" id="file" ref="file" accept="image/*" v-on:change="onFileChange" class="form-control"/>
                        </div>
                        <hr>

                        <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                        <div class="col-lg-12" v-if="message" v-bind:class="pesankelas">
                            {{ message }}
                        </div>

                        <button class="btn btn-block btn-success btn-primary">
                            Simpan
                        </button>
                    </form>
                </div>

                <div class="tab-pane" id="profile" role="tabpanel">
                    
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card card-default">
                                <div class="card-header">Add New Fasilitas</div>
                                <div class="card-body">
                                    <vue-loading v-if="loading2" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                                    <div v-if="messagefasilitas" v-bind:class="pesankelasfasilitas">
                                        {{ messagefasilitas }}
                                    </div>

                                    <form @submit.prevent="storeFasilitas" action="/data/fasilitas" method="post">
                                        <div class="form-group">
                                            <label for="" class="control-label">Name</label>
                                            <input type="text" class="form-control" v-model="statefasilitas.name">
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="control-label">Description</label>
                                            <ckeditor :editor="editor" v-model="statefasilitas.desc" :config="editorConfig"></ckeditor>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Icon</label><br>
                                                <img v-bind:src="statefasilitas.filefasilitas" v-show="showPreviewFasilitas" class="img-fluid"/>
                                            <br><br>
                                            <div class="input-group">
                                                <input type="file" id="filefasilitas" ref="filefasilitas" accept="image/*" v-on:change="onFileChangeFasilitas" class="form-control"/>
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

                                            <a href="#" @click="kosongFasilitas()" class="btn btn-default">
                                                Batal    
                                            </a>           
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Icon</th>
                                        <th width="17%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(l, index) in fasilitas.data" v-bind:key="index">
                                        <td>{{index+1}}</td>
                                        <td>{{l.name}}</td>
                                        <td>
                                            <div v-html="l.deskripsi"></div>
                                        </td>
                                        <td>
                                            <img :src="l.icon_url" alt="" class="img-fluid">
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-warning" @click="updateFasilitas(l.id)">
                                                    <i class="fa fa-edit text-white"></i>
                                                </a>

                                                <a class="btn btn-danger" v-on:click="hapusFasilitas(l.id)" v-bind:id="'delete'+l.id">
                                                    <i class="fa fa-trash text-white"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                        </div>


                    </div>

                </div>
                
                <div class="tab-pane" id="messages" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card card-default">
                                <div class="card-header">Add New Video</div>
                                <div class="card-body">
                                    <vue-loading v-if="loading2" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                                    <div v-if="messagefasilitas" v-bind:class="pesankelasfasilitas">
                                        {{ messagefasilitas }}
                                    </div>

                                    <form @submit.prevent="storeVideo" action="/data/video" method="post">
                                        <div class="form-group">
                                            <label for="" class="control-label">Youtube URL</label>
                                            <input type="text" class="form-control" v-model="video.url">
                                        </div>

                                        <hr>
                                        <div class="form-group">
                                            <button class="btn btn-primary">
                                                <i class="fa fa-save"></i>
                                                Tambah
                                            </button>   

                                            <a href="#" @click="kosongVideo()" class="btn btn-default">
                                                Batal    
                                            </a>           
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th>Video</th>
                                        <th width="17%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(l, index) in videos.data" v-bind:key="index">
                                        <td>{{index+1}}</td>
                                        <td>
                                            <youtube :video-id="l.video_id" :player-width="230" :player-height="120"></youtube>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-warning" @click="updateVideo(l.id)">
                                                    <i class="fa fa-edit text-white"></i>
                                                </a>

                                                <a class="btn btn-danger" v-on:click="hapusVideo(l.id)" v-bind:id="'delete'+l.id">
                                                    <i class="fa fa-trash text-white"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

                <div class="tab-pane" id="contact" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card card-default">
                                <div class="card-header">Add New Kontak</div>
                                <div class="card-body">
                                    <vue-loading v-if="loading2" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                                    <div v-if="messagefasilitas" v-bind:class="pesankelasfasilitas">
                                        {{ messagefasilitas }}
                                    </div>

                                    <form @submit.prevent="storeKontak" action="/data/kontak" method="post">
                                        <div class="form-group">
                                            <label for="" class="control-label">Parameter Name</label>
                                            <input type="text" class="form-control" v-model="kontak.name">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label">Parameter Value</label>
                                            <input type="text" class="form-control" v-model="kontak.value">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label">Icon</label>
                                            <select name="icon" id="icon" class="form-control" v-model="kontak.icon">
                                                <option value="">--No Icon--</option>
                                                <option value="telp">Telp</option>
                                                <option value="email">Email</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label">Show Name</label>
                                            <select name="showname" id="showname" class="form-control" v-model="kontak.show_name">
                                                <option value="Y">Y</option>
                                                <option value="N">N</option>
                                            </select>
                                        </div>

                                        <hr>
                                        <div class="form-group">
                                            <button class="btn btn-primary">
                                                <i class="fa fa-save"></i>
                                                Tambah
                                            </button>   

                                            <a href="#" @click="kosongKontak()" class="btn btn-default">
                                                Batal    
                                            </a>           
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th>Parameter Name</th>
                                        <th>Parameter Value</th>
                                        <th>Show Name</th>
                                        <th>Icon</th>
                                        <th width="17%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(l, index) in kontaks.data" v-bind:key="index">
                                        <td>{{index+1}}</td>
                                        <td>{{l.parameter_name}}</td>
                                        <td>{{l.parameter_value}}</td>
                                        <td>{{l.show_name}}</td>
                                        <td>{{l.icon}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-warning" @click="updateKontak(l.id)">
                                                    <i class="fa fa-edit text-white"></i>
                                                </a>

                                                <a class="btn btn-danger" v-on:click="hapusKontak(l.id)" v-bind:id="'delete'+l.id">
                                                    <i class="fa fa-trash text-white"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

                <div class="tab-pane" id="sosmed" role="tabpanel">
                    <div v-show="tampilFormSosmed == true">
                        <form @submit.prevent="storeSosmed" action="/data/sosmed" method="post" enctype="multipart/form-data">
                            <vue-loading v-if="loading2" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                            <div v-if="messagefasilitas" v-bind:class="pesankelasfasilitas">
                                {{ messagefasilitas }}
                            </div>

                            <div v-for="(l,index) in sosmed" :key="index" class="form-group">
                                <label for="" class="control-label">{{l.name}}</label>
                                <input type="text" class="form-control" placeholder="URL" v-model="stateSosmed.sosmed[l.id]">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary">
                                    <i class="fa fa-save"></i> Save
                                </button>
                                <a href="#" class="btn btn-default" @click.prevent="batalNewSosmed">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>

                    <div v-show="tampilFormSosmed == false">
                        <a href="#" class="btn btn-warning text-white" @click.prevent="addNewSosmed">
                            <i class="fa fa-pencil"></i> Update Social Media
                        </a>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th>Name</th>
                                        <th>URL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(l,index) in instansiSosmed" :key="index">
                                        <td>{{index+1}}</td>
                                        <td>{{l.name}}</td>
                                        <td>{{l.pivot.social_media_url}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { VueLoading } from 'vue-loading-template'

export default {
    components: {
        VueLoading,
        VoerroTagsInput
    },
    data(){
        return {
            state:{
                id:'',
                tentang:'',
                nama_instansi:'',
                nama_lengkap_instansi:'',
                alamat:'',
                visi:'',
                misi:'',
                telp:'',
                email:'',
                fax:'',
                website:'',
                logo:'',
                tmplogo:'',
                lat:'',
                lng:'',
                tagline:'',
                teaser:''
            },
            statefasilitas:{
                kode:'',
                name:'',
                desc:'',
                file:'',
                filefasilitas:''
            },
            pesankelas:'',
            message:'',
            messagefasilitas:'',
            messagefasilitas:'',
            loading:false,
            loading2:false,
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            },
            tampilLogo:false,
            tmptampilLogo:false,
            fasilitas:[],
            listFasilitas:{},
            showPreviewFasilitas:false,

            videos:[],
            video:{
                kode:'',
                url:''
            },

            kontaks:[],
            kontak:{
                kode:'',
                name:'',
                value:'',
                show_name:'Y',
                icon:''
            },
            tampilFormSosmed:false,
            sosmed:[],
            instansiSosmed:[],
            stateSosmed:{
                sosmed:{}
            }
        }
    },
    mounted() {
        this.showInfo();
        this.showFasilitas();
        this.showVideo();
        this.showKontak();
        this.getSosmed();
        this.getInstansiSosmed();
    },
    methods:{
        showInfo(){
            this.loading=true;
            axios.get('data/info')
                .then(response => {
                    this.loading=false;
                    if(response.data!=null){
                        this.state={
                            id:response.data.id,
                            tentang:response.data.tentang,
                            nama_instansi:response.data.nama_instansi,
                            nama_lengkap_instansi:response.data.nama_lengkap_instansi,
                            alamat:response.data.alamat,
                            visi:response.data.visi,
                            misi:response.data.misi,
                            telp:response.data.telp,
                            email:response.data.email,
                            fax:response.data.fax,
                            website:response.data.website,
                            tmplogo:'/uploads/info/'+response.data.logo,
                            logo:'',
                            lat:response.data.lat,
                            lng:response.data.lng,
                            tagline:response.data.tagline,
                            teaser:response.data.teaser
                        }
                        if(response.data.logo != null){
                            this.tmptampilLogo=true;
                        }
                    }else{
                        this.state= {
                            id:'',
                            tentang:'',
                            nama_instansi:'',
                            nama_lengkap_instansi:'',
                            alamat:'',
                            visi:'',
                            misi:'',
                            telp:'',
                            email:'',
                            fax:'',
                            website:'',
                            logo:'',
                            tmplogo:'',
                            lat:'',
                            lng:'',
                            tagline:'',
                            teaser:''
                        }
                    }
                })
        },

        showFasilitas(){
            axios.get('/data/fasilitas')
                .then(response => {
                    this.fasilitas = response.data
                    this.listFasilitas=response.data
                })
        },

        showVideo(){
            axios.get('/data/video')
                .then(response => {
                    this.videos = response.data
                })
        },

        showKontak(){
            axios.get('/data/kontak')
                .then(response => {
                    this.kontaks = response.data
                })
        },

        getSosmed(){
            axios.get('/data/list-sosmed')
                .then(response => {
                    this.sosmed = response.data
                })
        },

        getInstansiSosmed(){
            axios.get('/data/list-instansi-sosmed')
                .then(response => {
                    this.instansiSosmed= response.data.sosmed;

                    for(var a=0; a< response.data.sosmed.length; a++){
                        this.stateSosmed.sosmed[response.data.sosmed[a].id] = response.data.sosmed[a].pivot.social_media_url;
                    }
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
                vm.state.logo = e.target.result;
                vm.tmptampilLogo=false;
                vm.tampilLogo = true;
            };
            reader.readAsDataURL(file);
        },

        onFileChangeFasilitas(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImageFasilitas(files[0]);
        },
        createImageFasilitas(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.statefasilitas.file = e.target.result;
                vm.statefasilitas.filefasilitas = e.target.result;
                vm.showPreviewFasilitas = true;
            };
            reader.readAsDataURL(file);
        },

        store(e) {
            this.loading=true;
            axios.post(e.target.action, this.state).then(response => {
                this.loading=false;
                if(response.data.success==true){
                    this.errors = [];
                    this.message = 'Data berhasil disimpan.';
                    this.pesankelas='alert alert-success';
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

        storeFasilitas(e){
            this.loading2=true;
            axios.post(e.target.action, this.statefasilitas).then(response => {
                this.loading2=false;
                if(response.data.success==true){
                    this.errors = [];
                    this.messagefasilitas = 'Data berhasil disimpan.';
                    this.pesankelasfasilitas='alert alert-success';

                    this.kosongFasilitas()
                    this.showFasilitas()
                }else{
                    this.pesankelasfasilitas='alert alert-danger';
                    this.messagefasilitas = response.data.errors;
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

        kosongFasilitas(){
            this.statefasilitas={
                kode:'',
                name:'',
                desc:'',
                file:'',
                filefasilitas:''
            }

            this.showPreviewFasilitas=false
        },

        updateFasilitas(id){
            this.statefasilitas.kode=id;
            this.messagefasilitas='';

            axios.get('/data/fasilitas/'+id)
                .then(response => {
                    this.statefasilitas.kode = response.data.id;
                    this.statefasilitas.name = response.data.name;
                    this.statefasilitas.desc = response.data.deskripsi;

                    if(response.data.icon!=null){
                        this.statefasilitas.filefasilitas=response.data.icon_url;
                        this.showPreviewFasilitas=true;
                    }
                })
                .catch( error => {
                    alert('data tidak dapat di load');
                })
        },

        hapusFasilitas(id){
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
                    axios.delete('/data/fasilitas/'+id)
                        .then(response => {
                            if(response.data.success==true){
                                this.message="";
                                this.$swal('Deleted', response.data.pesan , 'success');
                                this.showFasilitas();
                            }else{
                                this.$swal('Deleted', response.data.pesan , 'error');
                            }
                        })
                    
                } else {
                    this.$swal('Cancelled', 'Your file is still intact', 'info')
                }
            })
        },

        storeVideo(e){
            this.loading2=true;
            axios.post(e.target.action, this.video).then(response => {
                this.loading2=false;
                if(response.data.success==true){
                    this.errors = [];
                    this.messagefasilitas = 'Data berhasil disimpan.';
                    this.pesankelasfasilitas='alert alert-success';

                    this.kosongVideo()
                    this.showVideo()
                }else{
                    this.pesankelasfasilitas='alert alert-danger';
                    this.messagefasilitas = response.data.errors;
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

        kosongVideo(){
            this.video={
                kode:'',
                url:'',
            }
        },

        updateVideo(id){
            this.video.kode=id;
            this.messagefasilitas='';

            axios.get('/data/video/'+id)
                .then(response => {
                    this.video.kode = response.data.id;
                    this.video.url = response.data.youtube_url;
                })
                .catch( error => {
                    alert('data tidak dapat di load');
                })
        },

        hapusVideo(id){
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
                    axios.delete('/data/video/'+id)
                        .then(response => {
                            if(response.data.success==true){
                                this.message="";
                                this.$swal('Deleted', response.data.pesan , 'success');
                                this.showVideo();
                            }else{
                                this.$swal('Deleted', response.data.pesan , 'error');
                            }
                        })
                    
                } else {
                    this.$swal('Cancelled', 'Your file is still intact', 'info')
                }
            })
        },

        storeKontak(e){
            this.loading2=true;
            axios.post(e.target.action, this.kontak).then(response => {
                this.loading2=false;
                if(response.data.success==true){
                    this.errors = [];
                    this.messagefasilitas = 'Data berhasil disimpan.';
                    this.pesankelasfasilitas='alert alert-success';

                    this.showKontak();
                    this.kosongKontak();
                }else{
                    this.pesankelasfasilitas='alert alert-danger';
                    this.messagefasilitas = response.data.errors;
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

        kosongVideo(){
            this.kontak={
                kode:'',
                name:'',
                value:'',
                show_name:'Y',
                icon:''
            }
        },

        updateKontak(id){
            this.kontak.kode=id;
            this.messagefasilitas='';

            axios.get('/data/kontak/'+id)
                .then(response => {
                    this.kontak.kode = response.data.id;
                    this.kontak.name = response.data.parameter_name;
                    this.kontak.value= response.data.parameter_value;
                    this.kontak.show_name = response.data.show_name;
                    this.kontak.icon = response.data.icon;
                })
                .catch( error => {
                    alert('data tidak dapat di load');
                })
        },

        hapusKontak(id){
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
                    axios.delete('/data/kontak/'+id)
                        .then(response => {
                            if(response.data.success==true){
                                this.message="";
                                this.$swal('Deleted', response.data.pesan , 'success');
                                this.showKontak();
                            }else{
                                this.$swal('Deleted', response.data.pesan , 'error');
                            }
                        })
                    
                } else {
                    this.$swal('Cancelled', 'Your file is still intact', 'info')
                }
            })
        },

        addNewSosmed(){
            this.tampilFormSosmed = true
        },

        batalNewSosmed(){
            this.tampilFormSosmed = false
        },

        storeSosmed(e){
            this.loading2=true;
            axios.post(e.target.action, this.stateSosmed).then(response => {
                this.loading2=false;
                if(response.data.success==true){
                    this.errors = [];
                    this.messagefasilitas = 'Data berhasil disimpan.';
                    this.pesankelasfasilitas='alert alert-success';

                    // this.showKontak();
                    // this.kosongKontak();
                    this.tampilFormSosmed = false
                    this.getInstansiSosmed();
                }else{
                    this.pesankelasfasilitas='alert alert-danger';
                    this.messagefasilitas = response.data.errors;
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


    }
}
</script>
<template>
    <div class="card card-default">
        <div class="card-header">Info</div>
        <div class="card-body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home2" role="tab" aria-controls="home">
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile">
                        Sambutan Ketua Yayasan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#messages2" role="tab" aria-controls="messages">
                        Sambutan Ketua
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="home2" role="tabpanel">
                    <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                    <div class="col-lg-12" v-if="message" v-bind:class="pesankelas">
                        {{ message }}
                    </div>

                    <form @submit.prevent="store" action="data/info" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Nama Yayasan</label>
                                    <input type="text" class="form-control" v-model="state.nama_yayasan">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Nama Instansi</label>
                                    <input type="text" class="form-control" v-model="state.nama_instansi">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Nama Lengkap Instansi</label>
                                    <input type="text" class="form-control" v-model="state.nama_lengkap_instansi">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Alamat</label>
                                    <input type="text" class="form-control" v-model="state.alamat">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Telp.</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" v-model="state.telp">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Email</label>
                                    <div class="input-group">
                                        <input class="form-control" id="input2-group1" type="email" name="input2-group1" placeholder="Email" autocomplete="email" v-model="state.email">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-envelope-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Fax</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" v-model="state.fax">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-fax"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Website</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" v-model="state.website">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-firefox"></i>
                                            </span>
                                        </div>
                                    </div>
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
                            </div>

                            <hr>
                            <div class="col-lg-12">
                                <div class="card card-flat bg-secondary" style="border:0px;">
                                    <div class="card-body">
                                        <div id="pesan"></div>

                                        <button class="btn btn-primary pull-right">
                                            <i class="icon-floppy-disk"></i>
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>  
                </div>
                <div class="tab-pane" id="profile2" role="tabpanel">
                    <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                    <div class="col-lg-12" v-if="message" v-bind:class="pesankelas">
                        {{ message }}
                    </div>

                    <form @submit.prevent="store" action="data/info" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-8">
                                <form action="">
                                    <div class="form-group">
                                        <label for="" class="control-label">Sambutan Ketua Yayasan</label>
                                        <ckeditor :editor="editor" v-model="state.sambutan_ketua_yayasan" :config="editorConfig"></ckeditor>
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-4">
                                <div class="card card-default">
                                    <div class="card-header">Foto</div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <img v-bind:src="state.foto_ketua_yayasan" v-show="tampilFotoKetuaYayasan" class="img-fluid"/>
                                            <img v-bind:src="state.tmp_foto_ketua_yayasan" v-show="tmptampilFotoKetuaYayasan" class="img-fluid"/>
                                            <input type="file" id="fileketuayayasan" ref="fileketuayayasan" accept="image/*" v-on:change="onFileChangeFotoKetuaYayasan" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="col-lg-12">
                                <div class="card card-flat bg-secondary" style="border:0px;">
                                    <div class="card-body">
                                        <div id="pesan"></div>

                                        <button class="btn btn-primary pull-right">
                                            <i class="icon-floppy-disk"></i>
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="messages2" role="tabpanel">
                    <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                    <div class="col-lg-12" v-if="message" v-bind:class="pesankelas">
                        {{ message }}
                    </div>
                    
                    <form @submit.prevent="store" action="data/info" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-8">
                                <form action="">
                                    <div class="form-group">
                                        <label for="" class="control-label">Sambutan Ketua</label>
                                        <ckeditor :editor="editor" v-model="state.sambutan_ketua" :config="editorConfig"></ckeditor>
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-4">
                                <div class="card card-default">
                                    <div class="card-header">Foto</div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <img v-bind:src="state.foto_ketua" v-show="tampilFotoKetua" class="img-fluid"/>
                                            <img v-bind:src="state.tmp_foto_ketua" v-show="tmptampilFotoKetua" class="img-fluid"/>
                                            <input type="file" id="fileketua" ref="fileketua" accept="image/*" v-on:change="onFileChangeFotoKetua" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="col-lg-12">
                                <div class="card card-flat bg-secondary" style="border:0px;">
                                    <div class="card-body">
                                        <div id="pesan"></div>

                                        <button class="btn btn-primary pull-right">
                                            <i class="icon-floppy-disk"></i>
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                nama_yayasan:'',
                nama_instansi:'',
                nama_lengkap_instansi:'',
                alamat:'',
                telp:'',
                email:'',
                fax:'',
                website:'',
                logo:'',
                tmplogo:'',
                lat:'',
                lng:'',
                sambutan_ketua_yayasan:'',
                foto_ketua_yayasan:'',
                tmp_foto_ketua_yayasan:'',
                sambutan_ketua:'',
                foto_ketua:'',
                tmp_foto_ketua:''
            },
            pesankelas:'',
            message:'',
            loading:false,
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            },
            tampilLogo:false,
            tmptampilLogo:false,
            tampilFotoKetuaYayasan:false,
            tmptampilFotoKetuaYayasan:false,
            tampilFotoKetua:false,
            tmptampilFotoKetua:false,
            loading:false
        }
    },
    mounted() {
        this.showInfo();
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
                            nama_yayasan:response.data.nama_yayasan,
                            nama_instansi:response.data.nama_instansi,
                            nama_lengkap_instansi:response.data.nama_lengkap_instansi,
                            alamat:response.data.alamat,
                            telp:response.data.telp,
                            email:response.data.email,
                            fax:response.data.fax,
                            website:response.data.website,
                            tmplogo:'/uploads/info/'+response.data.logo,
                            logo:'',
                            lat:response.data.lat,
                            lng:response.data.lng,
                            sambutan_ketua_yayasan:response.data.sambutan_ketua_yayasan,
                            foto_ketua_yayasan:'',
                            tmp_foto_ketua_yayasan:'/uploads/info/'+response.data.foto_ketua_yayasan,
                            sambutan_ketua:response.data.sambutan_ketua,
                            foto_ketua:'',
                            tmp_foto_ketua:'/uploads/info/'+response.data.foto_ketua,
                        }

                        if(response.data.logo != null){
                            this.tmptampilLogo=true;
                        }

                        if(response.data.foto_ketua_yayasan != null){
                            this.tmptampilFotoKetuaYayasan=true;
                        }

                        if(response.data.foto_ketua != null){
                            this.tmptampilFotoKetua=true;
                        }

                    }else{
                        this.state= {
                            nama_yayasan:'',
                            nama_instansi:'',
                            nama_lengkap_instansi:'',
                            alamat:'',
                            telp:'',
                            email:'',
                            fax:'',
                            website:'',
                            logo:'',
                            lat:'',
                            lng:'',
                            sambutan_ketua_yayasan:'',
                            foto_ketua_yayasa:'',
                            sambutan_ketua:'',
                            foto_ketua:''
                        }
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

        onFileChangeFotoKetuaYayasan(e){
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImageKetuaYayasan(files[0]);
        },

        createImageKetuaYayasan(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.state.foto_ketua_yayasan = e.target.result;
                vm.tmptampilFotoKetuaYayasan=false;
                vm.tampilFotoKetuaYayasan = true;
            };
            reader.readAsDataURL(file);
        },

        onFileChangeFotoKetua(e){
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImageKetua(files[0]);
        },

        createImageKetua(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.state.foto_ketua = e.target.result;
                vm.tmptampilFotoKetua=false;
                vm.tampilFotoKetua = true;
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
    }
}
</script>


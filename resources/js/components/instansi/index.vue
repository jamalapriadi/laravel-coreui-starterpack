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
                    <form @submit.prevent="store" action="data/info" method="post" enctype="multipart/form-data">
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
                            <label for="" class="control">SEO ID</label>
                            <input type="text" class="form-control" v-model="state.seo">
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
                    <fasilitas-component></fasilitas-component>
                </div>
                
                <div class="tab-pane" id="messages" role="tabpanel">
                    <videoComponent></videoComponent>
                </div>

                <div class="tab-pane" id="contact" role="tabpanel">
                    <contactComponent></contactComponent>
                </div>

                <div class="tab-pane" id="sosmed" role="tabpanel">
                    <sosmedComponent></sosmedComponent>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { VueLoading } from 'vue-loading-template'
import fasilitasComponent from './fasilitas'
import videoComponent from './video'
import contactComponent from './contact'
import sosmedComponent from './sosmed'

export default {
    components: {
        VueLoading,
        VoerroTagsInput,
        fasilitasComponent,
        videoComponent,
        contactComponent,
        sosmedComponent
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
                teaser:'',
                seo:''
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
                            teaser:response.data.teaser,
                            seo:response.data.seo_id
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
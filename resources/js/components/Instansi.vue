<template>
    <div class="col-md-6">
        <div class="card mx-4">
            <div class="card-body p-4">
                <h1>SETUP INSTANSI</h1>
                <p class="text-muted">Isi data instansi anda</p>
            </div>
            <div class="card-footer p-4">
                <div class="row">
                    <div class="col-12">
                        <form @submit.prevent="store" action="/simpan-info" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="" class="control-label">Nama Instansi</label>
                                <input type="text" class="form-control" v-model="state.nama_instansi" required>
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
        methods:{
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
                        window.location.reload()
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
<template>
    <div class="card card-accent-primary">
        <div class="card-header">
            Tambah Data Pengurus
        </div>
        <div class="card-body">

            <div v-if="message" v-bind:class="pesankelas">
                {{ message }}
            </div>

            <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    

            <form @submit.prevent="store" action="/data/pengurus" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="" class="control-label">Name</label>
                            <input type="text" class="form-control" :class="{ 'is-invalid': errors.name }" v-model="state.name">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Email</label>
                            <input type="text" class="form-control" :class="{ 'is-invalid': errors.name }" v-model="state.email">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">No. HP</label>
                            <input type="text" class="form-control" :class="{ 'is-invalid': errors.name }" v-model="state.hp">
                        </div>
                        
                        <div class="form-group">
                            <label for="" class="control-label">Description</label>
                            <trumbowyg v-model="state.desc" class="form-control" name="content"></trumbowyg>
                        </div>

                        <fieldset>
                            <legend>Jabatan & Posisi</legend>
                            <div class="form-group">
                                <label for="" class="control-label">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control" v-model="state.posisi.jabatan" @change="ubahJabatan">
                                    <option value="" disabled selected>--Pilih Jabatan--</option>
                                    <option v-for="(l,index) in jabatan" :key="index" :value="l.id">{{l.name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Posisi</label>
                                <select name="posisi" id="posisi" class="form-control" v-model="state.posisi.id">
                                    <option value="" disabled selected>--Pilih Posisi--</option>
                                    <option v-for="(l,index) in posisi" :key="index" :value="l.id">{{l.name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Tgl. Menjabat</label>
                                <datepicker :value="state.posisi.tgl_menjabat" :format="tanggalFormatter" v-model="state.posisi.tgl_menjabat"></datepicker>
                            </div>
                        </fieldset>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-default">
                            <div class="card-header">Images</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <img v-bind:src="imagePreview" v-show="showPreview" class="img-fluid"/>
                                    <br>
                                    <div class="input-group">
                                        <input type="file" id="file" ref="file" accept="image/*" v-on:change="onFileChange" class="form-control"/>
                                        <span class="input-group-addon" id="removeFeaturedImage">
                                            <i class=" icon-cross3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            
                
                <hr>

                <div class="form-group">
                    <button class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Simpan
                    </button>

                    <router-link to="/pengurus" class="btn btn-warning text-white">
                        <i class="fa fa-backward"></i> Batal
                    </router-link>                    
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { VueLoading } from 'vue-loading-template'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import Datepicker from 'vuejs-datepicker'
import moment from 'moment'

import Trumbowyg from 'vue-trumbowyg';
  
// Import editor css
import 'trumbowyg/dist/ui/trumbowyg.css';

export default {
    components: {
        Datepicker,
        VueLoading,
        Trumbowyg
    },
    data() {
        return {
            state: {
                name:'',
                email:'',
                hp:'',
                desc:'',
                posisi:'',
                file:'',
                posisi:{
                    id:'',
                    jabatan:'',
                    tgl_menjabat:new Date()
                }
            },
            message:'',
            loading:false,
            pesankelas:'',
            errors: [],
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            },
            showPreview: false,
            imagePreview: '',
            posisi:[],
            jabatan:[],
            imagePreview: '',
        }
    },
    mounted(){
        this.getJabatan()
        // this.getPosisi()
    },
    methods: {
        tanggalFormatter(date) {
            return moment(date).format('YYYY-MM-DD');
        },
        getJabatan(){
            axios.get('/data/list-jabatan')
                .then(response => {
                    this.jabatan = response.data
                })
        },

        getPosisi(){
            axios.get('/data/list-posisi')
                .then(response => {
                    this.posisi = response.data
                })
        },

        ubahJabatan(){
            axios.get('/data/list-posisi',{
                params:{
                    jabatan: this.state.posisi.jabatan
                }
            }).then(response => {
                this.posisi = response.data
            })
        },

        store(e) {
            this.loading = true;

            axios.post(e.target.action, this.state).then(response => {
                if(response.data.success==true){
                    this.errors = [];
                    this.state = {
                        name:'',
                        email:'',
                        hp:'',
                        desc:'',
                        posisi:'',
                        file:'',
                        posisi:{
                            id:'',
                            jabatan:'',
                            tgl_menjabat:new Date()
                        }
                    },
                    this.imagePreview =''
                    this.pesankelas='alert alert-success';
                    this.message = 'Data berhasil disimpan';
                }else{
                    this.pesankelas='alert alert-danger';
                    this.message = response.data.errors;
                    this.errors.name=true;
                }

                this.loading = false;
            }).catch(error => {
                if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                        this.errors = error.response.data;
                        console.log(this.errors);
                    }
                }
            });
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
                vm.imagePreview= e.target.result;
                vm.state.file = e.target.result;
                vm.showPreview = true;
            };
            reader.readAsDataURL(file);
        },
    },
    computed:{
        valname() {
            if (this.post.name.length === 0 || this.post.name.length > 50) {
                return true;
            } 
            return false;
        },
        valStatus() {
            if (this.post.harga.length === 0 || this.post.harga.length > 50) {
                return true;
            } 
            return false;
        }
    }
}
</script>
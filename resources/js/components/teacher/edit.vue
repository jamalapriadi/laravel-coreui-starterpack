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

            <form @submit.prevent="store" action="data/pengurus" method="post" enctype="multipart/form-data">
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
                            <trumbowyg v-model="state.desc" class="form-control" :config="configText" name="content"></trumbowyg>
                        </div>

                        <fieldset>
                            <legend>Jabatan & Posisi</legend>
                            <div class="form-group">
                                <label for="" class="control-label">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control" v-model="state.jabatan_id" @change="ubahJabatan">
                                    <option value="" disabled selected>--Pilih Jabatan--</option>
                                    <option v-for="(l,index) in jabatan" :key="index" :value="l.id">{{l.name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Posisi</label>
                                <select name="posisi" id="posisi" class="form-control" v-model="state.posisi_id">
                                    <option value="" disabled selected>--Pilih Posisi--</option>
                                    <option v-for="(l,index) in posisi" :key="index" :value="l.id">{{l.name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Tgl. Menjabat</label>
                                <datepicker :value="state.tgl_menjabat" :format="tanggalFormatter" v-model="state.tgl_menjabat"></datepicker>
                            </div>
                        </fieldset>


                    </div>

                    <div class="col-lg-4">
                        <div class="card card-default">
                            <div class="card-header">Images</div>
                            <div class="card-body">

                                <div class="card card-default" v-show="showPreview">
                                    <div class="card-header">Images Info</div>
                                    <div class="card-body">
                                        <img v-bind:src="imagePreview" class="img-fluid" v-bind:style="{ 'height': state.height+'px', 'width': state.width+'px', 'border-top-left-radius': state.border_radius.top_left+'px', 'border-top-right-radius': state.border_radius.top_right+'px', 'border-bottom-left-radius': state.border_radius.bottom_left+'px', 'border-bottom-right-radius': state.border_radius.bottom_right+'px'}">
                                        
                                        <br><br>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <label for="" class="control-label">Width</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" v-model="state.width">
                                                            <span class="input-group-append">
                                                                <button class="btn btn-secondary" type="button">px</button>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="" class="control-label">Height</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" v-model="state.height">
                                                            <span class="input-group-append">
                                                                <button class="btn btn-secondary" type="button">px</button>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="" class="control-label">Border Radius</label>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-append">
                                                                        <button class="btn btn-secondary" type="button">Top Left</button>
                                                                    </span>
                                                                    <input type="text" class="form-control" v-model="state.border_radius.top_left">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-append">
                                                                        <button class="btn btn-secondary" type="button">Top Right</button>
                                                                    </span>
                                                                    <input type="text" class="form-control" v-model="state.border_radius.top_right">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-append">
                                                                        <button class="btn btn-secondary" type="button">Bottom</button>
                                                                    </span>
                                                                    <input type="text" class="form-control" v-model="state.border_radius.bottom_left">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-append">
                                                                        <button class="btn btn-secondary" type="button">Bottom</button>
                                                                    </span>
                                                                    <input type="text" class="form-control" v-model="state.border_radius.bottom_right">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="" class="control-label">Alignment</label>
                                                        <select name="alignment" id="alignment" v-model="state.alignment" class="form-control">
                                                            <option value="left">Left</option>
                                                            <option value="right">Right</option>
                                                            <option value="center">Center</option>
                                                        </select>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">

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
                    

                    <router-link to="/pengurus" class="btn btn-default">
                        <i class="fa fa-backward"></i> Batal
                    </router-link>      

                    <button class="btn btn-primary float-right">
                        <i class="fa fa-save"></i>
                        Simpan
                    </button>              
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
import 'trumbowyg/plugins/fontsize/trumbowyg.fontsize';
import 'trumbowyg/plugins/fontfamily/trumbowyg.fontfamily';

export default {
    components: {
        Datepicker,
        VueLoading,
        Trumbowyg
    },
    data() {
        return {
            pengurusId:'',
            state: {
                name:'',
                email:'',
                hp:'',
                desc:'',
                posisi:'',
                file:'',
                jabatan_id:'',
                posisi_id:'',
                tgl_menjabat:'',
                height:324,
                width:210,
                border_radius:{
                    top_left:0,
                    top_right:0,
                    bottom_left:0,
                    bottom_right:0
                },
                alignment:'left'
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
            configText:{
                btns: [
                    ['viewHTML'],
                    ['fontfamily'],
                    ['fontsize'],
                    ['undo', 'redo'], // Only supported in Blink browsers
                    ['formatting'],
                    ['strong', 'em', 'del'],
                    ['superscript', 'subscript'],
                    ['link'],
                    ['insertImage'],
                    ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                    ['unorderedList', 'orderedList'],
                    ['horizontalRule'],
                    ['removeformat'],
                    ['fullscreen'],
                ],
                plugins: {
                    fontsize: {
                        sizeList: [
                            '5px',
                            '9px',
                            '10px',
                            '11px',
                            '12px',
                            '14px',
                            '16px',
                            '18px',
                            '20px',
                            '22px',
                            '24px',
                            '26px',
                            '28px',
                            '36px',
                            '48px',
                        ],
                        allowCustomSize: false
                    }
                },
                autogrow: true,
                changeActiveDropdownIcon: true
            }
        }
    },
    mounted(){
        this.getJabatan()
        this.getData()
        // this.getPosisi()
    },
    methods: {
        getData(){
            let app=this;
            let id= app.$route.params.id;
            this.pengurusId = id;

            axios.get('data/pengurus/'+id)
                .then(response => {
                    this.state.name=response.data.name
                    this.state.email=response.data.email
                    this.state.hp=response.data.no_hp,
                    this.state.desc=response.data.description
                    

                    this.state.width = response.data.image_width;
                    this.state.height = response.data.image_height;
                    this.state.alignment = response.data.image_alignment;
                    this.state.border_radius={
                        top_left: response.data.image_border_top_left_radius,
                        top_right: response.data.image_border_top_right_radius,
                        bottom_left: response.data.image_border_bottom_left_radius,
                        bottom_right: response.data.image_border_bottom_right_radius
                    }

                    if(response.data.images!=null){
                        this.imagePreview=response.data.image_url
                        this.state.file='';
                        this.showPreview=true;
                    }


                    if(response.data.posisi.length>0){
                        for(var a=0; a< response.data.posisi.length; a++){
                            this.state.jabatan_id = response.data.posisi[a].jabatan[0].id
                        }
                    }

                    this.ubahJabatan()

                    if(response.data.posisi.length>0){
                        for(var a=0; a< response.data.posisi.length; a++){
                            this.state.posisi_id = response.data.posisi[a].id
                            this.state.tgl_menjabat = response.data.posisi[a].pivot.tgl_menjabat
                        }
                    }
                })
                .catch( error => {
                    alert('data tidak dapat di load');
                })
        },

        tanggalFormatter(date) {
            return moment(date).format('YYYY-MM-DD');
        },
        getJabatan(){
            axios.get('data/list-jabatan')
                .then(response => {
                    this.jabatan = response.data
                })
        },

        getPosisi(){
            axios.get('data/list-posisi')
                .then(response => {
                    this.posisi = response.data
                })
        },

        ubahJabatan(){
            axios.get('data/list-posisi',{
                params:{
                    jabatan: this.state.jabatan_id
                }
            }).then(response => {
                this.posisi = response.data
            })
        },

        store(e) {
            this.loading = true;

            axios.patch(e.target.action+'/'+this.pengurusId, this.state)
                .then(response => {
                    if(response.data.success==true){
                        this.errors = [];
                        this.state = {
                            name:'',
                            email:'',
                            hp:'',
                            desc:'',
                            posisi:'',
                            file:''
                        },
                        this.getData()
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

            let ukuran = files[0].size;

            if(ukuran > 1000000){
                this.$swal('Warning', 'Ukuran file image tidak boleh lebih dari 1 MB' , 'warning');
                return;
            }

            if(files[0]['type']==='image/jpeg' || files[0]['type']==='image/png' || files[0]['type']==='image/jpg'){
                this.createImage(files[0]);
            }else{
                this.$swal('Warning', 'Format file tidak diketahui' , 'warning');
                return;
            }
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
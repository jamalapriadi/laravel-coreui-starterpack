<template>
    <div class="card card-accent-primary">
        <div class="card-header">
            Tambah Data Founder
        </div>
        <div class="card-body">

            <div v-if="message" v-bind:class="pesankelas">
                {{ message }}
            </div>

            <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    

            <form @submit.prevent="store" action="data/founder" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="" class="control-label">Name</label>
                    <input type="text" name="name" class="form-control" :class="{ 'is-invalid': errors.name }" v-model="state.name">
                </div>
                <div class="form-group">
                    <label class="control-label">Images</label>
                    <br>
                        <img v-bind:src="state.file_preview" v-show="showPreview" class="img-fluid"/>
                    <br>
                    <div class="input-group">
                        <input type="file" id="file" ref="file" accept="image/*" v-on:change="onFileChange" class="form-control"/>
                        <span class="input-group-addon" id="removeFeaturedImage">
                            <i class=" icon-cross3"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Description</label>
                    <trumbowyg v-model="state.desc" class="form-control" name="content"></trumbowyg>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Simpan
                    </button>

                    <router-link to="/founder" class="btn btn-warning text-white">
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

import Trumbowyg from 'vue-trumbowyg';
  
// Import editor css
import 'trumbowyg/dist/ui/trumbowyg.css';

export default {
    components: {
        VueLoading,
        Trumbowyg
    },
    data() {
        return {
            state: {
                name:'',
                desc:'',
                file:'',
                file_preview:''
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
        }
    },
    methods: {
        store(e) {
            this.loading = true;

            axios.post(e.target.action, this.state).then(response => {
                if(response.data.success==true){
                    this.errors = [];
                    this.state = {
                        name:'',
                        desc:'',
                        file:''
                    },
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
                vm.state.file_preview = e.target.result;
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
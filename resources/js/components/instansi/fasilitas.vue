<template>
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-default">
                <div class="card-header">Add New Fasilitas</div>
                <div class="card-body">
                    <vue-loading v-if="loading2" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                    <div v-if="messagefasilitas" v-bind:class="pesankelasfasilitas">
                        {{ messagefasilitas }}
                    </div>

                    <form @submit.prevent="storeFasilitas" action="data/fasilitas" method="post">
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
            <div class="table-responsive">
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
            statefasilitas:{
                kode:'',
                name:'',
                desc:'',
                file:'',
                filefasilitas:''
            },
            messagefasilitas:'',
            messagefasilitas:'',
            loading2:false,
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            },
            fasilitas:[],
            listFasilitas:{},
            showPreviewFasilitas:false,
        }
    },
    mounted() {
        this.showFasilitas();
    },
    methods:{
        showFasilitas(){
            axios.get('data/fasilitas')
                .then(response => {
                    this.fasilitas = response.data
                    this.listFasilitas=response.data
                })
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

            axios.get('data/fasilitas/'+id)
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
                    axios.delete('data/fasilitas/'+id)
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

    }
}
</script>
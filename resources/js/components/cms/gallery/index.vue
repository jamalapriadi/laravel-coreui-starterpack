<template>
    <div class="card card-default">
        <div class="card-header">
            GALLERY
        </div>
        <div class="card-body">
            <code>Gallery</code> digunakan untuk maintenance konten yang ada dimenu <a href="https://kidsrepublic.sch.id/gallery" target="_blank">Gallery</a> frontend.<br>
            <code>Step 1</code> buat album dengan button <code>Add Album</code>.<br>
            <code>Step 2</code> klik nama album yang sudah dibuat -&gt; upload file images atau video(youtube) dengan  album dengan button <code>Add Images atau Add Video</code>.<br>
            Urutkan Album atau File agar tampilan file yang ingin dihighlight ada di urutan atas dimenu <a href="https://kidsrepublic.sch.id/gallery" target="_blank">Gallery</a> frontend.<br>
            <hr>

            <div class="row" v-show="tampilForm == false">
                <div class="col-lg-4">
                    <div class="card card-default">
                        <div class="card-header">
                            ALBUM
                            <div class="card-header-actions">
                                <a href="#" class="btn btn-primary" @click.prevent="addNew">
                                    <i class="fa fa-plus"></i> Add New
                                </a>
                            </div>
                        </div>
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

                            <div class="col-lg-12" v-if="message" v-bind:class="pesankelas">
                                {{ message }}
                            </div>
                            <div class='table-responsive'>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th>Nama Album</th>
                                            <th>Created At</th>
                                            <th width="17%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(l, index) in list.data" v-bind:key="index">
                                            <td>{{index+1}}</td>
                                            <td>{{l.name}}</td>
                                            <td>{{l.created_at}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-success" @click.prevent="detailGallery(l)">
                                                        <i class="icon-images2 text-white"></i>
                                                    </a>

                                                    <a href="#" class="btn btn-warning" @click.prevent="editGallery(l)">
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

                <div class="col-lg-8" v-show="tampilDetailGallery == true">
                    <div class="card card-default" v-show="tampilFormImage==true">
                        <div class="card-header">Add Images</div>
                        <div class="card-body">
                            <form @submit.prevent="savegallery" action="data/save-file-gallery" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="" class="control-label">Image Title</label>
                                    <input type="text" class="form-control" v-model="form.video_title" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Images</label>
                                    <img v-bind:src="form.preview_file" v-show="showPreview" class="img-fluid"/>
                                    <br><br>
                                    <input type="file" id="file" ref="file" accept="image/*" v-on:change="onFileChange" class="form-control"/>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <a href="#" class="btn btn-default" @click.prevent="bataladdNewImages">Batal</a>

                                    <button class="btn btn-primary">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card card-default" v-show="tampilFormYoutube==true">
                        <div class="card-header">Add Video</div>
                        <div class="card-body">
                            <form @submit.prevent="savegallery" action="data/save-file-gallery" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="" class="control-label">Video Title</label>
                                    <input type="text" class="form-control" v-model="form.video_title" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Video (URL Youtube)</label>
                                    <input type="text" class="form-control" v-model="form.video_url" required>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <a href="#" class="btn btn-default" @click.prevent="bataladdNewVideo">Batal</a>

                                    <button class="btn btn-primary">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card card-default">
                        <div class="card-header">
                            FILE ALBUM - {{gallery.name}}
                            <div class="card-header-actions">
                                <div class="btn btn-group">
                                    <a href="#" class="btn btn-primary" @click.prevent="addNewImages">
                                        <i class="icon-images2"></i>
                                    </a>

                                    <a href="#" class="btn btn-success" @click.prevent="addNewVideos">
                                        <i class="icon-video-camera3"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>File</th>
                                        <th>Type</th>
                                        <th>Title</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <draggable v-model="list" tag="tbody"> -->
                                    <tr v-for="(l,index) in listdetailGallery.file" :key="index">
                                        <td>{{index+1}}</td>
                                        <td>
                                            <div v-if="l.file_type == 'image'">
                                                <img :src="l.image_url" alt="" class="img-fluid" width="120px;">
                                            </div>

                                            <div v-else>
                                                <youtube :video-id="l.file" :player-width="230" :player-height="120"></youtube>
                                            </div>
                                        </td>
                                        <td>{{l.file_type}}</td>
                                        <td>{{l.title}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-warning" @click.prevent="editImageGallery(l)">
                                                    <i class="fa fa-edit text-white"></i>
                                                </a>

                                                <a href="#" class="btn btn-danger" @click.prevent="hapusImageGallery(l.id)">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- </draggable> -->
                                </tbody>
                            </table>

                            <!-- <rawDisplayer class="col-3" :value="listdetailGallery.file" title="List" /> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" v-show="tampilForm == true">
                <div class="col-lg-12">
                    <div class="card card-default">
                        <div class="card-header">Add New Album</div>
                        <div class="card-body">
                            <form @submit.prevent="store" action="data/gallery" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="" class="control-label">Nama Album</label>
                                    <input type="text" class="form-control" placeholder="Nama Album" v-model="state.name">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Deskripsi</label>
                                    <ckeditor :editor="editor" v-model="state.desc" :config="editorConfig"></ckeditor>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Related Event</label>
                                    <select name="related" id="related" class="form-control" v-model="state.related" @change="changeRelated">
                                        <option v-for="(l,index) in pilihan" :key="index" :value="l">{{l}}</option>
                                    </select>
                                </div>
                                <div class="form-group" v-show="state.related == 'Yes'">
                                    <label for="" class="control-label">Event Name</label>
                                    <select name="event" id="event" class="form-control" v-model="state.event">
                                        <option value="" disabled>--Pilih Event--</option>
                                        <option v-for="(l,index) in event" :key="index" :value="l.id">{{l.title}}</option>
                                    </select>
                                </div>
                                <hr>
                                <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    

                                <div class="form-group">
                                    <label for="" class="control-label"></label>
                                    <a href="#" class="btn btn-default" @click.prevent="batalForm">
                                        <i class="fa fa-backward"></i> Batal
                                    </a>
                                    <button class="btn btn-primary">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
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
import draggable from 'vuedraggable'

export default {
    components: {
        VueLoading,
        draggable
    },
    data(){
        return {
            tampilForm:false,
            state:{
                kode:'',
                name:'',
                related:'No',
                event:'',
                desc:'',
            },
            list:[],
            listData:{},
            pencarian:'',
            pesankelas:'',
            message:'',
            loading:true,
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            },
            event:[],
            pilihan:['No','Yes'],
            tampilDetailGallery:false,
            gallery:{
                id:'',
                name:''
            },
            // list:[],
            listdetailGallery:[],
            dragging: false,
            tampilFormImage:false,
            tampilFormYoutube:false,
            form:{
                kode:'',
                type:'',
                video_title:'',
                video_url:'',
                preview_file:'',
                file:''
            },
            showPreview: false,
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
        addNew(){
            this.tampilForm=true
        },
        batalForm(){
            this.tampilForm=false
        },
        changeRelated(){
            this.event=[]

            if(this.state.related == 'Yes'){
                axios.get('data/list-event')
                    .then(response => {
                        this.event = response.data
                    })
            }
        },

        editGallery(l){
            this.tampilForm=true
            this.state.kode = l.id 
            this.state.name = l.name 
            this.state.desc = l.description

            if(l.event_id != null){
                this.state.related = 'Yes'
            }else{
                this.state.related = 'No'
            }

            this.changeRelated()

            this.state.event = l.event_id
        },
        
        detailGallery(l){
            this.tampilDetailGallery = true
            this.tampilFormImage=false
            this.tampilFormYoutube=false
            this.gallery={
                id: l.id,
                name: l.name
            }

            //getdetail gallery
            this.getDetailGallery()
            
        },

        bataladdNewImages(){
            this.form.type=''
            this.tampilFormImage=false
            this.tampilFormYoutube=false
        },

        bataladdNewVideo(){
            this.form.type=''
            this.tampilFormImage=false
            this.tampilFormYoutube=false
        },

        addNewImages(){
            this.form.type='image'
            this.tampilFormImage=true
            this.tampilFormYoutube=false
        },

        addNewVideos(){
            this.form.type='video'
            this.tampilFormImage=false
            this.tampilFormYoutube=true
        },

        getDetailGallery(){
            axios.get('data/detail-gallery/'+this.gallery.id)
                .then(response => {
                    this.listdetailGallery = response.data
                })
        },

        editImageGallery(l){
            this.form.type=l.file_type
            this.form.kode=l.id
            this.form.video_title = l.title
            this.form.preview_file = l.image_url

            if(l.image_url!=null){
                this.showPreview=true
            }

            if(l.file_type == "image"){
                this.tampilFormImage=true
                this.tampilFormYoutube=false
            }else{
                this.form.video_url = l.video_url
                this.tampilFormImage=false
                this.tampilFormYoutube=true
            }
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

            axios.get('data/gallery?page='+page)
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

            axios.get('data/gallery?q='+this.pencarian)
                .then(response => {
                    this.list = response.data;
                })
                .catch( errors => {
                    alert('pencarian tidak ditemukan');
                })
        },

        hapus(id,index){
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
                    axios.delete('data/post/'+id)
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

        hapusImageGallery(id){
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
                    axios.delete('data/delete-file-gallery/'+id)
                        .then(response => {
                            if(response.data.success==true){
                                // this.message="";
                                this.$swal('Deleted', response.data.message , 'success');
                                this.getDetailGallery()
                            }else{
                                this.$swal('Deleted', response.data.message , 'error');
                            }
                        })
                    
                } else {
                    this.$swal('Cancelled', 'Your file is still intact', 'info')
                }
            })
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
                vm.form.file = e.target.result;
                vm.form.preview_file = e.target.result;
                vm.showPreview = true;
            };
            reader.readAsDataURL(file);
        },

        store(e) {
            this.loading=true;


            axios.post(e.target.action, this.state).then(response => {
                this.loading=false;
                if(response.data.success==true){
                    this.errors = [];
                    this.state={
                        kode:'',
                        name:'',
                        related:'No',
                        event:'',
                        desc:'',
                    },

                    this.tampilForm=false

                    this.message = 'Data has been saved.';
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

        savegallery(e){
            this.loading=true;


            axios.post(e.target.action+'/'+this.gallery.id, this.form).then(response => {
                this.loading=false;
                if(response.data.success==true){
                    this.errors = [];
                    this.form={
                        kode:'',
                        type:'',
                        video_title:'',
                        video_url:'',
                        preview_file:'',
                        file:''
                    }

                    this.message = 'Data has been saved.';
                    this.pesankelas='alert alert-success';

                    this.form.type=''
                    this.tampilFormImage=false
                    this.tampilFormYoutube=false
                    this.getDetailGallery()
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
        }
    }
}
</script>
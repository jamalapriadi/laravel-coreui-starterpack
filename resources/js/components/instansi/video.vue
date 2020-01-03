<template>
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-default">
                <div class="card-header">Add New Video</div>
                <div class="card-body">
                    <vue-loading v-if="loading2" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                    <div v-if="messagefasilitas" v-bind:class="pesankelasfasilitas">
                        {{ messagefasilitas }}
                    </div>

                    <form @submit.prevent="storeVideo" action="data/video" method="post">
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
            <div class="table-responsive">
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
            messagefasilitas:'',
            messagefasilitas:'',
            loading2:false,
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            },
            videos:[],
            video:{
                kode:'',
                url:''
            },
        }
    },
    mounted() {
        this.showVideo();
    },
    methods:{
        showVideo(){
            axios.get('data/video')
                .then(response => {
                    this.videos = response.data
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

            axios.get('data/video/'+id)
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
                    axios.delete('data/video/'+id)
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

    }
}
</script>
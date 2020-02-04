<template>
    <form v-on:submit.prevent="saveForm()" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-flat">
                    <div class="card-header">Edit Calendar</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input class="form-control" name="title" id="title" placeholder="Title" v-model="state.title">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Deskripsi</label>
                            <!-- <trumbowyg v-model="state.desc" class="form-control" :config="configText" name="content"></trumbowyg> -->
                            <textarea name="desc" id="desc" v-model="state.desc" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Choose File</label><br>
                            <div class="input-group">
                                <input type="file" id="file" ref="file" v-on:change="onFileChange" class="form-control"/>
                                <span class="input-group-addon" id="removeFeaturedImage">
                                    <i class=" icon-cross3"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
            <div class="col-lg-12" v-if="message" v-bind:class="pesankelas">
                {{ message }}
            </div>

            <div class="col-lg-12">
                <div class="card card-flat">
                    <div class="card-body">
                        <div id="pesan"></div>

                        <router-link to="/calendar-academics" class="btn btn-default">
                            <i class="icon-arrow-left7"></i> Back
                        </router-link>

                        <button class="btn btn-primary float-right">
                            <i class="icon-floppy-disk"></i>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <b-modal ref="myModalRef" size="lg" id="modal-1" title="Related News">
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

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(l,index) in relatednews.data" v-bind:key="index">
                        <td>
                            <input type="checkbox" v-model="pilihrelatednews[index]" v-bind:value="l" @click="pilihnews(l,$event)">
                        </td>
                        <td>{{l.title}}</td>
                        <td>{{l.penulis.name}}</td>
                    </tr>
                </tbody>
            </table>

            <div align="right">
                <!-- <pagination :data="relatednews" @pagination-change-page="showRelatedNews" :show-disabled="true"></pagination> -->
            </div>
        </b-modal>


    </form>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { VueLoading } from 'vue-loading-template'
import Multiselect from 'vue-multiselect'
import Datepicker from 'vuejs-datepicker';
import moment from 'moment'
import Timeselector from 'vue-timeselector';

import Trumbowyg from 'vue-trumbowyg';
  
// Import editor css
import 'trumbowyg/dist/ui/trumbowyg.css';
import 'trumbowyg/plugins/fontsize/trumbowyg.fontsize';
import 'trumbowyg/plugins/fontfamily/trumbowyg.fontfamily';

export default {
    components: {
        VueLoading,
        VoerroTagsInput,
        Multiselect,
        Datepicker,
        Timeselector,
        Trumbowyg
    },
    data(){
        return {
            postId:'',
            state:{
                title:'',
                topik:'',
                teaser:'',
                desc:'',
                tanggal: '',
                jam_mulai:'',
                jam_selesai:'',
                comment:'open',
                lokasi:'',
                lat:'',
                lng:'',
                youtube:'',
                file:'',
                facebook:'',
                category:'',
                status:'publish',
            },
            pencarian:'',
            pesankelas:'',
            message:'',
            loading:false,
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            },
            categories:[],
            relatednews:[],
            pilihrelatednews:[],
            showPreview: false,
            tmpshowPreview:false,
            imagePreview: '',
            tag: '',
            selectedTags:{},
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
    mounted() {
        // this.getCategory();
        this.getData();
    },
    watch: {
        pencarian: function(q) {
            if (q != ''){
                this.cariRelatedNews();
            }else{
                this.showRelatedNews();
            }
        }
    },
    methods:{
        tanggalFormatter(date) {
            return moment(date).format('DD-MM-YYYY');
        },

        getCKeditor(){
            CKEDITOR.replace( 'desc',{
                extraPlugins : ['btgrid','wenzgmap','bootstrapTabs','link'],
                language: 'en',
                allowedContent: true,
                entities: false,
                enterMode:2,forceEnterMode:false,shiftEnterMode:1,
                toolbar :
                    [
                        [ 'Font', 'FontSize','Styles' ],        
                        [ 'Bold', 'Italic', 'Underline'],
                        [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ],
                        ['TextColor','BGColor'],
                        [ 'Paste', 'PasteText', 'PasteFromWord'],
                        '/',
                        [ 'NumberedList', 'BulletedList', '-','JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
                        [ 'Link','Anchor','btgrid','About','wenzgmap','BootstrapTabs','Source','Maximize'],
                    ],
                toolbarGroupsCanCollapse:true,
                filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
                filebrowserWindowWidth: '1000',
                filebrowserWindowHeight: '700'
            });
        },

        getData(){
            let app=this;
            let id= app.$route.params.id;
            this.postId = id;

            axios.get('data/post/'+id)
                .then(response => {
                    this.state.title=response.data.title;
                    this.state.topik=response.data.topik;
                    this.state.teaser=response.data.teaser;
                    this.state.desc=response.data.description;
                    this.state.youtube=response.data.featured_youtube;
                    this.state.facebook=response.data.featured_facebook;
                    this.state.relatednews=response.data.related;
                    this.state.status=response.data.post_status;
                    this.state.tanggal=response.data.tanggal;
                    this.state.jam_mulai=response.data.jam_mulai;
                    this.state.jam_selesai=response.data.jam_selesai;
                    this.state.comment=response.data.comment,
                    this.state.lokasi=response.data.lokasi;
                    this.state.file="";

                    this.getCKeditor()
                    
                })
                .catch( error => {
                    alert('data tidak dapat di load');
                })
        },

        getCategory(){
            axios.get('data/list-category')
                .then(response => {
                    this.categories = response.data;
                })  
        },

        showModal () {
            this.$refs.myModalRef.show()
            this.showRelatedNews();
        },

        showRelatedNews(){
            axios.get('data/list-post?type=artikel')
                .then(response => {
                    this.relatednews = response.data;
                })
        },

        cariRelatedNews(page){
            if(typeof page === 'undefined'){
                page = 1;
            }

            axios.get('data/list-post?type=artikel&q='+this.pencarian)
                .then(response => {
                    this.relatednews = response.data;
                })
                .catch( errors => {
                    alert('pencarian tidak ditemukan');
                })
        },

        pilihnews(l, event){
            if (event.target.checked) {
                this.state.relatednews.push(l);
            }else{
                this.state.relatednews.splice(l, 1);
            }

            console.log(this.state.relatednews);
        },
        
        hapusrelatednews(l){
            this.state.relatednews.splice(l, 1);
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
                vm.state.file = e.target.result;
                // vm.showPreview = true;
                // vm.tmpshowPreview=false;
            };
            reader.readAsDataURL(file);
        },

        saveForm(){
            this.loading=true;

            this.state.desc = CKEDITOR.instances.desc.getData();

            let formData = new FormData();
            formData.append('kode',this.postId);
            formData.append('title',this.state.title);
            formData.append('desc', this.state.desc);
            formData.append('file', this.state.file);

            axios.post('data/calendar', formData)
                .then(response => {
                    this.loading=false;
                    if(response.data.success==true){
                        this.errors = [];
                        // this.state={
                        //     title:'',
                        //     topik:'',
                        //     teaser:'',
                        //     desc:'',
                        //     youtube:'',
                        //     file:'',
                        //     facebook:'',
                        //     status:'publish',
                        //     relatednews:[],
                        //     category:[],
                        //     subcategory:[],
                        //     tags:[]
                        // },
                        this.message = 'Data has been saved.';
                        this.pesankelas='alert alert-success';
                        // this.$router.replace('/all-post');
                    }else{
                        this.pesankelas='alert alert-danger';
                        this.message = response.data.errors;
                        this.errors.nama=true;
                    }
                })
                .catch( error => {
                    alert('data gagal diupdate');
                })
        },
    }
}
</script>


<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
    /* adapted from http://maxwells.github.io/bootstrap-tags.html */
    .ck-editor__editable {
        min-height: 400px;
    }

    /* The input */
    .tags-input {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }

    .tags-input input {
        flex: 1;
        background: transparent;
        border: none;
    }

    .tags-input input:focus {
        outline: none;
    }

    .tags-input input[type="text"] {
        color: #495057;
    }

    .tags-input-wrapper-default {
        padding: .5rem .25rem;

        background: #fff;

        border: 1px solid transparent;
        border-radius: .25rem;
        border-color: #dbdbdb;
    }

    /* The tag badges & the remove icon */
    .tags-input span {
        margin-right: 0.3rem;
    }

    .tags-input-remove {
        cursor: pointer;
        position: relative;
        display: inline-block;
        width: 0.5rem;
        height: 0.5rem;
        overflow: hidden;
    }

    .tags-input-remove:before, .tags-input-remove:after {
        content: '';
        position: absolute;
        width: 100%;
        top: 50%;
        left: 0;
        background: #5dc282;
        
        height: 2px;
        margin-top: -1px;
    }

    .tags-input-remove:before {
        transform: rotate(45deg);
    }
    .tags-input-remove:after {
        transform: rotate(-45deg);
    }

    /* Tag badge styles */
    .tags-input-badge {
        display: inline-block;
        padding: 0.25em 0.4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }

    .tags-input-badge-pill {
        padding-right: 0.6em;
        padding-left: 0.6em;
        border-radius: 10rem;
    }

    .tags-input-badge-selected-default {
        color: #212529;
        background-color: #f0f1f2;
    }

    /* Typeahead - badges */
    .typeahead-badges > span {
        cursor: pointer;
        margin-right: 0.3rem;
    }

    /* Typeahead - dropdown */
    .typeahead-dropdown {
        list-style-type: none;
        padding: 0;
        margin: 0;
        position: absolute;
        width: 100%;
    }

    .typeahead-dropdown li {
        padding: .25rem 1rem;
        cursor: pointer;
    }

    /* Typeahead elements style/theme */
    .tags-input-typeahead-item-default {
        color: #fff;
        background-color: #343a40;
    }

    .tags-input-typeahead-item-highlighted-default {
        color: #fff;
        background-color: #007bff;
    }
</style>


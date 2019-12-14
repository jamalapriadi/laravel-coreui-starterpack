<template>
    <form v-on:submit.prevent="saveForm()" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-flat">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input class="form-control" name="title" id="title" placeholder="Title" v-model="state.title">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Teaser</label>
                            <textarea name="teaser" id="teaser" cols="30" rows="3" class="form-control" v-model="state.teaser"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Full Text</label>
                            <trumbowyg v-model="state.desc" class="form-control" name="content"></trumbowyg>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Youtube URL</label>
                            <input type="text" name="youtube" id="youtube" class="form-control" v-model="state.youtube">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Facebook URL</label>
                            <input type="text" name="facebook" id="facebook" class="form-control" v-model="state.facebook">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h6 class="card-title">Status</h6>
                    </div>
                    <div class="card-body">
                        <select name="status" id="status" class="form-control" v-model="state.status">
                            <option value="publish">Publish</option>
                            <option value="draft">Draft</option>
                            <option value="private">Private</option>
                        </select>
                    </div>  
                </div>

                <div class="card card-flat">
                    <div class="card-header">
                        Related News
                        <span class="float-right">
                            <a @click="showModal" href="#" class="btn btn-primary addnews">
                                <i class="icon-add"></i> Add News
                            </a>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class='table table-striped' v-if="state.relatednews.length > 0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(l,index) in state.relatednews" v-bind:key="index">
                                    <td>{{l.title}}</td>
                                    <td>
                                        <a class='btn btn-sm btn-danger text-white hapusrelatednews' @click="hapusrelatednews(l)">
                                            <i class='icon-trash'></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card card-flat">
                    <div class="card-header">
                        <h6 class="card-title">Category</h6>
                    </div>
                    <div class="card-body">
                        <multiselect v-model="state.categories" :options="categories" :multiple="true" 
                            :close-on-select="false" :clear-on-select="false" :preserve-search="true" 
                            placeholder="Pilih Category" label="text" track-by="text" :preselect-first="true">
                        </multiselect>
                    </div>  
                </div>

                <div class="card card-flat">
                    <div class="card-header">
                        <h6 class="card-title">Featured Image</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label">Choose File</label><br>
                                <img v-bind:src="state.file_preview" v-show="showPreview" class="img-fluid"/>
                            <br><br>
                            <div class="input-group">
                                <input type="file" id="file" ref="file" accept="image/*" v-on:change="onFileChange" class="form-control"/>
                                <span class="input-group-addon" id="removeFeaturedImage">
                                    <i class=" icon-cross3"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-flat">
                    <div class="card-header">
                        Tags
                        <span class="float-right">
                            <a href="#" class="btn btn-primary header-btn" id="addtag">
                                <i class="icon-add"></i> Add Tag
                            </a>
                        </span>
                    </div>
                    <div class="card-body">
                        <!-- <span class="tag badge badge-dark" v-for="(k,index) in state.tags" v-bind:key="index">
                            <span>{{k.nama}}</span>
                            <a class="removetag">x</a>
                        </span> -->
                        <tags-input element-id="tags"
                            v-model="state.tags"
                            :typeahead="true">
                        </tags-input>
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

                        <router-link to="/all-post" class="btn btn-default">
                            <i class="icon-arrow-left7"></i> Back
                        </router-link>

                        <button class="btn btn-primary pull-right">
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
import Trumbowyg from 'vue-trumbowyg';
  
// Import editor css
import 'trumbowyg/dist/ui/trumbowyg.css';

export default {
    components: {
        VueLoading,
        VoerroTagsInput,
        Multiselect,
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
                youtube:'',
                file:'',
                file_preview:'',
                facebook:'',
                category:'',
                status:'publish',
                relatednews:[],
                categories:[],
                subcategory:[],
                tags: [],
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
            imagePreview: '',
            tag: '',
            selectedTags:{}
        }
    },
    mounted() {
        this.getCategory();
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
                    if(response.data.featured_image!=null){
                        this.state.file_preview=response.data.feature_image_url;
                        this.showPreview=true;
                    }

                    console.log(this.state.file);

                    for(var b=0; b<response.data.category.length; b++){
                        this.state.categories.push({id:response.data.category[b].id,text:response.data.category[b].category_name});
                    }

                    for(var a=0; a<response.data.tags.length; a++){
                        this.state.tags.push(response.data.tags[a].tag_name);
                    }
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
                vm.state.file_preview = e.target.result;
                vm.state.file = e.target.result;
                vm.showPreview = true;
            };
            reader.readAsDataURL(file);
        },

        saveForm(){
            this.loading=true;

            axios.patch('data/post/'+this.postId, this.state)
                .then(response => {
                    this.loading=false;
                    if(response.data.success==true){
                        this.errors = [];
                        this.state={
                            title:'',
                            topik:'',
                            teaser:'',
                            desc:'',
                            youtube:'',
                            file:'',
                            facebook:'',
                            status:'publish',
                            relatednews:[],
                            category:[],
                            subcategory:[],
                            tags:[]
                        },
                        this.message = 'Data has been saved.';
                        this.pesankelas='alert alert-success';
                        this.$router.replace('/all-post');
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


<template>
    <form @submit.prevent="store" action="data/page" method="post" enctype="multipart/form-data">
        <div class="row">

            <div class="col-lg-4">
                <div class="card card-default">
                    <div class="card-header">Page Attribut</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="" class="control-label">Menu</label>
                            <select name="menu" id="menu" class="form-control" v-model="state.menu">
                                <option value="" disabled selected>--Pilih Menu--</option>
                                <option v-for="(l,index) in menus" :key="index" :value="l.id">{{l.menu}}</option>
                            </select>
                        </div>
                        <div  v-show="state.page_type =='text' || state.page_type=='component' || state.page_type=='text and component'">
                            <div class="form-group">
                                <label for="template" class="control-label">Template</label>
                                <select name="template" id="template" class="form-control" v-model="state.template">
                                    <option value="default">Default Template (1 Column)</option>
                                    <option value="column-two" v-show="state.page_type == 'text'">2 Column (Page+Image)</option>
                                    <option value="column-two-with-slider" v-show="state.page_type == 'text'">2 Column (Page+Slider)</option>
                                    <option value="column-two-with-thumbnail" v-show="state.page_type == 'text'">2 Column (Page+Thumbnail)</option>
                                    <option value="column-two-with-carousel" v-show="state.page_type == 'text'">1 Column (Page+Carousel)</option>
                                    <option value="template-with-sidebar">Template With Sidebar</option>
                                </select>
                            </div>

                            <div v-show="state.template == 'template-with-sidebar'">
                                <div class="form-group">
                                    <label for="sidebar" class="control-label">Sidebar Layout</label>
                                    <select name="sidebar" id="sidebar" class="form-control" v-model="state.sidebar_layout">
                                        <option value="left-sidebar">Left Sidebar</option>
                                        <option value="right-sidebar">Right Sidebar</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label">Sidebar Content</label>
                                    <select name="sidebar_content" id="sidebar_content" class="form-control" v-model="state.sidebar_content">
                                        <option value="latest-news">Latest News</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card card-primary" v-show="state.page_type =='text' || state.page_type=='component' || state.page_type=='text and component'">
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

                <div class="card card-flat" v-show="state.page_type =='text' || state.page_type=='component' || state.page_type=='text and component'">
                    <div class="card-header">
                        <h6 class="card-title">Featured Image</h6>
                    </div>
                    <div class="card-body">

                        <div class="card card-default" v-show="showPreview">
                            <div class="card-header">Images Info</div>
                            <div class="card-body">
                                <img v-bind:src="state.file" class="img-fluid" v-bind:style="{ 'height': state.height+'px', 'width': state.width+'px', 'border-top-left-radius': state.border_radius.top_left+'px', 'border-top-right-radius': state.border_radius.top_right+'px', 'border-bottom-left-radius': state.border_radius.bottom_left+'px', 'border-bottom-right-radius': state.border_radius.bottom_right+'px'}">
                                
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
                            <label class="control-label">Choose File</label><br>
                            <div class="input-group">
                                <input type="file" id="file" ref="filex" accept="image/*" v-on:change="onFileChange" class="form-control"/>
                                <span class="input-group-addon" id="removeFeaturedImage">
                                    <i class=" icon-cross3"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-flat" v-show="state.page_type =='text' || state.page_type=='component' || state.page_type=='text and component'">
                    <div class="card-header">
                        Tags
                        <span class="float-right">
                            <a href="#" class="btn btn-primary header-btn" id="addtag">
                                <i class="icon-add"></i> Add Tag
                            </a>
                        </span>
                    </div>
                    <div class="card-body">
                        <tags-input element-id="tags"
                            v-model="state.tags"
                            :typeahead="true">
                        </tags-input>
                    </div>
                </div>


            </div>


            <div class="col-lg-8">
                <div class="card card-flat">
                    <div class="card-header">Create Page</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="" class="control-label">Heading Title</label>
                            <input class="form-control" name="heading title" id="title" placeholder="Heading Title" v-model="state.heading_title">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input class="form-control" name="title" id="title" placeholder="Title" v-model="state.title">
                                </div>
                                <div class="col-lg-6">
                                    <input class="form-control" name="lasttitle" id="lasttitle" placeholder="Last Title" v-model="state.second_title">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Page Type</label>
                            <select name="type" id="type" class="form-control" v-model="state.page_type">
                                <option value="text">Text</option>
                                <option value="component">Component</option>
                                <option value="url">Url</option>
                                <option value="text and component">Text and Component</option>
                            </select>
                        </div>

                        <div v-show="state.page_type == 'component' || state.page_type == 'text and component'">
                            <div class="form-group">
                                <label for="" class="control-label">Component Name</label>
                                <select name="component" id="component" class="form-control" v-model="state.component">
                                    <option value="" disabled selected>--Pilih Component--</option>
                                    <option value="founder-component">Founder Component</option>
                                    <option value="teacher-component">Teacher Component</option>
                                    <option value="program-component">Program Component</option>
                                    <option value="blog-component">Blog Component</option>
                                    <option value="gallery-component">Gallery Component</option>
                                    <option value="contact-component">Contact Component</option>
                                    <option value="newsletter-component">Newsletter Component</option>
                                    <option value="testimoni-component">Testimoni Component</option>
                                    <option value="single-post-component">Single Post Component</option>
                                </select>
                            </div>
                        </div>

                        <div v-show="state.page_type == 'text' || state.page_type=='text and component'">
                            <div class="form-group">
                                <label class="control-label">Full Text</label>
                                <!-- <trumbowyg v-model="state.desc" class="form-control" name="content" :config="configText"></trumbowyg> -->
                                <textarea name="desc" id="desc" v-model="state.desc" cols="30" rows="10"></textarea>
                            </div>
                            <!-- <div class="form-group">
                                <label class="control-label">Youtube URL</label>
                                <input type="text" name="youtube" id="youtube" class="form-control" v-model="state.youtube">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Facebook URL</label>
                                <input type="text" name="facebook" id="facebook" class="form-control" v-model="state.facebook">
                            </div> -->

                            <!-- <div class="form-group" v-show="state.template != 'column-two-with-slider'">
                                <label for="">Gallery Image</label>
                                <vue-upload-multiple-image
                                    @upload-success="uploadImageSuccess"
                                    @before-remove="beforeRemove"
                                    @edit-image="editImage"
                                    @data-change="dataChange"
                                    :data-images="images"
                                    :maxImage=20
                                    dragText="Pilih Image"
                                    browseText="Cari"
                                    dropText="Drag n Drop"
                                    markIsPrimaryText="Default Image"
                                    primaryText="Primary Image"
                                    >
                                </vue-upload-multiple-image>
                            </div> -->

                            <div v-show="state.template == 'column-two-with-slider' || state.template == 'column-two-with-thumbnail' || state.template == 'column-two-with-carousel'">
                                <fieldset>
                                    <legend v-if="state.template == 'column-two-with-slider'">Add New Slider</legend>
                                    <legend v-if="state.template == 'column-two-with-thumbnail'">Add New Thumbnail</legend>
                                    <legend v-if="state.template == 'column-two-with-carousel'">Add New Carousel</legend>
                                    <div>
                                        <div class="form-group">
                                            <label for="" class="control-label">File Name</label>
                                            <input type="text" class="form-control" v-model="slider.title">
                                        </div>
                                        <div class="card card-default" v-show="showPreviewSlider">
                                            <div class="card-header">Images Info</div>
                                            <div class="card-body">
                                                <img v-bind:src="slider.file" class="img-fluid" v-bind:style="{ 'height': slider.height+'px', 'width': slider.width+'px', 'border-top-left-radius': slider.border_radius.top_left+'px', 'border-top-right-radius': slider.border_radius.top_right+'px', 'border-bottom-left-radius': slider.border_radius.bottom_left+'px', 'border-bottom-right-radius': slider.border_radius.bottom_right+'px'}">
                                                
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <fieldset>
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Width</label>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" v-model="slider.width">
                                                                    <span class="input-group-append">
                                                                        <button class="btn btn-secondary" type="button">px</button>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="" class="control-label">Height</label>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" v-model="slider.height">
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
                                                                            <input type="text" class="form-control" v-model="slider.border_radius.top_left">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-append">
                                                                                <button class="btn btn-secondary" type="button">Top Right</button>
                                                                            </span>
                                                                            <input type="text" class="form-control" v-model="slider.border_radius.top_right">
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
                                                                            <input type="text" class="form-control" v-model="slider.border_radius.bottom_left">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-append">
                                                                                <button class="btn btn-secondary" type="button">Bottom</button>
                                                                            </span>
                                                                            <input type="text" class="form-control" v-model="slider.border_radius.bottom_right">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="" class="control-label">Alignment</label>
                                                                <select name="alignment" id="alignment" v-model="slider.alignment" class="form-control">
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
                                            <label for="" class="control-label">Images</label>
                                            <input type="file" id="file" ref="filey" accept="image/*" v-on:change="onFileChangeSlider" class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <a class="btn btn-primary text-white" @click.prevent="tambahSlider">
                                                <i class="fa fa-plus"></i> Add 
                                            </a>
                                        </div>
                                    </div>
                                </fieldset>
                                <br>
                                <table class="table table-striped">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>No.</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(l,index) in state.slider" :key="index">
                                            <td>{{index+1}}</td>
                                            <td>{{l.title}}</td>
                                            <td>
                                                <img v-bind:src="l.file" class="img-fluid" style="width:120px"/>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-danger" @click.prevent="hapusSlider(index)">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div v-show="state.page_type == 'url'">
                            <div class="form-group">
                                <label for="" class="control-label">URL</label>
                                <input type="text" class="form-control" v-model="state.url">
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

                        <router-link to="/page" class="btn btn-default">
                            <i class="icon-arrow-left7"></i> Back
                        </router-link>

                        <button class="btn btn-primary pull-right float-right">
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
import VueUploadMultipleImage from 'vue-upload-multiple-image'
// import SimpleUploadAdapter from '@ckeditor/ckeditor5-upload/src/adapters/simpleuploadadapter'
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
        VueUploadMultipleImage,
        Trumbowyg
    },
    data(){
        return {
            state:{
                heading_title:'',
                title:'',
                second_title:'',
                topik:'',
                teaser:'',
                desc:'',
                youtube:'',
                file:'',
                facebook:'',
                category:'',
                status:'publish',
                relatednews:[],
                categories:[],
                subcategory:[],
                tags: [],
                images:[],
                page_type:'text',
                component:'',
                menu:'',
                template:'default',
                sidebar_layout:'left-sidebar',
                sidebar_content:'latest-news',
                url:'',
                slider:[],
                height:770,
                width:384,
                border_radius:{
                    top_left:0,
                    top_right:0,
                    bottom_left:0,
                    bottom_right:0
                },
                alignment:'left'
            },
            slider:{
                title:'',
                file:'',
                file_preview:'',
                status:'',
                height:770,
                width:384,
                border_radius:{
                    top_left:0,
                    top_right:0,
                    bottom_left:0,
                    bottom_right:0
                },
                alignment:'left'
            },
            showPreviewSlider:false,
            pencarian:'',
            pesankelas:'',
            message:'',
            loading:false,
            categories:[],
            relatednews:[],
            pilihrelatednews:[],
            showPreview: false,
            imagePreview: '',
            tag: '',
            selectedTags : '',
            images:[],
            maxImage:10,
            menus:[],
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
        this.getTag();
        this.getMenu();
        this.getCKeditor();
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
        getMenu(){
            axios.get('data/list-menu')
                .then(response => {
                    this.menus = response.data
                })
        },

        getCKeditor(){
            CKEDITOR.replace( 'desc',{
                extraPlugins : ['btgrid','wenzgmap','bootstrapTabs'],
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
                        [ 'btgrid','About','wenzgmap','BootstrapTabs','Source','Maximize'],
                    ],
                toolbarGroupsCanCollapse:true,
                filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
                filebrowserWindowWidth: '1000',
                filebrowserWindowHeight: '700'
            });
        },

        getTag(){
            axios.get('data/list-tags')
                .then(response=>{
                    this.selectedTags=response.data.toString();
                    // for(var a=0;a.response.data.length; a++){
                    //     this.selectedTags.push(response.data[a].text);
                    // }
                })
            console.log(this.selectedTags);
        },

        showModal () {
            this.$refs.myModalRef.show()
            this.showRelatedNews();
        },

        showRelatedNews(){
            axios.get('data/list-post?type=artikel')
                .then(response => {
                    this.relatednews = response.data;
                    console.log(this.relatednews);
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
            let filex = this.$refs.filex.files[0];
            if(!filex || filex.type.indexOf('image/') !== 0) return;
            
            let reader = new FileReader();
            
            reader.readAsDataURL(filex);
            reader.onload = evt => {
                let img = new Image();
                img.onload = () => {
                    this.state.width = img.width
                    this.state.height = img.height
                    console.log(img.width+' - '+img.height)
                }
                img.src = evt.target.result;
            }

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
                vm.state.file = e.target.result;
                vm.showPreview = true;
            };
            reader.readAsDataURL(file);
        },

        onFileChangeSlider(e){
            let filey = this.$refs.filey.files[0];
            if(!filey || filey.type.indexOf('image/') !== 0) return;
            
            let reader = new FileReader();
            
            reader.readAsDataURL(filey);
            reader.onload = evt => {
                let img = new Image();
                img.onload = () => {
                    this.slider.width = img.width
                    this.slider.height = img.height
                    console.log(img.width+' - '+img.height)
                }
                img.src = evt.target.result;
            }

            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;

            let ukuran = files[0].size;

            if(ukuran > 1000000){
                this.$swal('Warning', 'Ukuran file image tidak boleh lebih dari 1 MB' , 'warning');
                return;
            }

            if(files[0]['type']==='image/jpeg' || files[0]['type']==='image/png' || files[0]['type']==='image/jpg'){
                this.createImageSlider(files[0]);
            }else{
                this.$swal('Warning', 'Format file tidak diketahui' , 'warning');
                return;
            }
        },

        createImageSlider(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.slider.file = e.target.result;
                vm.showPreviewSlider = true;
            };
            reader.readAsDataURL(file);
        },

        tambahSlider(){
            if(this.slider.text==""){
                alert('Text Harus diisi');

                return false;
            }  

            if(this.slider.file==""){
                alert('File harus diisi');

                return false;
            }

            this.state.slider.push({
                title:this.slider.title,
                file:this.slider.file,
                status:'new',
                height:this.slider.height,
                width:this.slider.width,
                top_left: this.slider.border_radius.top_left,
                top_right: this.slider.border_radius.top_right,
                bottom_left: this.slider.border_radius.bottom_left,
                bottom_right: this.slider.border_radius.bottom_right,
                alignment:this.slider.alignment
            });

            this.slider={
                title:'',
                file:'',
                file_preview:'',
                status:'',
                height:770,
                width:384,
                border_radius:{
                    top_left:0,
                    top_right:0,
                    bottom_left:0,
                    bottom_right:0
                },
                alignment:'left'
            }

            this.showPreviewSlider=false
        },

        hapusSlider: function(index) {
            this.state.slider.splice(index, 1);
        },

        store(e,) {
            this.loading=true;
            this.state.desc = CKEDITOR.instances.desc.getData();

            axios.post(e.target.action, this.state).then(response => {
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
                        tags:[],
                        images:[],
                        height:770,
                        width:384,
                        border_radius:{
                            top_left:0,
                            top_right:0,
                            bottom_left:0,
                            bottom_right:0
                        },
                        alignment:'left'
                    },
                    this.showPreview=false
                    this.message = 'Data has been saved.';
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

        uploadImageSuccess(formData, index, fileList) {
            console.log('data', formData, index, fileList)
            this.state.images.push(fileList[index]);
            // Upload image api
            // axios.post('data/page', { data: formData }).then(response => {
            //   console.log(response)
            // })
        },
        beforeRemove (index, done, fileList) {
            console.log('index', index, fileList)
            var r = confirm("remove image")
            if (r == true) {
                done()
            } else {

            }
        },
        editImage (formData, index, fileList) {
            console.log('edit data', formData, index, fileList)
        },
        dataChange (data) {
            console.log(data)
        }
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

    #my-strictly-unique-vue-upload-multiple-image {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        margin-top: 60px;
    }

    h1, h2 {
        font-weight: normal;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        display: inline-block;
        margin: 0 10px;
    }

    a {
        color: #42b983;
    }
</style>


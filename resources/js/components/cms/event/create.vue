<template>
    <form @submit.prevent="store" action="data/event" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-flat">
                    <div class="card-header">Create Event</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input class="form-control" name="title" id="title" placeholder="Title" v-model="state.title">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Teaser</label>
                            <textarea name="teaser" id="teaser" cols="30" rows="3" class="form-control" v-model="state.teaser"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="" class="control-label">Tanggal</label>
                                    <!-- <datepicker :value="state.tanggal" :format="tanggalFormatter" v-model="state.tanggal"></datepicker> -->
                                    <VueHotelDatepicker @update="updateRangePicker"></VueHotelDatepicker>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="" class="control-label">Jam Mulai</label>
                                    <div class="input-group">
                                        <input type="time" v-model="state.jam_mulai" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="" class="control-label">Jam Selesai</label>
                                    <div class="input-group">
                                        <input type="time" v-model="state.jam_selesai" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Lokasi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" v-model="state.lokasi">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-map-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="" class="control-label">Lat</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" v-model="state.lat">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-map-marker"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="" class="control-label">Lng</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" v-model="state.lng">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-map-marker"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Full Text</label>
                            <!-- <trumbowyg v-model="state.desc" class="form-control" :config="configText" name="content"></trumbowyg> -->
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

                <div class="card card-primary">
                    <div class="card-header">
                        <h6 class="card-title">Comment</h6>
                    </div>
                    <div class="card-body">
                        <select name="comment" id="comment" class="form-control" v-model="state.comment">
                            <option value="open">Open</option>
                            <option value="close">Close</option>
                        </select>
                    </div>  
                </div>

                <div class="card card-flat">
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
                                <input type="file" id="file" ref="file" accept="image/*" v-on:change="onFileChange" class="form-control"/>
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

                        <router-link to="/event" class="btn btn-default">
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

import VueHotelDatepicker from '@northwalker/vue-hotel-datepicker'

export default {
    components: {
        VueLoading,
        VoerroTagsInput,
        Multiselect,
        Datepicker,
        Timeselector,
        Trumbowyg,
        VueHotelDatepicker
    },
    data(){
        return {
            state:{
                title:'',
                topik:'',
                teaser:'',
                desc:'',
                tanggal: '',
                tanggal_selesai:'',
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
            selectedTags : '',
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
            // selectedTags: { 
            //     1: 'Web Development',
            //     2: 'PHP',
            //     3: 'JavaScript',
            // },
        }
    },
    mounted() {
        // this.getCategory();
        // this.getTag();
        this.getCKeditor()
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
        updateRangePicker(event){
            this.state.tanggal=event.start;
            this.state.tanggal_selesai=event.end;
        },
        tanggalFormatter(date) {
            return moment(date).format('YYYY-MM-DD');
        },
        jamFormatter(date) {
            return moment(date).format('h:mm:ss a');
        },
        getCategory(){
            axios.get('data/list-category')
                .then(response => {
                    this.categories = response.data;
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
            let file = this.$refs.file.files[0];
            if(!file || file.type.indexOf('image/') !== 0) return;
            
            let reader = new FileReader();
            
            reader.readAsDataURL(file);
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

        store(e) {
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
                        type:'Featured',
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

    .vdp-datepicker input{
        display: block;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .vdp-datepicker input::-ms-expand {
        background-color: transparent;
        border: 0;
    }

    .vtimeselector input{
        display: block;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }    

    .vhd-input{
        height: 33px;
    }

</style>


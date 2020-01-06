<template>
    <form @submit.prevent="store" action="data/testimoni" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-flat">
                    <div class="card-header">Create Testimoni</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input class="form-control" name="title" id="title" placeholder="Title" v-model="state.title">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <trumbowyg v-model="state.desc" class="form-control" :config="configText" name="content"></trumbowyg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">

                <div class="card card-flat">
                    <div class="card-header">
                        <h6 class="card-title">Foto</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label">Choose File</label><br>
                                <img v-bind:src="state.file" v-show="showPreview" class="img-fluid"/>
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

                
            </div>

            <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
            <div class="col-lg-12" v-if="message" v-bind:class="pesankelas">
                {{ message }}
            </div>

            <div class="col-lg-12">
                <div class="card card-flat">
                    <div class="card-body">
                        <div id="pesan"></div>

                        <router-link to="/testimoni" class="btn btn-default">
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

    </form>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { VueLoading } from 'vue-loading-template'
import Multiselect from 'vue-multiselect'
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
        Trumbowyg
    },
    data(){
        return {
            state:{
                title:'',
                topik:'',
                teaser:'',
                desc:'',
                file:''
            },
            pencarian:'',
            pesankelas:'',
            message:'',
            loading:false,
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            },
            showPreview: false,
            imagePreview: '',
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
    methods:{
        
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
                        title:'',
                        topik:'',
                        teaser:'',
                        desc:'',
                        file:'',
                    },
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
</style>


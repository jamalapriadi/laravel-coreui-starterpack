<template>
    <div>
        <div v-show="tampilFormSosmed == true">
            <form @submit.prevent="storeSosmed" action="data/sosmed" method="post" enctype="multipart/form-data">
                <vue-loading v-if="loading2" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                <div v-if="messagefasilitas" v-bind:class="pesankelasfasilitas">
                    {{ messagefasilitas }}
                </div>

                <div v-for="(l,index) in sosmed" :key="index" class="form-group">
                    <label for="" class="control-label">{{l.name}}</label>
                    <input type="text" class="form-control" placeholder="URL" v-model="stateSosmed.sosmed[l.id]">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">
                        <i class="fa fa-save"></i> Save
                    </button>
                    <a href="#" class="btn btn-default" @click.prevent="batalNewSosmed">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <div v-show="tampilFormSosmed == false">
            <a href="#" class="btn btn-warning text-white" @click.prevent="addNewSosmed">
                <i class="fa fa-pencil"></i> Update Social Media
            </a>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Name</th>
                            <th>URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(l,index) in instansiSosmed" :key="index">
                            <td>{{index+1}}</td>
                            <td>{{l.name}}</td>
                            <td>{{l.pivot.social_media_url}}</td>
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
            tampilFormSosmed:false,
            sosmed:[],
            instansiSosmed:[],
            stateSosmed:{
                sosmed:{}
            },
            messagefasilitas:'',
            messagefasilitas:'',
            loading2:false,
        }
    },
    mounted() {
        this.getSosmed();
        this.getInstansiSosmed();
    },
    methods:{
        getSosmed(){
            axios.get('data/list-sosmed')
                .then(response => {
                    this.sosmed = response.data
                })
        },

        getInstansiSosmed(){
            axios.get('data/list-instansi-sosmed')
                .then(response => {
                    this.instansiSosmed= response.data.sosmed;

                    for(var a=0; a< response.data.sosmed.length; a++){
                        this.stateSosmed.sosmed[response.data.sosmed[a].id] = response.data.sosmed[a].pivot.social_media_url;
                    }
                })
        },

        addNewSosmed(){
            this.tampilFormSosmed = true
        },

        batalNewSosmed(){
            this.tampilFormSosmed = false
        },

        storeSosmed(e){
            this.loading2=true;
            axios.post(e.target.action, this.stateSosmed).then(response => {
                this.loading2=false;
                if(response.data.success==true){
                    this.errors = [];
                    this.messagefasilitas = 'Data berhasil disimpan.';
                    this.pesankelasfasilitas='alert alert-success';

                    // this.showKontak();
                    // this.kosongKontak();
                    this.tampilFormSosmed = false
                    this.getInstansiSosmed();
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
    }
}
</script>
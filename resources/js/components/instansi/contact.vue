<template>
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-default">
                <div class="card-header">Add New Kontak</div>
                <div class="card-body">
                    <vue-loading v-if="loading2" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                    <div v-if="messagefasilitas" v-bind:class="pesankelasfasilitas">
                        {{ messagefasilitas }}
                    </div>

                    <form @submit.prevent="storeKontak" action="data/kontak" method="post">
                        <div class="form-group">
                            <label for="" class="control-label">Parameter Name</label>
                            <input type="text" class="form-control" v-model="kontak.name">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Parameter Value</label>
                            <input type="text" class="form-control" v-model="kontak.value">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Icon</label>
                            <select name="icon" id="icon" class="form-control" v-model="kontak.icon">
                                <option value="">--No Icon--</option>
                                <option value="telp">Telp</option>
                                <option value="email">Email</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Show Name</label>
                            <select name="showname" id="showname" class="form-control" v-model="kontak.show_name">
                                <option value="Y">Y</option>
                                <option value="N">N</option>
                            </select>
                        </div>

                        <hr>
                        <div class="form-group">
                            <button class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                Tambah
                            </button>   

                            <a href="#" @click="kosongKontak()" class="btn btn-default">
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
                            <th>Parameter Name</th>
                            <th>Parameter Value</th>
                            <th>Show Name</th>
                            <th>Icon</th>
                            <th width="17%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(l, index) in kontaks.data" v-bind:key="index">
                            <td>{{index+1}}</td>
                            <td>{{l.parameter_name}}</td>
                            <td>{{l.parameter_value}}</td>
                            <td>{{l.show_name}}</td>
                            <td>{{l.icon}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-warning" @click="updateKontak(l.id)">
                                        <i class="fa fa-edit text-white"></i>
                                    </a>

                                    <a class="btn btn-danger" v-on:click="hapusKontak(l.id)" v-bind:id="'delete'+l.id">
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
            kontaks:[],
            kontak:{
                kode:'',
                name:'',
                value:'',
                show_name:'Y',
                icon:''
            },
            messagefasilitas:'',
            messagefasilitas:'',
            loading2:false,
        }
    },
    mounted() {
        this.showKontak();
    },
    methods:{
        showKontak(){
            axios.get('data/kontak')
                .then(response => {
                    this.kontaks = response.data
                })
        },

        storeKontak(e){
            this.loading2=true;
            axios.post(e.target.action, this.kontak).then(response => {
                this.loading2=false;
                if(response.data.success==true){
                    this.errors = [];
                    this.messagefasilitas = 'Data berhasil disimpan.';
                    this.pesankelasfasilitas='alert alert-success';

                    this.showKontak();
                    this.kosongKontak();
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
            this.kontak={
                kode:'',
                name:'',
                value:'',
                show_name:'Y',
                icon:''
            }
        },

        updateKontak(id){
            this.kontak.kode=id;
            this.messagefasilitas='';

            axios.get('data/kontak/'+id)
                .then(response => {
                    this.kontak.kode = response.data.id;
                    this.kontak.name = response.data.parameter_name;
                    this.kontak.value= response.data.parameter_value;
                    this.kontak.show_name = response.data.show_name;
                    this.kontak.icon = response.data.icon;
                })
                .catch( error => {
                    alert('data tidak dapat di load');
                })
        },

        hapusKontak(id){
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
                    axios.delete('data/kontak/'+id)
                        .then(response => {
                            if(response.data.success==true){
                                this.message="";
                                this.$swal('Deleted', response.data.pesan , 'success');
                                this.showKontak();
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
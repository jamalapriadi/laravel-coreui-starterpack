<template>
    <div class="card card-default">
        <div class="card-header">
            Newsletter
            
            <div class="card-header-actions">
                <router-link to="/newsletter/create" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add New
                </router-link>
            </div>
        </div>
        <div class="card-body">
            <code>Newsletter</code> digunakan untuk maintenance konten yang ada dimenu <a href="https://kidsrepublic.sch.id/newsletter" target="_blank">Newsletter</a> frontend.<br>
            file <code>images</code> untuk tampilan preview dibawah ini otomatis akan disetting ke 150x100 pixel.<br>
            file <code>images</code> dimenu <a href="https://kidsrepublic.sch.id/newsletter" target="_blank">Newsletter</a> frontend akan otomatis disetting ke 770x348 pixel.<br>
            file <code>images</code> maksimal 1 Mb.<br>
            file <code>attachment</code> maksimal 2 Mb.<br>
            <hr>

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

                <div class="col-lg-7">
                    <div class="form-group float-right">
                        <select name="page" id="page" class="form-control" v-model="halaman" @change="ubahHalaman">
                            <option v-for="(l,index) in pages" :key="index" :value="l">{{l}}</option>    
                        </select>     
                    </div>
                </div>
            </div>

            <br>
            
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Images</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Attachment</th>
                            <th width="17%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(l, index) in list.data" v-bind:key="index">
                            <td>{{index+1}}</td>
                            <td>
                                <img :src="l.feature_image_url" alt="" class="img-fluid" style="width:150px; height:100px;">
                            </td>
                            <td>{{l.title}}</td>
                            <td>
                                <div v-html="l.description"></div>
                            </td>
                            <td>
                                <label v-for="(k,idx) in l.files" :key="idx" class="label-info">
                                    <a :href="'uploads/newsletter/'+k.file" target="_blank">
                                        Attachment
                                    </a>
                                </label>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <router-link :to="{ name: 'newsletterEdit', params: {id: l.id}}" class="btn btn-warning">
                                        <i class="fa fa-edit text-white"></i>
                                    </router-link>

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
</template>

<script>
import { VueLoading } from 'vue-loading-template'

export default {
    components: {
        VueLoading
    },
    data(){
        return {
            state:{
                kode:'',
                name:'',
                desc:'',
                parent:''
            },
            list:[],
            listData:{},
            pencarian:'',
            pesankelas:'',
            message:'',
            loading:true,
            halaman:10,
            pages:[5,10,15,20,25,50,100]
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
        paginate(url){
            axios.get(url)
                .then(response => {
                    this.list = response.data;
                })
        },

        ubahHalaman(){
            this.showData()
        },

        showData(page){
            if(typeof page === 'undefined'){
                page = 1;
            }

            axios.get('data/newsletter?page='+page+'&type=promo&halaman='+this.halaman)
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

            axios.get('data/newsletter?q='+this.pencarian+'&type=promo&halaman='+this.halaman)
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
    }
}
</script>


<template>
    <div class="card card-default">
        <div class="card-header">
            All Headline
            
            <div class="card-header-actions">
                <router-link to="/headline/create" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add New
                </router-link>
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
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th>Title</th>
                        <th>Topik</th>
                        <th>Teaser</th>
                        <th width="17%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(l, index) in list.data" v-bind:key="index">
                        <td>{{index+1}}</td>
                        <td>{{l.post.title}}</td>
                        <td>{{l.post.topik}}</td>
                        <td>{{l.post.teaser}}</td>
                        <td>
                            <div class="btn-group">
                                <router-link :to="{ name: 'headlineEdit', params: {id: l.post.id}}" class="btn btn-warning">
                                    <i class="fa fa-edit text-white"></i>
                                </router-link>

                                <a class="btn btn-danger" v-on:click="hapus(l.post.id, index)" v-bind:id="'delete'+l.id">
                                    <i class="fa fa-trash text-white"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

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
                    this.list = response.data.head;
                })
        },

        showData(page){
            if(typeof page === 'undefined'){
                page = 1;
            }

            axios.get('data/headline?type=Featured&page='+page)
                .then(response => {
                    this.loading=false;
                    this.list = response.data.head;
                    this.listData = response.data.head;
                })
        },
        cariData(page){
            if(typeof page === 'undefined'){
                page = 1;
            }

            axios.get('/data/headline?type=Featured&q='+this.pencarian)
                .then(response => {
                    this.list = response.data.head;
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
                    axios.delete('/data/headline/'+id)
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


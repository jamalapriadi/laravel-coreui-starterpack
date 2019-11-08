<template>
    <div class="card card-accent-primary">
        <div class="card-header">
            Data User

            <div class="card-header-actions">
                <router-link to="/users/create" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add New
                </router-link>
            </div>
        </div>

        <div class="card-body">
            
            <div class="row">
                <div class="col-lg-5">
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="" class="control-label col-lg-2">FILTER:</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="q" id="q" placeholder="Type and Enter" v-model="pencarian">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <br>
            
            <table class="table table-striped">
                <thead class="bg-light">
                    <tr>
                        <th width="5%">No.</th>
                        <th width="15%">
                            <!-- <i class="icon-people"></i> -->
                        </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status Login</th>
                        <th>Role</th>
                        <th>Active</th>
                        <th width="8%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(l, index) in list.data" v-bind:key="index">
                        <td>{{index+1}}</td>
                        <td>
                            <img :src="l.image_url" alt="" class="img-avatar" style="height:50px;width:50px;">
                        </td>
                        <td>{{l.name}}</td>
                        <td>{{l.email}}</td>
                        <td>
                            {{l.status_login}}
                        </td>
                        <td>
                            <span v-for="(k,idx) in l.roles" :key="idx" class="label label-info">{{k.name}}</span>
                        </td>
                        <td>
                            <!-- {{l.active}} -->
                            <span v-show="l.active == 'Y'">
                                <toggle-button :value="true"
                                    :sync="true"
                                    name="phone"
                                    :labels="{checked: 'Ya', unchecked: 'No'}"
                                    :color="{checked: '#7DCE94', unchecked: '#82C7EB'}"
                                    @change="nonAktifUser(l.id)"/>
                            </span>

                            <span v-show="l.active == 'N'">
                                <toggle-button :value="false"
                                    name="phone"
                                    :sync="false"
                                    :labels="{checked: 'Ya', unchecked: 'No'}"
                                    :color="{checked: '#7DCE94', unchecked: '#82C7EB'}"
                                    @change="aktifUser(l.id)"/>
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <router-link :to="{ name: 'hasAksesUser', params: {id: l.id}}" class="btn btn-sm btn-success text-white" title="Ubah Role">
                                    <i class="icon-support text-white"></i>
                                </router-link>

                                <!-- <a class="btn btn-danger" v-on:click="hapus(l.id, index, l.nm)" v-bind:id="'delete'+l.id">
                                    <i class="fa fa-trash text-white"></i>
                                </a> -->
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
                list:[],
                listData:{},
                pencarian:'',
                loading:true
            }
        },
        mounted() {
            this.showData();

            console.log(this.list);
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
            nonAktifUser(id){
                this.$swal({
                    title: 'Non Aktif User?',
                    text: 'Apakah anda yakin ingin menonaktifkan user ini!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Lanjutkan!',
                    cancelButtonText: 'Tidak',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                })
                .then((result) => {
                    if(result.value) {
                        axios.get('/data/status-user/'+id+'?status=N')
                            .then(response => {
                                if(response.data.success==true){
                                    this.$swal('Non Aktif', 'Non Aktif user berhasil' , 'success');
                                }else{
                                    this.$swal('Non Aktif', 'Non aktif user gagal' , 'error');
                                }

                                this.list=[]
                                this.showData();
                            })
                    } else {
                        this.$swal('Cancelled', 'User tidak di non aktifkan', 'info')
                        this.list=[]
                        this.showData();
                    }
                })
            },

            aktifUser(id){
                this.$swal({
                    title: 'Aktif User?',
                    text: 'Apakah anda yakin ingin mengaktifkan user ini!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Lanjutkan!',
                    cancelButtonText: 'Tidak',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                })
                .then((result) => {
                    if(result.value) {
                        axios.get('/data/status-user/'+id+'?status=Y')
                            .then(response => {
                                if(response.data.success==true){
                                    this.$swal('Aktif', 'Aktif user berhasil' , 'success');
                                }else{
                                    this.$swal('Aktif', 'aktif user gagal' , 'error');
                                }

                                this.list=[]
                                this.showData();
                            })
                    } else {
                        this.$swal('Cancelled', 'User tidak di aktifkan', 'info')

                        this.list=[]
                        this.showData();
                    }
                })
            },

            paginate(url){
                axios.get(url)
                    .then(response => {
                        this.list = response.data;
                    })
            },

            showData(page){
                if(typeof page === 'undefined'){
                    page = 1;
                }

                axios.get('data/users?page='+page)
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

                axios.get('/data/users?q='+this.pencarian)
                    .then(response => {
                        this.list = response.data;
                    })
                    .catch( errors => {
                        alert('pencarian tidak ditemukan');
                    })
            },

            hapus(id,index,name){
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
                        axios.delete('/data/users/'+id)
                            .then(response => {
                                if(response.data.success==true){
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

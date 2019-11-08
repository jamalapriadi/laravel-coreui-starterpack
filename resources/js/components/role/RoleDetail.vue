<template>
    <div class="card card-accent-primary">
        <div class="card-header">
            Setting Role - {{state.name}}
        </div>
        <div class="card-body">

            <div v-if="message" v-bind:class="pesankelas">
                {{ message }}
            </div>

            <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>   

            <table class="table table-striped">
                <thead class="bg-light">
                    <tr>
                        <th width='5%'>#</th>
                        <th>Permission</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(l,index) in permission" :key="index">
                        <td>
                            <div class="form-check checkbox">
                                <input class="form-check-input" id="check1" type="checkbox" :checked="cek[index]" :v-model="state.role[index]" v-bind:value="l" @click="pilihrole(l,$event)">
                            </div>
                        </td>
                        <td>
                            {{l.name}}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">
                            <button class="btn btn-primary" @click="simpanPermission">
                                Save Permission
                            </button>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script>
import { VueLoading } from 'vue-loading-template'
export default {
    components: {
        VueLoading
    },
    data() {
        return {
            bankId:'',
            state: {
                name:'',
                role:[],
            },
            message:'',
            loading:false,
            pesankelas:'',
            permission:[],
            errors: [],
            perm:[],
            cek:[]
        }
    },
    mounted() {
        this.getData();
        this.getPermission();
    },
    methods: {
        getData(){
            let app=this;
            let id= app.$route.params.id;
            this.bankId = id;

            axios.get('/data/roles/'+id)
                .then(response => {
                    this.state.name = response.data.name;
                    this.perm = response.data.permissions
                })
                .catch( error => {
                    alert('data tidak dapat di load');
                })
        },

        getPermission(){
            axios.get('/data/list-permission')
                .then(response => {
                    this.permission = response.data

                    for(var a=0; a<this.permission.length;a++){
                        for(var b=0; b<this.perm.length; b++){
                            if(this.perm[b].id == this.permission[a].id){
                                this.cek[a]=true
                                this.state.role[a]=this.perm[b]
                            }
                        }
                    }
                })
        },

        simpanPermission(){
            this.loading = true
            axios.post('/data/save-permission-role/'+this.bankId,this.state)
                .then(response => {
                    this.loading = false
                    if(response.data.success==true){
						this.pesankelas='alert alert-success';
						this.message = 'Data berhasil disimpan';
					}else{
						this.pesankelas='alert alert-danger';
						this.message = response.data.pesan+","+response.data.error+"";
					}
                })
        },

        pilihrole(l, event){
            if (event.target.checked) {
                this.state.role.push(l);
            }else{
                this.state.role.splice(l, 1);
            }
        },
    },
    computed:{
        // valKode() {
        //     if (this.post.kode.length === 0 || this.post.kode.length > 50) {
        //         return true;
        //     } 
        //     return false;
        // },
        valname() {
            if (this.post.name.length === 0 || this.post.name.length > 50) {
                return true;
            } 
            return false;
        },
        valStatus() {
            if (this.post.harga.length === 0 || this.post.harga.length > 50) {
                return true;
            } 
            return false;
        }
    }
}
</script>
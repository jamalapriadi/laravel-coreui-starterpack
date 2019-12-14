<template>
    <div class="card card-accent-primary">
        <div class="card-header">
            Tambah Data Role
        </div>
        <div class="card-body">

            <div v-if="message" v-bind:class="pesankelas">
                {{ message }}
            </div>

            <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    

            <form v-on:submit.prevent="saveForm()">
                <div class="form-group">
                    <label for="" class="control-label">Name</label>
                    <input type="text" class="form-control" :class="{ 'is-invalid': errors.name }" v-model="state.name">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Simpan
                    </button>

                    <router-link to="/role" class="btn btn-warning text-white">
                        <i class="fa fa-backward"></i> Batal
                    </router-link>                    
                </div>
            </form>
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
            },
            message:'',
            loading:false,
            pesankelas:'',
            errors: [],
        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData(){
            let app=this;
            let id= app.$route.params.id;
            this.bankId = id;

            axios.get('data/roles/'+id)
                .then(response => {
                    this.state.name = response.data.name;
                })
                .catch( error => {
                    alert('data tidak dapat di load');
                })
        },

        saveForm(){
            var newState = this.state;
            this.loading=true;

            axios.patch('data/roles/'+this.bankId, newState)
                .then(response => {
                    if(response.data.success==true){
                        this.pesankelas='alert alert-success';
                        this.message="Data berhasil diupdate";
                    }else{
                        this.pesankelas='alert alert-danger';
                        this.message="Data gagal diupdate";
                    }

                    this.loading=false;
                })
                .catch( error => {
                    alert('data gagal diupdate');
                })
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
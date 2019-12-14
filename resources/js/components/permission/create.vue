<template>
    <div class="card card-accent-primary">
        <div class="card-header">
            Tambah Data Permission
        </div>
        <div class="card-body">

            <div v-if="message" v-bind:class="pesankelas">
                {{ message }}
            </div>

            <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    

            <form @submit.prevent="store" action="data/permissions" method="post">
                <div class="form-group">
                    <label for="" class="control-label">Name</label>
                    <input type="text" class="form-control" :class="{ 'is-invalid': errors.name }" v-model="state.name">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Simpan
                    </button>

                    <router-link to="/permission" class="btn btn-warning text-white">
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
            state: {
                name:'',
            },
            message:'',
            loading:false,
            pesankelas:'',
            errors: [],
        }
    },
    methods: {
        store(e) {
            this.loading = true;

            axios.post(e.target.action, this.state).then(response => {
                if(response.data.success==true){
                    this.errors = [];
                    this.state = {
                        name:''
                    }
                    this.pesankelas='alert alert-success';
                    this.message = 'Data berhasil disimpan';
                }else{
                    this.pesankelas='alert alert-danger';
                    this.message = response.data.errors;
                    this.errors.name=true;
                }

                this.loading = false;
            }).catch(error => {
                if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                        this.errors = error.response.data;
                        console.log(this.errors);
                    }
                }
            });
        }
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
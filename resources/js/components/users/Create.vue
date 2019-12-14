<template>
    <div class="container">
        <div class="card card-accent-primary">
            <div class="card-header">
                Add New User
            </div>
            <div class="card-body">

                <div class="col-lg-12" v-if="message" v-bind:class="pesankelas">
                    {{ message }}
                </div>

                <form @submit.prevent="store" action="data/users" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="control-label">Email</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.email }" v-model="state.email">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Name</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.name }" v-model="state.name">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Password</label>
                        <input type="password" class="form-control" :class="{ 'is-invalid': errors.password }" v-model="state.password">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Confirm Password</label>
                        <input type="password" class="form-control" :class="{ 'is-invalid': errors.password_confirm }" v-model="state.password_confirm">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Role</label>
                        <select name="role" id="role" v-model="state.role" class="form-control">
                            <option v-for="(l,index) in role" :key="index" :value="l.id">{{l.name}}</option>
                        </select>
                    </div>
                    <label class="control-label">Avatar</label><br>
                        <img v-bind:src="state.file" v-show="showPreview" class="img-fluid"/>
                    <br><br>
                    <div class="input-group">
                        <input type="file" id="file" ref="file" accept="image/*" v-on:change="onFileChange" class="form-control"/>
                        <span class="input-group-addon" id="removeFeaturedImage">
                            <i class=" icon-cross3"></i>
                        </span>
                    </div>
                    <hr>
                    
                    <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    

                    <div class="form-group">
                        <router-link to="/users" class="btn btn-default">
                            <i class="fa fa-backward"></i> Back
                        </router-link>

                        <button class="btn btn-primary">
                            <i class="fa fa-save"></i>
                            Save
                        </button>
                    </div>
                </form>
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
    data() {
        return {
            state: {
                name: '',
                password:'',
                password_confirm:'',
                email:'',
                file:'',
                role:''
            },
            pesankelas:'',
            message:'',
            loading:false,
            errors: [],
            perusahaan:[],
            showPreview: false,
            imagePreview: '',
            role:[]
        }
    },
    methods: {
        getRole(){
            axios.get('data/list-role')
                .then(response => {
                    this.role = response.data
                })
        },

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
            this.loading = true;

            axios.post(e.target.action, this.state).then(response => {
                if(response.data.success==true){
                    this.loading=false;
                    this.errors = [];
                    this.state = {
                        name: '',
                        password:'',
                        password_confirm:'',
                        email:'',
                        role:''
                    }
                    this.message = 'Data has been saved.';
                    this.pesankelas='alert alert-success';
                }else{
                    this.pesankelas='alert alert-danger';
                    this.message = response.data.errors;
                    this.loading=false;
                    this.errors.nama=true;
                }
            }).catch(error => {
                if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                        this.loading=false;
                        this.errors = error.response.data;
                        console.log(this.errors);
                    }
                }
            });
        }
    },
    mounted() {
        this.getRole()
    },
    computed:{
        valKode() {
            if (this.post.kode.length === 0 || this.post.kode.length > 50) {
                return true;
            } 
            return false;
        },
        valNama() {
            if (this.post.nama.length === 0 || this.post.nama.length > 50) {
                return true;
            } 
            return false;
        },
        valStatus() {
            if (this.post.status.length === 0 || this.post.status.length > 50) {
                return true;
            } 
            return false;
        }
    }
}
</script>
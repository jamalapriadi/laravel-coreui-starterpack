<template>
    <div class="card card-default">
        <div class="card-header">Ubah Role</div>
        <div class="card-body">
            <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
            <div class="col-lg-12" v-if="message" v-bind:class="pesankelas">
                {{ message }}
            </div>

            <div class="form-group">
                <label for="" class="control-label">Role</label>
                <select name="role" id="role" class="form-control" v-model="state.role">
                    <option v-for="(l,index) in role" :key="index" :value="l.id">{{l.name}}</option>
                </select>
            </div>
            <hr>
            <div class="form-group">
                <router-link to="/users" class="btn btn-default">
                    <i class="fa fa-backward"></i> Back
                </router-link>
                <button class="btn btn-primary" @click="updateRole">
                    <i class="fa fa-save"></i> Save
                </button>
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
            userId:'',
            role:[],
            user:{},
            state:{
                id:'',
                role:''
            },
            pesankelas:'',
            message:'',
            loading:false,
        }
    },
    mounted(){
        this.getRole()
    },
    methods:{
        getRole(){
            let app=this;
            let id= app.$route.params.id;
            this.state.id=id
            this.userId = id;

            axios.get('data/list-role-with-permission/'+id)
                .then(response => {
                    this.user = response.data.user
                    this.role = response.data.role

                    if(response.data.user.roles.length > 0){
                        this.state.role = response.data.user.roles[0].id
                    }
                })
        },

        updateRole(){
            this.loading = true
            axios.post('data/update-role-user/'+this.userId,this.state)
                .then(response => {
                    this.loading = false
                    if(response.data.success == true){
                        this.getRole()
                        this.message = 'Data has been saved.';
                        this.pesankelas='alert alert-success';
                    }else{
                        this.pesankelas='alert alert-danger';
                        this.message = response.data.errors;
                    }
                })
        }
    }
}
</script>
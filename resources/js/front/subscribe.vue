<template>
    <div>
        <section class="page-title center">
            <div class="container">
                <h2>SUBSCRIBE</h2>
            </div>
        </section>

        <section class="about">
            <div class="container">
                <div class="row">
                    <div class="single-column col-md-12 col-sm-12">
                        <div class="section-title">
                        </div>
                    </div>    
                </div>
            </div>           
        </section>

        <section class="contact-us">
            <div class="container">
                <div class="section-title center">
                        <h2>Subscribe <span>Newsletter</span></h2>
                    </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 col-sm-12">
                        <div class="contact-box">

                            <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                            <div class="col-lg-12" v-if="message" v-bind:class="pesankelas">
                                {{ message }}
                            </div>
        
                            <form @submit.prevent="store" action="/proses/subscribe" method="post" enctype="multipart/form-data">
                                    
                                <div class="row clearfix">
                                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <input type="text" name="first_name" v-model="state.first_name" placeholder="First Name*" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <input type="text" name="last_name" v-model="state.last_name" placeholder="Last Name*" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <input type="email" name="email" v-model="state.email" placeholder="Email*" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                        <input type="text" name="phone" v-model="state.phone" placeholder="Phone No" required>
                                    </div>
                                    <div class="form-group col-lg-12 center">
                                        <button type="submit" name="submit" class="btn-style-one center">Submit now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import { VueLoading } from 'vue-loading-template'

export default {
    components: {
        VueLoading
    },
    data(){
        return{
            state:{
                first_name:'',
                last_name:'',
                email:'',
                phone:''
            },
            pesankelas:'',
            message:'',
            loading:false,
        }
    },
    methods:{
        store(e) {
            this.loading=true;

            axios.post(e.target.action, this.state).then(response => {
                this.loading=false;
                if(response.data.success==true){
                    this.errors = [];
                    this.state={
                        first_name:'',
                        last_name:'',
                        email:'',
                        phone:''
                    },
                    this.message = response.data.message;
                    this.pesankelas='alert alert-success';
                }else{
                    this.pesankelas='alert alert-danger';
                    this.message = response.data.message;
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
<template>
    <div>
        <section class="contact-us" style="background-color: rgb(189, 230, 251);">
            <div class="upper">
                <div class="container">
                    <div class="row">
                    
                        <div class="single-column col-md-6">
                            <div class="section-title">
                                <h2>Find<span> Us</span> </h2>
                            </div>

                            <div class="map-responsive">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15864.780692068041!2d106.889507!3d-6.237987!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc2aff6aaa55a9a49!2sKids%20Republic!5e0!3m2!1sid!2sid!4v1566739844103!5m2!1sid!2sid" width="800" height="600" frameborder="0" style="border:0; border-radius: 30px; box-shadow: 10px 10px 5px grey;" allowfullscreen=""></iframe>
                            </div>
                        </div>

                        <div class="single-column col-md-6">
                            <div class="section-title">
                                <h2>Get In<span> Touch</span> </h2>
                            </div>    
                            <div class="contact-box">
                                <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    
                                <div class="col-lg-12" v-if="message" v-bind:class="pesankelas">
                                    {{ message }}
                                </div>

                                <form @submit.prevent="store" action="./proses/kontak" method="post" enctype="multipart/form-data">
                            
                                    <div class="row clearfix">
                                        <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                            <input type="text" style="border-radius: 10px" name="first_name" maxlength="28" v-model="state.first_name" placeholder="First Name*" required>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                            <input type="text" style="border-radius: 10px" name="last_name" maxlength="28" v-model="state.last_name" placeholder="Last Name*" required>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                            <input type="email" style="border-radius: 10px" name="email" maxlength="50" v-model="state.email" placeholder="Email*" required>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                            <input type="text" style="border-radius: 10px" name="phone" maxlength="30" v-model="state.phone" placeholder="Phone No" required>
                                        </div>
                                        <div class="form-group col-lg-12 col-sm-12 col-xs-12">
                                            <textarea name="message" style="border-radius: 10px; height: 285px" maxlength="300" v-model="state.message" placeholder="Message" required></textarea>
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
            </div>
        </section>

        <section class="contact-us">
            <div class="upper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12 column">
                            <div class="item center">
                                <div class="icon">
                                    <span class="icon-location"></span>
                                </div>
                                <div class="content">
                                    <h4><a href="#">Main Campus</a></h4>
                                    <p>Jl. Cipinang Bali 1 no. 5A Kec. Jatinegara,<br />Jakarta Timur 13420</p>
                                </div>
                            </div>

                            <div class="item center">
                                <div class="icon">
                                    <span class="icon-technology-2"></span>
                                </div>
                                <div class="content">
                                    <h4><a href="#">Phone</a></h4>
                                    <p>(021) 2982 7245</p>
                                    <p>0821 200 77600</p>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12 column">

                            <div class="item center">
                                <div class="icon">
                                    <span class="icon-location"></span>
                                </div>
                                <div class="content">
                                    <h4><a href="#">Center Bekasi</a></h4>
                                    <p>Kids Republic Jl. Pulo Sirih Barat, Ruko Arcadia Blok Bd 111,112,115 Grand Galaxy City, Bekasi</p>
                                </div>
                            </div>

                            <div class="item center">
                                <div class="icon">
                                    <span class="icon-technology-2"></span>
                                </div>
                                <div class="content">
                                    <h4><a href="#">Phone</a></h4>
                                    <p>0813 888 33343</p>   
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12 column">
                            <div class="item center">
                                <div class="icon">
                                    <span class="icon-interface"></span>
                                </div>
                                <div class="content">
                                    <h4><a href="#">Email</a></h4>
                                    <p>info@kidsrepublic.sch.id</p>
                                </div>
                            </div>
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
        return {
            state:{
                first_name:'',
                last_name:'',
                email:'',
                phone:'',
                message:''
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
                        phone:'',
                        message:''
                    },
                    this.message = 'Data has been saved.';
                    this.pesankelas='alert alert-success';
                }else{
                    this.pesankelas='alert alert-danger';
                    this.message = response.data.errors;
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
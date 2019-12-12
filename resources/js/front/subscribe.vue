<template>
    <div>
        <section class="page-title center">
            <div class="container">
                <h2>SUBSCRIBE</h2>
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
        
                            <form method="post" action="#" class="contact-formnew" novalidate="novalidate">
                                    
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
                                        <button @click="save()" name="submit" class="btn-style-one center">Submit now</button>
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
export default {
    data(){
        return{
            state:{
                first_name:'',
                last_name:'',
                email:'',
                phone:''
            }
        }
    },
    methods:{
        save(){
            
        }
    }
}
</script>
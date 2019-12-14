<template>
    <section class="about" id="founder">
        <div class="container">
            <div class="section-title">
                <h2>Founders <span>Profile</span> </h2>
            </div>
            <div class="row text">
                <div v-for="(l,index) in founder" :key="index">
                    <div class="teacher-profile-tab col-md-8" style="text-align: justify;">  
                        <div class="heading-block">
                            <h3>{{l.name}}</h3>
                        </div>
                        <br>
                        <div v-html="l.description"></div>
                    </div>
                    <div class="teacher-profile-tab col-md-4"> 
                        <a href="#10" aria-controls="10" role="tab" data-toggle="tab">
                            <img :src="l.image_url" alt="images">
                        </a>
                        <hr>
                    </div> 
                </div>
            </div>
        </div>
    </section>
</template>

<script>

export default {
    data(){
        return {
            founder:[]
        }
    },
    mounted(){
        this.getFounder()
    },
    methods:{
        getFounder(){
            axios.get('list/founder')
                .then(response => {
                    this.founder = response.data
                })
        }
    }
}
</script>
<template>
    <section class="two-column style-3" id="testimony">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 testimonial">
                    <div class="section-title">
                        <h2>Parent<span>&nbsp;Testimonial</span></h2>
                    </div>

                    <carousel :perPage="1" :autoplay="true" :loop="true">        
                        <slide v-for="(l,index) in promo" :key="index">
                            <div class="item center" style="background-color: rgba(250, 250, 250, 0.5)">
                                <img :src="l.feature_image_url" alt="images">
                                <div class="img-ifo">
                                    <div class="text" v-html="l.description"></div>
                                    <div class="link">
                                        <a href="#" class="btn-style-one">{{l.title}}</a>
                                    </div>
                                </div>
                            </div>
                        </slide>

                    </carousel>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';

export default {
    components: { 
        Carousel,
        Slide
    },
    data(){
        return {
            promo:[]
        }
    },
    mounted(){
        this.getPromo()
    },
    methods:{
        getPromo(){
            axios.get('list/testimoni')
                .then(response => {
                    this.promo = response.data
                })
        }
    }
}
</script>
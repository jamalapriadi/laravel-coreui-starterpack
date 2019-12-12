<template>
    <section class="about" id="feature">
        <section class="two-column style-2 event" style="background-color: rgb(189, 230, 251); margin-bottom: 80px">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-12 tab-column">
                        <div class="section-title">
                            <h2>News</h2>
                        </div>

                        <div class="event-carousel" id="newsletterslider">
                            <carousel :perPage="3" :autoplay="true" :loop="true">  
                                <slide v-for="(l,index) in promo" :key="index">      
                                    <div class="item wow fadeIn" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn; margin-right:20px;">
                                        <div class="img-holder">
                                            <figure>
                                                <a :href="'news/'+l.slug" target="_blank">
                                                    <img :src="l.feature_image_url" alt="images">
                                                </a>
                                            </figure>
                                            <div class="content bg-color-2" style="line-height: 1.5em; height: 9em; overflow: hidden;">
                                                <div class="newsletter-home">
                                                    <h4>
                                                        <a :href="'news/'+l.slug" target="_blank">{{l.title}}</a>
                                                    </h4>
                                                    <p>
                                                        <span class="fa fa-clock-o"></span> {{l.created_at}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </slide>

                            </carousel>
                        </div>
                        
                    </div>

                    <div class="col-md-4 col-sm-12 testimonial">
                        <div class="section-title">
                            <h2>Parent <span>Testimonial</span></h2>
                        </div>
                        <div class="slidertetimony" >
                            <testimoni></testimoni>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
import testimoni from './home/testimoni'

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
            axios.get('/latest-news')
                .then(response => {
                    this.promo = response.data
                })
        }
    }
}
</script>
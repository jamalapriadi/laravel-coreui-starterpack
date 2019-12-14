<template>
    <section class="event">
        <div class="container">
            <div class="section-title">
                <h2>Current <span>Promo</span></h2>
            </div>
            <carousel :perPage="3" :autoplay="true" :loop="true">
                
                <slide v-for="(l,index) in promo" :key="index">
                    <div style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn; margin-right:20px;">
                        <div class="img-holder">
                            <figure>
                                <a :href="'/promo/'+l.slug" target="_blank">
                                    <img :src="l.feature_image_url" alt="images">
                                </a>
                            </figure>
                            <div class="content bg-color-3" style="line-height: 1.5em; height: 6em; overflow: hidden;">
                                <div class="newsletter-home">
                                    <h4><span style="display:block;text-overflow: ellipsis;width: 100px;overflow: hidden; white-space: nowrap;"></span>
                                        <a :href="'/promo/'+l.slug" target="_blank">First 15 students enrolled FREE EXTRACURRICULAR GYMNASTIC ACADEMY</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </slide>

            </carousel>
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
            axios.get('list/promo')
                .then(response => {
                    this.promo = response.data
                })
        }
    }
}
</script>
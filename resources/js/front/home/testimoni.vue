<template>
    <carousel :perPage="1" :autoplay="true" :loop="true">        
        <slide v-for="(l,index) in promo" :key="index">
            <div class="item center" style="background-color: rgba(250, 250, 250, 0.5)">
                <img :src="l.feature_image_url" alt="images">
                <div class="img-ifo">
                    <div class="text" v-html="l.description"></div>
                    <div class="link">
                        <a target="_blank" href="https://kidsrepublic.sch.id/testimony" class="btn-style-one">{{l.title}}</a>
                    </div>
                </div>
            </div>
        </slide>

    </carousel>
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
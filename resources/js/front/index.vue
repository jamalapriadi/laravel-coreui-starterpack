<template>
    <div>
        <section class="home-video-hero">
            <div id="myslider" class="carousel slide" data-ride="carousel" style="opacity: 0.9;">
                <VueCarousel :data="data" :controls="false"></VueCarousel>

                <div class="video-overlay"> </div>
                <div class="content-container">
                    <div class="content" style="text-align:center; vertical-align: center; -webkit-filter: drop-shadow(2px 2px 4px black); filter: drop-shadow(2px 2px 4px black);">
                        <div class="wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s" data-wow-offset="0" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                            <div class="post-content" v-html="overlay.text">
                            
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </section>
    </div>
</template>

<script>
import carousel from 'vue-owl-carousel'
import VueCarousel from '@chenfengyuan/vue-carousel';

export default {
    components: { 
        carousel,
        VueCarousel 
    },
    data(){
        return {
            overlay:{},
            data:[]
        }
    },
    mounted(){
        this.getCarousel()
    },
    methods:{
        getCarousel(){
            axios.get('/list-carousel')
                .then(response => {
                    this.overlay = response.data.overlay

                    // this.data = response.data.carousel
                    for(var a=0; a< response.data.carousel.length; a++){
                        this.data.push("<div class='example-slide'><img src='"+response.data.carousel[a].image_url+"' width='100%'></div>");
                    }
                })
        }
    }
}
</script>

<style>
    .example-slide {
        align-items: center;
        background-color: #666;
        color: #999;
        display: flex;
        font-size: 1.5rem;
        justify-content: center;
        min-height: 10rem;
    }

    /* .carousel-controls{
        position:relative; 
        width:300px;
        margin:0 auto;
    }

    .carousel-indicators{
        top:0px; 
    } */
</style>
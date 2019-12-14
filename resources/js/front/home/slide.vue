<template>
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
            data:[
                '<div class="example-slide"><img src="https://kidsrepublic.sch.id/uploads/6/0.jpeg" width="100%"></div>',
                '<div class="example-slide"><img src="https://kidsrepublic.sch.id/uploads/6/1.jpeg" width="100%"></div>',
                '<div class="example-slide"><img src="https://kidsrepublic.sch.id/uploads/6/2.jpeg" width="100%"></div>',
                '<div class="example-slide"><img src="https://kidsrepublic.sch.id/uploads/6/3.jpeg" width="100%"></div>',
                '<div class="example-slide"><img src="https://kidsrepublic.sch.id/uploads/6/4.jpeg" width="100%"></div>',
                '<div class="example-slide"><img src="https://kidsrepublic.sch.id/uploads/6/5.jpeg" width="100%"></div>',
            ]
        }
    },
    mounted(){
        this.getCarousel()
    },
    methods:{
        getCarousel(){
            axios.get('list/carousel')
                .then(response => {
                    this.overlay = response.data.overlay
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
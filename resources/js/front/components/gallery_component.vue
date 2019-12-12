<template>
    <div>
        <section class="filter" style="padding-top: 75px;">
            <div class="container">
                <div class="pull-left">
                    <select class="col-md-4 col-sm-6 col-xs-12 btn-style-one" @change="ubahAlbum">
                        <option value="">Select Album</option>
                        <option v-for="(l,index) in list" :key="index" :value="l.id">{{l.name}}</option>
                    </select>
                </div>
            </div>
        </section>

        <section class="gallery-section gallery-three-column style-3">
            <div class="container">
                <div id="lightbox" class="lightbox">
                    <div class="row">
                        <div v-for="(l,index) in file" :key="index"  class="col-md-4 col-sm-6 col-xs-12 default-portfolio-item">
                            <div v-if="l.file_type=='image'" class="inner-box">
                                <figure class="image-box">
                                    <img style="height:321.73px; width:370px;" v-lazy="l.image_url" alt="">
                                </figure>
                                <!--Overlay Box-->
                                <div class="content" style="text-shadow: 2px 2px 4px black;">
                                    <div class="inner-box">
                                        <h3>{{l.title}}</h3>
                                        <a testprety :href="l.image_url" rel="prettyPhoto[gallery]" class="bg-color-1">View Photo<span class=""></span></a>
                                    </div>
                                </div>
                            </div>

                            <div v-if="l.file_type=='video'" class="inner-box">
                                <figure class="image-box"><img style="height:321.73px; width:370px;" :src="l.video_url" alt="Kids Republic"></figure>
                                <!--Overlay Box-->
                                <div class="content">
                                    <div class="inner-box">
                                        <h3>{{l.title}}</h3>
                                        <a testprety :href="l.video_url" rel="prettyPhoto[gallery]" class="bg-color-1">View Video<span class=""></span></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
            </div>
                
        </section>

        <div class="link-btn center"><a href="javascript:void(0)" class="theme-btn btn-style-one">load more</a></div>

        <!-- <LightBox 
            :images="images" 
            ref="lightbox"
            :show-caption="true"
            :show-light-box="false"
        >
        </LightBox> -->


    </div>
</template>

<script>
import LightBox from 'vue-image-lightbox'

export default {
    components: {
        LightBox,
    },
    data(){
        return {
            list:[],
            file:[]
        }
    },
    mounted(){
        this.getGallery()
        this.getGalleryFile()
    },
    methods:{
        getGallery(){
            axios.get('/list-gallery') 
                .then(response => {
                    this.list = response.data
                })
        },

        getGalleryFile(){
            axios.get('/list-gallery-file')
                .then(response => {
                    this.file = response.data
                })
        },

        openGallery(index) {
            // this.$refs.lightbox.showImage(index)
        },

        ubahAlbum(){

        }
    }
}
</script>
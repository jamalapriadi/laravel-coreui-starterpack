<template>
    <div class="container-fluid">
    <section style="margin-top: 90px; margin-bottom: 90px">
        <div class="row"> 
            <!--Video Channel Youtube Kids -->
            <div class="section-title center pb-60">
                <h2 class="mt-4"> Video <span>Profiles</span></h2> 
                <div class="col-sm-12">
                    <div class="videoWrapper">
                        <div v-for="(l,index) in videos" :key="index" class="col-sm-6" style="margin-top: 35px">
                            <div style="border:17px solid #FDFD66; border-radius: 30px; background:#FDFD66" v-if="index == 0">
                                <youtube :video-id="l.video_id"></youtube>
                            </div>
                            <div style="border:17px solid #ACE1FA; border-radius: 30px; background:#ACE1FA;" v-else>
                                <youtube :video-id="l.video_id"></youtube>
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
export default {
    data(){
        return {
            videos:[]   
        }
    },
    mounted(){
        this.getVideo()
    },
    methods:{
        getVideo(){
            axios.get('list/video-profile')
                .then(response => {
                    this.videos = response.data
                })
        }
    }
}
</script>

<style>
    iframe {
        width: 100%;
        /* max-width: 650px;  */
        height: 420px;
        border-radius: 20px;
    }
</style>
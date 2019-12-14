<template>
    <section class="about" id="feature" style="background-color: rgb(189, 230, 251); padding-bottom: 80px">
        <div class="container">
            <div class="section-title center pb-60">
                <h2>Our <span> Feature</span> </h2>
            </div>
            <div class="row">
                <div class="single-column col-md-7 col-sm-12" style="background-color: rgba(250, 250, 250, 0.5) /* Blue background with 30% opacity */; border-radius: 30px; padding-left: 20px">
                    <div class="wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s" data-wow-offset="0" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                        <div class="post-content">
                            <div id="fromcke">
                                <div class="btgrid">
                                    <div class="row row-1">
                                        <div class="col col-md-6">
                                            <div class="content">
                                                <p v-for="(l,index) in fasilitas" :key="index" v-show="index < 5">
                                                    <br />
                                                    <span style="color:#000000;">
                                                        <span style="font-size:18px;">
                                                            <img alt="" :src="l.icon_url" style="width: 32px; height: 32px;" />&nbsp; 
                                                        </span>
                                                    </span>
                                                    <span style="color:#333333;">
                                                        <span style="font-size:18px;">{{l.name}}</span>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col col-md-6">
                                            <div class="content">
                                                <p v-for="(l,index) in fasilitas" :key="index" v-show="index >= 5">
                                                    <br />
                                                    <span style="color:#000000;">
                                                        <span style="font-size:18px;">
                                                            <img alt="" :src="l.icon_url" style="width: 32px; height: 32px;" />&nbsp; 
                                                        </span>
                                                    </span>
                                                    <span style="color:#333333;">
                                                        <span style="font-size:18px;">{{l.name}}</span>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bootstrap-tabs" data-tab-set-title="Test">&nbsp;</div>

                            </div>
                        </div>
                    </div>    
                </div>
                <div class="single-column col-md-5 col-sm-12">  
                    <div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.5s" data-wow-offset="0" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                        <figure class="img-box">
                            <a href="javascript:void(0)"><img src="https://kidsrepublic.sch.id/resizepng/3/OurFeature-97019.png/700/515/0/0" alt="images"> </a>
                        </figure>
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
            fasilitas:[]
        }
    },
    mounted(){
        this.getFasilitas()
    },
    methods:{
        getFasilitas(){
            axios.get('list/fasilitas')
                .then(response => {
                    this.fasilitas = response.data
                })
        }
    }
}
</script>
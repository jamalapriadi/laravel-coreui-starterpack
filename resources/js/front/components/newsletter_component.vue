<template>
    <div>
        <div class="sidebar-page blog">
            <div class="container">
            
                <div class="row clearfix">
                    
                    <!--Content Side--> 
                    <div class="col-md-8 col-sm-7 col-xs-12 blog-column">
                        <section class="blog-container">
                            <!--Blog Post-->
                            <div v-for="(l,index) in newsletter" :key="index" class="blog-post wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft; background-size: contain;">
                                <article class="single-column">
                                    <div class="img-box-s2">
                                        <div class="img-holder">
                                            <img :src="l.feature_image_url" alt="">
                                        </div>
                                        <div class="outer-box">
                                            <div class="content">
                                                <div class="date">
                                                    <span>{{l.updated_at}}</span>
                                                </div>
                                                <h3>
                                                    <a>{{l.title}}</a>
                                                </h3>
                                        
                                                <div class="text">
                                                    <p v-html="l.description"></p>
                                                    <p>Please <a href="https://kidsrepublic.sch.id/subscribe">Subscribe here</a> for update Newsletter</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>  
                            </div>
                        </section>
                    </div>

                    <!--Sidebar-->  
                    <div class="col-md-4 col-sm-5 col-xs-12 sidebar-column">
                        <aside class="sidebar">
                            <!-- Popular Categories -->
                            <div class="widget popular-categories wow fadeInUp animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
                                <div class="sidebar-title"><h2>Peri<span>ode</span></h2></div>
                                
                                <ul class="list catagories">
                                    <!-- <li ng-repeat="row in data.newsletterperperiode" ng-click="periode(row.periode)"><a href="javascript:void(0)" >{{row.periode}}<span class="pull-right">({{row.jml}})</span></a></li> -->
                                </ul>
                            </div>
                            
                            <!-- Popular Tags -->
                            <div class="widget recent-photo">
                                <div class="sidebar-title"><h2>Recent <span>Photo</span></h2></div>
                                
                                <div class="instagram">
                                    <!-- <figure class="img-box" ng-repeat="row in data.gallerylimit"><a href="https://kidsrepublic.sch.id/urlfile/4/{{row.file}}" target="_blank"><img src="https://kidsrepublic.sch.id/fitjpg/4/{{row.file}}/83/83" alt=""></a></figure> -->
                                </div>                   
                            </div>
                        </aside>
                    </div>
                    <!--Sidebar-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            newsletter:[]
        }
    },
    mounted(){
        this.getNewsletter()
    },
    methods:{
        getNewsletter(){
            axios.get('/list-newsletter')
                .then(response => {
                    this.newsletter = response.data
                })
        }
    }
}
</script>
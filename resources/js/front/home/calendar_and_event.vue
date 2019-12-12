<template>
    <section class="two-column style-2 event">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="section-title">
                        <h2>Calendar<span> Academics</span></h2>

                        <ul>
                            <li><a href="https://kidsrepublic.sch.id/uploads/Documents/Academic_Calendar_2019-2020_(Parents).pdf" target="_blank" rel="nofollow" title="Calendar Academic"><button type="button" class="btn btn-primary" style="margin-bottom: 10px"> <i class="fa fa-download"></i> Download Calendar</button></a></li>
                        </ul>

                        <!-- <pdf src="https://kidsrepublic.sch.id/uploads/Documents/Academic_Calendar_2019-2020_(Parents).pdf" :page="1">
                            <template slot="loading">
                            loading content here...
                            </template>
                        </pdf> -->

                        <div class="myIframe">
                            <iframe src="https://kidsrepublic.sch.id/uploads/Documents/Academic_Calendar_2019-2020_(Parents).pdf" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="upcoming-event">
                        <div class="section-title"> 
                            <h2>Upcoming<span> Events</span></h2>
                        </div>

                        <div v-for="(l,index) in event" :key="index" class="item">
                            <div class="content">            
                                <tr>
                                    <td>
                                        <h4>
                                            <a :href="'/event/'+l.slug" target="_blank" style="font color: #000">{{l.title}}</a>
                                        </h4>
                                        <p><span class="fa fa-calendar-o"></span> {{l.tanggal}}</p>
                                        <p><span class="fa fa-clock-o"></span> {{l.jam_mulai}} - {{l.jam_selesai}}</p>
                                        <p><span class="fa fa-map-marker"></span>{{l.lokasi}}</p>
                                    </td>
                                </tr>      
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import pdf from 'pdfvuer'

export default {
    components: {
        pdf
    },
    data(){
        return {
            event:[]
        }
    },
    mounted(){
        this.getEvent()
    },
    methods:{
        getEvent(){
            axios.get('/list-event')
                .then(response => {
                    this.event = response.data
                })
        }
    }
}
</script>

<style>
    .myIframe {
        position: relative;
        padding-bottom: 100%;
        height: 0;
        overflow: auto; 
        -webkit-overflow-scrolling:touch;
    } 
    .myIframe iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 97%;
        height: 74%;
    }
</style>
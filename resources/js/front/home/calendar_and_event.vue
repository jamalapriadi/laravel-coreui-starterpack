<template>
    <section class="two-column style-2 event">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="section-title">
                        <h2>Calendar<span> Academics</span></h2>

                        <ul>
                            <li><a :href="calendar" target="_blank" rel="nofollow" title="Calendar Academic"><button type="button" class="btn btn-primary" style="margin-bottom: 10px"> <i class="fa fa-download"></i> Download Calendar</button></a></li>
                            
                        </ul>

                        <div class="myIframe">
                            <pdf :src="calendar" style="position: absolute; top: -10%;
                                left:-20%;
                                width: 200%;
                                height: 74%;"></pdf>
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
import vuePdfjs from 'vue-pdfjs'
import pdf from 'vue-pdf'

export default {
    components: {
        vuePdfjs,
        pdf
    },
    data(){
        return {
            event:[],
            calendar:''
        }
    },
    mounted(){
        this.getEvent()
        this.getCalendar()
    },
    methods:{
        getEvent(){
            axios.get('list/event')
                .then(response => {
                    this.event = response.data
                })
        },

        getCalendar(){
            axios.get('list/calendar')
                .then(response => {
                    if(response.data!=null){
                        if(response.data.files.length >  0){
                            for(var a=0; a<response.data.files.length; a++){
                                this.calendar = response.data.files[a].image_url
                            }
                        }
                    }

                    console.log(this.calendar)
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
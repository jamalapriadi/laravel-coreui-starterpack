<template>
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
</template>

<script>
export default {
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
            axios.get('list/event')
                .then(response => {
                    this.event = response.data
                })
        }
    }
}
</script>
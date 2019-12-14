<template>
    <div class="section-title">
        <h2>Calendar<span> Academics</span></h2>

        <ul>
            <li>
            </li>
            
        </ul>

    </div>
</template>

<script>
export default {
    data(){
        return {
            calendar:''
        }
    },
    mounted(){
        this.getCalendar()
    },
    methods:{
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
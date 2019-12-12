<template>
    <div class="navbar-collapse collapse text-center">  
        <ul>
            <li class="current">
                <a href="https://kidsrepublic.sch.id">Home</a>
            </li>
            <li class="dropdown ">
                <a href="" style="cursor: default">About Us</a>
                <ul class="submenu">
                    <li><a href="https://kidsrepublic.sch.id/founder">Founders Profile</a></li>
                    <li><a href="https://kidsrepublic.sch.id/principal">Principal's Foreword</a></li>
                    <li class="dropdown ">
                        <a href="#" style="cursor: default">About the school</a>
                        <ul class="submenu">
                            <li><a href="https://kidsrepublic.sch.id/story">Vision Missions</a></li>
                            <li><a href="https://kidsrepublic.sch.id/philosophy">Kids Republic Philosophy</a></li>
                        </ul>
                    </li>
                    <li class="dropdown ">
                        <a href="#" style="cursor: default">Our Campus</a>
                        <ul class="submenu">
                            <li><a href="https://kidsrepublic.sch.id/teacher">Teachers, Instructor, &amp; Staff Profile</a></li>
                            <li><a href="https://kidsrepublic.sch.id/facility">Teaching Facility</a></li>
                        </ul>
                    </li>   
                </ul>
            </li>
            
            <li class="dropdown ">
                <a href="https://kidsrepublic.sch.id/ourprogram">Programmes</a>
                <ul class="submenu">
                    <li><a href="https://kidsrepublic.sch.id/educprogram">Education</a></li>
                    <li><a href="https://kidsrepublic.sch.id/gymprogram">Gymnastic</a></li>
                    <li><a href="https://kidsrepublic.sch.id/trainingprogram">Training Center</a></li>
                    <li><a href="https://kidsrepublic.sch.id/excul">Extracurricular</a>
                    </li>
                </ul>
            </li>
            
            
            <li class="">
                <a href="https://kidsrepublic.sch.id/newsletter">Newsletter</a>
            </li>

            <li class="dropdown">
                <a href="" style="cursor: default">Admission</a>
                <ul class="submenu">
                    <li class="dropdown">
                    <a href="#" style="cursor: default">Primary School</a>
                        <ul class="submenu">
                            <li><a href="https://kidsrepublic.sch.id/admissionprocedure">Admission Procedure</a></li>
                            <li><a href="https://kidsrepublic.sch.id/admissioninformation">Admission Information</a></li>
                            <li><a href="https://kidsrepublic.sch.id/flyer">Flyer</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class=""><a href="https://kidsrepublic.sch.id/contact">Contact Us</a></li>
            <li><a href="https://simak.kidsrepublic.sch.id">SIMAK</a></li>
        </ul>  
    </div> 
</template>

<script>
export default {
    data(){
        return {
            list:[]
        }
    },
    mounted(){
        this.getData()
    },
    methods:{
        getData(){
            axios.get('list-menu')
                .then(response => {
                    this.list = response.data
                    console.log(this.list)
                })
        }
    }
}
</script>
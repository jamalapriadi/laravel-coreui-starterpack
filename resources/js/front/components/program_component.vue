<template>
    <div class="row">
        <div style="text-align: center;"><span style="color:#333333;"><small><span dir="ltr"><big><span style="font-size:26px;"><span style="background:white"><span style="line-height:normal"><span style="font-family:&quot;dosis&quot;,serif"><strong>OUR PROGRAM</strong></span></span></span></span></big></span></small></span></div>
        <br>

        <div v-for="(l,index) in program" :key="index" class="col-lg-6">
            <div style="background: rgb(253, 253, 102); border: 1px solid rgb(204, 204, 204); padding: 5px 10px; text-align: center;">
                <span style="color:#333333;">
                    <span style="font-family:Lucida Sans Unicode,Lucida Grande,sans-serif;">
                        <span style="font-size:9.0pt">
                            <span style="line-height:107%">
                                <span style="font-size:16px;">
                                    <strong>{{l.title}}</strong>
                                </span>
                                <br />
                                ({{l.second_tile}})&nbsp;
                            </span>
                        </span>
                    </span>
                </span>
            </div>

            <div style="background: rgb(238, 238, 238); border: 1px solid rgb(204, 204, 204); padding: 5px 10px; text-align: center;">
                <span style="color:#333333;">
                    <span style="font-family:Lucida Sans Unicode,Lucida Grande,sans-serif;">
                        <img alt="Crawler" :src="l.feature_image_url" style="width: 150px; height: 150px;" />
                    </span>
                </span>
            </div>

            <div style="background: rgb(172, 225, 250); border: 1px solid rgb(204, 204, 204); padding: 5px 10px; text-align: center;">
                <span style="color:#333333;">
                    <span style="font-family:Lucida Sans Unicode,Lucida Grande,sans-serif;">
                        <span style="font-size:14px;">
                            <span style="line-height:107%" v-html="l.description">
                            </span>
                        </span>
                    </span>
                </span>
            </div>


        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            program:[]
        }
    },
    mounted(){
        this.getprogram()
    },
    methods:{
        getprogram(){
            axios.get('list/program')
                .then(response => {
                    this.program = response.data
                })
        }
    }
}
</script>
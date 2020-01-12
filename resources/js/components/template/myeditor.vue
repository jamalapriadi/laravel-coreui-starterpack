<template>
    <div>
        <textarea name="desc" :id="kodenya" v-model="desc" cols="30" rows="10"></textarea>
    </div>
</template>

<script>
export default {
    props:[
        'desc',
        'kodenya'
    ],
    data(){
        return {
            state:{
                desc:''
            }
        }
    },
    beforeUpdate () {
        const ckeditorId = this.kodenya

        if (this.desc !== CKEDITOR.instances[ckeditorId].getData()) {
            CKEDITOR.instances[ckeditorId].setData(this.desc)
        }
	},
    mounted(){
        const ckeditorId = this.kodenya

        CKEDITOR.replace( ckeditorId,{
            extraPlugins : ['btgrid','wenzgmap','bootstrapTabs'],
            language: 'en',
            allowedContent: true,
            entities: false,
            enterMode:2,forceEnterMode:false,shiftEnterMode:1,
            toolbar :
                [
                    [ 'Font', 'FontSize','Styles' ],        
                    [ 'Bold', 'Italic', 'Underline'],
                    [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ],
                    ['TextColor','BGColor'],
                    [ 'Paste', 'PasteText', 'PasteFromWord'],
                    '/',
                    [ 'NumberedList', 'BulletedList', '-','JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
                    [ 'btgrid','About','wenzgmap','BootstrapTabs','Source','Maximize'],
                ],
            toolbarGroupsCanCollapse:true,
        });

        CKEDITOR.instances[ckeditorId].setData(this.desc)
        CKEDITOR.instances[ckeditorId].on('change', () => {
            let ckeditorData = CKEDITOR.instances[ckeditorId].getData()
            if (ckeditorData !== this.desc) {
                this.$emit('input', ckeditorData)
            }
        })
    },
    destroyed () {
        if (CKEDITOR.instances.desc) {
            CKEDITOR.instances.desc.destroy()
        }
	}
}
</script>
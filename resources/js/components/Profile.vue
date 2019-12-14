<template>
    <div class="card card-default">
        <div class="card-header">Profile</div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <td>Nama</td>
                    <td>{{state.nama}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{state.email}}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            state:{
                nama:'',
                email:'',
                avatar_url:''
            }
        }
    },
    mounted(){
        this.getUser()
    },
    methods:{
        getUser(){
            axios.get('data/user')
                .then(response => {
                    this.state={
                        nama: response.data.name,
                        email: response.data.email,
                        avatar_url: response.data.avatar_url
                    }
                })
        }
    }
}
</script>
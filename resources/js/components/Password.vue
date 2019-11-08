<template>
    <div class="card card-default">
		<div class="card-header">
			<h6 class="card-title">Change Password</h6>
		</div>
		<div class="card-body">
			<div v-if="message" v-bind:class="pesankelas">
                {{ message }}
            </div>

            <vue-loading v-if="loading" type="bars" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>    


			<form  @submit.prevent="store" action="/data/change-password" method="post">
				<div id="pesan"></div>
				<div class="form-group">
					<label for="" class="control-label text-semibold">Password Lama</label>
					<input type="password" name="current" class="form-control" v-model="state.current">
				</div>
				<div class="form-group">
					<label for="" class="control-label text-semibold">Password Baru</label>
					<input type="password" name="password" class="form-control" v-model="state.password">
				</div>
				<div class="form-group">
					<label for="" class="control-label text-semibold">Konfirmasi Password</label>
					<input type="password" name="password_confirmation" class="form-control" v-model="state.password_confirmation">
				</div>
				<div class="form-group">
					<button class="btn btn-primary">
						<i class="icon-floppy-disk"></i> Change Password
					</button>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
	import { VueLoading } from 'vue-loading-template'

    export default {
		components: {
			VueLoading
		},
        data(){
            return {
                state:{
                    current:'',
                    password:'',
                    password_confirmation:''
				},
				message:'',
				loading:false,
				pesankelas:'',
				errors: [],
            }
        },
        mounted() {
            console.log('Component mounted.')
		},
		methods:{
			store(e) {
				this.loading = true;

				axios.post(e.target.action, this.state).then(response => {
					if(response.data.success==true){
						this.errors = [];
						this.state={
							current:'',
							password:'',
							password_confirmation:''
						}
						this.pesankelas='alert alert-success';
						this.message = 'Data berhasil disimpan';
					}else{
						this.pesankelas='alert alert-danger';
						this.message = response.data.pesan+","+response.data.error+"";
						this.errors.name=true;
					}

					this.loading = false;
				}).catch(error => {
					if (! _.isEmpty(error.response)) {
						if (error.response.status = 422) {
							this.errors = error.response.data;
							console.log(this.errors);
						}
					}
				});
			}
		}
    }
</script>
<template>
<form @submit.prevent="handleSubmit">
                              
                                    <div class="form-group">
                                        <label>Image</label>
                                       
                                        <file-input v-on:file-change="setFiles"></file-input>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit">Upload</button>
                                    </div>
                                </form>
</template>
<script>
import FileInput from './FileInput.vue'

	export default {
		methods: {
			handleSubmit (){
				let formData = new FormData();
				formData.append('file_name[]', this.files)

				axios.post('/api/images', formData)
					.then(res => {
						console.log("upload complete")
					})
					.catch(err => {
						console.log("gagal")
					})
			},
			setFiles (files){
				if (files != undefined){
					this.files = files
				}
			}
		},

		components: {
			FileInput
		},
		data (){
			return{
				files: ''
			}
		}
	}
</script>
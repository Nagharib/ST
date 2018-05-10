<template>
<div>
	<div class="input-group">
		<input type="text" :value="files.name" class="form-control" placeholder="Choose your images"  readonly>
		<span class="input-group-btn">
			<button class="btn btn-default" type="button" @click="showFilePicker">
				<i class="glyphicon glyphicon-paperclip"></i>
			</button>
		</span>
	</div>
	<input type="file" ref="file" style="display:none;" @change="onChange">

</div>
</template>

<script>

export default {
	data () {
		return {
			files: ''
		}
	},
	methods: {
		showFilePicker () {
		this.$refs.file.click();
		},
		onChange (event) {
			this.files = event.target.files[0]
			this.$emit('file-change', this.files)
		}
	}
	
}

</script>
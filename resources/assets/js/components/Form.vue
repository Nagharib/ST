<template>
	<form @submit.prevent="submit" method="post" action="">

		<div v-if="alert.message" :class="['alert alert-' + alert.type]">
			<p>{{ alert.message }}</p>
		</div>

		<div :class="['form-group', { 'has-error' : errors.perumahan }]">
			<label class="control-label">Perumahan</label>
			<select @change="perumahan" v-model="state.perumahan" class="form-control">
				<option value="">Pilih Perumahan</option>
				<option v-for="perumahan in perumahans" :value="perumahan.id">
					{{ perumahan.name }}
				</option>
			</select>
			<span v-if="errors.perumahan" class="label label-danger">
				{{ errors.perumahan[0] }}
			</span>
		</div>

		<div :class="['form-group', { 'has-error' : errors.block }]">
			<label class="control-label">Block</label>
			<select @change="block" v-model="state.block" class="form-control">
				<option value="">Pilih Block</option>
				<option v-for="block in regencies" :value="block.id">
					{{ block.name }}
				</option>
			</select>
			<span v-if="errors.block" class="label label-danger">
				{{ errors.block[0] }}
			</span>
		</div>

	</form>
</template>

<script>
	export default {
		name: 'LocationForm',

		data() {
			return {
				alert: {},
				errors: [],
				state: {
					perumahan: '',
					block: ''
					
				},
				perumahans: [],
				regencies: []
			}
		},

		mounted() {
			// get all perumahans data
			axios.get('/admin/perumahan').then(response => {
				this.perumahans = response.data;
			}).catch(error => console.error(error));
		},

		methods: {
			submit(e) {
				this.errors = [];
				this.alert = {};

				axios.post(e.target.action, this.state).then(response => {
					if (response.data.status) {
						this.alert = {
							type: 'success',
							message: response.data.message
						}

						this.errors = [];
					}
				}).catch(error => {
					if (error) {
						if (error.response.status == 422) {
							this.errors = error.response.data;
						}
					}
				});
			},

			perumahan() {
				this.state.block = '';

				// set params
				const params = {
					perumahan: this.state.perumahan
				}

				// url /location/block?perumahan=xxx
				axios.get('/admin/blockp', {params}).then(response => {
					this.regencies = response.data;
				}).catch(error => console.error(error));
			},

			block() {
				this.state.district = '';

				// set params
				const params = {
					block: this.state.block
				};

				
			}
		}
	}
</script>
<template>
	<form @submit.prevent="submit" method="post" v-on:submit.prevent="tambahblock">

		<div v-if="alert.message" :class="['alert alert-' + alert.type]">
			<p>{{ alert.message }}</p>
		</div>

		<div :class="['form-group', { 'has-error' : errors.perumahan }]">
			<label class="control-label">Perumahan</label>
			<select @change="perumahan" v-model="dataBaru.house_id" class="form-control">
				<option value="">Pilih Perumahan</option>
				<option v-for="perumahan in perumahans" :value="perumahan.id">
					{{ perumahan.name }}
				</option>
			</select>
			<span v-if="errors.perumahan" class="label label-danger">
				{{ errors.perumahan[0] }}
			</span>
		</div>

		<div :class="['form-group', { 'has-error' : errors.block_id }]">
			<label class="control-label">Block</label>
			<select @change="block" v-model="dataBaru.block_id" class="form-control">
				<option value="">Pilih Block</option>
				<option v-for="block in regencies" :value="block.id">
					{{ block.name }}
				</option>
			</select>

			<span v-if="errors.block" class="label label-danger">
				{{ errors.block[0] }}
			</span>
		</div>



		<div :class="['form-group', { 'has-error' : errors.created_by }]">
			<label class="control-label">created_by</label>

			
				<div v-for="created_by in users" :value="created_by.id">
				<b-form-input type="text" v-model="dataBaru.created_by" class="form-control">{{ created_by.id }}
				</b-form-input>
				
				</div >
				
		



			<span v-if="errors.created_by" class="label label-danger">
				{{ errors.created_by[0] }}
			</span>
		</div>

		<div :class="['form-group', { 'has-error' : errors.description }]">
			<label class="control-label">Deskripsi</label>
			<textarea type='text' v-model="dataBaru.description" class="form-control">{{ created_by.id }}</textarea>
			 
			<span v-if="errors.description" class="label label-danger">
				{{ errors.description[0] }}
			</span>
		</div>

		<div :class="['form-group', { 'has-error' : errors.active_flag }]">
			<label class="control-label">Aktif:</label>
			<input type="checkbox" v-model="dataBaru.active_flag" true-value="y" false-value="n">
			
			<span v-if="errors.active_flag" class="label label-danger">
				{{ errors.active_flag[0] }}
			</span>
		</div>
		
		<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
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
			dataBaru: {
			'description':'',
			'active_flag':'y',
			'status_flag':'y',
			'house_id':'0',
			'account_id':'{{ Auth::user()->account_id }}',
			'created_by':''
			
			},counter: 0,
			    pagination: {
			        total: 0,
			        per_page: 2,
			        from: 1,
			        to: 0,
			        current_page: 1
			    },
			     offset: 4,
				perumahans: [],
				users: [],
				regencies: []
			}
		},

		mounted() {
			// get all perumahans data
			axios.get('/location/perumahan').then(response => {
				this.perumahans = response.data;
			}).catch(error => console.error(error));

			axios.get('/location/userna').then(response => {
				this.users = response.data;
			}).catch(error => console.error(error));
		},

		methods: {
			submit(e) {
				this.errors = [];
				this.alert = {};

				axios.post(e.target.action, this.dataBaru).then(response => {
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

			tambahblock:function(){
		      var input = this.dataBaru;
		      axios.post(base_url+'/admin/unit',input).then(response=>{
		        this.dataBaru = {
		        'name':'',
		        'description':'',
		        'active_flag':'y',
		        'status_flag':'y',
		        'house_id':'0',
		        'account_id':'{{ Auth::user()->account_id }}',
		        'created_by':''
		        };

		        $("#tambah-data").modal('hide');
		        this.ambilunit(this.unit.current_page);
		      }).catch(errors=>{
		        if(errors.response){
		          if(errors.response.status = 422){
		            this.errorForm = errors.response.data;
		          }
		        } else {
		          console.error(errors);
		        }
		      })
		    },


			perumahan() {
				this.dataBaru.block = '';
	
				// set params
				const params = {
					perumahan: this.dataBaru.house_id
				}

			

				// url /location/block?perumahan=xxx
				axios.get('/location/block', {params}).then(response => {
					this.regencies = response.data;
				}).catch(error => console.error(error));

				
			},

			
		}



	}
</script>
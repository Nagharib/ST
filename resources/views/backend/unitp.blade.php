
@extends('layouts.main')
@section('content')
<div class="row" id="unit">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <button class="btn btn-info" data-toggle="modal" data-target="#tambah-data">Tambah  Unit</button>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 350px;">
                  <input type="text" v-model="cari" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" @click.prevent="cariblock"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
           <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th style="white-space: nowrap;">Nama  Unit</th>
                  <th style="white-space: nowrap;">Nama  Perumahan</th>
                  <th style="white-space: nowrap;">Nama  Block</th>
                  <th style="white-space: nowrap;">Deskripsi</th>
                 
                  <th>Aksi</th>
                </tr>
                <tr v-for=" lay in unit.data">
                   <td>@{{lay.name}}</td>
                  <td>@{{lay.perumna}}</td>
                  <td>@{{lay.blokna}}</td>
                  <td>@{{lay.description}}</td>
                  <td style="white-space: nowrap;">
                    <button class="btn btn-info btn-xs" @click.prevent="editblock(lay)">Edit</button>
                                <button class="btn btn-danger btn-xs" @click.prevent="hapusblock(lay.id)">Delete</button>
                  </td>
                </tr>
              </table>

                <vue-pagination  v-bind:pagination="pagination"
                     v-on:click.native="ambilunit(pagination.current_page)"
                     :offset="4">
                </vue-pagination>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <!-- Modal Tambah Data -->
        <div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form method="POST" enc="multipart/form-data" v-on:submit.prevent="tambahblock">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-name" id="myModalLabel">Tambah Data @{{dataBaru.name}}</h4>
              </div>
              <div class="modal-body">
                
              <!--<location-form></location-form>-->
              <div class="form-group">
                  <label for="name">Nama Unit:</label>
                  <input type='text' name="name" class="form-control" v-model="dataBaru.name" />
                  <span v-if="errorForm['name']" class="error text-danger">@{{ errorForm['name'] }}</span>
                </div>

				  	  <label>Pilih Perumahan</label>
                      <div class="row">
                        <div class="col-sm-12">

                          <select @change="perumahan" v-model="dataBaru.house_id" class="form-control">
                          <option value="">Pilih Perumahan</option>
                          <option v-for="perumahan in perumahans" v-bind:value="perumahan.id">
                            @{{ perumahan.name }}
                          </option>
                        </select>
                        <span v-if="errors.perumahan" class="label label-danger">
                          @{{ errors.perumahan[0] }}
                        </span>
						
                        </div>
                      </div>
                     
				      <label>Pilih Block</label>
                   <div class="row">
                        <div class="col-sm-12">
                    
                          <select @change="block" v-model="dataBaru.block_id" class="form-control">
                          <option value="">Pilih Block</option>

                          <option v-for="block in regencies" v-bind:value="block.id">
                            @{{ block.name }}
                          </option>
                          </select>

                           <span v-if="errorForm['block_id']" class="error text-danger">@{{ errorForm['block_id'] }}</span>
                        </div>
                      </div>
       

                  <input type="hidden" name="account_id"  class="form-control" v-model.trim="dataBaru.account_id" />
                  <span v-if="errorForm['account_id']" class="error text-danger">@{{ errorForm['account_id'] }}</span>

                  <input type="hidden" name="created_by" class="form-control" v-model="dataBaru.created_by" />
                  <span v-if="errorForm['created_by']" class="error text-danger">@{{ errorForm['created_by'] }}</span>

                <div class="form-group">
                  <label for="name">Deskripsi:</label>
                  <textarea name="description" class="form-control" v-model="dataBaru.description" /></textarea>
                  <span v-if="errorForm['description']" class="error text-danger">@{{ errorForm['description'] }}</span>
                </div>
				
				<div class="form-group">
                  <label for="name">Aktif:</label>
				   <input type="checkbox" v-model="dataBaru.active_flag" true-value="y" false-value="n">
                  <span v-if="errorForm['active_flag']" class="error text-danger">@{{ errorForm['active_flag'] }}</span>
                </div>
				
			
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
           
              </form>
            </div>
          </div>
        </div>

        <!-- Model Edit -->
        <div class="modal fade" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form method="POST" enc="multipart/form-data" v-on:submit.prevent="ubahblock(dataEdit.id)">
	
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-name" id="myModalLabel">Edit Data @{{dataEdit.name_}}</h4>
              </div>
              <div class="modal-body">
				<div class="form-group">
                  <label for="name">Nama Unit:</label>
                  <input type='text' name="name" class="form-control" v-model="dataEdit.name" />
                  <span v-if="errorForm['name']" class="error text-danger">@{{ errorForm['name'] }}</span>
                </div>

				 <label>Pilih Perumahan</label>
                      <div class="row">
                        <div class="col-sm-12">

                          <select @change="perum" v-model="dataEdit.house_id" class="form-control">
                          <option value="">Pilih Perumahan</option>
                          <option v-for="perum in perums" v-bind:value="perum.id">
                            @{{ perum.name }}
                          </option>
                        </select>
                        <span v-if="errors.perum" class="label label-danger">
                          @{{ errors.perum[0] }}
                        </span>

                        </div>
                      </div>
					  
                <div class="form-group">

                  <label for="name">Nama block:</label>

                   <select @change="blockna" v-model="dataEdit.block_id" class="form-control">
                          <option value="">Pilih Block</option>

                          <option v-for="blockna in editblocks" v-bind:value="blockna.id" selected="selected">
                            @{{ blockna.name }}
                          </option>
                          </select>

                           <span v-if="errorForm['block_id']" class="error text-danger">@{{ errorForm['block_id'] }}</span>

                  <input type="hidden" name="updated_by" class="form-control" v-model="dataEdit.updated_by" />
                  <span v-if="errorForm['updated_by']" class="error text-danger">@{{ errorForm['updated_by'] }}</span>
                </div>
               
                <div class="form-group">
                  <label for="name">Deskripsi:</label>
                  <input type="text" name="description" class="form-control" v-model="dataEdit.description" />
                  <span v-if="errorForm['description']" class="error text-danger">@{{ errorForm['description'] }}</span>
                </div>
               
			   <div class="form-group">
                  <label for="name">Aktif:</label>
				  <input type="checkbox" v-model="dataEdit.active_flag" true-value="y" false-value="n">
				  
                  <span v-if="errorForm['active_flag']" class="error text-danger">@{{ errorForm['active_flag'] }}</span>
                </div>
					
                  
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        

        <div class="modal fade" id="hapus-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-name" id="myModalLabel">Hapus Data</h4>
              </div>
              <div class="modal-body">
                Yakin ingin menghapus data ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">N O</button>
                <button type="submit" class="btn btn-primary" @click.prevent="hapuskonfirmblock(hapus_id)">O K</button>
              </div>
            </div>
          </div>
        </div>

      </div>

@push('script')

<script>

    var unit = new Vue({
    el: '#unit',
    data: {
      alert: {},
        errors: [],
    unit: null,
    dataBaru: {'name':'','description':'','active_flag':'y','status_flag':'O','house_id':'0','account_id':'{{ Auth::user()->account_id }}','created_by':'{{ Auth::user()->id }}'},
    errorForm:{},
    dataEdit: {'name':'','description':'','active_flag':'','house_id':'0','block_id':'0','updated_by':'{{ Auth::user()->id }}'},
    cari: null,
    counter: 0,
    pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1
    },
    offset: 4,
    perumahans: [],
    regencies: [],
    editblocks: [],
    perums: [],
    hapus_id:null
     },


     mounted() {
      // get all perumahans data
      axios.get('/location/perumahan').then(response => {
        this.perumahans = response.data;
      }).catch(error => console.error(error));

      axios.get('/location/userna').then(response => {
        this.users = response.data;
      }).catch(error => console.error(error));

      axios.get('/location/editblock').then(response => {
        this.editblocks = response.data;
      }).catch(error => console.error(error));

       axios.get('/location/perumahan').then(response => {
        this.perums = response.data;
      }).catch(error => console.error(error));
    },


    methods: {
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

    

        ambilunit:function(page){
      var cari = this.cari ? this.cari : '';
      this.errorForm = {};
            axios.get(base_url+'/api/unit?cari='+cari+'&page='+page).then(response => {
                this.unit = response.data;
          this.pagination = response.data;
            }).catch(errors => {
                console.error(errors);
            })
        },

  tambahblock:function(){
      var input = this.dataBaru;
      axios.post(base_url+'/admin/unit',input).then(response=>{
        this.dataBaru = {'name':'','description':'','active_flag':'y','status_flag':'y','house_id':'0','account_id':'{{ Auth::user()->account_id }}','created_by':'{{ Auth::user()->account_id }}'};
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

  perum(){
        // set params
        const params = {
          perum: this.dataEdit.house_id
        }
      
        axios.get('/location/editblock', {params}).then(response => {
          this.editblocks = response.data;
        }).catch(error => console.error(error));
      },

   editblock:function(unit){
      this.dataEdit.id = unit.id;
      this.dataEdit.name = unit.name;
      this.dataEdit.block_kategori_id = unit.block_kategori_id;
      this.dataEdit.description = unit.description;
      this.dataEdit.active_flag = unit.active_flag;
      this.dataEdit.house_id = unit.house_id;
      this.dataEdit.block_id = unit.block_id;

      var idna = this.dataEdit.house_id = unit.house_id;
            axios.get(base_url+'/location/editblock?perum='+idna).then(response => {
                this.editblocks = response.data;
            }).catch(error => console.error(error));

      this.dataEdit.updated_by = '{{ Auth::user()->id }}';
      $('#edit-data').modal('show');
    },

    ubahblock:function(id){
      var input = this.dataEdit;
      axios.patch(base_url+'/admin/unit/'+id,input).then(response => {
        $('#edit-data').modal('hide');
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

    hapusblock:function(id){
      this.hapus_id = id;
      $('#hapus-data').modal('show');
    },

    hapuskonfirmblock:function(id){
      axios.delete(base_url+'/admin/unit/'+id).then(response => {
        this.ambilunit(this.unit.current_page);
        $('#hapus-data').modal('hide');
      }).catch(errors=>{
        console.error(errors);
      })
    },

    cariblock:function(){
      axios.get(base_url+'/api/unit?cari='+this.cari).then(response => {
        this.unit = response.data;
        this.pagination = response.data;
        console.log(this.pagination);
      }).catch(errors=>{
        console.error(errors);
      })
    }

    },
    created(){
        this.ambilunit(this.pagination.current_page);
    }



});

</script>

@endpush
@endsection

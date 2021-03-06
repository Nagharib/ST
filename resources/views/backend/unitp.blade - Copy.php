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
                  <th style="white-space: nowrap;">Nama  Perumahan</th>
                  <th style="white-space: nowrap;">Nama  Block</th>
                  <th style="white-space: nowrap;">Nama  Unit</th>
                  <th style="white-space: nowrap;">Deskripsi</th>
                 
                  <th>Aksi</th>
                </tr>
                <tr v-for=" lay in unit.data">
                  <td>@{{lay.house.name}}</td>
                  <td>@{{lay.block_id}}</td>
                  <td>@{{lay.house_id}}</td>
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
				  	  <label>Pilih Perumahan</label>
                      <div class="row">
                        <div class="col-sm-12">
						
                          <select id="perumahan" class="form-control" name="house_id" v-model="dataBaru.house_id">
                            <option value="0" ></option>
                            @foreach($block as $key=>$block)
                            <option value="{{$key}}">{{$block}}</option>
                            @endforeach
                          </select>
						  
                           <span v-if="errorForm['house_id']" class="error text-danger">@{{ errorForm['house_id'] }}</span>
                        </div>
                      </div>
                     
				   <label>Pilih Block</label>
                   <div class="row">
                        <div class="col-sm-12">
                          <select id="blockpilih" class="form-control" name="block_id" v-model="dataBaru.block_id">
                             <option value="0" disable="true" selected="true">=== Select Block ===</option>
                          <!--  @foreach($blockna as $key=>$block)
                            <option value="{{$key}}">{{$block}}</option>
                            @endforeach -->
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
				
				 <label>Pilih Perumahan</label>
                      <div class="row">
                        <div class="col-sm-12">
                          <select class="form-control" name="house_id" v-model="dataEdit.house_id">
                            <option value="0" >Pilih Perumahan</option>
                            @foreach($blocka as $key=>$block)
                            <option value="{{$key}}">{{$block}}</option>
                            @endforeach
                          </select>
                           <span v-if="errorForm['house_id']" class="error text-danger">@{{ errorForm['house_id'] }}</span>
                        </div>
                      </div>
					  
                <div class="form-group">
                  <label for="name">Nama  block:</label>
                  <input type="text" name="name" class="form-control" v-model="dataEdit.name" />
                  <span v-if="errorForm['name']" class="error text-danger">@{{ errorForm['name'] }}</span>

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
    unit: null,
    dataBaru: {'description':'','active_flag':'y','status_flag':'y','house_id':'0','account_id':'{{ Auth::user()->account_id }}','created_by':'{{ Auth::user()->id }}'},
    errorForm:{},
    dataEdit: {'description':'','active_flag':'','house_id':'0','updated_by':'{{ Auth::user()->id }}'},
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
    hapus_id:null
     },
    methods: {

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

   editblock:function(unit){
      this.dataEdit.id = unit.id;
      this.dataEdit.name = unit.name;
      this.dataEdit.block_kategori_id = unit.block_kategori_id;
      this.dataEdit.description = unit.description;
      this.dataEdit.active_flag = unit.active_flag;
      this.dataEdit.house_id = unit.house_id;
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
<script type="text/javascript">
      $('#perumahan').on('change', function(e){
        console.log(e);
        var perumahan_id = e.target.value;
        $.get('/blockpilih?perumahan_id=' + perumahan_id,function(data) {
          console.log(data);
          $('#blockpilih').empty();
          $('#blockpilih').append('<option value="0" disable="true" selected="true">=== Select blockpilih ===</option>');

          $.each(data, function(index, regenciesObj){
            $('#blockpilih').append('<option value="'+ regenciesObj.id +'">'+ regenciesObj.name +'</option>');
          })
        });
      });
@endpush
@endsection

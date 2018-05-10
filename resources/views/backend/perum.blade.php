@extends('layouts.main')
@section('content')
<div class="row" id="perum">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <button class="btn btn-info" data-toggle="modal" data-target="#tambah-data">Tambah  Perumahan</button>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 350px;">
                  <input type="text" v-model="cari" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" @click.prevent="cariperum"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
           <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th style="white-space: nowrap;">Nama  Perumahan</th>
                  <th>Deskripsi</th>
                  <th>Alamat</th>
                  <th>Kabupaten</th>
                  <th>Aksi</th>
                </tr>
                <tr v-for=" lay in perum.data">
                  <td>@{{lay.name}}</td>
                  <td>@{{lay.description}}</td>
                  <td>@{{lay.address}}</td>
                  <td>@{{lay.region}}</td>
                  <td style="white-space: nowrap;">
                    <button class="btn btn-info btn-xs" @click.prevent="editperum(lay)">Edit</button>
                                <button class="btn btn-danger btn-xs" @click.prevent="hapusperum(lay.id)">Delete</button>
                  </td>
                </tr>
              </table>

                <vue-pagination  v-bind:pagination="pagination"
                     v-on:click.native="ambilperum(pagination.current_page)"
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
              <form method="POST" enc="multipart/form-data" v-on:submit.prevent="tambahperum">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-name" id="myModalLabel">Tambah Data @{{dataBaru.name}}</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="name">Nama  Perumahan:</label>
                  <input type="text" name="name" class="form-control" v-model="dataBaru.name" />
                  <span v-if="errorForm['name']" class="error text-danger">@{{ errorForm['name'] }}</span>
				  
				          <input type="hidden" name="account_id"  class="form-control" v-model.trim="dataBaru.account_id" />
                  <span v-if="errorForm['account_id']" class="error text-danger">@{{ errorForm['account_id'] }}</span>

                  <input type="hidden" name="created_by" class="form-control" v-model="dataBaru.created_by" />
                  <span v-if="errorForm['created_by']" class="error text-danger">@{{ errorForm['created_by'] }}</span>

                  
                
				
				</div>
                
                <div class="form-group">
                  <label for="name">Deskripsi:</label>
                  <input type="text" name="description" class="form-control" v-model="dataBaru.description" />
                  <span v-if="errorForm['description']" class="error text-danger">@{{ errorForm['description'] }}</span>
                </div>
                <div class="form-group">
                  <label for="name">Alamat:</label>
                  <input type="text" name="address" class="form-control" v-model.number="dataBaru.address" />
                  <span v-if="errorForm['address']" class="error text-danger">@{{ errorForm['address'] }}</span>
                </div>
                 <div class="form-group">
                  <label for="name">Kabupaten:</label>
                  <input type="text" name="region" class="form-control" v-model="dataBaru.region" />
                  <span v-if="errorForm['region']" class="error text-danger">@{{ errorForm['region'] }}</span>
                </div>
                 <div class="form-group">
                  <label for="name">Provinsi:</label>
                  <input type="text" name="province" class="form-control" v-model="dataBaru.province" />
                  <span v-if="errorForm['province']" class="error text-danger">@{{ errorForm['province'] }}</span>
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
              <form method="POST" enc="multipart/form-data" v-on:submit.prevent="ubahperum(dataEdit.id)">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-name" id="myModalLabel">Edit Data @{{dataEdit.name_}}</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="name">Nama  Perumahan:</label>
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
                  <label for="name">Alamat:</label>
                  <input type="text" name="address" class="form-control" v-model.number="dataEdit.address" />
                  <span v-if="errorForm['address']" class="error text-danger">@{{ errorForm['address'] }}</span>
                </div>
                  <div class="form-group">
                  <label for="name">Kabupaten:</label>
                  <input type="text" name="region" class="form-control" v-model.number="dataEdit.region" />
                  <span v-if="errorForm['region']" class="error text-danger">@{{ errorForm['region'] }}</span>
                </div>
                <div class="form-group">
                  <label for="name">Provinsi:</label>
                  <input type="text" name="province" class="form-control" v-model.number="dataEdit.province" />
                  <span v-if="errorForm['province']" class="error text-danger">@{{ errorForm['province'] }}</span>
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
                <button type="submit" class="btn btn-primary" @click.prevent="hapuskonfirmperum(hapus_id)">O K</button>
              </div>
            </div>
          </div>
        </div>

      </div>

@push('script')
<script>
    var perum = new Vue({
    el: '#perum',
    data: {
    perum: null,
    dataBaru: {'name':'','description':'','address':'','region':'','province':'','account_id':'{{ Auth::user()->account_id }}','created_by':'{{ Auth::user()->id }}'},
    errorForm:{},
    dataEdit: {'name':'','description':'','address':'','region':'','province':'','updated_by':'{{ Auth::user()->id }}'},
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

        ambilperum:function(page){
      var cari = this.cari ? this.cari : '';
      this.errorForm = {};
            axios.get(base_url+'/api/perum?cari='+cari+'&page='+page).then(response => {
                this.perum = response.data;
          this.pagination = response.data;
            }).catch(errors => {
                console.error(errors);
            })
        },

  tambahperum:function(){
      var input = this.dataBaru;
      axios.post(base_url+'/admin/perum',input).then(response=>{
        this.dataBaru = {'name':'','description':'','logo':'1','address':'','region':'','province':'','account_id':'{{ Auth::user()->account_id }}','created_by':'{{ Auth::user()->account_id }}'};
        $("#tambah-data").modal('hide');
        this.ambilperum(this.perum.current_page);
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

   editperum:function(perum){
      this.dataEdit.id = perum.id;
      this.dataEdit.name = perum.name;
      this.dataEdit.perum_kategori_id = perum.perum_kategori_id;
      this.dataEdit.description = perum.description;
      this.dataEdit.address = perum.address;
      this.dataEdit.region = perum.region;
      this.dataEdit.province = perum.province;
      this.dataEdit.updated_by = '{{ Auth::user()->id }}';
      $('#edit-data').modal('show');
    },

    ubahperum:function(id){
      var input = this.dataEdit;
      axios.patch(base_url+'/admin/perum/'+id,input).then(response => {
        $('#edit-data').modal('hide');
        this.ambilperum(this.perum.current_page);
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

    hapusperum:function(id){
      this.hapus_id = id;
      $('#hapus-data').modal('show');
    },

    hapuskonfirmperum:function(id){
      axios.delete(base_url+'/admin/perum/'+id).then(response => {
        this.ambilperum(this.perum.current_page);
        $('#hapus-data').modal('hide');
      }).catch(errors=>{
        console.error(errors);
      })
    },

    cariperum:function(){
      axios.get(base_url+'/api/perum?cari='+this.cari).then(response => {
        this.perum = response.data;
        this.pagination = response.data;
        console.log(this.pagination);
      }).catch(errors=>{
        console.error(errors);
      })
    }

    },
    created(){
        this.ambilperum(this.pagination.current_page);
    }
});

</script>


@endpush
@endsection

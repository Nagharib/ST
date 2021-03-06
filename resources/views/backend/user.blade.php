@extends('layouts.main')
@section('content')
<!-- @push('header')
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
</ol>
@endpush -->
<div class="row" id="user">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <button class="btn btn-info" data-toggle="modal" data-target="#tambah-data">Tambah  User</button>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 350px;">
                  <input type="text" v-model="cari" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" @click.prevent="cariuser"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th style="white-space: nowrap;">Nama  User</th>
                  <th>Batasan Akses</th>
                  <th>Email</th>
                  <th>Berlaku sampai</th>
                  <th>Aksi</th>
                </tr>
                <tr v-for=" pengguna in user.data">
                  <td>@{{pengguna.name}}</td>
                  <td>@{{pengguna.role_name}}</td>
                  <td>@{{pengguna.email}}</td>
                  <td>@{{pengguna.valid_dateto}}</td>
                  
                  <td style="white-space: nowrap;">
                  	<button class="btn btn-info btn-xs" @click.prevent="edituser(pengguna)">Edit</button>
						        <button class="btn btn-danger btn-xs" @click.prevent="hapususer(pengguna.id)">Delete</button>
                  </td>
                </tr>
              </table>

                <vue-pagination  v-bind:pagination="pagination"
                     v-on:click.native="ambiluser(pagination.current_page)"
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
              <form method="POST" enc="multipart/form-data" v-on:submit.prevent="tambahuser">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-name" id="myModalLabel">Tambah Data @{{dataBaru.name}} @{{dataBaru.username}} @{{dataBaru.nama_belakang}}</h4>

              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-12">
                  
                  <div class="form-group">
                      <label>Nama</label>
                      <div class="row">
                        <div class="col-sm-12">
                         <input class="form-control" name="Nama Pengguna" placeholder="Nama Pengguna"  v-model="dataBaru.name">
                          <span v-if="errorForm['name']" class="error text-danger">@{{ errorForm['name'] }}</span>
                        </div>

                      </div>
                    </div>                  

                  <div class="form-group">
                      <label>Berlaku Sampai:</label>
                      <div class="row">
                        <div class="col-sm-6">
                         <input type='date' class="form-control" name="valid_dateto"  v-model="dataBaru.valid_dateto">
                          <span v-if="errorForm['valid_dateto']" class="error text-danger">@{{ errorForm['valid_dateto'] }}</span>
                        </div>
                        <div class="col-sm-6">
                          <input class="form-control" name="username" placeholder="Username"  v-model="dataBaru.username">
                           <span v-if="errorForm['username']" class="error text-danger">@{{ errorForm['username'] }}</span>
                        </div>
                      </div>
                    </div>


                    <div class="form-group">
                      <!--<label>Nama User</label>-->
                      <label>Pilih Dari:</label>
                      <div class="row">
                        <div class="col-sm-6">
                         <!-- 
                         <input class="form-control" name="Nama Pengguna" placeholder="Nama Pengguna"  v-model="dataBaru.name">
                          <span v-if="errorForm['name']" class="error text-danger">@{{ errorForm['name'] }}</span>-->
                        <select id='yui' class="form-control">
                          <option value=""></option>
                          <option  value="1">Pelanggan</option>
                          <option value="2">Karyawan</option>
                          
                        </select>
                        

                        </div>

                        <div id='show1' class="col-sm-6"><!--
                          <input class="form-control" name="username" placeholder="Username"  v-model="dataBaru.username">

                          <input type="hidden" name="_token" value="{{ csrf_token() }}">

                           <span v-if="errorForm['username']" class="error text-danger">@{{ errorForm['username'] }}</span>-->
                          
                          <select class="form-control">
                          <option value=""></option>
                        </select>
                        </div>

                        <div id='pelanggan' class="col-sm-6"><!--
                          <input class="form-control" name="username" placeholder="Username"  v-model="dataBaru.username">

                          <input type="hidden" name="_token" value="{{ csrf_token() }}">

                           <span v-if="errorForm['username']" class="error text-danger">@{{ errorForm['username'] }}</span>-->
                          
                          <select @change="perumahan" v-model="dataBaru.iduser" class="form-control">
                          <option value=""></option>
                          <option v-for="perumahan in perumahans" v-bind:value="perumahan.id">
                            @{{ perumahan.first_name }}
                          </option>
                        </select>
                        </div> 

                          <div id='karyawan' class="col-sm-6"><!--
                          <input class="form-control" name="username" placeholder="Username"  v-model="dataBaru.username">

                          <input type="hidden" name="_token" value="{{ csrf_token() }}">

                           <span v-if="errorForm['username']" class="error text-danger">@{{ errorForm['username'] }}</span>-->
                          
                          <select @change="karyawan" v-model="dataBaru.iduser" class="form-control">
                          <option value=""></option>
                          <option v-for="karyawan in karyawans" v-bind:value="karyawan.id">
                            @{{ karyawan.first_name }}
                          </option>
                        </select>
                        </div>


                      </div>
                    </div>
                     <div id='role_show1' class="form-group">
                      <label>Batasan Akses</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <select class="form-control" name="role_id" v-model="dataBaru.role_id">
                            <option value="0" >Pilih Role</option>
                           
                          </select>
                           <span v-if="errorForm['role_id']" class="error text-danger">@{{ errorForm['role_id'] }}</span>
                        </div>
                        <div class="col-sm-6">
                          <input type="password" class="form-control" name="password" placeholder="Password"  v-model="dataBaru.password">
                           <span v-if="errorForm['password']" class="error text-danger">@{{ errorForm['password'] }}</span>
                        </div>
                      </div>
                    </div>                    

                    <div id='role_pelanggan' class="form-group">
                      <label>Batasan Akses</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <select class="form-control" name="role_id" v-model="dataBaru.role_id">
                            <option value="0" >Pilih Role asd</option>
                           
                          </select>
                           <span v-if="errorForm['role_id']" class="error text-danger">@{{ errorForm['role_id'] }}</span>
                        </div>
                        <div class="col-sm-6">
                          <input type="password" class="form-control" name="password" placeholder="Password"  v-model="dataBaru.password">
                           <span v-if="errorForm['password']" class="error text-danger">@{{ errorForm['password'] }}</span>
                        </div>
                      </div>
                    </div>                    

                    <div id='role_karyawan' class="form-group">
                      <label>Batasan Akses</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <select class="form-control" name="role_id" v-model="dataBaru.role_id">
                            <option value="0" >Pilih Role</option>
                            @foreach($user_roles as $key=>$role)
                            <option value="{{$key}}">{{$role}}</option>
                            @endforeach
                          </select>
                           <span v-if="errorForm['role_id']" class="error text-danger">@{{ errorForm['role_id'] }}</span>
                        </div>
                        <div class="col-sm-6">
                          <input type="password" class="form-control" name="password" placeholder="Password"  v-model="dataBaru.password">
                           <span v-if="errorForm['password']" class="error text-danger">@{{ errorForm['password'] }}</span>
                        </div>
                      </div>
                    </div>
                  
                  </div>
                  
                  <div class="col-sm-12">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6">
                          <label>Nomor Telp / Handphone</label>
                          <input class="form-control" name="no_telp"  v-model="dataBaru.no_telp">
                           <span v-if="errorForm['no_telp']" class="error text-danger">@{{ errorForm['no_telp'] }}</span>
                        </div>
                        <div class="col-sm-6">
                          <label>Email</label>
                          <input type="email" class="form-control" name="email" v-model="dataBaru.email">
                           <span v-if="errorForm['email']" class="error text-danger">@{{ errorForm['email'] }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
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
              <form method="POST" enc="multipart/form-data" v-on:submit.prevent="ubahuser(dataEdit.id)">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-name" id="myModalLabel">Edit Data @{{dataEdit.name}}}</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Nama User</label>
                      <div class="row">
                        <div class="col-sm-6">
                         <input class="form-control" name="Nama Pengguna" placeholder="Nama Pengguna"  v-model="dataEdit.name">
                          <span v-if="errorForm['name']" class="error text-danger">@{{ errorForm['name'] }}</span>
                        </div>
                        <div class="col-sm-6">
                          <input class="form-control" name="username" placeholder="Username"  v-model="dataEdit.username" disabled>
                           <span v-if="errorForm['username']" class="error text-danger">@{{ errorForm['username'] }}</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Batasan Akses</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <select class="form-control" name="role_id" v-model="dataEdit.role_id">
                            <option value="0" >Pilih Role</option>
                            @foreach($user_roles as $key=>$role)
                            <option value="{{$key}}">{{$role}}</option>
                            @endforeach
                          </select>
                           <span v-if="errorForm['role_id']" class="error text-danger">@{{ errorForm['role_id'] }}</span>
                        </div>
                        <div class="col-sm-6">
                          <input type="password" class="form-control" name="password" placeholder="Password"  v-model="dataEdit.password">
                           <span v-if="errorForm['password']" class="error text-danger">@{{ errorForm['password'] }}</span>
                        </div>
                      </div>
                    </div>
                
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6">
                          <label>Nomor Telp / Handphone</label>
                          <input class="form-control" name="no_telp"  v-model="dataEdit.no_telp">
                           <span v-if="errorForm['no_telp']" class="error text-danger">@{{ errorForm['no_telp'] }}</span>
                        </div>
                        <div class="col-sm-6">
                          <label>Email</label>
                          <input type="email" class="form-control" name="email" v-model="dataEdit.email">
                           <span v-if="errorForm['email']" class="error text-danger">@{{ errorForm['email'] }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
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
                <button type="submit" class="btn btn-primary" @click.prevent="hapuskonfirmuser(hapus_id)">O K</button>
              </div>
            </div>
          </div>
        </div>

      </div>

@push('script')
<script>
	var user = new Vue({
	el: '#user',
	data: {

    user: null,
    dataBaru: {'name':'','role_id':'KTP','username':'','nama_belakang':'','account_id':'{{ Auth::user()->account_id }}','user_primary_flag':'N','valid_dateto':''},
    errorForm:{},
    dataEdit: {'name':'','role_id':'KTP','username':'','nama_belakang':''},
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
     karyawans: [],
    hapus_id:null
	 },
   
   mounted() {
      // get all perumahans data
      axios.get('/userp/userpilih').then(response => {
        this.perumahans = response.data;
      }).catch(error => console.error(error));

      axios.get('/userp/userpilih2').then(response => {
        this.karyawans = response.data;
      }).catch(error => console.error(error));      
    },
      
        
	methods: {


perumahan() {
        

      },    

		ambiluser:function(page){
      var cari = this.cari ? this.cari : '';
      this.errorForm = {};
 			axios.get(base_url+'/api/user?cari='+cari+'&page='+page).then(response => {
    			this.user = response.data;
          this.pagination = response.data;
    		}).catch(errors => {
    			console.error(errors);
    		})
		},

    tambahuser:function(){
      var input = this.dataBaru;
      axios.post(base_url+'/admin/user',input).then(response=>{
        this.dataBaru = {'name':'','role_id':'KTP','account_id':'{{ Auth::user()->account_id }}','user_primary_flag':'N','valid_dateto':''};
        $("#tambah-data").modal('hide');
        this.ambiluser(this.user.current_page);
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

    edituser:function(user){
      this.dataEdit = user
      $('#edit-data').modal('show');
    },

    ubahuser:function(id){
      var input = this.dataEdit;
      axios.patch(base_url+'/admin/user/'+id,input).then(response => {
        $('#edit-data').modal('hide');
        this.ambiluser(this.user.current_page);
      }).catch(errors=>{
        console.error(errros);
      })
    },

    hapususer:function(id){
      this.hapus_id = id;
      $('#hapus-data').modal('show');
    },

    hapuskonfirmuser:function(id){
      axios.delete(base_url+'/admin/user/'+id).then(response => {
        this.ambiluser(this.user.current_page);
        $('#hapus-data').modal('hide');
      }).catch(errors=>{
        console.error(errors);
      })
    },

    cariuser:function(){
      axios.get(base_url+'/api/user?cari='+this.cari).then(response => {
        this.user = response.data;
        this.pagination = response.data;
        console.log(this.pagination);
      }).catch(errors=>{
        console.error(errors);
      })
    }

	},
	created(){
		this.ambiluser(this.pagination.current_page);
	}
});

</script>

<script src="jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#pelanggan').hide();
  $('#karyawan').hide();
  $('#role_karyawan').hide();
  $('#role_pelanggan').hide();

  $('#yui').change(function(){
            var optionValue = $(this).val();
            if(optionValue=='1'){
                $('#pelanggan').show();
                $('#karyawan').hide();
                $('#role_pelanggan').show();
                $('#role_karyawan').hide();
                 $('#role_show1').hide();                
                $('#show1').hide();
            } else{
                 $('#karyawan').show();
                 $('#role_karyawan').show();
                 $('#role_pelanggan').hide();
                 $('#role_show1').hide();
                $('#show1').hide();
                $('#pelanggan').hide();
            }    
    });
});

</script>

@endpush
@endsection

@extends('layouts.main')
@section('content')
<div class="row" id="employee">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <button class="btn btn-info" data-toggle="modal" data-target="#tambah-data">Tambah  Karyawan</button>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 350px;">
                  <input type="text" v-model="cari" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" @click.prevent="cariemployee"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
           <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th style="white-space: nowrap;">Nama  Karyawan</th>
                  <th>Nomor Karyawan</th>
                  <th>Alamat</th>
                  <th>Kabupaten</th>
                  <th>Aksi</th>
                </tr>
                <tr v-for=" lay in employee.data">
                  <td>@{{lay.first_name}}</td>
                  <td>@{{lay.cust_number}}</td>
                  <td>@{{lay.address_1}}</td>
                  <td>@{{lay.city}}</td>
                  <td style="white-space: nowrap;">
                    <button class="btn btn-info btn-xs" @click.prevent="editemployee(lay)">Edit</button>
                                <button class="btn btn-danger btn-xs" @click.prevent="hapusemployee(lay.id)">Delete</button>
                  </td>
                </tr>
              </table>

                <vue-pagination  v-bind:pagination="pagination"
                     v-on:click.native="ambilemployee(pagination.current_page)"
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
              <form method="POST" enc="multipart/form-data" v-on:submit.prevent="tambahemployee">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-name" id="myModalLabel">Tambah Data @{{dataBaru.first_name}}</h4>
              </div>
              <div class="modal-body">
                <div class="form-group col-xs-6">
                  <label for="name">Nama  Depan:</label>
                  <input type="text" name="first_name" class="form-control" v-model="dataBaru.first_name" />
                  <span v-if="errorForm['first_name']" class="error text-danger">@{{ errorForm['first_name'] }}</span>
				  
				          <input type="hidden" name="account_id"  class="form-control" v-model.trim="dataBaru.account_id" />
                  <span v-if="errorForm['account_id']" class="error text-danger">@{{ errorForm['account_id'] }}</span>

                  <input type="hidden" name="created_by" class="form-control" v-model="dataBaru.created_by" />
                  <span v-if="errorForm['created_by']" class="error text-danger">@{{ errorForm['created_by'] }}</span>
				          </div>
                
                <div class="form-group col-xs-6">
                  <label for="name">Nama Belakang:</label>
                  <input type="text" name="last_name" class="form-control" v-model="dataBaru.last_name" />
                  <span v-if="errorForm['last_name']" class="error text-danger">@{{ errorForm['last_name'] }}</span>
                </div>
                <div class="form-group col-xs-6">
                  <label for="name">Tanggal Lahir:</label>
                  <input type="date" name="birth_date" class="form-control" v-model="dataBaru.birth_date" />
                  <span v-if="errorForm['birth_date']" class="error text-danger">@{{ errorForm['birth_place'] }}</span>
                </div>                
                <div class="form-group col-xs-6">
                  <label for="name">Tempat Lahir:</label>
                  <input type="text" name="birth_place" class="form-control" v-model.number="dataBaru.birth_place" />
                  <span v-if="errorForm['birth_place']" class="error text-danger">@{{ errorForm['birth_place'] }}</span>
                </div>                
                <div class="form-group col-xs-6">
                  <label for="name">Alamat:</label>
                  <input type="text" name="address_1" class="form-control" v-model="dataBaru.address_1" />
                  <span v-if="errorForm['address_1']" class="error text-danger">@{{ errorForm['address_1'] }}</span>
                </div>
                <div class="form-group col-xs-6">
                  <label for="name">Desa:</label>
                  <input type="text" name="address_2" class="form-control" v-model="dataBaru.address_2" />
                  <span v-if="errorForm['address_2']" class="error text-danger">@{{ errorForm['address_2'] }}</span>
                </div>
                <div class="form-group col-xs-6">
                  <label for="name">Kecamatan:</label>
                  <input type="text" name="address_3" class="form-control" v-model="dataBaru.address_3" />
                  <span v-if="errorForm['address_3']" class="error text-danger">@{{ errorForm['address_3'] }}</span>
                </div>                                 
                 <div class="form-group col-xs-6">
                  <label for="name">Kabupaten/Kota:</label>
                  <input type="text" name="city" class="form-control" v-model="dataBaru.city" />
                  <span v-if="errorForm['city']" class="error text-danger">@{{ errorForm['city'] }}</span>
                </div>
                 <div class="form-group col-xs-6">
                  <label for="name">Provinsi:</label>
                  <input type="text" name="province" class="form-control" v-model="dataBaru.province" />
                  <span v-if="errorForm['province']" class="error text-danger">@{{ errorForm['province'] }}</span>
                </div>
              <div class="form-group col-xs-6">
                  <label for="name">Negara:</label>
                  <input type="text" name="country" class="form-control" v-model="dataBaru.country" />
                  <span v-if="errorForm['country']" class="error text-danger">@{{ errorForm['country'] }}</span>
                </div>                
                <div class="form-group col-xs-6">
                  <label for="name">Kode Pos:</label>
                  <input type="text" name="zip_code" class="form-control" v-model="dataBaru.zip_code" />
                  <span v-if="errorForm['zip_code']" class="error text-danger">@{{ errorForm['zip_code'] }}</span>
                </div>  
                <div class="form-group col-xs-6">
                  <label for="name">Agama:</label>
                  <select class="form-control" name="religion" v-model="dataBaru.religion">
                            <option value="Islam" >Islam</option>
                            <option value="Kristen" >Kristen</option>
                            <option value="Hindu" >Hindu</option>
                            <option value="Kong Hu Cu" >Kong Hu Cu</option>
                          </select>                  
                  <span v-if="errorForm['religion']" class="error text-danger">@{{ errorForm['religion'] }}</span>
                </div> 
                <div class="form-group col-xs-6">
                  <label for="name">Status:</label>
                  <select class="form-control" name="married_status" v-model="dataBaru.married_status">
                            <option value="Menikah" >Menikah</option>
                            <option value="Lajang" >Lajang</option>
                  </select>                  
                  
                  <span v-if="errorForm['married_status']" class="error text-danger">@{{ errorForm['married_status'] }}</span>
                </div>   
                <div class="form-group col-xs-6">
                  <label for="name">Pekerjaan:</label>
                  <input type="text" name="occupation" class="form-control" v-model="dataBaru.occupation" />
                  <span v-if="errorForm['occupation']" class="error text-danger">@{{ errorForm['occupation'] }}</span>
                </div> 
                <div class="form-group col-xs-6">
                  <label for="name">Kebangsaan:</label>
                  <input type="text" name="nationality" class="form-control" v-model="dataBaru.nationality" />
                  <span v-if="errorForm['nationality']" class="error text-danger">@{{ errorForm['nationality'] }}</span>
                </div>  

				<div class="form-group col-xs-6">
                  <label for="name">No Telepon:</label>
                  <input type="text" name="phone_number" class="form-control" v-model="dataBaru.phone_number" />
                  <span v-if="errorForm['phone_number']" class="error text-danger">@{{ errorForm['phone_number'] }}</span>
                </div>                 
				<div class="form-group col-xs-6">
                  <label for="name">No HP:</label>
                  <input type="text" name="mobile_number" class="form-control" v-model="dataBaru.mobile_number" />
                  <span v-if="errorForm['mobile_number']" class="error text-danger">@{{ errorForm['mobile_number'] }}</span>
                </div>                 
				<div class="form-group col-xs-6">
                  <label for="name">email:</label>
                  <input type="text" name="email" class="form-control" v-model="dataBaru.email" />
                  <span v-if="errorForm['email']" class="error text-danger">@{{ errorForm['email'] }}</span>
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
              <form method="POST" enc="multipart/form-data" v-on:submit.prevent="ubahemployee(dataEdit.id)">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-name" id="myModalLabel">Edit Data @{{dataEdit.first_name}}</h4>
              </div>
              <div class="modal-body">
                <div class="form-group col-xs-6">
                  <label for="name">Nama  Depan:</label>
                  <input type="text" name="first_name" class="form-control" v-model="dataEdit.first_name" />
                  <span v-if="errorForm['first_name']" class="error text-danger">@{{ errorForm['first_name'] }}</span>

                  <input type="hidden" name="updated_by" class="form-control" v-model="dataEdit.updated_by" />
                  <span v-if="errorForm['updated_by']" class="error text-danger">@{{ errorForm['updated_by'] }}</span>
                </div>
               
                <div class="form-group col-xs-6">
                  <label for="name">Nama Belakang:</label>
                  <input type="text" name="last_name" class="form-control" v-model="dataEdit.last_name" />
                  <span v-if="errorForm['last_name']" class="error text-danger">@{{ errorForm['last_name'] }}</span>
                </div>
                <div class="form-group col-xs-6">
                  <label for="name">Tanggal Lahir:</label>
                  <input type="date" name="birth_date" class="form-control" v-model="dataEdit.birth_date" />
                  <span v-if="errorForm['birth_date']" class="error text-danger">@{{ errorForm['birth_place'] }}</span>
                </div>                
                <div class="form-group col-xs-6">
                  <label for="name">Tempat Lahir:</label>
                  <input type="text" name="birth_place" class="form-control" v-model.number="dataEdit.birth_place" />
                  <span v-if="errorForm['birth_place']" class="error text-danger">@{{ errorForm['birth_place'] }}</span>
                </div>                
                <div class="form-group col-xs-6">
                  <label for="name">Alamat:</label>
                  <input type="text" name="address_1" class="form-control" v-model="dataEdit.address_1" />
                  <span v-if="errorForm['address_1']" class="error text-danger">@{{ errorForm['address_1'] }}</span>
                </div>
                <div class="form-group col-xs-6">
                  <label for="name">Desa:</label>
                  <input type="text" name="address_2" class="form-control" v-model="dataEdit.address_2" />
                  <span v-if="errorForm['address_2']" class="error text-danger">@{{ errorForm['address_2'] }}</span>
                </div>
                <div class="form-group col-xs-6">
                  <label for="name">Kecamatan:</label>
                  <input type="text" name="address_3" class="form-control" v-model="dataEdit.address_3" />
                  <span v-if="errorForm['address_3']" class="error text-danger">@{{ errorForm['address_3'] }}</span>
                </div>                                 
                 <div class="form-group col-xs-6">
                  <label for="name">Kabupaten/Kota:</label>
                  <input type="text" name="city" class="form-control" v-model="dataEdit.city" />
                  <span v-if="errorForm['city']" class="error text-danger">@{{ errorForm['city'] }}</span>
                </div>
                 <div class="form-group col-xs-6">
                  <label for="name">Provinsi:</label>
                  <input type="text" name="province" class="form-control" v-model="dataEdit.province" />
                  <span v-if="errorForm['province']" class="error text-danger">@{{ errorForm['province'] }}</span>
                </div>
              <div class="form-group col-xs-6">
                  <label for="name">Negara:</label>
                  <input type="text" name="country" class="form-control" v-model="dataEdit.country" />
                  <span v-if="errorForm['country']" class="error text-danger">@{{ errorForm['country'] }}</span>
                </div>                
                <div class="form-group col-xs-6">
                  <label for="name">Kode Pos:</label>
                  <input type="text" name="zip_code" class="form-control" v-model="dataEdit.zip_code" />
                  <span v-if="errorForm['zip_code']" class="error text-danger">@{{ errorForm['zip_code'] }}</span>
                </div>  
                <div class="form-group col-xs-6">
                  <label for="name">Agama:</label>
                  <select class="form-control" name="religion" v-model="dataEdit.religion">
                            <option value="Islam" >Islam</option>
                            <option value="Kristen" >Kristen</option>
                            <option value="Hindu" >Hindu</option>
                            <option value="Kong Hu Cu" >Kong Hu Cu</option>
                          </select>                  
                  <span v-if="errorForm['religion']" class="error text-danger">@{{ errorForm['religion'] }}</span>
                </div> 
                <div class="form-group col-xs-6">
                  <label for="name">Status:</label>
                  <select class="form-control" name="married_status" v-model="dataEdit.married_status">
                            <option value="Menikah" >Menikah</option>
                            <option value="Lajang" >Lajang</option>
                  </select>                  
                  
                  <span v-if="errorForm['married_status']" class="error text-danger">@{{ errorForm['married_status'] }}</span>
                </div>   
                <div class="form-group col-xs-6">
                  <label for="name">Pekerjaan:</label>
                  <input type="text" name="occupation" class="form-control" v-model="dataEdit.occupation" />
                  <span v-if="errorForm['occupation']" class="error text-danger">@{{ errorForm['occupation'] }}</span>
                </div> 
                <div class="form-group col-xs-6">
                  <label for="name">Kebangsaan:</label>
                  <input type="text" name="nationality" class="form-control" v-model="dataEdit.nationality" />
                  <span v-if="errorForm['nationality']" class="error text-danger">@{{ errorForm['nationality'] }}</span>
                </div>  

<div class="form-group col-xs-6">
                  <label for="name">No Telepon:</label>
                  <input type="text" name="phone_number" class="form-control" v-model="dataEdit.phone_number" />
                  <span v-if="errorForm['phone_number']" class="error text-danger">@{{ errorForm['phone_number'] }}</span>
                </div>                 
<div class="form-group col-xs-6">
                  <label for="name">No HP:</label>
                  <input type="text" name="mobile_number" class="form-control" v-model="dataEdit.mobile_number" />
                  <span v-if="errorForm['mobile_number']" class="error text-danger">@{{ errorForm['mobile_number'] }}</span>
                </div>                 
<div class="form-group col-xs-6">
                  <label for="name">email:</label>
                  <input type="text" name="email" class="form-control" v-model="dataEdit.email" />
                  <span v-if="errorForm['email']" class="error text-danger">@{{ errorForm['email'] }}</span>
                </div>

               
                 
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
              </form>
            </div>
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
                <button type="submit" class="btn btn-primary" @click.prevent="hapuskonfirmemployee(hapus_id)">O K</button>
              </div>
            </div>
          </div>
        </div>

      </div>
      

@push('script')
<script>
    var employee = new Vue({
    el: '#employee',
    data: {
    employee: null,
    dataBaru: {
      'account_id':'{{ Auth::user()->account_id }}',
      'first_name':'',
      'last_name':'',
      'birth_date':'',
      'birth_place':'',
      'address_1':'',
      'address_2':'',
      'address_3':'',
      'country':'',
      'province':'',
      'city':'',
      'zip_code':'',
      'religion':'',
      'married_status':'',
      'occupation':'',
      'nationality':'',
      'phone_number':'',
      'mobile_number':'',
      'email':'',
      'created_by':'{{ Auth::user()->id }}',
      'is_employee':'N',
      'is_employee':'Y'
    },
    errorForm:{},
    dataEdit: {'first_name':'','last_name':'','birth_date':'','birth_place':'','address_1':'','address_2':'','address_3':'','country':'','province':'','city':'','zip_code':'','religion':'','married_status':'','occupation':'','nationality':'','phone_number':'','mobile_number':'','email':'','updated_by':'{{ Auth::user()->id }}'},
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

        ambilemployee:function(page){
      var cari = this.cari ? this.cari : '';
      this.errorForm = {};
            axios.get(base_url+'/api/employee?cari='+cari+'&page='+page).then(response => {
                this.employee = response.data;
          this.pagination = response.data;
            }).catch(errors => {
                console.error(errors);
            })
        },

  tambahemployee:function(){
      var input = this.dataBaru;
      axios.post(base_url+'/admin/employee',input).then(response=>{
        this.dataBaru = {
          'account_id':'{{ Auth::user()->account_id }}',
          'first_name':'',
          'last_name':'',
          'birth_date':'',
          'birth_place':'',
          'address_1':'',
          'address_2':'',
          'address_3':'',
          'country':'',
          'province':'',
          'city':'',
          'zip_code':'',
          'religion':'',
          'married_status':'',
          'occupation':'',
          'nationality':'',
          'phone_number':'',
          'mobile_number':'',
          'email':'',
          'created_by':'{{ Auth::user()->account_id }}',
          'is_employee':'N',
          'is_employee':'Y'};
        $("#tambah-data").modal('hide');
        this.ambilemployee(this.employee.current_page);
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

   editemployee:function(employee){
      this.dataEdit.id = employee.id;
      this.dataEdit.first_name= employee.first_name;
      this.dataEdit.last_name= employee.last_name;
          this.dataEdit.birth_date= employee.birth_date;
          this.dataEdit.birth_place= employee.birth_place;
          this.dataEdit.address_1= employee.address_1;
          this.dataEdit.address_2= employee.address_2;
          this.dataEdit.address_3= employee.address_3;
          this.dataEdit.country= employee.country;
          this.dataEdit.province= employee.province;
          this.dataEdit.city= employee.city;
          this.dataEdit.zip_code= employee.zip_code;
          this.dataEdit.religion= employee.religion;
          this.dataEdit.married_status= employee.married_status;
          this.dataEdit.occupation= employee.occupation;
          this.dataEdit.nationality= employee.nationality;
          this.dataEdit.phone_number= employee.phone_number;
          this.dataEdit.mobile_number= employee.mobile_number;
          this.dataEdit.email= employee.email;

      this.dataEdit.updated_by = '{{ Auth::user()->id }}';
      $('#edit-data').modal('show');
    },

    ubahemployee:function(id){
      var input = this.dataEdit;
      axios.patch(base_url+'/admin/employee/'+id,input).then(response => {
        $('#edit-data').modal('hide');
        this.ambilemployee(this.employee.current_page);
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

    hapusemployee:function(id){
      this.hapus_id = id;
      $('#hapus-data').modal('show');
    },

    hapuskonfirmemployee:function(id){
      axios.delete(base_url+'/admin/employee/'+id).then(response => {
        this.ambilemployee(this.employee.current_page);
        $('#hapus-data').modal('hide');
      }).catch(errors=>{
        console.error(errors);
      })
    },

    cariemployee:function(){
      axios.get(base_url+'/api/employee?cari='+this.cari).then(response => {
        this.employee = response.data;
        this.pagination = response.data;
        console.log(this.pagination);
      }).catch(errors=>{
        console.error(errors);
      })
    }

    },
    created(){
        this.ambilemployee(this.pagination.current_page);
    }
});

</script>


@endpush
@endsection

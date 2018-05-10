@extends('layouts.main')
@section('content')

<style type="text/css">

/* make gutter sizes consistent */
.flex-row  {
    padding-left: 15px;
    padding-right: 15px;
}

/* 
  Extra Small Devices, Phones { .col-xs-$ } 
    ~ 480px to 767px ~

  Extra Small Devices, Phones { .col-sm-$ } 
    ~ 768px to 991px ~

  Extra Small Devices, Phones { .col-md-$ } 
    ~ 992 to 1200px ~

  Extra Small Devices, Phones { .col-lg-$ } 
    ~ 1201px up ~
 */
  
/* Extra Media Query Below for Retina Iphones and Smaller */
@media only screen and (max-width : 480px){
  .flex-row > [class*='col-'] {
      width: 100%;
  }
  .flex-row  {
    padding-left: 0px;
    padding-right: 0px;
  }
}

.flex-row {
  display: flex;
  flex-wrap: wrap;
}
.flex-row > [class*='col-'] {
  display: flex;
  flex-direction: column;
}

.flex-row .thumbnail,
.flex-row .caption {
  flex-direction: column;
  display: flex;
  flex: 1 0 auto;
  height: auto;
  position: relative;
}
.flex-text {
  flex-grow: 1;
}
.flex-row img {
  min-width: 0;
  width: 100%;
}
</style>
<style>
  .hoverbtn {
    position: absolute;
    top: 8px;
    right: 16px;
    font-size: 20px;
    width: 25px;
    
}  
  </style>
<div class="row" id="hotel">
        <div class="col-xs-12">
          <div class="box">

            <div class="box-header">
              <a target="_blank" href="tambahhotel"><button class="btn btn-info">Tambah  Hotel</button></a>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 350px;">
                  <input type="text" v-model="cari" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" @click.prevent="carihotel"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
           <!-- /.box-header -->

        <!-- TAMPILAN -->
          <div class="bs-example" data-example-id="thumbnails-with-custom-content"> <div class="row"> 

            <!-- LOOPINGKN -->
            <!-- @foreach ($thumbnails as $thumbnail)
            <div class="col-sm-6 col-md-4"> 
              <div class="thumbnail"> 
                <img alt="100%x200" data-src="holder.js/100%x200" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMzE5IiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDMxOSAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTYxZTQ5MTlkYzggdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxNnB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNjFlNDkxOWRjOCI+PHJlY3Qgd2lkdGg9IjMxOSIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMTcuOTg0Mzc1IiB5PSIxMDcuMiI+MzE5eDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;"> 
                <div class="caption">
                
                  <h3>{{ $thumbnail->hotel_name }}</h3> 
                  <p>{{ $thumbnail->description }}</p> 

                  <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p> 
                </div> 
              </div> 
            </div>
            @endforeach -->


            <div class="container">


    <!-- <div id="products" class="row list-group">
      @foreach ($thumbnails as $thumbnail)
        <div class="item  col-xs-3 col-lg-3">
            <div class="thumbnail">
                <img class="group list-group-image" src="{{ Storage::url( $thumbnail->file_name)}}" style="width: 178px;" alt="" />
                <div class="caption">
                    <h4 class="group inner list-group-item-heading">
                        {{ $thumbnail->hotel_name }}</h4>
                    <p class="group inner list-group-item-text">
                        {{ $thumbnail->description }}</p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <p class="lead">
                                Rp.{{  $thumbnail->unit_price - ($thumbnail->unit_price * $thumbnail->disc_price * 0.1)   }} 
                                Disc ( {{ $thumbnail->disc_price }} )%</p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  @endforeach

    </div> -->

    <div class="flex-row row">

    @foreach ($thumbnails as $thumbnail)
    <div class="col-xs-6 col-sm-4 col-lg-3">
      <div class="thumbnail">
        <div class='hoverbtn'>
        <button type="submit">
                     <a href='{{route('api.deleteHotel', ['id' => $thumbnail->id]) }}'> <i class="fa fa-trash"></i> </a>
                    </button>
        </div>

        <img class="group list-group-image" src="{{ Storage::url( $thumbnail->file_name)}}" style="width: 200px; height: 170px" alt="" />
        
                       
                 
        <div class="caption">
          <h3>{{ $thumbnail->hotel_name }}</h3>
          <p class="flex-text text-muted">{{ $thumbnail->description }}
          </p>
          <p class="lead">
                                Rp.{{  number_format($thumbnail->unit_price - ($thumbnail->unit_price * $thumbnail->disc_price / 100),0)   }} 
                                Disc ( {{ $thumbnail->disc_price }} )%</p>
          <p><a class="btn btn-primary" href="{{route('api.editHotel', ['id' => $thumbnail->id]) }}">Edit</a></p>
        </div>
        <!-- /.caption -->
      </div>
      <!-- /.thumbnail -->
    </div>
    @endforeach

  </div>

</div>

            <!-- END LOOPINGKN -->

           </div> 
         </div>
        <!-- END TAMPIILAN -->
           <!--  <div class="box-body table-responsive no-padding">


              <table class="table table-hover">
                <tr>
                  <th style="white-space: nowrap;">Nama  hotel</th>
                  <th>Harga</th>
                  <th>Disc</th>
                  <th>Deskripsi</th>
                  <th>Alamat</th>
                  <th>Kota</th>
                  <th>Aksi</th>
                </tr>
                <tr v-for=" lay in hotel.data">
                  <td>@{{lay.hotel_name}}</td>
                  <td>@{{lay.unit_price}}</td>
                  <td>@{{lay.disc_price}}%</td>
                  <td>@{{lay.description}}</td>
                  <td>@{{lay.address}}</td>
                  <td>@{{lay.city}}</td>
                  <td style="white-space: nowrap;">
                    <button class="btn btn-info btn-xs" @click.prevent="edithotel(lay)">Edit</button>
                                <button class="btn btn-danger btn-xs" @click.prevent="hapushotel(lay.id)">Delete </button>
                  </td>
                </tr>
              </table>

                <vue-pagination  v-bind:pagination="pagination"
                     v-on:click.native="ambilhotel(pagination.current_page)"
                     :offset="4">
                </vue-pagination>
            </div> -->
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

       
        <!-- Model Edit -->
        <div class="modal fade" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form method="POST" enc="multipart/form-data" v-on:submit.prevent="ubahhotel(dataEdit.id)">

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
                <button type="submit" class="btn btn-primary" @click.prevent="hapuskonfirmhotel(hapus_id)">O K</button>
              </div>
            </div>
          </div>
        </div>

      </div>

@push('script')
<script>
    var hotel = new Vue({
    el: '#hotel',
    data: {
    hotel: null,
    dataBaru: {
      'account_id':'{{ Auth::user()->account_id }}',
      'hotel_name':'',
      'description':'',
      'address':'',
      'city':'',
      'region':'',
      'province':''
      },
    errorForm:{},
    dataEdit: {'hotel_name':'','description':'','address':'','city':'','region':'','province':'','updated_by':'{{ Auth::user()->id }}'},
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

        ambilhotel:function(page){
      var cari = this.cari ? this.cari : '';
      this.errorForm = {};
            axios.get(base_url+'/api/hotel?cari='+cari+'&page='+page).then(response => {
                this.hotel = response.data;
          this.pagination = response.data;
            }).catch(errors => {
                console.error(errors);
            })
        },

  

   edithotel:function(hotel){
      this.dataEdit.id = hotel.id;
      this.dataEdit.first_name= hotel.first_name;
      this.dataEdit.last_name= hotel.last_name;
          this.dataEdit.birth_date= hotel.birth_date;
          this.dataEdit.birth_place= hotel.birth_place;
          this.dataEdit.address_1= hotel.address_1;
          this.dataEdit.address_2= hotel.address_2;
          this.dataEdit.address_3= hotel.address_3;
          this.dataEdit.country= hotel.country;
          this.dataEdit.province= hotel.province;
          this.dataEdit.city= hotel.city;
          this.dataEdit.zip_code= hotel.zip_code;
          this.dataEdit.religion= hotel.religion;
          this.dataEdit.married_status= hotel.married_status;
          this.dataEdit.occupation= hotel.occupation;
          this.dataEdit.nationality= hotel.nationality;
          this.dataEdit.phone_number= hotel.phone_number;
          this.dataEdit.mobile_number= hotel.mobile_number;
          this.dataEdit.email= hotel.email;

      this.dataEdit.updated_by = '{{ Auth::user()->id }}';
      $('#edit-data').modal('show');
    },

    ubahhotel:function(id){
      var input = this.dataEdit;
      axios.patch(base_url+'/admin/hotel/'+id,input).then(response => {
        $('#edit-data').modal('hide');
        this.ambilhotel(this.hotel.current_page);
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

    hapushotel:function(id){
      this.hapus_id = id;
      $('#hapus-data').modal('show');
    },

    hapuskonfirmhotel:function(id){
      axios.delete(base_url+'/admin/hotel/'+id).then(response => {
        this.ambilhotel(this.hotel.current_page);
        $('#hapus-data').modal('hide');
      }).catch(errors=>{
        console.error(errors);
      })
    },

    carihotel:function(){
      axios.get(base_url+'/api/hotel?cari='+this.cari).then(response => {
        this.hotel = response.data;
        this.pagination = response.data;
        console.log(this.pagination);
      }).catch(errors=>{
        console.error(errors);
      })
    }

    },
    created(){
        this.ambilhotel(this.pagination.current_page);
    }
});

</script>


@endpush
@endsection

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
              <a target="_blank" href="tambahroom"><button class="btn btn-info">Tambah Kamar Hotel</button></a>
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

            <div class="container">

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
          <h3>{{ $thumbnail->room_name }}</h3>
          <p class="flex-text text-muted">{{ $thumbnail->description }}
          </p>
          <p class="lead">
                                Rp.{{  number_format($thumbnail->unit_price - ($thumbnail->unit_price * $thumbnail->disc_price / 100),0)   }} 
                                Disc ( {{ $thumbnail->disc_price }} )%</p>
          <p><a class="btn btn-primary" href="{{route('api.editRoomHotel', ['id' => $thumbnail->id]) }}">Edit</a></p>
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

@extends('utama')
@section('content')
<style type="text/css">
  img {
  max-width: 100%; }

.preview {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }
  @media screen and (max-width: 996px) {
    .preview {
      margin-bottom: 20px; } }

  .preview-pic {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.preview-thumbnail.nav-tabs {
  border: none;
  margin-top: 15px; }
  .preview-thumbnail.nav-tabs li {
    width: 18%;
    margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
      max-width: 100%;
      display: block; }
    .preview-thumbnail.nav-tabs li a {
      padding: 0;
      margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
      margin-right: 0; }
.tab-content {
  overflow: hidden; }
  .tab-content img {
    width: 100%;
    height: 290px;
    -webkit-animation-name: opacity;
            animation-name: opacity;
    -webkit-animation-duration: .3s;
            animation-duration: .3s; }

.colors {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.product-title, .price, .sizes, .colors {
  text-transform: UPPERCASE;
  font-weight: bold; }

.checked, .price span {
  color: #ff9f1a; }

.product-title, .rating, .product-description, .price, .vote, .sizes {
  margin-bottom: 15px; }

.product-title {
  margin-top: 0; }

.size {
  margin-right: 10px; }
  .size:first-of-type {
    margin-left: 40px; }

.color {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
  height: 2em;
  width: 2em;
  border-radius: 2px; }
  .color:first-of-type {
    margin-left: 20px; }
.add-to-cart, .like {
  background: #ff9f1a;
  padding: 1.2em 1.5em;
  border: none;
  text-transform: UPPERCASE;
  font-weight: bold;
  color: #fff;
  -webkit-transition: background .3s ease;
          transition: background .3s ease; }
  .add-to-cart:hover, .like:hover {
    background: #b36800;
    color: #fff; }

.not-available {
  text-align: center;
  line-height: 2em; }
  .not-available:before {
    font-family: fontawesome;
    content: "\f00d";
    color: #fff; }

.orange {
  background: #ff9f1a; }

.green {
  background: #85ad00; }

.blue {
  background: #0076ad; }

.tooltip-inner {
  padding: 1.3em; }

  @-webkit-keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

#fasilitas{
  margin:5px;
  background: #eee;
  
}

#isi{
  margin:5px;
}


.image {
  margin-left: 10px;
}

.banner {
  background-color: #6699ee;
  color: white;
  text-align: center;
  width: 140px;
  position: absolute;
  top: 5px;
  height: 50px;
  font-size: 30px;
}

.left-triangle, right-triangle {
  width: 0;
  height: 0;
  position: absolute;
}

.left-triangle {
  border-top: 10px solid #5078b9;
  border-left: 10px solid transparent;
  margin-top: 1.5px;
}


.price{
  text-align: right;
}

/* DETAIL HIDE*/
.tile {
  margin-bottom:5px;
}

.detail{
  padding:5px;
}
.detail img{
  margin-bottom:-4px;
}
.description {
  padding:0 5px 10px 5px;
}
/*END DETAIL HIDE*/
</style>
  <div class="container" id="hotel">
    <div class="card">
      <div class="container-fliud">
        <div class="wrapper row">
          <div class="preview col-md-6">
            
            <div class="preview-pic tab-content">
              <div class="tab-pane active" id="pic-1"><img src="@foreach($hotels as $hotel){{ Storage::url( $hotel->file_name) }}@endforeach" /></div>
              <div class="tab-pane" id="pic-2"><img src="@foreach($hotel2s as $hotel2){{ Storage::url( $hotel2->file_name) }}@endforeach" /></div>
              <div class="tab-pane" id="pic-4"><img src="@foreach($hotel3s as $hotel3){{ Storage::url( $hotel3->file_name) }}@endforeach" /></div>
              <div class="tab-pane" id="pic-5"><img src="@foreach($hotel4s as $hotel4){{ Storage::url( $hotel4->file_name) }}@endforeach" /></div>
             
            </div>

            <ul class="preview-thumbnail nav nav-tabs">
              <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="@foreach($hotels as $hotel){{ Storage::url( $hotel->file_name) }}@endforeach" /></a></li>
              <li><a data-target="#pic-2" data-toggle="tab"><img src="@foreach($hotel2s as $hotel2){{ Storage::url( $hotel2->file_name) }}@endforeach" /></a></li>
              <li><a data-target="#pic-4" data-toggle="tab"><img src="@foreach($hotel3s as $hotel3){{ Storage::url( $hotel3->file_name) }}@endforeach" /></a></li>
              <li><a data-target="#pic-5" data-toggle="tab"><img src="@foreach($hotel4s as $hotel4){{ Storage::url( $hotel4->file_name) }}@endforeach" /></a></li>
         
            </ul>
            
          </div>
          <br>
          <div class="details col-md-6">
            <h3 class="product-title">@foreach($hotels as $hotel){{$hotel->hotel_name}}@endforeach</h3>
            <div class="rating">
              <div class="stars">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
              </div>
              <span class="review-no">41 reviews</span>
            </div>
            <span class="product-description">@foreach($hotels as $hotel){{$hotel->description}}@endforeach</span>
            <h4 class="price">Mulai Dari: <span>@foreach($hotels as $hotel)Rp. {{number_format($hotel->total_price,0)}}@endforeach</span></h4>
            
         
            <div class="action">
             <!--  <button class="add-to-cart btn btn-default" type="button">P</button>
              <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button> -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <br>
    <br>

<!-- KAMAR HOTEL -->
@foreach($rooms as $room)
    <div class="card">
      <div class="container-fliud">
        <div class="wrapper row">
          <div class="preview col-md-3">
            
            <div class="preview-pic tab-content">
              <div class="tab-pane active" id="pic-1"><img  class='image' src="@foreach($hotels as $hotel){{ Storage::url( $hotel->file_name) }}@endforeach"  style="width: 280px; height: 230px" />

                  <div class="banner">
                    {{ $room->disc_price }}%
                    <div class="left-triangle"></div>
                    
                  </div>

              </div>
            </div>
          </div>
          <br>

          <div class="details col-md-6">

            <h4 class="product-title">{{$room->room_name}}</h4>

            <div class="col-md-6">
            <span class="product-description"><div id='fasilitas'>Kapasitas Ruangan</div></span>
            <span class="product-description"><div id='fasilitas'>Sarapan</div></span>
            <span class="product-description"><div id='fasilitas'>Pembatalan</div></span>
            </div>
            <div class="col-md-6">
            <span class="product-description"><div id='isi'>{{$room->room_capacity}} Orang</div></span>

            
               @if($room->breakfast=='Y')
               <span class="product-description"><div id='isi'> Dengan Sarapan </div></span>
              @else
               <span class="product-description"><div id='isi'> Tanpa Sarapan </div></span>
              @endif
               
               @if($room->cancellation=='Y')
               <span class="product-description"><div id='isi'> Dikenakan Biaya </div></span>
              @else
               <span class="product-description"><div id='isi'> Tidak Dikenakan Biaya </div></span>
              @endif

            
            </div>

            <div class="col-md-6">
            <h4 class="price" ><strike>Rp.{{  number_format($room->unit_price,0)   }}</strike></h4>
            <h2 class="price" style="margin-top: -20px;"><span>Rp.{{  number_format($room->total_price,0)   }} </span></h2>
            </div>

<form  action="{{route('book1', ['id' => $room->id]) }}" method="post" enctype="multipart/form-data">

                                    {{ csrf_field() }}
            <div class="col-md-6">
              <div style="font-size: 16px;"><b>Kamar</b></div>
              <select style="width: 120px;" name="jumlah">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            
          </div>
            <div class="col-md-6">
              <b></b><br>
            

            <button style="margin-bottom: 6px; height: 38px; width: 120px;" type="submit" class="btn btn-success" > Pesan </button>

            </div>
</form>
            <!-- DETAIL KAMAR -->
      <div class="col-md-12">
        <div class='tile'>
        <div class='detail'>
          <img src='http://placehold.it/290x50&text=Details'>
        </div>
        <div class="description">
          <div class="col-md-6">
          <span class="product-description"><div id='fasilitas'>Fasilitas</div></span>
          
          <ul>
            @foreach(explode(',', $room->name_facilities) as $fasilitas)
            <li>
          {{ $fasilitas }}
            </li>
            @endforeach
          </ul>
        </div>

        <div class="col-md-6">
          <span class="product-description"><div id='fasilitas'>Deskripsi</div></span>
          {{ $room->description }}
        </div>

         <div class="col-md-6">
          <span class="product-description"><div id='fasilitas'>Informasi Tambahan</div></span>
          {{ $room->information }}
        </div>

        </div>
      </div>
    </div>

            <!-- END DETAIL KAMAR -->
            <div class="action">
             <!--  <button class="add-to-cart btn btn-default" type="button">P</button>
              <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button> -->
            </div>



<!-- MODAL PESAN -->
       <!--      <div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form method="POST" enc="multipart/form-data" v-on:submit.prevent="tambahperum">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-name" id="myModalLabel">Informasi Pemesan @{{dataBaru.name}}</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="name">Nama Pemesan:</label>
                  <input type="text" name="name" class="form-control" v-model="dataBaru.name" />
                  <span v-if="errorForm['name']" class="error text-danger">@{{ errorForm['name'] }}</span>
          
                  <input type="hidden" name="account_id"  class="form-control" v-model.trim="dataBaru.account_id" />
                  <span v-if="errorForm['account_id']" class="error text-danger">@{{ errorForm['account_id'] }}</span>

                  <input type="hidden" name="created_by" class="form-control" v-model="dataBaru.created_by" />
                  <span v-if="errorForm['created_by']" class="error text-danger">@{{ errorForm['created_by'] }}</span>
               </div>

               <div class="form-group">
                  <label for="name">Nomor Pemesan:</label>
                  <input type="text" name="nomor" class="form-control" v-model="dataBaru.nomor" />
                  <span v-if="errorForm['nomor']" class="error text-danger">@{{ errorForm['nomor'] }}</span>
          
                  <input type="hidden" name="account_id"  class="form-control" v-model.trim="dataBaru.account_id" />
                  <span v-if="errorForm['account_id']" class="error text-danger">@{{ errorForm['account_id'] }}</span>

                  <input type="hidden" name="created_by" class="form-control" v-model="dataBaru.created_by" />
                  <span v-if="errorForm['created_by']" class="error text-danger">@{{ errorForm['created_by'] }}</span>
               </div>

                <div class="form-group">
                  <label for="name">Alamat:</label>
                  <input type="text" name="address" class="form-control" v-model.number="dataBaru.address" />
                  <span v-if="errorForm['address']" class="error text-danger">@{{ errorForm['address'] }}</span>
                </div>
               
              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
              </form>
            </div>
          </div>
        </div> -->


          </div>

        </div>
      </div>
    </div>
@endforeach
<!-- END KAMAR HOTEL -->

  </div>


<script type="text/javascript">
$(document).ready(function(){
   $('.description').hide();

    $('.detail').click(function() {
      $(this).siblings('.description').toggle(100); 
     });
  });
</script>




@endsection
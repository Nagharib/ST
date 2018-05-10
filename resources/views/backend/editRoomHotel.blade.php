@extends('layouts.main')

@section('content')

<!doctype html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-field" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/upload.css') }}">

<style>
  .hoverbtn {
    position: absolute;
    top: 8px;
    right: 16px;
    font-size: 20px; 
}  
  </style>

        <style media="screen">
            nav.navbar {
                margin-bottom: 0;
            }

            #image-form-wrapper {
                padding-top: 20px;
                background: #f7f7f7;
            }
            #images {
                background: #eee;
                padding: 20px 0; 
            }


        </style>


          <style>
  .hoverbtn {
    position: absolute;
    top: 8px;
    right: 16px;
    font-size: 20px;
    
}  
  </style>

<!-- END ADMIN -->


  <style>

/* Responsive layout - makes a two column-layout instead of four columns */
@media (max-width: 800px) {
    .column {
        -ms-flex: 50%;
        flex: 50%;
        max-width: 50%;
    }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media (max-width: 600px) {
    .column {
        -ms-flex: 100%;
        flex: 100%;
        max-width: 100%;
    }
}
</style>




  <style>
div.gallery {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: 180px;
}



div.asd img {
    width: 100%;
    height: 150px;
}


div.desc {
    padding: 15px;
    text-align: center;
}
</style>

    </head>
    <body>

        <section id='image-form-wrapper'>
            <div class='container'>
                <div class='row'>
                    <div class='col-md-8 col-md-offset-2'>
                        <div class="panel panel-default">
                            <div class="panel-heading">Edit Data Hotel</div>
                            <div class="panel-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    @elseif (session( 'message' ))
                                    <div class="alert alert-info">
                                        {{ session('message') }}
                                    </div>
                                @endif



                                <form  action='' method="post" enctype="multipart/form-data">

                                    {{ csrf_field() }}

                                    <!-- UPLOAD MASAL -->
 <div class="wall">
  <!--Print mixin-->

  <div class="upload #{className}">
    <div class="upload__wrap" id="media-list">

        @foreach($hotels as $hotel)
        <div class="upload__item">
            <img src=" {{ Storage::url( $hotel->file_name)}}" class="upload__img">
            <a href="{{route('api.hapusGambarRoom', ['gambarid' => $hotel->gambarid,'id' => $hotel->id]) }}" data-id="24663" class="upload__del"></a>
        </div>
        @endforeach

       <!--  <img src="{{ Storage::url( $hotel->file_name)}}" class="upload__img"> -->

      <div class="upload__btn" id="upload__btn__wrap">
        <input class="upload__input" id="upload__btn" type="file" name="file_name[]" multiple="multiple" accept="image/jpeg,image/png"/>
      </div>

    </div>
    <div class="upload__mess" id="upload__mess">
      <p class="hidden_ms" id="count_img">Max:<strong id="count_img_var">8</strong></p>
      <p class="hidden_ms" id="size_img">Max Size:<strong id="size_img_var">5 Mb</strong></p>
      <p class="hidden_ms" id="file_types">Extension:<strong id="file_types_var">jpg, png</strong></p>
    </div>
  </div>
</div>


<!-- END UPLOAD MASAL -->           
                                    <div class="form-group">
                                        <label>Nama Hotel</label>
                                        <select name="id_hotel" class="form-control">
                                            @foreach ($pilihhotels as $pilihhotel)
                                            <option value="{{ $pilihhotel->id }}" {{ $hotel->id_hotel == $pilihhotel->id ? 'selected' : '' }}>{{ $pilihhotel->hotel_name }}</option>
                                            @endforeach
                                        </select>
                                       <!--  <input type="text" name="city" class="form-control"> -->
                                    </div> 

                                    <div class="form-group">
                                        <label>Nama Kamar</label>
                                        <input type="text" name="room_name" class="form-control" value="{{ $hotel->room_name }}">
                                    </div>  

                                    <div class="form-group">
                                        <label>Kapsitas Kamar</label>
                                        <input type="text" name="room_capacity" class="form-control" value="{{ $hotel->room_capacity }}">
                                    </div> 

                                      <div class="form-group">
                                        <label>Sarapan</label><br>
                                        <input type="radio" name="breakfast"  value="N" {{ $hotel->breakfast == 'N' ? 'checked' : '' }}><span>Tanpa Sarapan</span>
                                        <input type="radio" name="breakfast"  value="Y" {{ $hotel->breakfast == 'Y' ? 'checked' : '' }}><span>Dengan Sarapan</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Pembatalan</label><br>
                                        <input type="radio" name="cancellation"  value="N" {{ $hotel->cancellation == 'N' ? 'checked' : '' }}><span>Tidak Dikenakan Biaya</span>
                                        <input type="radio" name="cancellation"  value="Y" {{ $hotel->cancellation == 'Y' ? 'checked' : '' }}><span>Dikenakan Biaya</span>
                                    </div> 


                                    <div class="form-group">
                                        <label>Fasilitas</label><br>
                                        <textarea type="text" name="name_facilities" class="form-control" placeholder="Gunakan , (koma) sebagai pemisah. Ex: AC,TV">{{ $hotel->name_facilities }}</textarea>
                                    </div>  

                                    <div class="form-group">
                                        <label>Malam</label><br>
                                        <input class="form-control" type="text" name="duration" value="{{ $hotel->duration }}"> <!-- - <input type="time" name="checkout2" > -->
                                    </div>  

                                    <div class="form-group">
                                        <label>Check-In</label><br>
                                        <input type="time" name="checkin" value="{{ $hotel->checkin }}" > - <input type="time" name="checkin2" value="{{ $hotel->checkin2 }}" >
                                    </div>

                                    <div class="form-group">
                                        <label>Check-Out</label><br>
                                        <input type="time" name="checkout" value="{{ $hotel->checkout }}"> <!-- - <input type="time" name="checkout2" > -->
                                    </div>

                                    <div class="form-group">
                                        <label>Check-In Date</label><br>
                                        <input class="form-control" type="date" name="checkindate" value="{{ $hotel->checkindate }}"> 
                                    </div>

                                    <div class="form-group">
                                        <label>Check-Out Date</label><br>
                                        <input class="form-control" type="date" name="checkoutdate" value="{{ $hotel->checkoutdate }}" > <!-- - <input type="time" name="checkout2" > -->
                                    </div>

                                     <div class="form-group">
                                    <div class="input-group">
                                      
                                      <span class="input-group-addon" id="basic-addon1">Rp</span>
                                      <input type="text" class="form-control"  name='unit_price' aria-describedby="basic-addon1" placeholder="Harga Hotel" value="{{ $hotel->unit_price }}">
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <div class="input-group">
                                      
                                      <span class="input-group-addon" id="basic-addon1">%</span>
                                      <input type="text" class="form-control"  name='disc_price' aria-describedby="basic-addon1" placeholder="Diskon Harga Hotel" value="{{ $hotel->disc_price }}">
                                      <span class="input-group-addon">Disc</span>
                        
                                    </div>
                                    </div>

                                     <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea type="text" name="description" class="form-control" >{{ $hotel->description }}</textarea>
                                    </div> 
                                  
                                    <div class="form-group">
                                        <label>Informasi Tambahan</label>
                                        <textarea type="text" name="information" class="form-control" >{{ $hotel->information }}</textarea>
                                    </div> 

                                    <div class="form-group">
                                        <label>Fasilitas Spesial</label>
                                        <textarea type="text" name="special_facilities" class="form-control" >{{ $hotel->special_facilities }}</textarea>
                                    </div> 

                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit">Upload</button>
                                    </div>
                                 
                                </form> 

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@push('script')
      <script type="text/javascript">
      $(document).ready( function() {   
          $('body').on('click', '.upload__del', function() {
            $('#count_img, #size_img, #file_types').hide();
            $(this).closest('.upload__item').remove();
            $('#upload__btn').parent('.upload__btn').show();
            $('#count_img').hide();
            var removeItem = $(this).attr('24663');
            var yet = names.indexOf(removeItem);
            names.splice(yet, 1);
            console.log(names);
        });
      });
      </script>
@endpush      
        <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
        <script src="{{ asset('js/jquery.min.js') }}" charset="utf-8"></script>
        <script src="{{ asset('js/index.js') }}" charset="utf-8"></script>
    </body>
</html>
@endsection
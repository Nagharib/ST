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
                            <div class="panel-heading">Upload Your Images</div>
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



                                <form action="tambahhotel" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <!-- UPLOAD MASAL -->
 <div class="wall">
  <!--Print mixin-->

  <div class="upload #{className}">
    <div class="upload__wrap" id="media-list">
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
                                        <input type="text" name="hotel_name" class="form-control">
                                    </div>  

                                    <div class="form-group">
                                    <div class="input-group">
                                      
                                      <span class="input-group-addon" id="basic-addon1">Rp</span>
                                      <input type="text" class="form-control"  name='unit_price' aria-describedby="basic-addon1" placeholder="Harga Hotel">
                                    </div>
                                    </div>


                                    <div class="form-group">
                                    <div class="input-group">
                                      
                                      <span class="input-group-addon" id="basic-addon1">%</span>
                                      <input type="text" class="form-control"  name='disc_price' aria-describedby="basic-addon1" placeholder="Diskon Harga Hotel" value="0">
                                    </div>
                                    </div>

                                     <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea type="text" name="description" class="form-control"></textarea>
                                    </div> 
                                    <div class="form-group">
                                        <label>Kota</label>
                                        <select name="city" class="form-control">
                                            @foreach ($citys as $city)
                                            <option value="{{ $city->city }}">{{ $city->city }}</option>
                                            @endforeach
                                        </select>
                                       <!--  <input type="text" name="city" class="form-control"> -->
                                    </div> 

                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <input type="text" name="province" class="form-control">
                                    </div>  

                                    <!-- <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="file_name" class="form-control" >
                                     
                                    </div>
 -->
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea type="text" name="address" class="form-control"></textarea>
                                    </div> 

                                    <div class="form-group">
                                        <label>Informasi Tambahan</label>
                                        <textarea type="text" name="information" class="form-control"></textarea>
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

<!-- 
         <div class="col-lg-12">
            <div class="panel panel-default">   
            <div class="control-group"> 
            <div class="panel-heading">Kota Terpopuler</div>    
            <div class="panel-body">
                
          @foreach ($hotels as $hotel)

              <div class="gallery_product col-lg-3 col-md-3 col-sm-3 col-xs-12 filter hdpe" >
                <div class="asd" style='margin:1px 0px 5px -10px'>
                
                <img src="{{ $hotel->src }}" class="img-responsive" >
                <div class="desc">{{ $hotel->title }}</div>

                <div class='hoverbtn'>
              
                    <button type="submit">
                     <a href='{{route('api.delete', ['id' => $hotel->id_promo_header]) }}'> <i class="fa fa-trash"></i> </a>
                    </button>

                  
                 </div>
              
                 </div>
            </div>

            @endforeach
            
            
          </div>
          </div>

        </div>
     </div> -->


      
        <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
        <script src="{{ asset('js/jquery.min.js') }}" charset="utf-8"></script>
        <script src="{{ asset('js/index.js') }}" charset="utf-8"></script>
    </body>
</html>
@endsection
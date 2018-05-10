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

                                <form action="promo2" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }} 

                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="file_name" class="form-control" >
                                     
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

        <br>
         <div class="col-lg-12">
            <div class="panel panel-default">   
            <div class="control-group"> 
            <div class="panel-heading">Promo Terkini</div>    
            <div class="panel-body">
                
            @foreach ($images as $image)

              <div class="gallery_product col-lg-3 col-md-3 col-sm-3 col-xs-12 filter hdpe" >
                <div class="asd" style='margin:1px 0px 5px -10px'>
                
                <img src="{{ $image->src }}" class="img-responsive" >
                <div class="desc">{{ $image->title }}</div>

                <div class='hoverbtn'>
              
                    <button type="submit">
                     <a href='{{route('api.delete', ['id' => $image->id_promo_header]) }}'> <i class="fa fa-trash"></i> </a>
                    </button>

                  
                 </div>
              
                 </div>
            </div>

            @endforeach
            
            
          </div>
          </div>

        </div>
     </div>

        <!-- <section id="images">
            <div class="container">
                <div class="row">
                    @if ($images->count() < 1)
                        <div class="alert alert-warning">
                            No Image
                        </div>
                    @endif

                    @foreach ($images as $image)
                    <div class="img">
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="{{ $image->src }}" alt="">
                            <div class="caption">
                                <h3>{{ $image->title }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                    @endforeach
                </div>
            </div>
        </section> -->
        <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
    </body>
</html>
@endsection
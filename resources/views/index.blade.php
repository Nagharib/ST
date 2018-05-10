@extends('utama')
@section('content')


@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

  <div class="container">


            <div class="row row-centered pos">
                <div class="col-lg-12 ">
                    <div class="well">
                      
                      <div id="content-slider" class="clr">
    <div class="wrap-slider clr"> 
    
    
<!--  ========================Thumbnail ControlNav======================================    -->     
      <input type="radio" id="a-1" name="a" >     
      <input type="radio" id="a-2" name="a" >     
      <input type="radio" id="a-3" name="a" >
      <input type="radio" id="a-4" name="a" >
      
      <nav id="main">
          <label for="a-1" class="first"></label>
          <label for="a-2" class="first"></label>
          <label for="a-3" class="first"></label>
          <label for="a-4" class="first"></label>
          <!-- <label for="a-5" class="first"></label> -->
      </nav>
<!--  ==============================================================    -->
      <nav id="control">
          <label for="a-1" ></label>
          <label for="a-2" ></label>
          <label for="a-3" ></label>
          <label for="a-4" ></label>
          <!-- <label for="a-5" class="first"></label> -->
      </nav>
<!--  ==============================================================    -->

        <!--  IMAGE NAVIGATION pic -->
      <span id="b-1" class="th" tabindex="10">
       
        <div class="title-1">
            
        </div>
      </span>
      
      
      <!-- ______________IMAGES_________________________________________ -->            

      <div class="slider">
        <div class="inset">

        @foreach ($sliders as $slider)
          <figure>
              <figcaption class="title-1">
              <h1>{{ $slider->title }}</h1>
            
            </figcaption>
            <img src="{{$slider->src }}" alt="" id="i-1" class="f">           
          </figure>
          @endforeach

          <!-- <figure>
              <figcaption class="title-2">
              <h1>Kamov Ka-50 "Black Shark"</h1>
              <p>Attack helicopter</p>
              <a href="">read more...</a>
            </figcaption>
            <img src="{{asset('img/2.png')}}" alt="" id="i-2" class="f">            
          </figure>

          <figure>
            <figcaption class="title-3">
              <h1>Sukhoi Su-27</h1> 
              <p>Air superiority fighter</p> 
              <a href="">read more...</a>
            </figcaption>
            <img src="https://github.com/lime7/slider/blob/master/images/3.png?raw=true" alt="" id="i-3" class="f">           
          </figure>

          <figure>
            <figcaption class="title-4">
              <h1>mil mi-28</h1>
              <p>Attack helicopter</p>
              <a href="">FIND OUT MORE</a>
            </figcaption>
            <img src="https://github.com/lime7/slider/blob/master/images/4.png?raw=true" alt="" id="i-4" class="f">           
          </figure> -->


           
        </div>
      </div> 



    </div>    
  </div>

                    </div>
                </div>
            <div class="col-lg-12">
            <div class="panel panel-default">   
            <div class="control-group"> 
            <div class="panel-heading">Promo Terkini</div>    
            <div class="panel-body">
                
            @foreach ($images as $image)

              <div class="gallery_product col-lg-3 col-md-3 col-sm-3 col-xs-12 filter hdpe" >
                <div class="asd" style='margin:1px 0px 5px -10px'>
                <a target="_blank" href="/hotel">
                <img src="{{ $image->src }}" class="img-responsive" >
                <div class="desc">{{ $image->title }}</div>
                </a>
                 </div>
            </div>

            @endforeach
            
            
          </div>
          </div>

        </div>
     </div>


            <div class="col-md-12 col-centered">
            <div class="panel panel-default">    
            <div class="panel-heading">Kota Terpopuler</div>    
            <div class="panel-body">
          

              
<!-- KIRI -->
<div class="all">
  <div class="row all-row">


  <div class="column">


@foreach($kiris as $kiri) 
<a href="{{route('kota', ['city' => $kiri->city]) }}" target="_blank">
    <div class="container2">
    
    <img src="{{ Storage::url( $kiri->file_name) }}" style="width:100%; height:auto;">
   
    <p class="p"></p>
 
     <div class="top-left" style='cursor:pointer'>{{ $kiri->city }}</div>
    <div class="top-left2"> Harga Mulai dari Rp. 
  @foreach($hargas as $harga) 
      {{ $harga->total_price }}
  @endforeach
    </div>


    <button class="bottom-right btn btn-primary-outline " style="background-color:transparent">
  
      <h2>{{ $jumlah_hotel->where('city','=',$kiri->city)->count() }} Hotel</h2>
     
    </button>

  </div>
</a>
@endforeach

   <!--  <div class="container2">
    <img src="https://www.pegipegi.com/assets-hotel-homepage-pc/img/content/kota-populer/bali.jpg" style="width:100%; height:15%;">
    <p class="p"></p>
 
     <div class="top-left" style='cursor:pointer'>Bali</div>
    <div class="top-left2"> Harga Mulai dari Rp. 
  @foreach($hargas as $harga) 
      {{ $harga->total_price }}
  @endforeach
    </div>



    <button class="bottom-right btn btn-primary-outline " style="background-color:transparent"><h4>{{ $jumlah_hotel }}</h4></button>

    </div>

    <div class="container2">
  
     <img src="https://www.pegipegi.com/assets-hotel-homepage-pc/img/content/kota-populer/bogor.jpg" style="width:100%">
      <p class="p"></p>
    <div class="top-left">Bogor</div>
    <div class="top-left2">Harga Mulai dari Rp.</div>
    <button class="bottom-right btn btn-primary-outline " style="background-color:transparent"> Bottom Right</button>

    </div>

    <div class="container2">
    <img src="https://www.pegipegi.com/assets-hotel-homepage-pc/img/content/kota-populer/bandung.jpg" style="width:100%">
   <p class="p"></p>
    <div class="top-left">Top Left</div>
    <div class="top-left2">Harga Mulai dari Rp.</div>
    <button class="bottom-right btn btn-primary-outline " style="background-color:transparent;">Bottom Right</button>
    </div>
 -->

 
  </div>

  <!-- END KIRI -->


  <!-- END KANAN -->
  <div class="column">

@foreach($kanans as $kanan) 
    <div class="container2"  style='cursor:pointer;'>
    <img src="{{ Storage::url( $kanan->file_name)}}" style="width:100%; height:auto;"">
    <p class="p"></p>
    <div class="top-left">{{ $kanan->city }}</div>
    <div class="top-left2">Harga Mulai dari Rp.</div>
    
    <button class="bottom-right btn btn-primary-outline " style="background-color:transparent">Bottom Right</button>
    </div>
    </div>
@endforeach
    <!-- <div class="container2"  style='cursor:pointer;'>
    <img src="https://www.pegipegi.com/assets-hotel-homepage-pc/img/content/kota-populer/yogyakarta.jpg" style="width:100%; height:15%;"">
    <p class="p"></p>
    <div class="top-left">Yogyakarta</div>
    <div class="top-left2">Harga Mulai dari Rp.</div>
    
    <button class="bottom-right btn btn-primary-outline " style="background-color:transparent">Bottom Right</button>
    </div>

    <div class="container2">
     <img src="https://www.pegipegi.com/assets-hotel-homepage-pc/img/content/kota-populer/jakarta.jpg" style="width:100%">
    <p class="p"></p>
    <div class="top-left">Jakarta</div>
    <div class="top-left2">Harga Mulai dari Rp.</div>
    <button class="bottom-right btn btn-primary-outline " style="background-color:transparent">Bottom Right</button>
    </div>

    <div class="container2">
    <img src="https://www.pegipegi.com/assets-hotel-homepage-pc/img/content/kota-populer/malang.jpg" style="width:100%">
    <p class="p"></p>
    <div class="top-left">Malang</div>
    <div class="top-left2">Harga Mulai dari Rp.</div>
    <button class="bottom-right btn btn-primary-outline " style="background-color:transparent">Bottom Right</button>
    </div>

    <div class="container2">
    <img src="http://pegipegi.s3.amazonaws.com/asset/promo/banner/5a5584d9c3245.jpg" style="width:100%">
    <p class="p"></p>
    <div class="top-left">Top Left</div>
    <div class="top-left2">Harga Mulai dari Rp.</div>
    <div class="bottom-right" style='cursor:pointer'>Bottom Right</div>
    </div> -->

  </div>  

  <!-- END KANAN -->

  

</div>
 </div> 




                  </div>
                </div>
              </div>
                </div>
            </div>
        </div>


@endsection
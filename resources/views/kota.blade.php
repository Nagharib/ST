@extends('utama')
@section('content')

<head>
  <meta charset="UTF-8">
  <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="{{asset('/css/styleList.css')}}">

<style type="text/css">
.product_item {
  height: 240px;
}

.product_image img {

  top: -35;
  bottom: 0;
  left: 0;
  right: 0;
  
}
  .text {
  position: relative;
  font-size: 14px;
  color: black;
  width: 206px; /* Could be anything you like. */
}

.text-concat {
  position: relative;
  display: inline-block;
  word-wrap: break-word;
  overflow: hidden;
  max-height: 3.6em; /* (Number of lines you want visible) * (line-height) */
  line-height: 1.2em;
  text-align:justify;
}

.text.ellipsis::after {
  content: "...";
  position: absolute;
  right: -12px; 
  bottom: 4px;
}
</style>
  
</head>

<body>

<div class="product_grid">


  <ul class="product_list list">

@foreach($hotels as $hotel)
    <li class="product_item">
     
      <div class="product_sale">
        <p>On Sale</p>
      </div>
      <div class="product_image">

 <a href="{{route('detail', ['id' => $hotel->id]) }}" target="_blank">
          <img src="{{ Storage::url( $hotel->file_name) }}" style="width: 200px; height: 190px;">
</a>
          <div class="product_buttons">
            <button class="product_heart"><i class="fa fa-heart"></i></button>
            <button class="product_compare"><i class="fa fa-random"></i></button>
            <button class="add_to_cart"><i class="fa fa-shopping-cart"></i></button>
            <div class="quick_view">
              <a href="#"><h6>Quick View</h6></a>
            </div>
          </div>
      </div>
      <div class="product_values">
        <div class="product_title">
          <h5>{{ $hotel->hotel_name }}</h5>
        </div>
        <div class="product_price">
          <a href="#"><span class="price_old">Rp. @if ($hotel->unit_price === $hotel->total_price)
    0
@else
    {{ $hotel->unit_price }}
@endif
</span> <span class="price_new">Rp.{{ $hotel->total_price }}</span></a>
          <!--  <span class="product_rating"></span> --><br><br>
        </div>

        <div class="product_desc1">
          <div class="truncate text ellipsis"><span class="text-concat">{{ $hotel->description }}</span></div>
        </div>
        <!-- <div class="product_buttons">
          <button class="product_heart"><i class="fa fa-heart"></i></button>
          <button class="product_compare"><i class="fa fa-random"></i></button>
          <button class="add_to_cart"><i class="fa fa-shopping-cart"></i></button>
        </div> -->
      </div>

    </li>

 @endforeach
  </ul>
</div>


  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/87118/jQuery.succinct.min.js'></script>

  


    <script  src="{{asset('/js/index.js')}}"></script>




</body>

@endsection
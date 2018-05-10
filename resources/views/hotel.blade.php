@extends('utama')
@section('content')

<style type="text/css">
  div.asd3:hover {
    border: 2px solid #db4939;
    cursor: pointer;
    width: auto;
    height: 154px;
   }
div.asd3 img {
    width: 100%;
    height: 150px;
}
</style>
  <div class="container">
            <div class="row row-centered pos">
                <div class="col-lg-12 col-xs-12 col-centered">
                    <div class="well">
                      


                    </div>
                </div>
            <div class="col-lg-12 col-centered">
            <div class="panel panel-default">    
            <div class="panel-heading">Hotel Group</div>    
            <div class="panel-body">
                
            <div class="row panel-group">
            
            @foreach($hotels as $hotel )
            <div class="gallery_product col-lg-3 col-md-3 col-sm-3 col-xs-12 filter hdpe aho">
                <div class="asd3">
                <img src="{{ Storage::url( $hotel->file_name)}}" class="img-responsive" width="620px" height="200px">
                <div class="desc">{{ $hotel->hotel_name }}</div>
                 </div>
            </div>
            @endforeach
            
    

          </div>


          </div>
          </div>
          </div>



                </div>
            </div>
        </div>


@endsection
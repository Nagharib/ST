@extends('layouts.main')
@section('content')
<div class="box">
	<div class="box-body">
		<div class="row">
			@foreach($perum as $room)
			<div class="col-sm-3">
				<div class="small-box bg-green">
					<div class="inner">
						<h3>{{$room->id}}</h3>
						<p>{{$room->blokna}}</p>
					</div>
					<div class="icon">
						<i class="fa fa-bed"></i>
					</div>
					<a class="small-box-footer" href="{{route('checkin.edit',$room->id)}}">Pilih Kamar</a>
					</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection
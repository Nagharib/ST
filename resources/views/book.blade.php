@extends('utama')
@section('content')
<style type="text/css">
	.well{
background-color: white !important;
}
</style>
<div class="container">
	<div class="row">
	<div class="well"><h1>Pemesanan Hotel</h1></div>
    <div class="col-md-6">
      <div class="well"><h4>Informasi Pemesanan</h4></div>
      <div class="well">
 @foreach($books as $book)
      	<form target="_blank" name="frm" action="{{route('book2') }}" onsubmit="myFunction()"  method="POST">
      		{{ csrf_field() }}
      		<div class="form-group">
		      <label for="usr">Nama Pemesan:</label>
		      <input type="text" class="form-control" name="name" required>
		      <span>Isi nama pemesan sesuai KTP/Paspor/SIM (tanpa tanda baca/gelar)</span>
		    </div>
		    <div class="form-group">
		      <label for="usr">Nomor Whatsapp:</label>
		      <input type="text" class="form-control" name="wa" required>
		    </div>
		    <div class="form-group">
		      <label for="usr">Email:</label>
		      <input type="email" class="form-control" name="email" required>
		      <span>Contoh: email@example.com</span>
		    </div>

		    <input type="hidden" class="form-control" name="hotel" value="{{ $book->hotel_name }}">
		    <input type="hidden" class="form-control" name="kamar" value="{{ $book->room_name }}">
		    <input type="hidden" class="form-control" name="duration" value="{{ $book->duration }}">
		    <input type="hidden" class="form-control" name="checkindate" value="{{ $book->checkindate }}">
		    <input type="hidden" class="form-control" name="checkoutdate" value="{{ $book->checkoutdate }}">
		    <input type="hidden" class="form-control" name="jumlah_kamar" value="{{ $totalna }}">
		    <input type="hidden" class="form-control" name="harga" value="Rp.{{ number_format($book->total_price * $totalna, 0) }}">
		    

		    <button class="btn btn-success" style="width: 100%;" >Pesan</button>

 
      </div>
    </div>

  
    <div class="col-md-6">
      <div class="well"><h4>Ringkasan Pemesanan</h4></div>
      <div class="well">
  
      		<div  data-elevation="0.5">
      			<div>
      				<hr class="_1Hwni" data-inset="false">
      			</div>
      			<div >
      	
      						<h5 ><b>{{ $book->room_name }}</b></h5>
      			
      		
      				
      				<table class="wRcWJ">
      					<tbody>
      						<tr>
      							<td>Durasi</td>
      							<td class="_3owtl tvat-stayDuration">
      								{{ $book->duration }} Malam
      							</td>
      						</tr>
      						<tr>
      							<td>Check-in</td>
      							<td class="_3owtl tvat-checkInDate">{{ $book->checkindate }}</td>
      						</tr>
      						<tr>
      							<td>Check-out</td>
      							<td class="_3owtl tvat-checkOutDate">{{ $book->checkoutdate }}</td>
      						</tr>
      					<!-- 	<tr>
      							<td>Tipe kamar</td>
      							<td class="_3owtl tvat-roomType">Executive King, Room Only For 1 Person</td>
      						</tr> -->
      						<tr>
      							<td>Jumlah kamar</td>
      							<td class="_3owtl tvat-numOfRoom">{{ $totalna }} Kamar</td>
      						</tr>
      						
      						<tr><td>&nbsp</td></tr>
      						<tr><td></td></tr>
      						
      						<tr>
      							<td  colspan="3"><h2>Total : Rp. 
      								{{ number_format($book->total_price * $totalna, 0) }}
      							</h2></td>

      						</tr>
      					</tbody>
      				</table>
      			</div>
      		</div>
      		
      	</form>
      </div>
    </div>
  </div>
  @endforeach

</div>

<script type="text/javascript">
function myFunction() {
  
            if (window.confirm('Data berhasil akan dikirim!'))
{
    window.location.href = "{{route('index') }}"
}
}

</script>
@endsection
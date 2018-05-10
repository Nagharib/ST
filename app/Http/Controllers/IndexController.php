<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Promo;
use App\Model\Hotel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use DB;
use Mail;

class IndexController extends Controller
{
     public function index()
    { 
        $images = Promo::latest()
        ->where('is_slider', '!=' ,'Y')
        ->get();

        $this->data['jumlah_hotel'] = DB::table('ng_hotels')
        ->select('city')
        ->get();


        $kotas = DB::table('ng_hotels')->select('city')->get();

        $hargas = DB::table('ng_hotels')
        ->select('total_price')
        ->orderBy('total_price', 'asc')
        ->limit(1)
        ->get();


        $kiris = DB::table('ng_hotels')
        ->join('ng_promo2s', 'ng_hotels.city', '=', 'ng_promo2s.city')
        ->where('ng_promo2s.position', '=', 'L')
        ->groupBy('ng_promo2s.city')
        ->orderBy('ng_promo2s.city','Desc')
        ->get();
    
       /* $kanans = DB::table('ng_promo2s')
        ->where('position', '=', 'R')
        ->get();*/

         $kanans = DB::table('ng_hotels')
        ->join('ng_promo2s', 'ng_hotels.city', '=', 'ng_promo2s.city')
        ->where('ng_promo2s.position', '=', 'R')
        ->groupBy('ng_promo2s.city')
        ->orderBy('ng_promo2s.city','Desc')
        ->get();

        $sliders = Promo::latest()
        ->where('is_slider', '=' ,'Y')
        ->get();

        return view('index',  ['images' => $images,'hargas' => $hargas,'kiris' => $kiris,'kanans' => $kanans,'kotas' => $kotas,'sliders' => $sliders],$this->data);    	
    
    }

    public function hotel()
    {
    	$hotels = DB::table('ng_hotels')
    	->leftJoin('ng_images', 'ng_images.id_hotel', '=' ,'ng_hotels.id')
        ->groupBy('ng_hotels.hotel_name')
    	->get();

    	return view('hotel', ['hotels' => $hotels ]);
    }

    public function city($city = null){
       
        $gambar = DB::table('ng_hotels')
        ->join('ng_images', 'ng_hotels.id', '=', 'ng_images.id_hotel')
        ->select('ng_images.file_name')
        ->limit(1)
        ->get();

        $hotels = DB::table('ng_hotels')
        ->join('ng_images', 'ng_hotels.id', '=', 'ng_images.id_hotel')
        ->select('ng_images.file_name','ng_hotels.*')
        ->where('city', '=', $city)
        ->groupBy('ng_images.id_hotel')
        ->get();

        return view('kota', ['hotels' => $hotels,'gambar' => $gambar  ]);

         
    }


    public function detailHotel($id = null){
       $this->data['datahotel'] = Hotel::where('id', '=' , $id)->select('hotel_name')->first();

       $hotels = DB::table('ng_hotels')
        ->join('ng_images', 'ng_hotels.id', '=', 'ng_images.id_hotel')
        ->where('ng_hotels.id', '=', $id)
        ->limit(1)
        ->get();

        $hotel2s = DB::select( DB::raw("select * from ng_images where id_hotel = $id limit 1,1") );

        $hotel3s = DB::select( DB::raw("select * from ng_images where id_hotel = $id limit 2,1") );
        $hotel4s = DB::select( DB::raw("select * from ng_images where id_hotel = $id limit 3,1") );

        $rooms = DB::table('ng_hotel_rooms')
        ->select('ng_hotels.id','ng_hotel_rooms.*','ng_room_facilities.name_facilities')
        ->join('ng_hotels', 'ng_hotels.id', '=', 'ng_hotel_rooms.id_hotel')
        ->join('ng_room_facilities', 'ng_hotel_rooms.id', '=', 'ng_room_facilities.room_id')
        ->where('ng_hotels.id', '=', $id)
        ->get();

        $roomimages = DB::table('ng_hotel_rooms')
        ->join('ng_hotels', 'ng_hotels.id', '=', 'ng_hotel_rooms.id_hotel')
        ->join('ng_room_images', 'ng_hotel_rooms.id', '=', 'ng_room_images.room_id')
        ->where('ng_hotels.id', '=', $id)
        ->limit(1)
        ->get();


      return view('detailhotel',['hotels' => $hotels,'hotel2s' => $hotel2s,'hotel3s' => $hotel3s,'hotel4s' => $hotel4s,'rooms' => $rooms,'roomimages' => $roomimages], $this->data);

         
    }

    public function bookHotel(Request $request, $id = null){

        $books = DB::table('ng_hotel_rooms')
        ->select('ng_hotel_rooms.*','ng_hotels.hotel_name')
        ->join('ng_hotels', 'ng_hotels.id', '=', 'ng_hotel_rooms.id_hotel')
        ->where('ng_hotel_rooms.id', '=', $id)
        ->get();

        $harganas = DB::table('ng_hotel_rooms')
        ->select('total_price')
        ->where('id', '=', $id)
        ->get();

        $this->data['totalna'] = $request->jumlah;

        return view('book',['books' => $books],$this->data);        
    }

    public function WA (Request $request){

        $data = array(
            'name' => $request->name,
            'Whatsapp' => $request->wa,
            'email' => $request->email,
            'hotel_name' => $request->hotel,
            'room_name' => $request->kamar,
            'duration' => $request->duration,
            'checkindate' => $request->checkindate,
            'checkoutdate' => $request->checkoutdate,
            'jumlah_kamar' => $request->jumlah_kamar,
            'harga' => $request->harga
        );

        $url = "https://www.waboxapp.com/api/send/chat?token=828d66f37228809b61f9308e5c6a5a445abb0087118d2&uid=6281313062788&to=6289657919711&custom_uid=msg-".rand(999,9999)."&text=Nama+:+".$request->name."+%0ANo+Whatsapp+:+".$request->wa."+%0AEmail+:+".$request->email."+%0ANama+Hotel+:+".$request->hotel."+%0AKamar+:+".$request->kamar."+%0ADurasi+:+".$request->duration."+Malam+%0ACheck-in+:+".$request->checkindate."+%0ACheck-out+:+".$request->checkoutdate."+%0AJumlah+Kamar+:+".$request->jumlah_kamar."+%0AHarga+:+".$request->harga."";


        return Redirect::to($url);




       
    }


    public function bookHotelsip(Request $request){
/* SEND EMAIL */
        $data = array(
            'name' => $request->name,
            'Whatsapp' => $request->wa,
            'email' => $request->email,
            'hotel_name' => $request->hotel,
            'room_name' => $request->kamar,
            'duration' => $request->duration,
            'checkindate' => $request->checkindate,
            'checkoutdate' => $request->checkoutdate,
            'jumlah_kamar' => $request->jumlah_kamar,
            'harga' => $request->harga
        );

        Mail::send('email2', $data, function ($message) use ($data) {
           
            $message->to('playps1122@gmail.com');
            $message->subject('Pemesanan Hotel');
        });
        /* END SEND EMAIL */

        $images = Promo::latest()
        ->where('is_slider', '!=' ,'Y')
        ->get();

        $this->data['jumlah_hotel'] = DB::table('ng_hotels')
        ->select('city')
        ->get();


        $kotas = DB::table('ng_hotels')->select('city')->get();

        $hargas = DB::table('ng_hotels')
        ->select('total_price')
        ->orderBy('total_price', 'asc')
        ->limit(1)
        ->get();


        $kiris = DB::table('ng_hotels')
        ->join('ng_promo2s', 'ng_hotels.city', '=', 'ng_promo2s.city')
        ->where('ng_promo2s.position', '=', 'L')
        ->groupBy('ng_promo2s.city')
        ->orderBy('ng_promo2s.city','Desc')
        ->get();
    
       /* $kanans = DB::table('ng_promo2s')
        ->where('position', '=', 'R')
        ->get();*/

         $kanans = DB::table('ng_hotels')
        ->join('ng_promo2s', 'ng_hotels.city', '=', 'ng_promo2s.city')
        ->where('ng_promo2s.position', '=', 'R')
        ->groupBy('ng_promo2s.city')
        ->orderBy('ng_promo2s.city','Desc')
        ->get();

        $sliders = Promo::latest()
        ->where('is_slider', '=' ,'Y')
        ->get();

        return view('index',  ['images' => $images,'hargas' => $hargas,'kiris' => $kiris,'kanans' => $kanans,'kotas' => $kotas,'sliders' => $sliders],$this->data)->with('message', 'Pemesanan anda berhasil dan sedang kami proses');


    }
}

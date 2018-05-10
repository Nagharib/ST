<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Image;
use App\Model\Hotel;
use App\Model\PromoKota;
use App\Model\HotelRoom;
use App\Model\RoomFacilities;
use App\Model\RoomImage;

use DB;
use Illuminate\Support\Facades\Redirect;

class HotelRoomCtrl2 extends Controller
{
    public function __construct()
    {
        $this->middleware('role');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
         //
        $this->data['title'] = 'Data Kamar Hotel';
        $this->data['deskripsi_title'] = 'Admin';
        
        $hotels = Hotel::latest()->get();
        /*$citys = DB::table('ng_promo2s')->select('city');*/
        $citys = Hotel::latest()->get();

        return view('backend.tambahroom',  ['hotels' => $hotels,'citys' => $citys],$this->data);     
    
    }

    public function store(Request $request){
    	$this->validate($request,[
    		
    		'room_name' => 'required'
    	]);

            $a = $request->unit_price;
            $b = $request->disc_price;
            $c = $a * $b / 100;
            $d = $a - $c;

    		$hotel = new HotelRoom();
            $hotel->id_hotel = $request->id_hotel;
            $hotel->room_name = $request->room_name;
            $hotel->room_capacity = $request->room_capacity;
            $hotel->description = $request->description;
            $hotel->information = $request->information;
            $hotel->unit_price = $request->unit_price;
            $hotel->disc_price = $request->disc_price;
            $hotel->total_price = $d;
            $hotel->breakfast = $request->breakfast;
            $hotel->cancellation = $request->cancellation;
            $hotel->checkin = $request->checkin;
            $hotel->checkin2 = $request->checkin2;
            $hotel->checkout = $request->checkout;
            $hotel->checkindate = $request->checkindate;
            $hotel->checkoutdate = $request->checkoutdate;
            $hotel->special_facilities = $request->special_facilities;
            $hotel->duration = $request->duration;       	    	
	    	$hotel->save();
	    	

//UPLOAD FILE
$images = $this->uploadFiles($request);

$roomid = HotelRoom::whereRaw('id = (select max(`id`) from ng_hotel_rooms)')->first();
$rid = $roomid->id;

			$fasilitas = new RoomFacilities();
	    	$fasilitas->room_id = $rid;
	    	$fasilitas->name_facilities = $request->name_facilities;
	    	$fasilitas->save();

foreach ($images as $imageFile) {

	list($fileName,$hid) = $imageFile;

	$hotel2 = new RoomImage();
            $hotel2->file_name = $fileName;
            $hotel2->room_id = $hid;  
	    	$hotel2->save();	    	
}
//END UPLOAD FILE
    	return redirect('admin/tambahroom')->with('message', 'Your hotel successfully uploaded!');
    }

 protected function uploadFiles($request)
   {

   	$uploadedImages = [];
 

    	if ($request->hasFile('file_name'))
    	{
    		$images = $request->file('file_name');

    		foreach ($images as $image) {
    			$uploadedImages[] = $this->uploadFile($image);
    		}
    	
    	}
    	return $uploadedImages;
    } 

    protected function uploadFile($image){

    	$originalFileName = $image->getClientOriginalName();
    		$extension = $image->getClientOriginalExtension();
    		$fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
    		$fileName = str_slug($fileNameOnly) . "-" . time() . "." . $extension;

            $hotelid = HotelRoom::whereRaw('id = (select max(`id`) from ng_hotel_rooms)')->first();
             $hid= $hotelid->id;

            $uploadedFileName = $image->storeAs('public/files', $fileName);

    		return [$uploadedFileName, $hid];
    }

 public function update($id){

        $this->data['title'] = 'Data Kota Terpopuler';
        $this->data['deskripsi_title'] = 'Admin';

        $hotels = DB::select(DB::raw("
            select ng_hotel_rooms.*,
            ng_hotels.id as idhotel,
            ng_hotels.hotel_name,
            ng_room_facilities.name_facilities,
            ng_room_images.file_name,ng_room_images.id_image as gambarid from ng_hotel_rooms  
            LEFT JOIN ng_room_images ON 
            ng_room_images.room_id = ng_hotel_rooms.id 
            LEFT JOIN ng_hotels ON
            ng_hotels.id = ng_hotel_rooms.id_hotel
            LEFT JOIN ng_room_facilities ON
            ng_hotel_rooms.id = ng_room_facilities.room_id
            where ng_hotel_rooms.id = $id 
            "));

        $pilihhotels = DB::select(DB::raw("
            select * from ng_hotels
            "));
        
        return view('backend.editRoomHOtel',  ['hotels' => $hotels,'pilihhotels' => $pilihhotels],$this->data);
    }

///////////////////////// EDIT DATA ////////////////////////////////////////////

public function updateData(Request $request, $id ){

  /* $hotel = Hotel::where('id', $id)->update($request->except(['_token','file_name']));*/
            $a = $request->unit_price;
            $b = $request->disc_price;
            $c = $a * $b / 100;
            $d = $a - $c;

  $hotel = HotelRoom::find($id);

            $hotel->id_hotel = $request->id_hotel;
            $hotel->room_name = $request->room_name;
            $hotel->room_capacity = $request->room_capacity;
            $hotel->description = $request->description;
            $hotel->information = $request->information;
            $hotel->unit_price = $request->unit_price;
            $hotel->disc_price = $request->disc_price;
            $hotel->total_price = $d;
            $hotel->breakfast = $request->breakfast;
            $hotel->cancellation = $request->cancellation;
            $hotel->checkin = $request->checkin;
            $hotel->checkin2 = $request->checkin2;
            $hotel->checkout = $request->checkout;
            $hotel->checkindate = $request->checkindate;
            $hotel->checkoutdate = $request->checkoutdate;
            $hotel->special_facilities = $request->special_facilities; 
            $hotel->duration = $request->duration; 

   $hotel->save();

   RoomFacilities::where('room_id','=', $id)->update(['name_facilities' => $request->name_facilities]);
   
            

   $images = $this->EdituploadFiles($request);

foreach ($images as $imageFile) {

    list($fileName,$hid) = $imageFile;

    $hotel = new RoomImage();
            $hotel->file_name = $fileName;
            $hotel->room_id = $hid;
            $hotel->save();
}


    return redirect()->route('api.editRoomHotel', ['id' => $id])->with('message', 'Your hotel successfully Updated!');

}


protected function EdituploadFiles($request)
   {

    $uploadedImages = [];
 

        if ($request->hasFile('file_name'))
        {
            $images = $request->file('file_name');
            $id = $request->id;

            foreach ($images as $image) {
                $uploadedImages[] = $this->EdituploadFile($image,$id);
            }
        
        }
        return $uploadedImages;
    } 

protected function EdituploadFile($image, $id){

        $originalFileName = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
            $fileName = str_slug($fileNameOnly) . "-" . time() . "." . $extension;

            $hotelid = $hotel = HotelRoom::find($id);
             $hid= $hotelid->id;

            $uploadedFileName = $image->storeAs('public/files', $fileName);

            return [$uploadedFileName, $hid];
    }
///////////////////////// END EDIT DATA ////////////////////////////////////////////


public function hapusGambar($gambarid, $id){

        $hapus = RoomImage::where('id_image','=',$gambarid)->delete();

       return redirect()->route('api.editRoomHotel', ['id' => $id])->with('message', 'Your Image successfully deleted!');

}

    public function destroy($id)
        {

        $hapus = HotelRoom::findorfail($id)->delete();

        return response()->json($hapus);

        }


}

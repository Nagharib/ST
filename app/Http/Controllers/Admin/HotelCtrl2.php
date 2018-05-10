<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Image;
use App\Model\Hotel;
use App\Model\PromoKota;
use DB;
use Illuminate\Support\Facades\Redirect;

class HotelCtrl2 extends Controller
{
   //

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
        $this->data['title'] = 'Data Kota Terpopuler';
        $this->data['deskripsi_title'] = 'Admin';
        
        $hotels = Hotel::latest()->get();
        /*$citys = DB::table('ng_promo2s')->select('city');*/
        $citys = PromoKota::latest()->get();

        return view('backend.tambahhotel',  ['hotels' => $hotels,'citys' => $citys],$this->data);     
    
    }

    public function store(Request $request){
    	$this->validate($request,[
    		
    		'hotel_name' => 'required'
    	]);
            $a = $request->unit_price;
            $b = $request->disc_price;
            $c = $a * $b / 100;
            $d = $a - $c;

    		$hotel = new Hotel();
            $hotel->hotel_name = $request->hotel_name;
            $hotel->description = $request->description;
            $hotel->address = $request->address;
            $hotel->city = $request->city;
            $hotel->province = $request->province;
            $hotel->unit_price = $request->unit_price;
            $hotel->disc_price = $request->disc_price;
            $hotel->total_price = $d;
            $hotel->information = $request->information;
	    	
	    	$hotel->save();

//UPLOAD FILE
$images = $this->uploadFiles($request);



foreach ($images as $imageFile) {



	list($fileName,$hid) = $imageFile;

	$hotel = new Image();
            $hotel->file_name = $fileName;
            $hotel->id_hotel = $hid;
            
            
	    	$hotel->save();
}
//END UPLOAD FILE
    	return redirect('admin/tambahhotel')->with('message', 'Your hotel successfully uploaded!');
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

            $hotelid = Hotel::whereRaw('id = (select max(`id`) from ng_hotels)')->first();
             $hid= $hotelid->id;

            $uploadedFileName = $image->storeAs('public/files', $fileName);

    		return [$uploadedFileName, $hid];
    }

 public function update($id){

        $this->data['title'] = 'Data Kota Terpopuler';
        $this->data['deskripsi_title'] = 'Admin';

        $hotels = DB::select(DB::raw("
            select ng_hotels.*,ng_images.file_name,ng_images.id as gambarid from ng_hotels  
            LEFT JOIN ng_images ON 
            ng_images.id_hotel = ng_hotels.id 
            where ng_hotels.id = $id 
            "));
        
        return view('backend.editHOtel',  ['hotels' => $hotels],$this->data);
    }

///////////////////////// EDIT DATA ////////////////////////////////////////////

public function updateData(Request $request, $id ){

  /* $hotel = Hotel::where('id', $id)->update($request->except(['_token','file_name']));*/
            $a = $request->unit_price;
            $b = $request->disc_price;
            $c = $a * $b / 100;
            $d = $a - $c;

  $hotel = Hotel::find($id);

  $hotel->hotel_name = $request->hotel_name;
            $hotel->description = $request->description;
            $hotel->address = $request->address;
            $hotel->city = $request->city;
            $hotel->province = $request->province;
            $hotel->unit_price = $request->unit_price;
            $hotel->disc_price = $request->disc_price;
            $hotel->total_price = $d;
            $hotel->information = $request->information;
   $hotel->save();

   $images = $this->EdituploadFiles($request);

foreach ($images as $imageFile) {

    list($fileName,$hid) = $imageFile;

    $hotel = new Image();
            $hotel->file_name = $fileName;
            $hotel->id_hotel = $hid;
            
            
            $hotel->save();
}
    return redirect()->route('api.editHotel', ['id' => $id])->with('message', 'Your hotel successfully Updated!');

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

            $hotelid = $hotel = Hotel::find($id);
             $hid= $hotelid->id;

            $uploadedFileName = $image->storeAs('public/files', $fileName);

            return [$uploadedFileName, $hid];
    }
///////////////////////// END EDIT DATA ////////////////////////////////////////////


public function hapusGambar($gambarid, $id){

        $hapus = Image::findorfail($gambarid)->delete();

       return redirect()->route('api.editHotel', ['id' => $id])->with('message', 'Your Image successfully deleted!');

}

    public function destroy($id)
        {

        $hapus = Hotel::findorfail($id)->delete();

        return response()->json($hapus);

        }


}

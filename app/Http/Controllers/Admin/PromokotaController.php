<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Promo;
use App\Model\PromoKota;
use DB;

class PromokotaController extends Controller
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
        $this->data['title'] = 'Data Promo Kota';
        $this->data['deskripsi_title'] = 'Admin';
        
        $images = PromoKota::latest()->get();
        return view('backend.promokota',  ['images' => $images],$this->data);    	
    
    }

    public function store(Request $request){

    	$this->validate($request,[
    		'file_name' => 'mimes:jpg,jpeg,png,gif,bmp',
    		'city' => 'required',
    		'position' => 'required'

    	]);

    	$images = $this->uploadFile($request);


    		$image = new PromoKota();
	    	$image->city = $request->city;
	    	$image->file_name = $this->uploadFile($request);
	    	$image->position = $request->position;
	    	$image->save();

    	return redirect('admin/promokota')->with('message', 'Your image successfully uploaded!');
    }

   protected function uploadFile($request)
    {
    	if ($request->hasFile('file_name'))
    	{
    		$image = $request->file('file_name');
    		$originalFileName = $image->getClientOriginalName();
    		$extension = $image->getClientOriginalExtension();
    		$fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
    		$fileName = str_slug($fileNameOnly) . "-" . time() . "." . $extension;

    		 
    		return $image->storeAs('public', $fileName);
    	}
    	return null;
    } 

    public function destroy($id)
        {


            $image = DB::table('ng_promo2s')->where('id',$id)->delete();

            return redirect('admin/promokota')->with('message', 'Your image successfully Deleted!');
        }
}

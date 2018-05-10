<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Promo;
use DB;

class ImageController extends Controller
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
        $this->data['title'] = 'Data Promo Terkini';
        $this->data['deskripsi_title'] = 'Admin';
        
        $images = Promo::latest()->get();
        return view('backend.promo2',  ['images' => $images],$this->data);    	
    
    }

    public function store(Request $request){

    	$this->validate($request,[
    		'file_name' => 'mimes:jpg,jpeg,png,gif,bmp',
    		'title' => 'required'

    	]);

    	$images = $this->uploadFile($request);


    		$image = new Promo();
	    	$image->title = $request->title;
	    	$image->file_name = $this->uploadFile($request);
            $image->is_slider = $request->is_slider;
	    	$image->save();

    	return redirect('admin/promo2')->with('message', 'Your image successfully uploaded!');
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

    public function destroy($id_promo_header)
        {


            $image = DB::table('ng_promo_headers')->where('id_promo_header',$id_promo_header)->delete();

            return redirect('admin/promo2')->with('message', 'Your image successfully Deleted!');
        }


}

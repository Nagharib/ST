<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Promo;
use App\Model\Hotel;
use DB;

class HotelCtrl extends Controller
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
        
   
        /*$thumbnails = DB::table('ng_hotels')
            ->select('ng_hotels.*, ng_images.*')
            ->leftJoin('ng_images', 'ng_images.id_hotel', '=', 'ng_hotels.id')

            ->groupBy('ng_images.id_hotel')
            ->get();*/

        $thumbnails = DB::select(DB::raw("
            select ng_hotels.*,ng_images.file_name 
            from ng_hotels
            LEFT JOIN ng_images ON 
            ng_images.id_hotel = ng_hotels.id 
            GROUP BY ng_images.id_hotel"));

    
        return view('backend.hotel',  ['thumbnails' => $thumbnails], $this->data);   	
    
    }

   
    public function getLayanan(Request $request){
        $cari = $request->get('cari');
       /* DB::enableQueryLog();*/
       /* if($cari){
            $typekamar = Perum::whereHas('Perum',function($q) use ($cari){
                                $q->where('name','LIKE','%'.$cari.'%');
                            })->orWhere('description','LIKE','%'.$cari.'%')
                            ->orWhere('address','LIKE','%'.$cari.'%')
                            ->orWhere('region','LIKE','%'.$cari.'%')
                            ->with('Perum')
                            ->paginate(5)
                            ->appends($request->only('cari'));
        } else {*/
            //$post = Auth::user()->jmlperum();
            /* $accounts = DB::table('ng_housings')->paginate(5)
            ->leftJoin('users', 'users.account_id', '=', 'ng_housings.account_id')
            ->get();*/

            //$typekamar = Perum::with('user')->paginate(5);
            //$typekamar = Perum::where('account_id',1)->firstOrFail()->paginate(5);
          /* $typekamar = DB::table('ng_hotels')->paginate(5);*/

           $typekamar = DB::select(DB::raw("
            select * from ng_hotels 
            INNER JOIN ng_images ON 
            ng_images.id_hotel = ng_hotels.id 
            GROUP BY ng_images.id_hotel"))

           ;

           /*DB::table('ng_hotels')->paginate(5)
            ->leftJoin('ng_images', 'ng_images.id_hotel', '=', 'ng_hotels.id')
            ->groupBy('ng_images.id_hotel')
            ->get();*/

           
           /* $typekamar = Hotel::where('account_id', Auth::user()->account_id)->paginate(5);*/
            
       // }
         /*       echo "<pre>".print_r(
            DB::getQueryLog()   
        ,true)."</pre>";*/
        return response()->json($typekamar);
    }

   

   
    public function destroy($id)
        {

        $hapus = Hotel::findorfail($id)->delete();

        return response()->json($hapus);

        }


}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location\Perumahan;
use App\Location\Block;
use App\Model\User;
use App\Model\Perum;
use App\Model\ThirdParty;
use Illuminate\Support\Facades\Auth;
use DB;
class UserCreatController extends Controller
{
    //
        /**
     * Get all province
     *
     * @return string JSON
     */

/////////////////////////////////////////////////////////////////////////
    public function userpilih()
    {
   $products = ThirdParty::orderBy('first_name', 'ASC')->where('is_customer','Y')->get();
        return $products;
        //return response()->json(Perumahan::orderBy('name', 'ASC')->get());
    }

	public function userpilih2()
    {
   $products = ThirdParty::orderBy('first_name', 'ASC')->where('is_employee','Y')->get();
        return $products;
        //return response()->json(Perumahan::orderBy('name', 'ASC')->get());
    }    
   
  

     public function pilihuser()
    {
        $editblock = ThirdParty::whereId(request('customer'))
            ->orderBy('first_name', 'ASC')
            ->get();
           
        return response()->json($editblock);
    }

///////////////////////////////////////////////////////////////////////
    ///
    /**
     * Get cities based on selected province
     *
     * @return string JSON
     */
   
    public function form()
    {
        return view('location.form')
            ->withTitle('Lokasi');
    }

    public function submit(Request $request)
    {
        // do something here
        return response()->json([
            'status' => true,
            'message' => 'Semua data valid.',
        ]);
    }
}

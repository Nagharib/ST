<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/////////////////////////////////////
use App\Location\Perumahan;
use App\Location\Block;
use App\Model\User;
use App\Model\Perum;
use Illuminate\Support\Facades\Auth;
use DB;
////////////////////////////////////
class LocationController extends Controller
{

    /**
     * Get all province
     *
     * @return string JSON
     */

/////////////////////////////////////////////////////////////////////////
    public function perumahan()
    {
   $products = Perum::where('account_id',Auth::user()->account_id)
            ->get();
        return $products;
        //return response()->json(Perumahan::orderBy('name', 'ASC')->get());
    }

   public function block()
    {
        $blockna = Block::whereHouseId(request('perumahan'))
            ->orderBy('name', 'ASC')
            ->get();

        return response()->json($blockna);
    }

    public function userna()
    {
        $userna = User::where('id',Auth::user()->id)->get();
           
        return response()->json($userna);
    }

     public function editblock()
    {
        $editblock = Block::whereHouseId(request('perum'))
            ->orderBy('name', 'ASC')
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

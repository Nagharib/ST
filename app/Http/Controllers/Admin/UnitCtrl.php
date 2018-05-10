<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Perum;
use App\Model\Unit;

use App\Model\Block;
use App\Model\Ng_account;
use App\Model\User;
use DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class UnitCtrl extends Controller
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
        $this->data['title'] = 'Unit Perumahan';
        $this->data['deskripsi_title'] = 'Unit Perumahan';
        /*
        $this->data['block'] = perum::where('account_id',Auth::user()->account_id)->pluck('name','id');
		
        $this->data['blocka'] = perum::where('account_id',Auth::user()->account_id)->pluck('name','id');
		
        $this->data['blockna'] = block::where('account_id',Auth::user()->account_id)->pluck('name','id');
        */
		return view('backend.unitp', $this->data);

        
    }
///////////////////////////////// SELECT CHAINED COMBOBOX ////////////////////////////////////

	public function perumahan(Request $request)
    {
        $un = perum::orderBy('name', 'ASC')->get();
        return response()->json($un);
    }

   public function block()
    {
        $block = block::whereHouseId(request('perumahan'))
            ->orderBy('name', 'ASC')
            ->get();

        return response()->json($block);
    }

//////////////////////////////////////////////////////////////    
    public function getUnit(Request $request){
        $cari = $request->get('cari');
       /* DB::enableQueryLog();*/
       /* if($cari){
            $typeblock = Perum::whereHas('Perum',function($q) use ($cari){
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

            //$typeblock = Block::with('user')->paginate(5);
            //$typeblock = Perum::where('account_id',1)->firstOrFail()->paginate(5);
            //$post = DB::table('ng_housings')->where('name', 'a')->first();
            //$typeblock = Block::where('account_id', Auth::user()->account_id)->paginate(5);
            //$unit = Unit::with(['house','block',])
           //->paginate(5);

           $unit = DB::table('ng_house_units')
            ->join('ng_housings', 'ng_house_units.house_id', '=', 'ng_housings.id')
            ->join('ng_house_blocks', 'ng_house_units.block_id', '=', 'ng_house_blocks.id')
            ->select('ng_house_units.*', 'ng_housings.name as perumna', 'ng_house_blocks.name as blokna')
            ->where('ng_housings.account_id', Auth::user()->account_id)
            ->paginate(5);
            

            
       // }
         /*       echo "<pre>".print_r(
            DB::getQueryLog()
        ,true)."</pre>";*/
        return response()->json($unit);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
        
        'description' => 'required'
        ]);
        

        $buat = Unit::create($request->all());

        return response()->json($buat);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
           
            'description' => 'required'
        ]);
        $ubah = Unit::findorfail($id)->update($request->all());

        return response()->json($ubah);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         $hapus = Unit::findorfail($id)->delete();

        return response()->json($hapus);
    }
}

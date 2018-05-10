<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Promo;
use App\Model\Ng_account;
use App\Model\User;
use DB;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Auth;

class PromoCtrl extends Controller
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
        $this->data['title'] = 'Data Promo Terkini';
        $this->data['deskripsi_title'] = 'Admin';
       // $this->data['layanan_kategori'] = layananKategori::pluck('nama_layanan_kategori','id');
        return view('backend.promo', $this->data);

        
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
            //$post = DB::table('ng_housings')->where('name', 'a')->first();
            $typekamar = DB::table('ng_promo_headers')->paginate(5);

            
       // }
         /*       echo "<pre>".print_r(
            DB::getQueryLog()   
        ,true)."</pre>";*/
        return response()->json($typekamar);
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
        'promo_name' => 'required',
        'description' => 'required',
 
    	]);
		
        //$avatar = $request->file('img')->store('images');
        $buat = Promo::create($request->all());

        dd($buat);
        //return response()->json($buat);
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
            'name' => 'required',
            'description' => 'required'
        ]);
        $ubah = Perum::findorfail($id)->update($request->all());

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
         $hapus = Promo::findorfail($id)->delete();

        return response()->json($hapus);
    }
}

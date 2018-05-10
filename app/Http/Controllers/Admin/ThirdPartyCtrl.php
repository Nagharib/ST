<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Perum;
use App\Model\Ng_account;
use App\Model\User;
use App\Model\ThirdParty;
use DB;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Auth;
class ThirdPartyCtrl extends Controller
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
        $this->data['title'] = 'Pelanggan';
        $this->data['deskripsi_title'] = 'Administrasi Perumahan';
       // $this->data['layanan_kategori'] = layananKategori::pluck('nama_layanan_kategori','id');
        return view('backend.hotel', $this->data);

        
    }

    
    public function indexEmp()
    {
        //
        $this->data['title'] = 'Karyawan';
        $this->data['deskripsi_title'] = 'Administrasi Perumahan';
       // $this->data['layanan_kategori'] = layananKategori::pluck('nama_layanan_kategori','id');
        return view('backend.employee', $this->data);

        
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
            //$typekamar = ThirdParty::where('account_id', Auth::user()->account_id)->paginate(5);
            $typekamar = DB::table('ng_third_partys')
                                ->where('account_id',  Auth::user()->account_id)
                                ->where('is_customer','Y')
                                
                                ->paginate(5);            

            
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
        'first_name' => 'required'
        ]);
        
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $pin = mt_rand(1000000, 9999999)
        . mt_rand(1000000, 9999999)
        . $characters[rand(0, strlen($characters) - 1)];          

        //$buat = ThirdParty::create($request->all());

            $cust = ThirdParty::create();
            $cust->account_id = $request->account_id;
            $cust->cust_number = $pin;
            $cust->first_name = $request->first_name;
              $cust->last_name = $request->last_name;
              $cust->birth_date = $request->birth_date;
              $cust->birth_place = $request->birth_place;
              $cust->address_1 = $request->address_1;
              $cust->address_2 = $request->address_2;
              $cust->address_3 = $request->address_3;
              $cust->country = $request->country;
              $cust->province = $request->province;
              $cust->city = $request->city;
              $cust->zip_code = $request->zip_code;
              $cust->religion = $request->religion;
              $cust->married_status = $request->married_status;
              $cust->occupation = $request->occupation;
              $cust->nationality = $request->nationality;
              $cust->phone_number = $request->phone_number;
              $cust->mobile_number = $request->mobile_number;
              $cust->email = $request->email;
              $cust->is_customer = $request->is_customer;
              $cust->is_employee = $request->is_employee;              
            $cust->save();   

   


        return response()->json($cust);
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
            
        ]);
        $ubah = ThirdParty::findorfail($id)->update($request->all());

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
         $hapus = ThirdParty::findorfail($id)->delete();

        return response()->json($hapus);
    }    
}

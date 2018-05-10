<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\User;
use App\Model\ThirdParty;
use App\Model\userRole;
use DB;
use Mail;

use Illuminate\Support\Facades\Auth;
class UserCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('role')->except('edit','update');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	public function default_account_id($a){
		return $a == 'a1';
	}
	
	 public function index()
    {
        //
        $this->data['title'] = 'Pengguna';
        $this->data['deskripsi_title'] = 'Administrasi pengguna sistem';
        $this->data['user_roles'] = userRole::pluck('role_name','id');
        return view('backend.user',$this->data);
    }

    ///////////////////////////////// SELECT CHAINED COMBOBOX ////////////////////////////////////

    public function userp(Request $request)
    {
        $un = ThirdParty::orderBy('first_name', 'ASC')->get();
        return response()->json($un);
    }



//////////////////////////////////////////////////////////////    

    public function getUser(Request $request)
    {
        $cari = $request->get('cari');
        if($cari){
            $user = User::whereHas('userroles',function($q) use ($cari){
                                    $q->where('role_name','LIKE','%'.$cari.'%');
                                })
                                ->orWhere('name','LIKE','%'.$cari.'%')
                                ->orWhere('email','LIKE','%'.$cari.'%')
                                
                                ->orWhere('username','LIKE','%'.$cari.'%')
                                ->with('userroles')
                                ->paginate(5)
                                ->appends($request->only('cari'));
        } else {
            //$user = User::with('userroles')->paginate(5);
        
            $user = DB::table('users')
            ->join('user_roles', 'users.role_id', '=', 'user_roles.id')
            ->select('users.*','user_roles.role_name')
            ->where('account_id', Auth::user()->account_id)
            ->paginate(5);
        }
        return response()->json($user);
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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }   

public function store(Request $request)
    {   
  
        $iduser = $request->input('iduser');
        $name = $request->input('name');
        $email = $request->input('email');

        $buat = User::create();
        $buat->name = $request->input('name');
        $buat->username = $request->input('username');  
        $buat->email = $request->input('email');  
        $buat->password = $request->input('password');  
        $buat->role_id = $request->input('role_id');  
        $buat->no_telp = $request->input('no_telp');  
        $buat->account_id = $request->input('account_id');  
        $buat->user_primary_flag = $request->input('user_primary_flag'); 
        $buat->valid_dateto = $request->input('valid_dateto'); 
        $buat->save(); 

       //$buat = User::create($request->all());

        $third = ThirdParty::where('id', $iduser)->first();
        $third->user_id = $buat->id;
        $third->save();       

       $data = array('name' => $name,
                  'email' => $email); 

       Mail::send('mails.confirm', $data, function($message) use($data){
                $message->to($data['email']);
                $message->subject('Regitration Confitmation');
             });       

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
        $this->data['title'] = 'Profil';
        $this->data['deskripsi_title'] = 'Data Profil Pengguna';
        $this->data['user'] = User::find($id);
        $this->data['user_roles'] = userRole::pluck('role_name','id');
        return view('backend.users.edit',$this->data);
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
        $response = ['success' => false ,'message' => 'Data Tidak Berhasil Diubah'];

        $this->validate($request, [
            'name' => 'required',
            'role_id' =>'numeric|min:1',
          
            'no_telp' => 'required',
            'email' => 'required|email'
        ]);
        $buat = User::findorfail($id)->update($request->all());

        if($buat){
            $response = ['success' => true , 'message' => 'Data Berhasil Diubah'];
        }
        return response()->json($response);
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
        $hapus = User::findorfail($id)->delete();
        
        return response()->json($hapus);
    }
}

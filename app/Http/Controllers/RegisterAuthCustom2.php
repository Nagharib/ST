<?php

namespace App\Http\Controllers;

use Response;
use Exception;
use Illuminate\Http\Request;

use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use DB;
use Mail;

class RegisterAuthCustom extends Controller
{
    //
	public function showRegisterForm()
	{
		return view('register');
	}
	public function showAccountForm()
	{
		
		return view('account');
	}

/*
	function regInsert(Request $reg){
	
		$errormsg = "";
        $result = false;
        try{
        	$name=$reg->input('name');
			$username=$reg->input('username');
			$email=$reg->input('email');
			$password=$reg->input('password');
			$no_telp=$reg->input('no_telp');
			$role='1';

			$data = array('name'=>$name,'username'=>$username,'email'=>$email,'password'=>$password,'no_telp'=>$no_telp,'role_id'=>$role);

            $result = DB::table('users')->insert($data);
             return view('account');
        }catch(\Exception $exception)
        {
            $errormsg = 'Database error! ' . $exception->getCode();

            return view('already');
        }
         return Response::json(['success'=>$result,'errormsg'=>$errormsg]);
	

	}
*/
	

/*
	function regInsert(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username'=>$data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'no_telp' => $data['no_telp'],
        ]);
    }	
*/

	protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }    

	protected function register(Request $request){
        $input =  $request->all();
        $validator = $this->validator($input);

        if ($validator->passes()){
            $data = $this->create($input)->toArray();

            $data['token'] = str_random(25);

            $user = User::find($data['id']);
            $user->token = $data['token'];
            $user->save();

            Mail::send('mails.confirmation', $data, function($message) use($data){
                $message->to($data['email']);
                $message->subject('Regitration Confitmation');
             });
            return redirect(route('login'))->with('status','Confirmation email has been send. Please check your email.');
        }
        return redirect(route('login'))->with('status', $validator->errors());
    }


    public function confirmation($token){
        $user = User::where('token', $token)->first();

        if (!is_null($user)){
            $user->confirmed = 1;
            $user->token = '';
            $user->role_id = 4;
         
            $user->save();
            return redirect(route('login'))->with('status', 'Your activation is completed.');
        }
            return redirect(route('login'))->with('status', 'Ooops!!!');

    }
	
}


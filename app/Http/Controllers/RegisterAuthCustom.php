<?php

namespace App\Http\Controllers;

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
	public function showAccountForm($account_id)
	{	
		$account_id = User::find($account_id);
		
		return redirect(route('accountReg'));
	}   


     protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'no_telp' => $data['no_telp'],
          
        ]);
    }

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

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		// generate a pin based on 2 * 7 digits + a random character
		$pin = mt_rand(1000000, 9999999)
		    . mt_rand(1000000, 9999999)
		    . $characters[rand(0, strlen($characters) - 1)];

		// shuffle the result
		

        if ($validator->passes()){
            $data = $this->create($input)->toArray();

            $data['token'] = str_random(25);
        
        $tanggal_now = date('Y-m-d');
         $tambah_tanggal = mktime(0,0,0,date('m')+1,date('d'),date('Y'));
         $dateto = date('Y-m-d',$tambah_tanggal);           

            $user = User::find($data['id']);
            $user->token = $data['token'];
            $user->valid_dateto = $dateto;
          
            
            $user->save();
/* SEND MAIL
            Mail::send('mails.confirmation', $data, function($message) use($data){
                $message->to($data['email']);
                $message->subject('Regitration Confitmation');
             });
*/
            //return redirect(route('login'))->with('status','Confirmation email has been send. Please check your email.');
            return redirect(route('acc',$user->id));
        }
        return redirect(route('login'))->with('status', $validator->errors());
    }


    public function confirmation($token){
        $user = User::where('token', $token)->first();

                

        if (!is_null($user)){
            $user->confirmed = 1;
            $user->token = '';
            $user->role_id = 4;
            $user->user_primary_flag = 'Y';
         
         
            $user->save();
            return redirect(route('login'))->with('status', 'Your activation is completed.');
        }
            return redirect(route('login'))->with('status', 'Ooops!!!');

    }

 public function confirm($email){
        $user = User::where('email', $email)->first();

        if (!is_null($user)){
            $user->confirmed = 1;
            $user->token = '';
            $user->user_primary_flag = 'N';
         
            $user->save();
            return redirect(route('login'))->with('status', 'Your activation is completed.');
        }
            return redirect(route('login'))->with('status', 'Ooops!!!');

    }    
 
}

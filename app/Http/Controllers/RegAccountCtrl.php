<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\User;
use App\Model\AccountModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use DB;
use Mail;

class RegAccountCtrl extends Controller
{
    //
    public function showAccForm()
	{
		return view('account');
	}
    
 protected function create(array $data)
    {
        return AccountModel::create([
            'user_id' => $data['user_id'],
            'name' => $data['name'],
            'address' => $data['address'],
            'region' => $data['region'],
            'province' => $data['province'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'website' => $data['website'],
            'comp_number' => $data['comp_number'],
            'tax_number' => $data['tax_number'],
            
          
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

 protected function regAccount($id){
		
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		// generate a pin based on 2 * 7 digits + a random character
		$pin = mt_rand(1000000, 9999999)
		    . mt_rand(1000000, 9999999)
		    . $characters[rand(0, strlen($characters) - 1)]; 


			$acc = AccountModel::create();
            $acc->user_id = $id;
            $acc->created_by = $id;
            $acc->updated_by = $id;
            $acc->account_number = $pin;
            $acc->save(); 			

            $user = User::where('id', $id)->first();
            $user->account_id = $acc->id;
            $user->save();


            $data['idna'] = $id;
            return view('account',$data);
    }  

    
    protected function AddAccount(Request $request,$idna){
    		
    		$accna = AccountModel::where('user_id', $idna)->update($request->except(['_token']));
   
            $data['idna'] = $idna;  

            $userdata = User::where('id', $idna)->first();
            $data = array('name' => $userdata->name,
                  'token' => $userdata->token);

			Mail::send('mails.confirmation', $data, function($message) use($userdata){
                $message->to($userdata->email);
                $message->subject('Regitration Confitmation');
             });

            return redirect(route('login'))->with('status','Confirmation email has been send. Please check your email.');            	

    }  
          
    
}

<?php
namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use App\Model\AccountModel;
use DB;


class loginCtrl extends Controller
{
    //
    public function checkLogin(Request $request){
    	/*DB::enableQueryLog();*/
    	$remember = $request->get('remember');
    	$username = $request->get('username');
    	$password = $request->get('password');

        $now = date('Y-m-d');

    	$check = Auth::attempt(['username' => $username, 'password' => $password,'confirmed' => 1],$remember);

        $user = User::where('username', $username)->where('confirmed', 1)->where('valid_dateto', '>=', $now)->first();

        $user2 = User::where('username', $username)->where('confirmed', 0)->where('valid_dateto', '<=', $now)->first();

        $user3 = User::where('username', $username)->where('confirmed', 1)->where('valid_dateto', '<=', $now)->first();

/*    	echo "<pre>".print_r(
            DB::getQueryLog()
        ,true)."</pre>";*/
        //die();
    	if ($user and Auth::validate(compact('password')) ) {

            $account = AccountModel::where('id', $user->account_id)->where('valid_dateto', '>=', $now)->first();
            if($account){
                return response()->json(route('dashboard.index'));
            }else{
               return response()->json(route('block'));
            }


		}elseif ($user2 and Auth::validate(compact('password')) ) {

            return response()->json(route('login'))->with('status','Your email has not been verified yet!');

        }elseif ($user3 and Auth::validate(compact('password')) ) {

            return response()->json(route('block'));

        } else {
			return redirect(route('login'))->with('status','Username not found.');
		}
    }
}

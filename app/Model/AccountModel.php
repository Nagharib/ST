<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model
{
    //	
    	protected $table = 'ng_accounts';
		protected $fillable = [
		        'user_id','account_number','name','address','region','province','phone_number', 'email', 'website','comp_number','tax_number','valid_dateto','token',
		    ];    
}

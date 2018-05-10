<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ThirdParty extends Model
{
    //
	protected $table = 'ng_third_partys';
    protected $fillable = ['user_id','account_id','cust_number','first_name','last_name','birth_date','birth_place','address_1','address_2','address_3','country',
		'province',
		'city',
		'zip_code',
		'religion',
		'married_status',
		'occupation',
		'nationality',
		'phone_number',
		'mobile_number',
		'email',
		'created_by',
		'updated_by',          
		'is_customer',
		'is_employee',          
		];        
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Perum extends Model
{
    //
     protected $table = 'ng_housings';
     protected $fillable = ['account_id','name','description','logo','address','region','province','created_by','updated_by'];

    public function user(){
    	return $this->belongsTo('App\Model\User','account_id','account_id');
    }
}

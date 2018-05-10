<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
	protected $table = 'ng_house_units';
    protected $fillable = ['name','account_id','house_id','block_id','description','active_flag','status_flag','created_by','updated_by'];

    
    public function user(){
    	return $this->belongsTo('App\Model\User','account_id','account_id');
    }
	
	public function house(){
    	return $this->hasOne('App\Model\Perum','id','house_id');
    }
	
	public function block(){
        return $this->hasOne('App\Model\Block','id','house_id');
    }
    
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    //
     protected $table = 'ng_house_blocks';
     protected $fillable = ['account_id','house_id','name','description','active_flag','created_by','updated_by'];

    
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

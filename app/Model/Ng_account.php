<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ng_account extends Model
{
    //
     protected $table = 'ng_accounts';
     protected $fillable = ['name','duedate','active_flag','status_flag','description','created_by','updated_by'];

		
    
}

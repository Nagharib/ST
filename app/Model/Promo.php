<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Promo extends Model
{
    //
     protected $table = 'ng_promo_headers';
     protected $fillable = ['title','file_name','is_slider','created_by','updated_by'];

      public function getSrcAttribute()
    {
    	return Storage::url($this->file_name);
    }
}

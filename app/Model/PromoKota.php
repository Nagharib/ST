<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Storage;

class PromoKota extends Model
{
    protected $table = 'ng_promo2s';
     protected $fillable = ['file_name','city','position','created_by','updated_by'];

        public function getSrcAttribute()
    {
        return Storage::url($this->file_name);
    }
}

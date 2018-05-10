<?php

namespace App;
use Storage;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    public function getSrcAttribute()
    {
    	return Storage::url($this->file_name);
    }
}

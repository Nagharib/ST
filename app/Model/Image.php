<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Image extends Model
{
    //
    protected $table = 'ng_images';
     protected $fillable = ['id_hotel',
     'file_name',
      'created_by',
     'updated_by'];

     public function hotel(){
     	return $this->belongsTo(Hotel::class);
     }

       public function getSrcAttribute()
    {
        return Storage::url($this->file_name);
    }

    

}

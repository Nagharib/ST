<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Hotel extends Model
{
    //
    protected $table = 'ng_hotels';
     protected $fillable = ['hotel_name',
     'description',
     'address',
     'city',
     'region',
     'province',
     'unit_price',
     'disc_price',
     'total_price',
     'information',
     'created_by',
     'updated_by'];

     

    public function gambar(){

        return $this->hasMany(Image::class);
    }

     public function getSrcAttribute()
    {
        return Storage::url($this->file_name);
    }

}

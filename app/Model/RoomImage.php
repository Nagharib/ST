<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
     //
    protected $table = 'ng_room_images';
     protected $fillable = ['room_id',
     'file_name'];

     public function hotel(){
     	return $this->belongsTo(HotelRoom::class);
     }
       public function getSrcAttribute()
    {
        return Storage::url($this->file_name);
    }

}


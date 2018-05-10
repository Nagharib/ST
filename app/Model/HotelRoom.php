<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Storage;

class HotelRoom extends Model
{
   //
    protected $table = 'ng_hotel_rooms';
     protected $fillable = ['id_hotel','
     id_fasilities',
     'room_name',
	 'room_capacity',
	'description',
	'information',
	'unit_price',
	'disc_price',
	'total_price',
	'breakfast',
	'cancellation',
    'checkin',
	'checkin2',
    'checkout',
    'checkindate',
    'checkoutdate',
    'duration',

	'special_facilities'];

     

    public function gambar(){

        return $this->hasMany(RoomImage::class);
    }

     public function getSrcAttribute()
    {
        return Storage::url($this->file_name);
    }

}
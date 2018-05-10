<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoomFacilities extends Model
{

  protected $table = 'ng_room_facilities';
     protected $fillable = ['room_id',
     'name_facilities'];
}

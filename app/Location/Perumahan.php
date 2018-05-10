<?php

namespace App\Location;

use Illuminate\Database\Eloquent\Model;

class Perumahan extends Model
{
    //
    protected $table = 'ng_housings';
      protected $fillable = [
        'name',
    ];
}

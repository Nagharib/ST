<?php

namespace App\select;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    //
    protected $table = 'ng_house_blocks';
    protected $fillable = [
        'house_id',
        'name',
    ];
}

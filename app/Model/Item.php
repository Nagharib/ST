<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $table = 'ng_dest_items';
     protected $fillable = ['dest_item_name',
     'address',
     'town_id',
     'description',
     'active_flag',
     'created_by',
     'updated_by'];
}

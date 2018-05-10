<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NgDestItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
               Schema::create('ng_dest_items', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('dest_item_name',30);
            $table->string('address',50);
            $table->string('town_id',15);
            $table->string('country_id',15);
            $table->string('unit_price',30);
            $table->string('disc_price',30);
            $table->string('total_price',30);
            $table->string('dest_type_id',15);
            $table->string('active_flag',5);
            $table->string('image_id',25);
            $table->string('image_type',50);
            $table->date('valid_date');
            $table->string('account_id');
            $table->integer('created_by');
            $table->integer('updated_by');                                              
            $table->timestamps();
        });                
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
         Schema::dropIfExists('ng_dest_items');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NgHotelRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('ng_hotel_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_hotel',10);
            $table->string('room_name');
            $table->string('room_capacity');
            $table->string('description');
            $table->string('information');
            $table->string('unit_price');
            $table->string('disc_price');
            $table->string('total_price');
            $table->string('breakfast',5);
            $table->string('cancellation',5);
            $table->string('checkin');
            $table->string('checkin2');
            $table->string('checkout');
            $table->date('checkindate');
            $table->date('checkoutdate');
            $table->string('duration',5);

            $table->string('special_facilities');
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
        Schema::dropIfExists('ng_hotel_rooms');
    }
}

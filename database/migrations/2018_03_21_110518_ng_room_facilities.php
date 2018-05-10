<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NgRoomFacilities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

    Schema::create('ng_room_facilities', function (Blueprint $table) {
            $table->increments('id_facilities');
            $table->string('room_id',10);
            $table->string('name_facilities');
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
        Schema::dropIfExists('ng_room_facilities');
    }
}

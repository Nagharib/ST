<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NgHotelImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

    Schema::create('ng_images', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('id_hotel');
          
            $table->string('file_name');

            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();

            /*$table->foreign('id_hotel')->references('id')->on('ng_hotels')->onDelete('cascade');*/
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ng_images');
    }
}

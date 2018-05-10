<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NgHotels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

  Schema::create('ng_hotels', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('hotel_name');
            $table->text('description');
            $table->text('address');
            $table->string('city');
            $table->text('region');
            $table->text('province');
            $table->text('information');
            $table->string('unit_price');
            $table->string('disc_price');
            $table->string('total_price');
            $table->string('price_note');
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
        Schema::dropIfExists('ng_hotels');
    }
}
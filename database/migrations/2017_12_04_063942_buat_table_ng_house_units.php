<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTableNgHouseUnits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
    {
        Schema::create('ng_house_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('account_id');
            $table->integer('house_id')->unsigned();
            $table->integer('block_id')->unsigned();
            $table->text('description',255);
            $table->text('active_flag',5);
            $table->text('status_flag',15);
            $table->integer('created_by');
            $table->integer('updated_by');
        
            $table->timestamps();

            $table->foreign('house_id')->references('id')->on('ng_housings')->onDelete('restrict');
            $table->foreign('block_id')->references('id')->on('ng_house_blocks')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ng_house_units');
    }
}
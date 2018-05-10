<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTableNgHouseTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
 public function up()
    {
        Schema::create('ng_housing_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            $table->integer('housing_id')->unsigned();
            $table->string('name');
            $table->text('description',255);
            $table->string('land_width');
            $table->string('land_length');
            $table->string('bld_size');
            $table->string('no_floor');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();

            $table->foreign('housing_id')->references('id')->on('ng_housings')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ng_housing_types');
    }
}
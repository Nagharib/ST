<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTableNgHousings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ng_housings', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('account_id');
            $table->text('name');
            $table->text('description',255);
            $table->text('logo');
            $table->text('address',255);
            $table->text('region');
            $table->text('province');
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
        Schema::dropIfExists('ng_housings');
    }
}
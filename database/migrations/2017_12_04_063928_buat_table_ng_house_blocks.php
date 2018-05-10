<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTableNgHouseBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
        Schema::create('ng_house_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id');
            $table->integer('house_id')->unsigned();
            $table->string('name');
            $table->text('description',255);
            $table->string('active_flag',5);
            $table->string('created_by');
            $table->string('updated_by');
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
        Schema::dropIfExists('ng_house_blocks');
    }
}

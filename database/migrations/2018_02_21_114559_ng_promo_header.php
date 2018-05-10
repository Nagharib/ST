<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NgPromoHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ng_promo_headers', function (Blueprint $table) {
            $table->Increments('id_promo_header');
            $table->string('title',30);
            $table->string('file_name');
            $table->string('is_slider',5);
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
        Schema::dropIfExists('ng_promo_headers');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTableNgAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('ng_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id',15);
            $table->string('account_number',15);
            $table->string('name',30);
            $table->text('address',50);
            $table->string('region',25);
            $table->string('province',25);
            $table->string('phone_number',25);
            $table->string('email',25);
            $table->string('website',30);
            $table->string('comp_number',30);
            $table->string('tax_number',30);
            $table->date('valid_dateto');
            $table->string('created_by');
            $table->string('updated_by');            
            $table->string('token',254)->nullable();            
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
        Schema::dropIfExists('ng_accounts');
    }
}
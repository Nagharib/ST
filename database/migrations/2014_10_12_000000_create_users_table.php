<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role_id');
            $table->string('no_telp');
            //$table->string('account_id');
            $table->rememberToken();
            $table->integer('account_id');
            $table->boolean('confirmed')->default(0);
            $table->string('token',254)->nullable();
            $table->string('user_primary_flag',5);
            $table->date('valid_dateto');
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
        Schema::dropIfExists('users');
    }
}

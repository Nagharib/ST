<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NgThirdPartys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ng_third_partys', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('user_id',15);
            $table->string('account_id',15);
            $table->string('cust_number',30);
            $table->string('first_name',30);
            $table->string('last_name',30);
            $table->date('birth_date');
            $table->string('birth_place',50);
            $table->string('address_1',50);
            $table->string('address_2',50);
            $table->string('address_3',50);
            $table->string('country',30);
            $table->string('province',30);
            $table->string('city',30);
            $table->string('zip_code',10);
            $table->string('religion',30);
            $table->string('married_status',10);
            $table->string('occupation',30);
            $table->string('nationality',30);
            $table->string('phone_number',25);
            $table->string('mobile_number',25);
            $table->string('email',25);
            $table->string('created_by');
            $table->string('updated_by');                       
            $table->string('is_customer',5);                       
            $table->string('is_employee',5);                       
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
         Schema::dropIfExists('ng_third_partys');
    }
}

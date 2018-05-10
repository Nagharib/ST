<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        $perusahaan = config('settings.perusahaan');
       

       //UPLOAD

        Validator::extend('image64', function ($attribute, $value, $parameters, $validator) {
        $type = explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
        if (in_array($type, $parameters)) {
            return true;
        }
        return false;
    });

    Validator::replacer('image64', function($message, $attribute, $rule, $parameters) {
        return str_replace(':values',join(",",$parameters),$message);
    });

        //


        $check_table = Schema::hasTable('perusahaan');
         if($check_table){
            $set = $perusahaan::find(1);
            if($set){
                config(['settings.nama_hotel' => $set->nama_hotel,
                        'settings.nama_perusahaan' => $set->nama_perusahaan,
                        'settings.alamat_jalan' => $set->alamat_jalan,
                        'settings.alamat_kabupaten' => $set->alamat_kabupaten,
                        'settings.alamat_provinsi' => $set->alamat_provinsi,
                        'settings.nomor_telp' => $set->nomor_telp,
                        'settings.nomor_fax' => $set->nomor_fax,
                        'settings.website' => $set->website,
                        'settings.email' => $set->email]);
            }
        }   

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }



}

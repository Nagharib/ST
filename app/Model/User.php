<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','role_id','no_telp','account_id','confirmed','user_primary_flag','token','valid_dateto',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userroles()
    {
        return $this->hasOne('App\Model\userRole','id','role_id');
    }

    public function setPasswordAttribute($value){
        return $this->attributes['password'] = bcrypt($value);
    }

    public function jmlperum(){
             return $this->hasMany('App\Model\Perum','account_id','account_id');
         
        }

    public function jmlblock(){
             return $this->hasMany('App\Model\Block','account_id','account_id');
         
        }

 

}

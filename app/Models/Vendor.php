<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Vendor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

      protected $table='vendors';
      protected $guard= 'vendor';


      protected $fillable = [

        'name',
        'email',
        'password',
        'country_code',
        'phone_no',
        'address',
      
        'terms_condition'

    ];

     protected $hidden = [
        'password',
      
    ];


    public function setPasswordAttribute($password){
        $this->attributes['password']=bcrypt($password);
    }

       public function vendor_product(){

          return $this->hasMany(Product::class, 'vendor_id', 'id')->with('ProductImage')->orderBy('id', 'DESC');

        }



}

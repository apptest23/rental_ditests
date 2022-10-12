<?php
namespace App\Models;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notification\notifiable;
class Admin extends Authenticatable
{
   
    // The authentication guard for admin

    protected $table='admins';
    protected $guard= 'admin';

      protected $fillable = [
        'name',
        'email',
        'password',
        'token',
       
    ];

     protected $hidden = [
        'password',
      
    ];


    public function setPasswordAttribute($password){
        $this->attributes['password']=bcrypt($password);
    }
}

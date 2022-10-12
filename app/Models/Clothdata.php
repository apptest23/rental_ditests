<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothdata extends Model
{
    use HasFactory;

    protected $table='colth_data';

       protected $fillable = [
         'size',
         'colour',
         'product_id'

    ];
}

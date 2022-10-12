<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beg_Item extends Model
{
    use HasFactory;

     protected $table='beg_item';


       protected $fillable = [

        'product_id',
        'user_id',
        'image',
        'product_name',
        'price',
        'total_qty',
        'delivery_date',
        'return_date',
        'days',
        'Quantity',
     
    ];
}

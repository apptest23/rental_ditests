<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tranding_product extends Model
 {
    use HasFactory;

    protected $table='tranding_product';

       protected $fillable = [

          'product_id',
          'vendor_id',
    
      ];

         public function tranding_product(){

          return $this->hasMany(Product::class, 'id', 'product_id')->with('ProductImage')->orderBy('id', 'DESC');

        }
 }

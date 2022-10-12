<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

       protected $table='subcategory';

       protected $fillable = [
        'category',
        'name',
    
     
    ];
     public function Product_Item()

        {
         return $this->hasMany(Item::class, 'subcategory', 'id');

        }
}

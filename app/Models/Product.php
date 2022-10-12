<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

       protected $table='product';


       protected $fillable = [
           
        'name',
        'category',
        'subcategory',
        'price',
        'quantity',
        'description',
        'vendor_id',
        'Item',
        'status',
        'total_qty',
         'current_status',

    ];


       public function ProductImage()

        {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');

        }

         public function Clothdata()
 
         {
          return $this->hasMany(Clothdata::class, 'product_id', 'id');

         }
          public function category()

        {
        return $this->hasMany(Category::class, 'id', 'category');

        }
          public function subcategory()

        {
        return $this->hasMany(SubCategory::class, 'id', 'subcategory');

        }



}

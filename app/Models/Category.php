<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

       protected $table='category';


       protected $fillable = [
        'image',
        'icon_image',
        'name',
        'description'
     
    ];
    
        public function categoryProduct(){

          return $this->hasMany(Product::class, 'category', 'id')->with('ProductImage')->orderBy('id', 'DESC');

        }
           public function SubCategorylist(){

          return $this->hasMany(SubCategory::class,'category','id')->with('Product_Item');

        }
           public function category()

        {
        return $this->hasMany(Category::class, 'id', 'category');

        }



}

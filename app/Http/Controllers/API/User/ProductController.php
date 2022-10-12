<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\Clothdata;
use App\Models\Size;
use App\Models\Tranding_product;
use App\Models\Vendor;
use Hash;
use Validator;
use Carbon\Carbon;


class ProductController extends BaseController
{
      public function getCategory()
       {


        try {

           $category= Category::all();

           $responseArray=[];

           $responseArray['category']=$category;

           $responseArray['message']='Get all categories';

           return $this->sendResponse($responseArray, 'Get all categories');


          }catch (\Throwable $th) {

            return $this->sendError('something went wrong.!!! please try again later.');

          }

      }


      public function getSubCategory(Request $request)
         {

         try {


                $validator = Validator::make($request->all(), [
                    
                    'category_id' => 'required',
               
                  
                 ]);


                  if($validator->fails()){

                     return $this->sendError('Validation Error.', $validator->errors());  

                   }

                   $category_id=$request->category_id;

                   $sub_category= SubCategory::where('category',$category_id)->get();

                   $responseArray=[];

                   $responseArray['subcategory']=$sub_category;

                   $responseArray['message']='Get subcategory of category';

                   return $this->sendResponse($responseArray, 'Get subcategory of category');


                   }catch (\Throwable $th) {

                      return $this->sendError('something went wrong.!!! please try again later.');

              }

        }

          public function getProductbySubcategory(Request $request)
           {

         try {

                $validator = Validator::make($request->all(), [
                    
                    'subcategory_id' => 'required',
               
                  
                 ]);


                  if($validator->fails()){

                     return $this->sendError('Validation Error.', $validator->errors());  

                   }

                   $subcategory_id=$request->subcategory_id;

                   $product=Product::where('subcategory',$subcategory_id)->with(['ProductImage','Clothdata'])->get();

                   $responseArray=[];

                   if($product==null){

                      return $this->sendResponse($responseArray, 'No product is available ');
                     
                   }else{


                   $responseArray['product']=$product;

                   $responseArray['message']='Get product by SubCategory id';

                   return $this->sendResponse($responseArray, 'Get product by SubCategory id');


                    }


                   }catch (\Throwable $th){

                      return $this->sendError('something went wrong.!!! please try again later.');

              }

        }

        public function getProductbyCategory(Request $request){

           try {

                $validator = Validator::make($request->all(), [
                    
                    'category_id' => 'required',
               
                  
                 ]);


                  if($validator->fails()){

                     return $this->sendError('Validation Error.', $validator->errors());  

                   }

                   $category_id=$request->category_id;

                   $product=Product::where('category',$category_id)->with(['ProductImage','Clothdata'])->get();

                   $responseArray=[];

                   if($product==null){

                      return $this->sendResponse($responseArray, 'No product is available ');
                     
                   }else{

                     $responseArray['product']=$product;

                     $responseArray['message']='Get product by Category id';

                     return $this->sendResponse($responseArray, 'Get product by Category id');

                   }

                 }catch(\Throwable $th){

                   return $this->sendError('something went wrong.!!! please try again later.');

              }

        }

        public function getproduct_detail(Request $request){


       /*   try {*/

                $validator = Validator::make($request->all(), [
                    
                    'product_id' => 'required',
               
                  
                 ]);


                  if($validator->fails()){

                     return $this->sendError('Validation Error.', $validator->errors());  

                   }

                     $product_id=$request->product_id;

                     $product=Product::where('id',$product_id)->with(['ProductImage','Clothdata'])->get();

                     $responseArray=[];


                     if($product !=''){


                      $category_id=$product[0]->category;

                      $category=Category::where('id',$category_id)->get();

                      $category_name=$category[0]->name;


                      $subcategory_id=$product[0]->subcategory;

                      $subcategory=SubCategory::where('id',$subcategory_id)->get();

                      $subcategory_name=$subcategory[0]->name;

                      $vendor_id=$product[0]->vendor_id;

                      $vendor_data=Vendor::where('id',$vendor_id)->get();

                      $vendor_name=$vendor_data[0]->name;  
                      $vendor_phone_no=$vendor_data[0]->phone_no;


                     $responseArray['product_id']=$product[0]->id;
                     $responseArray['product_name']= $product[0]->name;
                     $responseArray['product_price']=$product[0]->price;
                     $responseArray['product_description']=$product[0]->description;
                     $responseArray['product_quantity']=$product[0]->quantity;
                     $responseArray['product_category']= $category_name;
                     $responseArray['product_subcategory']= $subcategory_name;
                     $responseArray['vendor_id']=$vendor_id;
                     $responseArray['vendor_name']=$vendor_name;
                     $responseArray['vendor_phone_no']= $vendor_phone_no;


                     $product_image=ProductImage::where('product_id',$product_id)->get();
                     $responseArray['product_image']=$product_image;


                     if($category_id==13){

                        $clothdata=Clothdata::where('product_id',$product_id)->get();

                        $colour=$clothdata[0]->colour;

                        $size=$clothdata[0]->size;

                        $sizedata=Size::where('id',$size)->get();

                        $size1=$sizedata[0]->size;

                        $responseArray['product_colour']=$colour;

                        $responseArray['product_size']=$size1;


                      }else{

                         $responseArray['product_colour']='';

                         $responseArray['product_size']='';

                      }

                     $responseArray['message']='Product detail data';

                     return $this->sendResponse($responseArray, 'Get product by Category id');


                      }else{


                        $responseArray['message']='no product avaible';

                        return $this->sendResponse($responseArray, 'no product avaible');


                      }
                 

                /* }catch(\Throwable $th){

                   return $this->sendError('something went wrong.!!! please try again later.');

              }*/

        }

        public function get_total_days(Request $request){


          try {

                $validator = Validator::make($request->all(), [
                    
                    'delivery_date' => 'required',
                    'return_date' => 'required',
               
                  
                  ]);


                  if($validator->fails()){

                     return $this->sendError('Validation Error.', $validator->errors());  

                   }

                   $delivery_date=$request->delivery_date;
                   $return_date=$request->return_date;

  
                 $delivery_date = strtotime($delivery_date);
                 $return_date = strtotime($return_date);
                 $datediff = $return_date - $delivery_date;

                $days=round($datediff / (60 * 60 * 24));

                if($days==0){


                      $days=1;

                 }


                 $responseArray=[];

                 $responseArray['total_days']=$days;

                 $responseArray['message']='Total rent days of product';

                 return $this->sendResponse($responseArray, 'Total rent days of product');
                

                 }catch(\Throwable $th){

                   return $this->sendError('something went wrong.!!! please try again later.');

              }


        }

    

             public function get_product(){

              try {
            
                   $product=Product::with(['ProductImage','Clothdata'])->inRandomOrder()->get();

                   $responseArray=[];

                   if($product==null){

                      return $this->sendResponse($responseArray, 'No product is available');
                     
                   }else{
 
                       $responseArray['product']=$product;

                       $responseArray['message']='Get product data';

                       return $this->sendResponse($responseArray, 'Get product by SubCategory id');


                      }


                    }catch (\Throwable $th){

                       return $this->sendError('something went wrong.!!! please try again later.');
  
                   }


             }
             
             
            public function getCategoryProduct(){


                 $categorylist=Category::with(['categoryProduct'])->limit(2)->get();

                 $responseArray=[];

                 $responseArray['category_productlist']=$categorylist;
           
                 $responseArray['message']='Get all category product !';

                 return $this->sendResponse($responseArray, 'Get all category product !');



             }
                 public function getTrandingProduct(){

                 $tranding_product=Tranding_product::with(['tranding_product'])->orderBy('id', 'DESC')->get();

                 $responseArray=[];

                 $responseArray['tranding_product']=$tranding_product;
           
                 $responseArray['label']='Trending Products';

                 return $this->sendResponse($responseArray, 'Get all Tranding Product!');

                }
                
                 public function search_product(Request $request){
 
                  $validator = Validator::make($request->all(), [
                    
                        'text' => 'required'
               
                  
                    ]);

                     if($validator->fails()){

                     return $this->sendError('Validation Error.', $validator->errors());  

                   }


                      $text =$request->text;
    


             if($text !=''){


                 $search_result=Product::join('category','category.id','product.category')->join('subcategory','subcategory.id','product.subcategory')->where('product.name', 'like', '%' . $text . '%')->orwhere('category.name', 'like', '%' . $text .'%')->orwhere('subcategory.name', 'like', '%' . $text . '%')->select("product.*","category.name as cname","subcategory.name as sname")->with(['ProductImage','Clothdata'])->inRandomOrder()->get();  

                }else{

                 $search_result='';


                 }

                  if(count($search_result) !=0){

                       $responseArray=[];

                       $responseArray['search_product']=$search_result;
           
                       $responseArray['label']='Search Product';

                   }else{


                      $responseArray=[];

                       $responseArray['search_product']=$search_result;
           
                       $responseArray['label']='Search Product not available';


                   }


    
                 return $this->sendResponse($responseArray, 'Search product!');



                }
                
                   public function getSearchProduct(Request $request)
             {


                $validator = Validator::make($request->all(), [
                    
                    'product_id' => 'required',
               
                  
                 ]);


                  if($validator->fails()){

                     return $this->sendError('Validation Error.', $validator->errors());  

                   }

                   $product_id=$request->product_id; 


                   $product=Product::where('id',$product_id)->get();


                   $subCategory=$product[0]->subcategory;
                   $item=$product[0]->item;

                   if($item !=''){


                         $product=Product::where('Item',$item)->with(['ProductImage','Clothdata'])->orderBy('id', 'DESC')->get();


                    }else{
 
                      $product=Product::where('subcategory',$subCategory)->with(['ProductImage','Clothdata'])->orderBy('id', 'DESC')->get();



                    }

                     $responseArray=[];

                    $responseArray['Subcategory_Product']= $product;


                    return $this->sendResponse($responseArray, 'Get all Tranding Product!');
             

             }


 
      }

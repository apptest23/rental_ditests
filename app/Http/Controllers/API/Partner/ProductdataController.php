<?php

namespace App\Http\Controllers\API\Partner;
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
use App\Models\Item;
use Auth;
use Validator;

class ProductdataController extends BaseController
{


    public function getCategorylist()
       {


        try {

           $category= Category::with('SubCategorylist')->get();

           $responseArray=[];

           $responseArray['category']=$category;

           $responseArray['message']='Get all categories';

           return $this->sendResponse($responseArray, 'Get all categories');


         }catch (\Throwable $th) {

            return $this->sendError('something went wrong.!!! please try again later.');

          }

      }
      
       public function addproduct(Request $request){

            $validator = Validator::make($request->all(), [
                    
                  'name' => 'required',
                  'image' => 'required',
                  'category' => 'required',
                  'subcategory' => 'required',
                  'price' => 'required',
                  'quantity' => 'required',
                  'description' => 'required',           
               ]);


          if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());  

            }


             $name=$request->name;
             $category=$request->category;
             $subcategory=$request->subcategory;
             $price=$request->price;
             $quantity=$request->quantity;
             $description=$request->description;
          
             $vendor_id=Auth::id();
             $item=$request->Item;

             $status=1;
             $current_status='Available';

              $isinsert=Product::create(['name'=>$name,'category'=>$category,'subcategory'=>$subcategory,'price'=>$price,'quantity'=>$quantity,'description'=>$description,'status'=>$status,'current_status'=>$current_status,'total_qty'=>$quantity,'vendor_id'=>$vendor_id,'Item'=>$item]); 


                        $product_id=Product::max('id');

            
                         $colour=$request->colour;
                         $size=$request->size;

                         $category=Category::where('id',$category)->get();

                         $category_name=$category[0]->name;

                         if($category_name=='Cloths'){

                            Clothdata::create(['size'=>$size,'colour'=>$colour,'product_id'=>$product_id]);

                         }

                         $file=$request->file('image');

                         if($file){

                               $filename='';
                   
                        foreach($file as $key =>$f){

                             $destinationPath='uploads';
                             $filename=time().'_'.$f->getClientOriginalName();

                   
                               $f->move($destinationPath,$filename);

                              ProductImage::insert(['file'=>$filename, 'product_id'=>$product_id]);
                             
                         
                          }
                      }

                       $product=Product::where('id',$product_id)->with(['ProductImage','Clothdata'])->orderBy('id', 'DESC')->get();

                       $responseArray=[];

                       $responseArray['vendor_product']=$product;

                       $responseArray['message']='Inserted product Inserted successfully';

                       return $this->sendResponse($responseArray, 'Inserted product Inserted successfully');




        }
        
           public function getProductlist(Request $request){

            try{


              $validator = Validator::make($request->all(), [
                    
                  'vendor_id' => 'required',
                 
               ]);
               
               
          if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());  

            }

                  $vendor_id=$request->vendor_id;


                  $product=Product::where('vendor_id',$vendor_id)->with(['ProductImage','Clothdata','category','subcategory'])->orderBy('id', 'DESC')->get();
               

                  $responseArray=[];

                  $responseArray['vendor_product_list']=$product;

                   $responseArray['message']='Get Partner Product list';

                  return $this->sendResponse($responseArray, 'IGet Partner Product list');


              
          }catch (\Throwable $th) {

            return $this->sendError('something went wrong.!!! please try again later.');

          }
    }
    
      public function delete_product(Request $request){


             $validator = Validator::make($request->all(), [
                    
                     'product_id' => 'required',
                 
                 ]);
               
               
               if($validator->fails()){

                  return $this->sendError('Validation Error.', $validator->errors());  

                }

                  $product_id=$request->product_id;



                   $product=Product::where('id', $product_id)->get();

                      $product_img=ProductImage::where('product_id', $product_id)->get();

                      if($product_img !=''){

                         foreach($product_img as $pi){

                        if($pi->file!=''){

                            unlink(public_path("/uploads/".$pi->file));

                           }


                         }
 
                       }

                        ProductImage::where('product_id', $product_id)->delete();

                        Clothdata::where('product_id', $product_id)->delete();

                        Product::where('id', $product_id)->delete();

                        $responseArray['message']='Product Deleted successfully ';

    
                 

                  return $this->sendResponse($responseArray, 'delete data status' );


          }
          
            public function viewproductdetail(Request $request){

              try {

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


                     $responseArray['product_id']=$product[0]->id;
                     $responseArray['product_name']= $product[0]->name;
                     $responseArray['product_price']=$product[0]->price;
                     $responseArray['product_description']=$product[0]->description;
                     $responseArray['product_quantity']=$product[0]->quantity;
                     $responseArray['product_category']= $category_name;
                     $responseArray['product_subcategory']= $subcategory_name;
                   


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
                 

                 }catch(\Throwable $th){

                   return $this->sendError('something went wrong.!!! please try again later.');

              }

          }
          
          
            public function delete_multiple_product(Request $request){


                  $validator = Validator::make($request->all(), [
                    
                    'product_ids' => 'required',
               
                  
                     ]);


                    if($validator->fails()){

                        return $this->sendError('Validation Error.', $validator->errors());  

                     }


                    $ids = $request->product_ids;


                      foreach($ids as $id){

                         $product_img=ProductImage::where('product_id', $id)->get();

                            if($product_img !=''){

                                foreach($product_img as $pi){


                                      if ($pi->file!=''){

                                        unlink(public_path("/uploads/".$pi->file));
                                      }


                                  }
             
                             }

                           ProductImage::where('product_id', $id)->delete();
                           Clothdata::where('product_id', $id)->delete();
                           Product::where('id', $id)->delete();

                      }

                        $responseArray['message']='product deleted';

                        return $this->sendResponse($responseArray, 'product deleted');
              }
              
              
                public function delete_product_image(Request $request){



                  $validator = Validator::make($request->all(), [
                    
                    'product_image_id' => 'required',
               
                  
                     ]);


                    if($validator->fails()){

                        return $this->sendError('Validation Error.', $validator->errors());  

                     }

                    $id=$request->product_image_id;


                   $product_image_data=ProductImage::where('id', $id)->get();

                   if($product_image_data !=''){ 


                       $product_image=$product_image_data[0]->file;

                        if($product_image !=''){


                            unlink(public_path('/uploads/'.$product_image));


                          }


                          ProductImage::where('id', $id)->delete();

                         $responseArray['message']='product Image deleted';

                        return $this->sendResponse($responseArray, 'product Image deleted');


                      }else{


                         $responseArray['message']='product Image not available';

                        return $this->sendResponse($responseArray, 'product Image not available');


                      }

                     

                  }

                  public function get_item(Request $request){


                    $validator = Validator::make($request->all(), [
                 
                              'subcategory_id' => 'required',
                            
                         ]);


                    if($validator->fails()){

                        return $this->sendError('Validation Error.', $validator->errors());  

                        }

                        $subcategory_id=$request->subcategory_id;

                        $item_list =Item::where('subcategory',$subcategory_id)->get();

                        $responseArray['message']='Item list base on Subcategory';
                        $responseArray['item_list']= $item_list;

                        return $this->sendResponse($responseArray, 'product Image deleted');


                  }

                  public function get_size(){


                        $size_data=Size::all();


                        $responseArray['message']='get all size data';
                        $responseArray['size_data']= $size_data;

                        return $this->sendResponse($responseArray, 'get all size data');



                  }


                  public function edit_product(Request $request){



                     $validator = Validator::make($request->all(), [
                 
                              'name' => 'required',
                              'category' => 'required',
                              'subcategory' => 'required',
                              'price' => 'required',
                              'quantity' => 'required',
                              'description' => 'required',
                              'product_id' => 'required',
               
                  
                     ]);


                    if($validator->fails()){

                        return $this->sendError('Validation Error.', $validator->errors());  

                        }

                             $name=$request->name;
                             $category=$request->category;
                             $subcategory=$request->subcategory;
                             $price=$request->price;
                             $quantity=$request->quantity;
                             $description=$request->description;
                             $product_id=$request->product_id;


                            $product=Product::where('id',$product_id)->get();

                             $old_category=$product[0]->category;

                             $category_arr=Category::where('id',$old_category)->get();


                             $old_category_name=$category_arr[0]->name;

                             if($old_category!=$category && $old_category_name=='Cloths'){

                                 Clothdata::where('product_id',$product_id)->delete();
                                

                                }
 
                      Product::where('id',$product_id)->Update(['name'=>$name,'category'=>$category,'subcategory'=>$subcategory,'price'=>$price,'quantity'=>$quantity,'description'=>$description]); 


                             $colour=$request->colour;
                             $size=$request->size;

                             $item=$request->item;



                             $category=Category::where('id',$category)->get();

                              $category_name=$category[0]->name;       

                            if($category_name=='Cloths'){

                                Product::where('id',$product_id)->Update(['Item'=>$item]);

                                Clothdata::where('product_id',$product_id)->delete();

                                Clothdata::insert(['size'=>$size,'colour'=>$colour,'product_id'=>$product_id]);

                             }

                             $file=$request->file('image');


                             if($file !=''){

                          
                             $filename='';
                       
                         foreach($file as $key =>$f) {

                             $destinationPath='uploads';
                             $filename=time().'_'.$f->getClientOriginalName();

                               $f->move($destinationPath,$filename);

                               ProductImage::insert(['file'=>$filename, 'product_id'=>$product_id]);
                              
                               }
                             }


                             $product_data= Product::where('id',$product_id)->with(['ProductImage','Clothdata'])->get();

                           $responseArray[]='';
                           $responseArray['product_data']=$product_data;

                        return $this->sendResponse($responseArray, 'Updated Product Data');



                      }
                      
                    public function get_single_productdata(Request $request){
                          
                          
                       /*    try {*/

                $validator = Validator::make($request->all(), [
                    
                    'product_id' => 'required',
               
                  
                 ]);


                  if($validator->fails()){

                     return $this->sendError('Validation Error.', $validator->errors());  

                   }

                     $product_id=$request->product_id;
                     
                          $responseArray=[];
                        $product=Product::where('id',$product_id)->count();
                        
               if($product !=0){



                     $product=Product::where('id',$product_id)->with(['ProductImage','Clothdata'])->get();


                


                      $category_id=$product[0]->category;

                      $category=Category::where('id',$category_id)->get();


                   

                      $category_name=$category[0]->name;


                      $subcategory_id=$product[0]->subcategory;

                      $subcategory=SubCategory::where('id',$subcategory_id)->get();
                      
                      $subcategory_name=$subcategory[0]->name;
                       
                   
                      
                      $vendor_id=$product[0]->vendor_id;

                
                      $vendor_data=Vendor::where('id',$vendor_id)->get();

                      $vendor_name=$vendor_data[0]->name;
                      
                

            
                     $responseArray['product_id']=$product[0]->id; 
                     $responseArray['product_category_id']=$category_id; 
                     $responseArray['product_subcategory_id']=$subcategory_id; 
                     $responseArray['product_name']= $product[0]->name;
                     $responseArray['product_price']=$product[0]->price;
                     $responseArray['product_description']=$product[0]->description;
                     $responseArray['product_quantity']=$product[0]->quantity;
                     $responseArray['product_category']= $category_name;
                     $responseArray['product_subcategory']= $subcategory_name;
                   


                     $product_image=ProductImage::where('product_id',$product_id)->get();


                     $responseArray['product_image']=$product_image;


                     if($category_id==13){
                         
                         
                       $item_id=$product[0]->Item;
                       
                       
                      
                         $item=Item::where('id',$item_id)->get();
                       
                     
                         $item_name=$item[0]->item;
                      
                    

                        $clothdata=Clothdata::where('product_id',$product_id)->get();

                        $colour=$clothdata[0]->colour;

                        $size=$clothdata[0]->size;


                        $sizedata=Size::where('id',$size)->get();

                         

                        $size1=$sizedata[0]->size;


                        $responseArray['product_colour']=$colour;

                        $responseArray['product_size']=$size1;
                        
                        $responseArray['product_item']=$item_name;
                        $responseArray['product_item_id']=$item_id;
                        $responseArray['product_size_id']=$size;


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

                          
                          
                          
                          
                          
                          
                          
                          
                          
                       /*    $validator = Validator::make($request->all(), [
                 
                              'product_id' => 'required',
                            
                         ]);


                       if($validator->fails()){

                        return $this->sendError('Validation Error.', $validator->errors());  

                        }
                        
                        $product_id=$request->product_id;
                        
                        
                        $product=Product::where('id', $product_id)->with('ProductImage','Clothdata')->get();
                         
                         
                         $category_id=$product[0]->category;
                         
                         $category=Category::where('id',$category_id)->get();
                         
                         $category_name=$category[0]->name;
                         
                         $subcategory_id=$product[0]->subcategory;
                         
                         $subcategory=SubCategory::where('id',$subcategory_id)->get();
                         
                         $subcategory_name= $subcategory[0]->name;
                         
                         
                        
                        
                       
                         $responseArray['single_productdata']= $product;
                         $responseArray['category_name']= $category_name;
                         $responseArray['subcategory_name']= $subcategory_name;

                        return $this->sendResponse($responseArray, 'get single productdata');
                        */
                        

                          
                      }
                      

}

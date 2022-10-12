<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;

class Vendor_Productcontroller extends Controller
{
        public function __construct(){

                $this->middleware('auth:vendor');
        }


               public function vender_product(){

                 $vendor=Auth::guard('vendor')->user();
 
                 $data['vendor']=$vendor;

                 $data['site_url']= env('APP_URl');
                 $data['metatitle']='home page';

                 $id=Auth::id();
                 $vendor=vendor::where('id',$id)->get();

                 $data['name']=$vendor[0]->name;

                 $category=DB::table('category')->get();
                 $data['category']=$category;

                 $product=DB::table('product')->Where('id','desc')->orwhere('vendor_id', $id)->paginate(6);
                 $data['product']=$product;

                 $product_image=DB::table('product_image')->get();
                 $data['product_image']=$product_image;

                 $subcategory=DB::table('subcategory')->get();
                 $data['subcategory']=$subcategory;


                 $product_status=DB::table('product_status')->get();
                 $data['product_status']=$product_status;

                  return view('vendor.product',$data);
               }


               public function add_vender_product(){


                    $vendor=Auth::guard('vendor')->user();
     
                     $data['vendor']=$vendor;

                     $data['site_url']= env('APP_URl');
                     $data['metatitle']='home page';

                     $id=Auth::id();
                     $vendor=vendor::where('id',$id)->get();

                     $data['name']=$vendor[0]->name;
                     $category=DB::table('category')->get();
                     $data['category']=$category;

                     $size=DB::table('size')->get();
                     $data['size']=$size;
         
                     $subcategory=DB::table('subcategory')->get();
                     $data['subcategory']=$subcategory;

                  return view('vendor.add_product',$data);

                }

               public function getsubcategory($id){

                 return json_encode( DB::table('subcategory')->where('category',$id)->get()->toArray());

                  }

               public function store_vender_product(Request $request){


                         $errors=$request->validate([

                          'name' => 'required',
                          'image' => 'required',
                          'category' => 'required',
                          'subcategory' => 'required',
                          'price' => 'required',
                          'quantity' => 'required',
                          'description' => 'required',
                           
                        ]);

                         $name=$request->input('name');
                         $category=$request->input('category');
                         $subcategory=$request->input('subcategory');
                         $price=$request->input('price');
                         $quantity=$request->input('quantity');
                         $description=$request->input('description');
                      
                         $vendor_id=Auth::id();
                              $item=$request->input('item');


                     $status=1;
                     $current_status='Available';

              DB::table('product')->insert(['name'=>$name,'category'=>$category,'subcategory'=>$subcategory,'price'=>$price,'quantity'=>$quantity,'description'=>$description,'status'=>$status,'current_status'=>$current_status,'total_qty'=>$quantity,'vendor_id'=>$vendor_id,'Item'=>$item]); 


                        $product_id=DB::table('product')->max('id');

            
                         $colour=$request->input('colour');
                         $size=$request->input('size');

                         $category=DB::table('category')->where('id',$category)->get();

                         $category_name=$category[0]->name;

                         if($category_name=='Cloths'){

                            DB::table('colth_data')->insert(['size'=>$size,'colour'=>$colour,'product_id'=>$product_id]);

                         }

                         $file=$request->file('image');

                      
                         $filename='';
                   
                     foreach($file as $key =>$f) {

                         $destinationPath='uploads';
                         $filename=time().'_'.$f->getClientOriginalName();

               
                           $f->move($destinationPath,$filename);

                           DB::table('product_image')->insert(['file'=>$filename, 'product_id'=>$product_id]);
                         
                         
                          }

                  return redirect('Partner/vender_product')->with('error','your product inserted successfully!!');

               }

              public function get_product_subcategory($id){

                 return json_encode( DB::table('subcategory')->where('category',$id)->get()->toArray());

                  }

              public function get_cloth_item($id){

                  return json_encode( DB::table('item')->where('subcategory',$id)->get()->toArray());

                 }


              public function view_product_detail($id){

                   $vendor=Auth::guard('vendor')->user();
     
                     $data['vendor']=$vendor;

                     $data['site_url']= env('APP_URl');
                     $data['metatitle']='home page';

                     $vendor_id=Auth::id();
                     $vendor=vendor::where('id',$vendor_id)->get();

                     $data['name']=$vendor[0]->name;


                    $category=DB::table('category')->get();
                    $data['category']=$category;

                    $product_image=DB::table('product_image')->where('product_id',$id)->get();
                    $data['product_image']=$product_image;
    
                    $product=DB::table('product')->where('id',$id)->get();
                    $data['name1']=$product[0]->name;
                    $category2=$product[0]->category;

                    $data['category1']=$category2;

                    $subcategory2=$product[0]->subcategory;

                    $data['subcategory1']=$product[0]->subcategory;
                    $data['price']=$product[0]->price;
                    $data['quantity']=$product[0]->quantity;
                    $data['description']=$product[0]->description;
                    $data['id']=$product[0]->id;

                    $category3=DB::table('category')->where('id',$category2)->get();
                    $data['category_name']=$category3[0]->name;

                    $subcategory3=DB::table('subcategory')->where('id',$subcategory2)->get();
                    $data['subcategory_name']=$subcategory3[0]->name;


                    $size=DB::table('colth_data')->where('product_id',$id)->count();

                    if($size !=0){

                         $size=DB::table('colth_data')->where('product_id',$id)->get();

                         $data['size']=$size[0]->size;
                         $data['colour']=$size[0]->colour;


                      }else{


                        $data['size']='';
                         $data['colour']='';

                      }
                   

                   return view('vendor.view_product_detail',$data);

               }  


                   public function update_vendor_product($id){

                     $vendor=Auth::guard('vendor')->user();
     
                     $data['vendor']=$vendor;

                     $data['site_url']= env('APP_URl');
                     $data['metatitle']='home page';

                     $vendor_id=Auth::id();
                     $vendor=vendor::where('id',$vendor_id)->get();

                     $data['name']=$vendor[0]->name;

                        $category=DB::table('category')->get();
                        $data['category']=$category; 

                        $product_image=DB::table('product_image')->where('product_id',$id)->get();

                        $data['product_image']=$product_image;

                        $size1=DB::table('size')->get();
                        $data['size1']=$size1;

                        $product=DB::table('product')->where('id',$id)->get();
                        $data['name1']=$product[0]->name;
                        $category2=$product[0]->category;

                         $subcategory1=$product[0]->subcategory;


                        $data['category1']=$category2;
                        $data['subcategory1']=$product[0]->subcategory;
                        $data['price']=$product[0]->price;
                        $data['quantity']=$product[0]->quantity;
                        $data['description']=$product[0]->description;
                        $data['id']=$product[0]->id;


                        $category3=DB::table('category')->where('id',$category2)->get();
                        $data['category_name']=$category3[0]->name;

                        $subcategory=DB::table('subcategory')->where('category',$category2)->get();
                        $data['subcategory']=$subcategory;

                        $Item_list=DB::table('item')->where('subcategory',$subcategory1)->get();
                        $data['item_list']=$Item_list;
                   

                        $size=DB::table('colth_data')->where('product_id',$id)->count();

                         $data['item_id']=$product[0]->Item;

                        if($size !=0){

                             $size=DB::table('colth_data')->where('product_id',$id)->get();

                             $data['size']=$size[0]->size;
                             $data['colour']=$size[0]->colour;


                          }else{


                             $data['size']='';
                             $data['colour']='';
                             $data['item']='';


                          }
                       
                    
                        return view('vendor.update_product',$data);
                      }


                 public function update_vendor_product_image($id){
                  
                     $vendor=Auth::guard('vendor')->user();
     
                     $data['vendor']=$vendor;

                     $data['site_url']= env('APP_URl');
                     $data['metatitle']='home page';

                     $vendor_id=Auth::id();
                     $vendor=vendor::where('id',$vendor_id)->get();

                     $data['name']=$vendor[0]->name;


                      $product_image=DB::table('product_image')->where('id',$id)->get();

                      $data['image']=$product_image[0]->file;

                      $data['product_id']=$product_image[0]->product_id;

                      $data['id']=$id;

                      return view('vendor.update_product_image',$data);

                      }

                public function store_update_vendor_product_image(Request $request, $id){


                     $product_image=DB::table('product_image')->where('id',$id)->get();

                     $product_id=$product_image[0]->product_id;

                     $file=$request->file('image');
           
                     $imagename='';

                     if($file){
                 
                       $destinationPath='uploads';
                       $imagename=time().'_'.$file->getClientOriginalName();
                    
                       $file->move($destinationPath,$imagename);

                       DB::table('product_image')->where('id', $id)->update(['file'=>$imagename]);

                      if($request->input('oldimage')!='') {

                            unlink(public_path("/uploads/".$request->input('oldimage')));  
                         }
                       }

                      return redirect('Partner/update_vendor_product/'.$product_id);         

                   }

                public function delete_vendor_product_image($id){

                      $product_image=DB::table('product_image')->where('id',$id)->get();

                      $product_id=$product_image[0]->product_id;


                      $count=DB::table('product_image')->where('product_id',$product_id)->count();

                      if($count==1){

                       return response()->json(['success'=>'Minimum 1 Image is required !',
                                              'status'=>0  ]);
                                    
                        }else{


                       $product=DB::table('product_image')->where('id', $id)->get();


                      if($product[0]->file!=''){

                          unlink(public_path("/uploads/".$product[0]->file));
                        }

                         $count=DB::table('product_image')->where('id', $id)->delete();


                         return response()->json(['success'=>'SubCategory data deleted successfully!!!',

                       ]);


                     }

                 }

                   public function store_update_vendor_product(Request $request,$id){

                             $errors=$request->validate([

                              'name' => 'required',
                              'category' => 'required',
                              'subcategory' => 'required',
                              'price' => 'required',
                              'quantity' => 'required',
                              'description' => 'required',
                               
                            ]);

                             $name=$request->input('name');
                             $category=$request->input('category');
                             $subcategory=$request->input('subcategory');
                             $price=$request->input('price');
                             $quantity=$request->input('quantity');
                             $description=$request->input('description');

                         
                        
                             $product=DB::table('product')->where('id',$id)->get();

                             $old_category=$product[0]->category;

                             $category_arr=DB::table('category')->where('id',$old_category)->get();
                             $old_category_name=$category_arr[0]->name;

                             if($old_category!=$category && $old_category_name=='Cloths'){

                                  DB::table('colth_data')->where('product_id',$id)->delete();
                                

                                }


                           DB::table('product')->where('id',$id)->Update(['name'=>$name,'category'=>$category,'subcategory'=>$subcategory,'price'=>$price,'quantity'=>$quantity,'description'=>$description]); 
                       

                             $colour=$request->input('colour');
                             $size=$request->input('size');

                             $category=DB::table('category')->where('id',$category)->get();

                              $category_name=$category[0]->name;


                            if($category_name=='Cloths'){

                                 DB::table('colth_data')->where('product_id',$id)->delete();

                                DB::table('colth_data')->insert(['size'=>$size,'colour'=>$colour,'product_id'=>$id]);

                             }

                             $file=$request->file('image');


                             if($file !=''){

                          
                             $filename='';
                       
                         foreach($file as $key =>$f) {

                             $destinationPath='uploads';
                             $filename=time().'_'.$f->getClientOriginalName();

                               $f->move($destinationPath,$filename);

                               DB::table('product_image')->insert(['file'=>$filename, 'product_id'=>$id]);
                              
                               }
                             }

                         return redirect('Partner/vender_product')->with('error','your product data updated successfully!!');

                     }

                public function delete_all_vendor_product(Request $request){

                        $ids = $request->ids;
                            foreach($ids as $id){

                            $product_img=DB::table('product_image')->where('product_id', $id)->get();

                            if($product_img !=''){

                                foreach($product_img as $pi){


                                      if ($pi->file!=''){

                                        unlink(public_path("/uploads/".$pi->file));
                                      }


                                  }
             
                              }

                           DB::table('product_image')->where('product_id', $id)->delete();
                           DB::table('colth_data')->where('product_id', $id)->delete();
                           DB::table('product')->where('id', $id)->delete();

                        }

                       return response()->json(['status'=>200]);


                  }

               public function delete_vendor_product($id){


                 $product_img=DB::table('product_image')->where('product_id', $id)->get();

                    if($product_img !=''){

                      foreach($product_img as $pi){


                          if ($pi->file!=''){

                            unlink(public_path("/uploads/".$pi->file));
                          }


                       }
 
                    }

                       DB::table('product_image')->where('product_id', $id)->delete();

                       DB::table('colth_data')->where('product_id', $id)->delete();

                      DB::table('product')->where('id', $id)->delete();
         
                     return response()->json(['success'=>'SubCategory data deleted successfully!!!',]);


          }



       public function search_vendor_product(Request $request){

                $vendor_id=Auth::id();

                $category=DB::table('category')->get();
             
                $product=DB::table('product')->paginate(6);
             
                $product_image=DB::table('product_image')->get();
               
                $subcategory=DB::table('subcategory')->get();
              

          $category=DB::table('category')->get();
                        

            $text = $request->input('text');


            if($text !=''){

                $search_result=DB::table('product')->where('vendor_id',$vendor_id)->where('name', 'like', '%' . $text . '%')->orWhere('category', 'like', '%' . $text . '%')->orWhere('subcategory', 'like', '%' . $text . '%')->paginate(6);

              }else{


                  $search_result=DB::table('product')->paginate(6);

              }

          $total_row = $search_result->count();

          $output='';


         if($total_row > 0)
          {
           foreach($search_result as $row)
          {

        $output .= '
     
                    <tr class="product_'.$row->id.'>
                    <td  class="test"><input type="checkbox" name="test" > </td>
                    <td><input type="checkbox" name="ids" class="checkBoxClass testbox" value="'.$row->id.'"></td>
                        <td>';

                     foreach($product_image as $pi){
                           if($row->id==$pi->product_id){

                         $output .= '<img src="/uploads/'.$pi->file.'" width="60" height="60">';

                              break;

                           }

                         }
                  $output .= '</td>

                        <td>'.$row->name.'</td>

                        <td>';

                          foreach($category as $c){

                              if($row->category==$c->id){

                            
                       $output .= $c->name;

                           }
                         }         

                          
             $output .= '</td>
                        <td>';

                          foreach($subcategory as $sc){

                              if($row->subcategory==$sc->id){

                            
                           $output .= $sc->name;
                         

                             }

                         }


            $output .= '</td>
                        <td>'.$row->price.'/Day</td>
                        <td>'.$row->quantity.'</td>
                        <td>
                           <a class="icon__1" href="/admin/view_product/'.$row->id.'"><i class="fas fa-eye"></i></a>
                           <a class="icon__1" href="/admin/update_product/'.$row->id.'"><i class="fas fa-edit"></i></a>
                           <a class="icon__2" onclick="delete_product('.$row->id.')"><i class="fas fa-trash-alt"></i></a>

                        
                        </td>
                       
                        
                    </tr>
              ';
        }

      }
      else
      {
      
          $output .='<h3> Search data is not available...</h3>';

      }  
           return response($output);
         }

         public function update_status($id){


              $product=DB::table('product')->where('id',$id)->get();

              $product_qty=$product[0]->quantity;

              $status=$product[0]->status;

           /*   $total_qty=$product[0]->total_qty;*/


             if($status==1){



                  $response = [
                                'success'=>true,
                                'product_qty' =>$product_qty,
                                'product_id' =>$id,
                                'status'=>1,
                              
                          ];



                      }else{


                     $response = [
                                'success'=>true,
                                'product_qty' =>$product_qty,
                                'product_id' =>$id,
                                'status'=>2,
                              
                          ];


                      }

             return response()->json($response, 200);


         }


        public function update_status_1(Request $request,$id){


           $validator=Validator::make($request->all(),[

             'rent_product'=>'required',

            ]);

           if($validator->passes()){

             $product_id=$id;

             $total_product=$request->total_product;
             $rent_product=$request->rent_product;

             $available_product=$total_product-$rent_product;

             if($available_product==0){

                    $current_status='On Rent';

                    $color='#8a5c67';

                    $status=2;

 
                }else{

                    $current_status='Available';

                    $color='#ADFEC4';

                    $status=1;

                }
 
                  $order=1;
 
          
           /*  $order=DB::table('product')->where('id',$product_id)->update(['status'=>$status, 'current_status'=>$current_status,'quantity'=>$available_product]);*/
        
            $output='';
           $response[]='';
             if($order){


                      $output='<span class="status_btn "style="background-color:'.$color.'">'.$current_status.'</span>

                                 <div class="action-dropdown">

                                     <div class="dropdown ">
                                        <div class="btn-link dot_click" id="'.$product_id.'" data-toggle="dropdown">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                 <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5"></circle>
                                                 <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5"></circle>
                                                 <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5"></circle>
                                                </svg>
                                             </div>

                                          </div>

                                      </div>';


                             $response = [
                                'success'=>true,
                                'color' =>$color,
                                'product_id' =>$product_id,
                                'status'=>$current_status,
                                'available_product'=>$available_product,
                                'output'=>$output
                                         
                              
                          ];



                    }

                       return response()->json($response);


             }else{

              return response()->json(['error'=>$validator->errors()]);


           }

            }
     



}

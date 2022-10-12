<?php

namespace App\Http\Controllers\Admin;

use Intervention\Image\ImageManagerStatic as Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Admin;
use Auth;
use DB;

class ProductController extends Controller
{
      public function __construct(){

                $this->middleware('auth:admin');
        }

                public function productlist(){

                $id=Auth::id();
                $admin=Admin::where('id',$id)->get();
                $data['name']=$admin[0]->name;

                $category=DB::table('category')->get();
                $data['category']=$category;

                $product=DB::table('product')->paginate(6);
                $data['product']=$product;

                 $product_image=DB::table('product_image')->get();
                 $data['product_image']=$product_image;

                 $subcategory=DB::table('subcategory')->get();
                 $data['subcategory']=$subcategory;

                return view('admin.productlist',$data);
             }

                public function add_product(){

                 $id=Auth::id();
                 $admin=Admin::where('id',$id)->get();
                 $data['name']=$admin[0]->name;

                 $category=DB::table('category')->get();
                 $data['category']=$category;

                 $item=DB::table('item')->get();
                 $data['item']=$item;

                 $size=DB::table('size')->get();
                 $data['size']=$size;
               
     
                 $subcategory=DB::table('subcategory')->paginate(14);
                 $data['subcategory']=$subcategory;

              return view('admin.add_product',$data);

                }

             public function getsubcategory($id){

                 return json_encode( DB::table('subcategory')->where('category',$id)->get()->toArray());

                  }

                  public function get_item($id){

                  return json_encode( DB::table('item')->where('subcategory',$id)->get()->toArray());

                   }

                public function store_product(Request $request){


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

                 $item=$request->input('item');

                 $status=1;
                 $current_status='Available';


              DB::table('product')->insert(['name'=>$name,'category'=>$category,'subcategory'=>$subcategory,'price'=>$price,'quantity'=>$quantity,'description'=>$description,'status'=>$status,'current_status'=>$current_status,'total_qty'=>$quantity,'Item'=>$item]); 

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

                   /*$resize_image = Image::make($f->getRealPath());

                       $resize_image->resize(150, 150, function($constraint){
                       $constraint->aspectRatio();
                       })->save($destinationPath . '/' . $filename);
*/

       
                  $f->move($destinationPath,$filename);

                   DB::table('product_image')->insert(['file'=>$filename, 'product_id'=>$product_id]);
                 
                 
                  }

                return redirect('admin/product')->with('error','your product inserted successfully!!');


               }

                public function delete_product($id){


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

                    public function update_product($id){


                        $admin_id=Auth::id();
                        $admin=Admin::where('id',$admin_id)->get();
                        $data['name']=$admin[0]->name;


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
                        $data['subcategory1']=$subcategory1;
                        $data['price']=$product[0]->price;
                        $data['quantity']=$product[0]->quantity;
                        $data['description']=$product[0]->description;
                        $data['id']=$product[0]->id;                          

                        $Item_list=DB::table('item')->where('subcategory',$subcategory1)->get();
                        $data['item_list']=$Item_list;
                   

                        $category3=DB::table('category')->where('id',$category2)->get();
                        $data['category_name']=$category3[0]->name;
                  
                        $subcategory=DB::table('subcategory')->where('category',$category2)->get();
                        $data['subcategory']=$subcategory;

                        $size=DB::table('colth_data')->where('product_id',$id)->count();

                          $data['item_id']=$product[0]->Item;

                        if($size !=0){

                            $size=DB::table('colth_data')->where('product_id',$id)->get();
                            $data['size']=$size[0]->size;
                            $data['colour']=$size[0]->colour;     
                          
/*
                            if($item_id !=''){

                                $Item=DB::table('item')->where('item',$item_id)->get();
                                $data['item']=$Item[0]->item;


                            }*/

                          }else{

                                $data['size']='';
                                $data['colour']='';
                                $data['item']='';
                          }
                       
                        return view('admin.update_product',$data);
                      }

                 public function update_product_image($id){

                      $admin_id=Auth::id();
                      $admin=Admin::where('id',$admin_id)->get();
                      $data['name']=$admin[0]->name;

                      $product_image=DB::table('product_image')->where('id',$id)->get();

                      $data['image']=$product_image[0]->file;

                      $data['product_id']=$product_image[0]->product_id;

                      $data['id']=$id;

                      return view('admin.update_product_image',$data);

                      }

                public function store_update_product_image(Request $request, $id){


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

                      return redirect('admin/update_product/'.$product_id);         

                  }

                public function delete_product_image($id){

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

                public function store_update_product(Request $request,$id){

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


                           DB::table('product')->where('id',$id)->Update(['name'=>$name,'category'=>$category,'subcategory'=>$subcategory,'price'=>$price,'quantity'=>$quantity,'description'=>$description,'total_qty'=>$quantity]); 
                       

                             $colour=$request->input('colour');
                             $size=$request->input('size');

                             $item=$request->input('item');



                             $category=DB::table('category')->where('id',$category)->get();

                              $category_name=$category[0]->name;       

                            if($category_name=='Cloths'){

                                DB::table('product')->where('id',$id)->Update(['Item'=>$item]);

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

                         return redirect('admin/product')->with('error','your product data updated successfully!!');

                     }

                public function delete_all_product(Request $request){

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

                public function view_product($id){

                       $admin_id=Auth::id();
                       $admin=Admin::where('id',$admin_id)->get();
                       $data['name']=$admin[0]->name;

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
                       

                      return view('admin.view_product_detail',$data);

                  }




       public function search_product(Request $request){


                $category=DB::table('category')->get();
             

                $product=DB::table('product')->paginate(2);
             

                 $product_image=DB::table('product_image')->get();
               
                 $subcategory=DB::table('subcategory')->get();
              




        $category=DB::table('category')->get();
                        

            $text = $request->input('text');


            if($text !=''){

                $search_result=DB::table('product')->where('name', 'like', '%' . $text . '%')->orWhere('category', 'like', '%' . $text . '%')->orWhere('subcategory', 'like', '%' . $text . '%')->paginate(2);

            }else{


                $search_result=DB::table('product')->paginate(2);

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
     


    


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;
use App\Models\Beg_Item;
use Illuminate\Support\Facades\Validator;
Use Hash;
use Illuminate\support\facades\Redirect;



class UserController extends Controller
{
	   public function index(){

         $category_menu=DB::table('category')->get();
         $data['category_menu']=$category_menu;

         $subcategory_menu=DB::table('subcategory')->get();
         $data['subcategory_menu']=$subcategory_menu;


         $footer_product=DB::table('product')->inRandomOrder()->get();
         $data['footer_product']=$footer_product;

         $footer_product_image=DB::table('product_image')->get();
         $data['footer_product_image']=$footer_product_image;


         $subcategory=DB::table('subcategory')->paginate(14);
         $data['subcategory']=$subcategory;


         $category=DB::table('category')->get();
         $data['category']=$category;

         $subcategory=DB::table('subcategory')->paginate(14);
         $data['subcategory']=$subcategory;

         $banner=DB::table('banner')->paginate(3);
         $data['banner']=$banner;

         $more_maintitle=DB::table('more_maintitle')->get();
         $data['more_maintitle']=$more_maintitle;

       
         $product=DB::table('product')->inRandomOrder()->get();
         $data['product']=$product;


         $product1=DB::table('product')->get();
         $data['product1']=$product1;

          $product_image=DB::table('product_image')->get();
         $data['product_image']=$product_image;

     

         /*extra code for comment section in home page*/


         $category1=DB::table('category')->where('name','Cloths')->get();
         $cloth_id=$category1[0]->id;

         $cloth_data=DB::table('product')->where('category', $cloth_id)->get();
         $data['cloth_data']=$cloth_data;

          
         $category1=DB::table('category')->where('name','Electronics')->get();
         $elect_id=$category1[0]->id;

         $elect_data=DB::table('product')->where('category', $elect_id)->get();
         $data['elect_data']=$elect_data;

         $category1=DB::table('category')->where('name','Events')->get();
         $event_id=$category1[0]->id;

         $event_data=DB::table('product')->where('category', $event_id)->get();
         $data['event_data']=$event_data;

         $category1=DB::table('category')->where('name','Appliances')->get();
         $app_id=$category1[0]->id;

         $app_data=DB::table('product')->where('category', $app_id)->get();
         $data['app_data']=$app_data;


         $category1=DB::table('category')->where('name','Vehicle')->get();
         $vehicle_id=$category1[0]->id;

         $vehicle_data=DB::table('product')->where('category', $vehicle_id)->get();
         $data['vehicle_data']=$vehicle_data;


         $category1=DB::table('category')->where('name','Construction')->get();
         $const_id=$category1[0]->id;

         $const_data=DB::table('product')->where('category', $const_id)->get();
         $data['const_data']=$const_data;

        /***************************************************************************/
        
         return view('welcome',$data);
	 
	   }

	   public function all_category(){

         $category=DB::table('category')->get();
         $data['category']=$category;

         $subcategory=DB::table('subcategory')->get();
         $data['subcategory']=$subcategory;


         $category_menu=DB::table('category')->get();
         $data['category_menu']=$category_menu;

         $subcategory_menu=DB::table('subcategory')->get();
         $data['subcategory_menu']=$subcategory_menu;


         $footer_product=DB::table('product')->inRandomOrder()->get();
         $data['footer_product']=$footer_product;

         $footer_product_image=DB::table('product_image')->get();
         $data['footer_product_image']=$footer_product_image;

         return view('allcategory',$data);
	 
	    }

       public function product($id){


         $category_menu=DB::table('category')->get();
         $data['category_menu']=$category_menu;

         $subcategory_menu=DB::table('subcategory')->get();
         $data['subcategory_menu']=$subcategory_menu;


         $footer_product=DB::table('product')->inRandomOrder()->get();
         $data['footer_product']=$footer_product;

         $footer_product_image=DB::table('product_image')->get();
         $data['footer_product_image']=$footer_product_image;


         $prod_catategory=DB::table('subcategory')->where('id',$id)->get();
         $prod_catategory_name=$prod_catategory[0]->category;

         $category=DB::table('category')->get();
         $data['category']=$category;

         $product_data=DB::table('product')->where('subcategory', $id)->paginate(8);
         $data['product_data']=$product_data;

         $subcategory=DB::table('subcategory')->get();
         $data['subcategory']=$subcategory;

         $product1=DB::table('product')->where('category',$prod_catategory_name)->get();
         $data['product1']=$product1;
        
         $product_image=DB::table('product_image')->get();
         $data['product_image']=$product_image;
   
         $footer_product=DB::table('product')->inRandomOrder()->get();
         $data['footer_product']=$footer_product;

         $product_image=DB::table('product_image')->get();
         $data['footer_product_image']=$product_image;

         return view('product',$data);

       }

       public function product_detail($id){


         $category_menu=DB::table('category')->get();
         $data['category_menu']=$category_menu;

         $subcategory_menu=DB::table('subcategory')->get();
         $data['subcategory_menu']=$subcategory_menu;


         $footer_product=DB::table('product')->inRandomOrder()->get();
         $data['footer_product']=$footer_product;

         $footer_product_image=DB::table('product_image')->get();
         $data['footer_product_image']=$footer_product_image;



      
         $product_data=DB::table('product')->where('subcategory', $id)->paginate(8);
         $data['product_data']=$product_data;
       
         $product1=DB::table('product')->get();
         $data['product1']=$product1;

           $product_image=DB::table('product_image')->where('product_id',$id)->get();    
   
            $data['product_image']=$product_image;

            $size1=DB::table('size')->get();
            $data['size1']=$size1;

            $product=DB::table('product')->where('id',$id)->get();
            $data['name']=$product[0]->name;
            $category2=$product[0]->category;

            $subcategory2=$product[0]->subcategory;

             $product_data=DB::table('product')->where('subcategory', $subcategory2)->get();
             $data['product_data']=$product_data;

             $already_in_beg=0;

             $user_id=Auth::id();

             if($user_id !=''){

                $already_in_beg_data=Beg_Item::where('product_id',$id)->where('user_id',$user_id)->count();

                $already_in_beg=$already_in_beg_data;

               }

            $data['already_in_beg']=$already_in_beg;
            
            $product_image1=DB::table('product_image')->get();    
            $data['product_image1']=$product_image1;

            $data['subcategory2']=$subcategory2;

            $data['category1']=$category2;
            $data['subcategory1']=$subcategory2;
            $data['price']=$product[0]->price;
            $data['quantity']=$product[0]->quantity;
            $data['description']=$product[0]->description;
            $data['id']=$product[0]->id;

             $category3=DB::table('category')->where('id',$category2)->get();
             $data['category_name']=$category3[0]->name;

            $subcategory=DB::table('subcategory')->where('category',$category2)->get();
            $data['subcategory']=$subcategory;

            $subcategory=DB::table('subcategory')->where('id', $subcategory2)->get();
            $data['subcategory_name']=$subcategory[0]->name;

            $size=DB::table('colth_data')->where('product_id',$id)->count();

            if($size !=0){

                 $size=DB::table('colth_data')->where('product_id',$id)->get();

                 $data['size']=$size[0]->size;
                 $data['colour']=$size[0]->colour;

              }else{

                 $data['size']='';
                 $data['colour']='';

              }

              $vendor_id=$product[0]->vendor_id;

            $vendor=DB::table('vendors')->where('id',$vendor_id)->get();
            $data['vendor_name']=$vendor[0]->name;
            $data['vendor_id']=$vendor_id;

      
           
          return view('product_detail',$data);


       }

       public function category_product($id){

         $category=DB::table('category')->get();
         $data['category']=$category;

         $product_data=DB::table('product')->where('category', $id)->paginate(8);
         $data['product_data']=$product_data;


         $subcategory=DB::table('subcategory')->get();
         $data['subcategory']=$subcategory;

        
         $product_image=DB::table('product_image')->get();
         $data['product_image']=$product_image;


         $category_menu=DB::table('category')->get();
         $data['category_menu']=$category_menu;

         $subcategory_menu=DB::table('subcategory')->get();
         $data['subcategory_menu']=$subcategory_menu;


         $product2=DB::table('product')->where('category',$id)->inRandomOrder()->take(3)->get();
         $data['product2']=$product2;


         $footer_product=DB::table('product')->inRandomOrder()->get();
         $data['footer_product']=$footer_product;

         $footer_product_image=DB::table('product_image')->get();
         $data['footer_product_image']=$footer_product_image;

         $data['category_id']=$id;

         return view('category_product',$data);

       }

         public function tranding_product(){

         $category=DB::table('category')->get();
         $data['category']=$category;

         $product_data=DB::table('product')->inRandomOrder()->paginate(8);
         $data['product_data']=$product_data;

         $product2=DB::table('product')->inRandomOrder()->take(3)->get();
         $data['product2']=$product2;



         $subcategory=DB::table('subcategory')->get();
         $data['subcategory']=$subcategory;

         $product_image=DB::table('product_image')->get();
         $data['product_image']=$product_image;



         $category_menu=DB::table('category')->get();
         $data['category_menu']=$category_menu;

         $subcategory_menu=DB::table('subcategory')->get();
         $data['subcategory_menu']=$subcategory_menu;


         $footer_product=DB::table('product')->inRandomOrder()->get();
         $data['footer_product']=$footer_product;

         $footer_product_image=DB::table('product_image')->get();
         $data['footer_product_image']=$footer_product_image;

         return view('product',$data);

       }

       public function profile(){

   
         $category_menu=DB::table('category')->get();
         $data['category_menu']=$category_menu;

         $subcategory_menu=DB::table('subcategory')->get();
         $data['subcategory_menu']=$subcategory_menu;

         $footer_product=DB::table('product')->inRandomOrder()->get();
         $data['footer_product']=$footer_product;

         $footer_product_image=DB::table('product_image')->get();
         $data['footer_product_image']=$footer_product_image;


         $user_id=Auth::id();

         $user_data=User::where('id',$user_id)->get();

         $data['image']=$user_data[0]->image;
         $data['name']=$user_data[0]->name;
         $data['email']=$user_data[0]->email;
         $data['phone_no']=$user_data[0]->phone_no;
         $data['address']=$user_data[0]->address;


          $footer_product=DB::table('product')->inRandomOrder()->get();
         $data['footer_product']=$footer_product;

         $product_image=DB::table('product_image')->get();
         $data['footer_product_image']=$product_image;
                        
         return view('edit_profile',$data);

       }

         public function change_password(){


         $category_menu=DB::table('category')->get();
         $data['category_menu']=$category_menu;

         $subcategory_menu=DB::table('subcategory')->get();
         $data['subcategory_menu']=$subcategory_menu;

         $footer_product=DB::table('product')->inRandomOrder()->get();
         $data['footer_product']=$footer_product;

         $footer_product_image=DB::table('product_image')->get();
         $data['footer_product_image']=$footer_product_image;


         $category=DB::table('category')->get();
         $data['category']=$category;

         $subcategory=DB::table('subcategory')->get();
         $data['subcategory']=$subcategory;

       
                       
         return view('changepassword',$data);

       }

       public function update_profile(Request $request){


           $errors=$request->validate([

                  'name' => 'required',
                  'email' => 'required|email',
                  'phone_no' => 'required|size:10',
                                
                ]);

                 $name=$request->input('name');
                 $email=$request->input('email');
                 $phone_no=$request->input('phone_no');
                 $address=$request->input('address');
                 $image=$request->file('image');
                 $oldimage=$request->input('oldimage');

                 $id=Auth::id();

                 $imagename=' ';


             if($image)
               {
          
                $destinationPath='uploads';
                $imagename=time().'_'.$image->getClientOriginalName();
                $image->move($destinationPath,$imagename);

                User::where('id',$id)->update(['image'=>$imagename]);

               if($oldimage!='')
                {
                  unlink(public_path('/uploads/'.$oldimage));
                }
       
               }
            
              User::where('id',$id)->update(['name'=>$name,'email'=>$email,'phone_no'=>$phone_no,'address'=>$address]);

              return redirect('User/profile')->with('error','your profile successfully!!');

          }

          public function update_password(Request $request){

                $error=$request->validate([
              'oldpassword' => 'required|string',
              'newpassword' => 'required|string|min:6',
           
              ]);

               $oldpassword=$request->input('oldpassword');
               $newpassword=$request->input('newpassword');

               $id=Auth::id();

               $password=User::where('id', $id)->get();

               $password1=$password[0]->password;

              if(Hash::check($oldpassword,$password1)){

                   User::where('id', $id)->update(['password'=>Hash::make($newpassword)]);

                  return redirect('User/change_password')->with('error','your password has been update successfully' );

               }else{

                return Redirect::back()->with('success','Your Old password is not correct!!!!');

            }

           

            
        }


     
        public function search(Request $request){

          $text = $request->input('text');
    

          if($text !=''){

       /*   $search_result=DB::table('product')->where('name', 'like', '%' . $text . '%')->orWhere('category', 'like', '%' . $category_name . '%')->orWhere('subcategory', 'like', '%' . $subcategory_name . '%')->get();*/


            $search_result=DB::table('product')->join('category','category.id','product.category')->join('subcategory','subcategory.id','product.subcategory')->
            where('product.name', 'like', '%' . $text . '%')->orwhere('category.name', 'like', '%' . $text .'%')->orwhere('subcategory.name', 'like', '%' . $text . '%')->select("product.*","category.name as cname","subcategory.name as sname")->inRandomOrder()->get();  

        }else{

             $search_result=DB::table('product')->inRandomOrder(4);


        }

          $total_row = $search_result->count();

          $product_image=DB::table('product_image')->get();

           
            $subcategory=DB::table('subcategory')->get();

          $output='';


      if($total_row > 0)
      { 
        foreach($search_result as $row)
      {

                       $output .='<a href="/search_product/'.$row->id.'"><div class="d-flex">';

                               foreach($product_image as $p){

                                if($row->id == $p->product_id){


                                      $output .='

                                        <div class="search-img">

                                          <img src="/uploads/'.$p->file.'">

                                         </div>';

                                       break;

                                    }

                               }

                  
                             $output.='<div class="product-name">
                                 <h6>'.$row->name.'</h6>';

                             foreach($subcategory as $s){

                                if($row->subcategory == $s->id){

                                  $output.='<p>'.$s->name.'</p>';
                               }
                           }

                           $output.='</div>
                         </div></a>';    

       
        }

      }
      else
      {

                        $output .= '<div class="no_data">

                             <span> Search data is not available...</span>
                           
                         </div>' ;  
                
         

             }  
           return response($output);
         }
         
         
           public function search_product($id){


              $product_data=DB::table('product')->where('id', $id)->get();
              $category=$product_data[0]->category;
              $subcategory=$product_data[0]->subcategory;

              $item=$product_data[0]->Item;
     

              if($item !=''){

                $product =DB::table('product')->where('Item', $item)->paginate(8);

            
                $data['product_data']= $product;

                $product1=DB::table('product')->where('category',$category)->get();

                $data['product1']= $product1;


               }else{

                   $product =DB::table('product')->where('subcategory', $subcategory)->paginate(8);

                    $data['product_data']= $product;


                   $product1=DB::table('product')->where('category',$category)->get();

                   $data['product1']= $product1;



               }

                  $category_menu=DB::table('category')->get();
                 $data['category_menu']=$category_menu;

                 $subcategory_menu=DB::table('subcategory')->get();
                 $data['subcategory_menu']=$subcategory_menu;

             


             $category=DB::table('category')->get();
             $data['category']=$category;


             $subcategory=DB::table('subcategory')->get();
             $data['subcategory']=$subcategory;

            
              $product_image=DB::table('product_image')->get();
              $data['product_image']=$product_image;

              $footer_product=DB::table('product')->inRandomOrder()->get();
              $data['footer_product']=$footer_product;

              $product_image=DB::table('product_image')->get();
              $data['footer_product_image']=$product_image;

             return view('product',$data);


         }


          public function call_vendor(Request $request)
             {

             $product_id=$request->product_id;

             $user_id=Auth::id();

             $product=DB::table('product')->where('id',$product_id)->get();

             $vendor_id=$product[0]->vendor_id;

             $vendor=DB::table('vendors')->where('id',$vendor_id)->get();

             $vendor_phone=$vendor[0]->phone_no;

              DB::table('call_history')->insert(['product_id'=>$product_id,'vendor_id'=>$vendor_id,'user_id'=>$user_id]);

              $output=' ';
 
              $output .='<a id="call_vendor" href="tel:+91'.$vendor_phone.'" style="color:white"><span class="call-icon"><i class="fal fa-phone"></i></span> call now</a>';
    
              return response($output);
     
           }

         public function store_beg_item(Request $request){

               $product_id=$request->product_id;
               $delivery_date=$request->delivery_date;
               $return_date=$request->return_date;
               $days=$request->days;
               $Quantity=$request->Quantity;
               $user_id=Auth::id();


               if($delivery_date==''|| $return_date==''){

                  return response()->json(['error','You have entered invalid credentials']);
      
               }else{


                  
                   $delivery_date1 =\Carbon\Carbon::parse($delivery_date)->format('y/m/d');
                   $return_date1 =\Carbon\Carbon::parse($return_date)->format('y/m/d');




                 $product_data=DB::table('product')->where('id', $product_id)->get();

                  $product_name=$product_data[0]->name;
                  $price=$product_data[0]->price;
                  $total_qty=$product_data[0]->quantity;


                 $product_image=DB::table('product_image')->where('product_id',$product_id)->get();
                 $product_image=$product_image[0]->file;

    

                   Beg_Item::create(['product_id'=>$product_id,'user_id'=>$user_id,'return_date'=>$return_date1,'delivery_date'=>$delivery_date1,'days'=>$days,'Quantity'=>$Quantity,'image'=>$product_image,'product_name'=>$product_name,'price'=>$price,'total_qty'=>$total_qty]);

                      return response()->json(['status'=>1,

                         'success'=>'product added into bag item']);

                      }

                }

                public function beg_item(){

                 $category_menu=DB::table('category')->get();
                 $data['category_menu']=$category_menu;

                 $subcategory_menu=DB::table('subcategory')->get();
                 $data['subcategory_menu']=$subcategory_menu;


                 $footer_product=DB::table('product')->inRandomOrder()->get();
                 $data['footer_product']=$footer_product;

                 $footer_product_image=DB::table('product_image')->get();
                 $data['footer_product_image']=$footer_product_image;

                $user_id=Auth::id();

                $beg_item=Beg_Item::where('user_id',$user_id)->get();

                $data['beg_item']=$beg_item;

                $total=0;

                 foreach ($beg_item as $key => $b) {


                    $total1=$b->price*$b->days*$b->Quantity;

                    $total=$total+$total1;
                   
                 }

                  $data['total_amount']= $total;

                return view('beg_item',$data);

                }

               public function minus_qty(Request $request){

                    $count=$request->count;
                    $product_id=$request->product_id;
                    $beg_item_id=$request->beg_item_id;
                    $id=Auth::id();

                    if($count==0){

                         return response()->json(['error','You have entered invalid credentials']);

                      }else{

                            Beg_Item::where('id',$beg_item_id)->update(['Quantity'=>$count]);

                             $beg_item=Beg_Item::where('id',$beg_item_id)->get();

                             $price=$beg_item[0]->price;
                             $days=$beg_item[0]->days;
                             $Quantity=$beg_item[0]->Quantity;

                             $total=0;

                             $beg_item1=Beg_Item::where('user_id',$id)->get();

                            foreach($beg_item1 as $key => $b) {

                               $total1=$b->price*$b->days*$b->Quantity;

                               $total=$total+$total1;
                   
                              }

                              $response = [
                                'success'=>true,
                                'price' =>$price,
                                'days'    =>$days,
                                'Quantity' =>$Quantity,
                                'total'=>$total,
                             ];

                         return response()->json($response, 200);

                          
                      }

                }

           /* public function search_product($id){


              $product_data=DB::table('product')->where('id', $id)->get();
              $name=$product_data[0]->name;

              $product=DB::table('product')->where('name', 'like', '%' . $name . '%')->inRandomOrder()->paginate(8);

              $data['product_data']=$product;


             $category=DB::table('category')->get();
             $data['category']=$category;


             $subcategory=DB::table('subcategory')->get();
             $data['subcategory']=$subcategory;

            
              $product_image=DB::table('product_image')->get();
              $data['product_image']=$product_image;

              $footer_product=DB::table('product')->inRandomOrder()->get();
              $data['footer_product']=$footer_product;

              $product_image=DB::table('product_image')->get();
              $data['footer_product_image']=$product_image;

             return view('product',$data);


         }
*/


     public function privacy_policy(){

         return view('privacy_policy');

 

     }

       public function terms_condition(){

         return view('terms_condition');
 

     }

  public function partner_profile($id)
  { 

    return view('partner_profile');
 
  }



}

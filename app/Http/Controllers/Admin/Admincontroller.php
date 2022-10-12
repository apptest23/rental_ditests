<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Carbon\carbon;
use DB;
use Hash;
use \Crypt;
use Auth;
use Illuminate\support\facades\Redirect;
use Illuminate\support\facades\validator;

class Admincontroller extends Controller{


   public function __construct(){

                $this->middleware('auth:admin');
        }

   public function home(){
 
       $admin=Auth::guard('admin')->user();

       
          $data['admin']=$admin;

         $data['site_url']= env('APP_URl');
         $data['metatitle']='home page';

         $id=Auth::id();

      
         $admin=Admin::where('id',$id)->get();

         $data['name']=$admin[0]->name;
         
         $data['user']=User::count(); 


         return view('admin.home',$data);
      
     } 

      

     /*----------- change password ---------------*/

      public function changepassword(){
       
         return view('admin.change_password');
     }

     public function updatepassword(Request $request,$id){

          $error=$request->validate([
              'oldpassword' => 'required|string',
              'newpassword' => 'required|string|min:6',
           
              ]);

               $oldpassword=$request->input('oldpassword');
               $newpassword=$request->input('newpassword');

               $password=DB::table('admins')->where('id', $id)->get();

               $password1=$password[0]->password;

              if(Hash::check($oldpassword,$password1)){

                   DB::table('admins')->where('id', $id)->update(['password'=>Hash::make($newpassword)]);

                  return redirect('admin/home')->with('error','your password has been update successfully' );

               }else{

                return Redirect::back()->with('error','Your Old password is not correct!!!!');

            }
         }


/********************* Category list************************/

         public function category(){

          $id=Auth::id();
          $admin=Admin::where('id',$id)->get();
          $data['name']=$admin[0]->name;

             $category=DB::table('category')->paginate(4);
            $data['category']=$category;


            return view('admin.category',$data);
         }



/*********************  Add Category ************************/

           public function add_category(){

            $id=Auth::id();

            $admin=Admin::where('id',$id)->get();
            $data['name']=$admin[0]->name;

         
            return view('admin.add_category',$data);
         }


/*********************  store Category ************************/

       public function store_category(Request $request){

             $error=$request->validate([

               'image'=>'required',
               'icon_image'=>'required',
               'name'=>'required',
               'description'=>'required',
            
           ]);

           $name=$request->input('name');
           $description=$request->input('description');
           $image=$request->file('image');
           $icon_image=$request->file('icon_image');
           $imagename='';

           $icon_imagename='';

           if($image)
           {
          
               $destinationPath='uploads';
               $imagename=time().'_'.$image->getClientOriginalName();
               $image->move($destinationPath,$imagename);
       
           }

           if($icon_image)
           {
          
               $destinationPath='uploads';
               $icon_imagename=time().'_'.$icon_image->getClientOriginalName();
               $icon_image->move($destinationPath,$icon_imagename);
       
           }



           DB::table('category')->insert(['name'=>$name,'image'=>$imagename,'description'=>$description,'icon_image'=>$icon_imagename,]);

           return redirect('admin/category')->with('error','Category inserted successfully!!!');
            
          }

 /*********************  update Category ************************/

           public function update_category($id){

            $id1=Auth::id();

            $admin=Admin::where('id',$id1)->get();
            $data['name']=$admin[0]->name;

              $category=DB::table('category')->where('id',$id)->get();
              $data['c_name']=$category[0]->name;
              $data['id']=$category[0]->id;
              $data['image']=$category[0]->image;
              $data['icon_image']=$category[0]->icon_image;
              $data['description']=$category[0]->description;
         
            return view('admin.update_category',$data);
            }


 /*********************  store Update ************************/


         public function store_update_category(Request $request, $id){

           $error=$request->validate([

               'name'=>'required',
               'description'=>'required'

           ]);

           $name=$request->input('name');
           $description=$request->input('description');
           $image=$request->file('image');
           $icon_image=$request->file('icon_image');
           $oldimage=$request->input('oldimage');
           $oldimage1=$request->input('oldimage1');
           $imagename='';

          $icon_imagename='';

        
           if($image)
           {
          
               $destinationPath='uploads';
               $imagename=time().'_'.$image->getClientOriginalName();
               $image->move($destinationPath,$imagename);

               DB::table('category')->where('id',$id)->update(['image'=>$imagename]);

               if($oldimage!='')
                {
                  unlink(public_path('/uploads/'.$oldimage));
                }
       
             }

               if($icon_image)
               {
          
               $destinationPath='uploads';
               $icon_imagename=time().'_'.$icon_image->getClientOriginalName();
               $icon_image->move($destinationPath,$icon_imagename);

               DB::table('category')->where('id',$id)->update(['icon_image'=>$icon_imagename]);

               if($oldimage1!='')
                {
                  unlink(public_path('/uploads/'.$oldimage1));
                }
       
               }
             DB::table('category')->where('id',$id)->update(['name'=>$name,'description'=>$description]);

             return redirect('admin/category')->with('error','Category data updated successfully!!!');

           }
/*********************  Delete Category ************************/
    

           public function delete_category($id){


              $category=DB::table('category')->where('id',$id)->get();
              $image=$category[0]->image;

              if($image!='')
               {
                 unlink(public_path('/uploads/'.$image));
               }

               $icon_image=$category[0]->icon_image;


               if($icon_image!='')
                {
                 unlink(public_path('/uploads/'.$icon_image));
                 }


               DB::table('category')->where('id',$id)->delete();


               return response()->json(['success'=>'Category data deleted successfully!!!',]);

           }

   /*********************  Delete selected Category ************************/

           public function delete_all_category(Request $request){

                $ids = $request->ids;
                foreach($ids as $id){
 
                $category=DB::table('category')->where('id',$id)->get();
                $image=$category[0]->image;

               if($image!='')
                {
                 unlink(public_path('/uploads/'.$image));
                }

                 $icon_image=$category[0]->icon_image;

                 if($icon_image!='')
                 {
                  unlink(public_path('/uploads/'.$icon_image));
                 }


                 DB::table('category')->where('id',$id)->delete();

                }
  
                return response()->json(['status'=>200]);


               }


   /*********************   subCategory list ******************************/



         public function subcategory(){

          $id=Auth::id();
          $admin=Admin::where('id',$id)->get();
          $data['name']=$admin[0]->name;

        $category=DB::table('category')->get();
        $data['category']=$category;


          $subcategory=DB::table('subcategory')->paginate(14);
          $data['subcategory']=$subcategory;



            return view('admin.subcategory',$data);
         }

/**************************** add_subcategory**********************/



       public function add_subcategory(){

          $id=Auth::id();
          $admin=Admin::where('id',$id)->get();
          $data['name']=$admin[0]->name;

          $category=DB::table('category')->get();
          $data['category']=$category;


            return view('admin.add_subcategory',$data);
         }


 /**************************** store_subcategory**********************/

       public function store_subcategory(Request $request){

             $error=$request->validate([

               'category'=>'required',        
                'name'=>'required',
            
           ]);

           $name=$request->input('name');
           $category=$request->input('category');

           $isinserted=DB::table('subcategory')->where('name',$name)->count();

           if($isinserted){

            return redirect('admin/add_subcategory')->with('error','subCategory already inserted !!!');
          
             }else{


                DB::table('subcategory')->insert(['name'=>$name,'category'=>$category]);


               return redirect('admin/subcategory')->with('error','SubCategory inserted successfully!!!');



             }

            
          }


      /**************************** update_subcategory**********************/


           public function update_subcategory($id){

             $id1=Auth::id();

              $admin=Admin::where('id',$id1)->get();
              $data['name']=$admin[0]->name;

              $subcategory=DB::table('subcategory')->where('id',$id)->get();


                $data['sub_name']=$subcategory[0]->name;
                $data['category_name']=$subcategory[0]->category;
                $data['id']=$subcategory[0]->id;

                $category=DB::table('category')->get();
                $data['category']=$category;
 
              return view('admin.update_subcategory',$data);

            }



     /**************************** store updated_subcategory**********************/


       public function store_update_subcategory(Request $request,$id){

             $error=$request->validate([

                'category'=>'required',        
                'name'=>'required',
            
           ]);

           $name=$request->input('name');
           $category=$request->input('category');

           $inserted=DB::table('subcategory')->where('name',$name)->orwhere('category',$category)->count();

            if($inserted){ 

                $inserted_name1=DB::table('subcategory')->where('name',$name)->get();

                 $sub_name=$inserted_name1[0]->name;
                 $category_name=$inserted_name1[0]->category;

                 if($sub_name===$name && $category_name==$category){

                     return redirect('admin/update_subcategory/'.$id)->with('error','subCategory already inserted !!!');

                    }else{

                          DB::table('subcategory')->where('id',$id)->update(['name'=>$name,'category'=>$category]);

                            return redirect('admin/subcategory')->with('error','SubCategory updated successfully!!!');

                    }


          
             }else{


               DB::table('subcategory')->where('id',$id)->update(['name'=>$name,'category'=>$category]);


               return redirect('admin/subcategory')->with('error','SubCategory updated successfully!!!');



             }

           }


           /*********************  Delete  subCategory ************************/
    

           public function delete_subcategory($id){


               DB::table('subcategory')->where('id',$id)->delete();


               return response()->json(['success'=>'SubCategory data deleted successfully!!!',]);

           }



       /*********************  Delete  selected subCategory ************************/

           public function delete_all_subcategory(Request $request){

                $ids = $request->ids;
                foreach($ids as $id){
 

                 DB::table('subcategory')->where('id',$id)->delete();

                }
  
                return response()->json(['status'=>200]);


               }


           /***************************ADMIN DETAIL PAGE ****************************/

                public function adminprofile(){
 
                  $id1=Auth::id();

                  $admin=Admin::where('id',$id1)->get();
                  $data['name']=$admin[0]->name;

                  $data['mobile_no']=DB::table('admin_mobile')->get();
                  
                  $data['admindetail']=DB::table('admindetail')->get();

                  return view('admin.adminprofile',$data);

               }


               public function update_adminprofile($id){
 
                   $id1=Auth::id();

                   $admin=Admin::where('id',$id1)->get();
                   $data['name']=$admin[0]->name;
    
                   $list=DB::table('admindetail')->where('id',$id)->get();

                   $data['id']=$list[0]->id;
                   $data['name']=$list[0]->name;
                   $data['email']=$list[0]->email;
                   $data['address']=$list[0]->address;
                   $data['facebook']=$list[0]->facebook;
                   $data['instagram']=$list[0]->instagram;
                   $data['youtube']=$list[0]->youtube;
                   $data['linkedin']=$list[0]->linkedin;
                 
                  $data['mobile_no']=DB::table('admin_mobile')->where('admin_id',$id)->get();

                  return view('admin.update_admindetail',$data);

               }

               public function delete_mobileno($id){

                  DB::table('admin_mobile')->where('id',$id)->delete();

                  return response()->json(['success'=>'Mobile deleted successfully!!!',]);



              }


       public function store_update_adminprofile(Request $request,$id)
           {

           $error=$request->validate([
             
              'name' => 'required',
              'email' => 'required',
              'address' => 'required',
              
              
              ]);

            
            $name=$request->input('name');
            $email=$request->input('email');
            $address=$request->input('address');
            $facebook=$request->input('facebook');
            $instagram=$request->input('instagram');
            $youtube=$request->input('youtube');
            $linkedin=$request->input('linkedin');

             $mobileno=$request->input('tags');
             $mobileno1 = explode(",", $mobileno);



            DB::table('admindetail')->where('id',$id)->update(['name'=>$name,'email'=>$email,'address'=>$address,'facebook'=>$facebook,'instagram'=>$instagram,'youtube'=>$youtube,'linkedin'=>$linkedin]);


              foreach($mobileno1 as $key => $p) {

               DB::table('admin_mobile')->insert(['number'=>$p, 'admin_id'=>$id]);
        
              }

            return redirect('admin/adminprofile')->with('error','Admin Contact Info Updated Successfully!!!');

         }

        
    }



   

   

  





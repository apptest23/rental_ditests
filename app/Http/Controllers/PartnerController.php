<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Vendor;
use Illuminate\Support\Facades\Mail;
use Illuminate\support\facades\Redirect;
use Auth;
use DB;
use Hash;
use Carbon\Carbon;

class PartnerController extends Controller
{

     public function __construct(){

                $this->middleware('vendorauth');
        }



       public function vendor_home(){

         $vendor=Auth::guard('vendor')->user();
 
         $data['vendor']=$vendor;

         $data['site_url']= env('APP_URl');
         $data['metatitle']='home page';

         //$id=Auth::id();
         $id=$vendor->id;

         $vendor=vendor::where('id',$id)->get();

         $data['name']=$vendor[0]->name;



         return view('vendor.vendor_home',$data);


        }

        public function profile(){


       $vendor=Auth::guard('vendor')->user();
 
         $data['vendor']=$vendor;

         $data['site_url']= env('APP_URl');
         $data['metatitle']='home page';

         //$id=Auth::id();
         $id=$vendor->id;

         $vendor=vendor::where('id',$id)->get();

         $data['name']=$vendor[0]->name;
         $data['image']=$vendor[0]->image;
         $data['email']=$vendor[0]->email;
         $data['phone_no']=$vendor[0]->phone_no;
         $data['address']=$vendor[0]->address;

         return view('vendor.profile',$data);

        }

        public function edit_profile(Request $request){


           $errors=$request->validate([

                  'name' => 'required',
                  'email' => 'required|email',
                  'phone_no' => 'required|size:10',
                                
                ]);

              $vendor=Auth::guard('vendor')->user();
 
               $data['vendor']=$vendor;

              $data['site_url']= env('APP_URl');
              $data['metatitle']='home page';

         //$id=Auth::id();
               $id=$vendor->id;

                 $name=$request->input('name');
                 $email=$request->input('email');
                 $phone_no=$request->input('phone_no');
                 $address=$request->input('address');
                 $image=$request->file('image');
                 $oldimage=$request->input('oldimage');

               

                 $imagename=' ';


             if($image)
               {
          
                $destinationPath='uploads';
                $imagename=time().'_'.$image->getClientOriginalName();
                $image->move($destinationPath,$imagename);

                 Vendor::where('id',$id)->update(['image'=>$imagename]);

               if($oldimage!='')
                {
                  unlink(public_path('/uploads/'.$oldimage));
                }
       
               }
            
              Vendor::where('id',$id)->update(['name'=>$name,'email'=>$email,'phone_no'=>$phone_no,'address'=>$address]);

              return redirect('Partner/profile')->with('error','your profile successfully!!');


        }

        public function changepassword(){

             $vendor=Auth::guard('vendor')->user();
 
               $data['vendor']=$vendor;

              $data['site_url']= env('APP_URl');
              $data['metatitle']='home page';

       
             $id=$vendor->id;

            $vendor=vendor::where('id',$id)->get();

            $data['name']=$vendor[0]->name;


          return view('vendor.changepassword',$data);

        }

            public function updatepassword(Request $request){

                $error=$request->validate([
              'oldpassword' => 'required|string',
              'newpassword' => 'required|string|min:6',
           
              ]);

                  $vendor=Auth::guard('vendor')->user();
 
               $data['vendor']=$vendor;

              $data['site_url']= env('APP_URl');
              $data['metatitle']='home page';

       
             $id=$vendor->id;

               $oldpassword=$request->input('oldpassword');
               $newpassword=$request->input('newpassword');

            /*   $id=Auth::id();*/

               $password=Vendor::where('id', $id)->get();

               $password1=$password[0]->password;

              if(Hash::check($oldpassword,$password1)){

                   Vendor::where('id', $id)->update(['password'=>Hash::make($newpassword)]);

                  return redirect('Partner/changepassword')->with('error','your password has been update successfully' );

               }else{

                return Redirect::back()->with('success','Your Old password is not correct!!!!');

            }


       }

     
}

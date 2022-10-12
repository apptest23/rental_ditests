<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Mail;
use Auth;
use DB;
use Hash;
use Carbon\Carbon;


class VendorloginController extends Controller
{

 public function __construct(){

         // $this->middleware('guest:vendor')->except('logout');
        }


/*    public function vendor_home(){

         $vendor=Auth::guard('vendor')->vendor();
 
         $data['vendor']=$vendor;

         $data['site_url']= env('APP_URl');
         $data['metatitle']='home page';

         $id=Auth::id();

         echo $id;

         exit;
         $vendor=vendor::where('id',$id)->get();

         $data['name']=$vendor[0]->name;



         return view('vendor.vendor_home',$data);


        }
*/

          protected function guard(){

           return Auth::guard('vendor');

              }

         public function vendor_logout(){

           Auth::guard('vendor')->logout();

             /* Auth::logout();*/

          return redirect('User/login_registration');
      }



    public function registration(){

        return view('vendor.registration');
    }

      public function store_vendor(Request $request){

         $error=$request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:vendors', 
            'password' => 'required|min:6',
            'Confirm_Password' => 'required|same:password',
            'terms_condition' => 'accepted', 
            'phone_no' => 'required|size:10|unique:vendors',
            'address' => 'required', 
           

        ]);

             $name=$request->input('name');
             $email=$request->input('email');
             $password=$request->input('password');
             $terms_condition=$request->input('terms_condition');
             $phone_no=$request->input('phone_no');
             $address=$request->input('address');
             $verified=0;
             $country_code='+91';
             $products=$request->input('products');
             $products_name = explode(",", $products);

                $password1=Hash::make($password);

             $vendor=Vendor::insert(['name'=>$name,'email'=>$email,'password'=>$password1,'terms_condition'=>$terms_condition,'address'=>$address,'country_code'=>$country_code,'phone_no'=>$phone_no,'verified'=>$verified,]);

             $vendor_id=Vendor::max('id');
          

           foreach ($products_name as $key =>$p) {

             DB::table('vendor_product')->insert(['name'=>$p, 'vendor_id'=>$vendor_id]);
        
            }

            $products_name1 =DB::table('vendor_product')->where('vendor_id',$vendor_id)->get();

             $meta['FROM_EMAIL']="ditest787@gmail.com";
             $meta['email']="apptest2303@gmail.com";
             $meta['subject']="someone requested to become a partner";  
             $meta['id']= $vendor_id;
             $meta['name']=$name;
             $meta['email1']=$email;
             $meta['phone_no']=$phone_no;
             $meta['address']=$address;
             $meta['products_name']=$products_name1;    
  
             
             Mail::send('email.verification', $meta, function($m) use($meta){
        
               $m->from($meta['FROM_EMAIL'],'someone requested to become a partner');
               $m->to($meta['email']);
               $m->subject($meta['subject']); 
             });

        
         if($vendor){

            return redirect('User/login_registration')->with('success','your account go for the verification please wait for some time !!');

         }else{


           return redirect('Partner/registration')->with('error','Some error accured, Please Try again!!');

         }


     }


    public function Partner_authenticate(Request $request)

    {

          if($request->phone_no !=null){


           $validator=Validator::make($request->all(),[

              'phone_no'=>'required|size:10',
               'password'=>'required'
          
             ]);

           }else if($request->email !=null){

               $validator=Validator::make($request->all(),[

               'email'=>'required|email',
               'password'=>'required'
          
             ]);


           }else{


             $validator=Validator::make($request->all(),[

               'phone_no'=>'required|size:10',
               'email'=>'required|email',
               'password'=>'required'
          
             ]);


           }



        if($validator->passes()){

          if($request->phone_no !=null)  {

             $credentials = $request->only('phone_no', 'password');

          }else{

               $credentials = $request->only('email', 'password');

            }

          

             if (Auth::guard('vendor')->attempt($credentials)) {


             $user=Vendor::where('email',$request->email)->orwhere('phone_no',$request->phone_no)->get();

             $verified=$user[0]->verified;

             if($verified==0){


                 return response()->json(['status'=>3,
                                            'success'=>'your account is not verified, please wait for some time !!.']);

                  }


                    return response()->json(['status'=>1,
                                            'success'=>'Added new records.']);

                }else{


                      $user=Vendor::where('email',$request->email)->orwhere('phone_no',$request->phone_no)->count();

                     if($user){

                             return response()->json(['status'=>2,

                              'success'=>'You have entered incorrect password ']);

                        }else{

                              return response()->json(['status'=>0,

                                'success'=>'You have entered invalid credentials']);

                        }
                  
                }
    
        }else{

              return response()->json(['error'=>$validator->errors()]);

        }

      
    }


     public function verification_account($id){

         


      }



      //////////////////////////// forgot password////////////////////////

     public function Vendor_forgetpassword()
    {
  
      return view('vendor.forgetpassword');
    }
     public function Vendor_send_otp(Request $request){


         $error=$request->validate([

            'email' => 'required_without:phone_no',

            'phone_no' => 'required_without:email',


        ]);


           $email=$request->input('email');
           $phone_no=$request->input('phone_no');


          if($email !='' && $phone_no !=''){

             return redirect('Partner/forget_password')->with('error', 'please Enter only phone number OR Email address');

             }else{

           $vendor=Vendor::where('email', $email)->orWhere('phone_no',$phone_no)->count(); 

          if($vendor){

           $string=$this->generateRandomString(4);

           $created_at=Carbon::now();

           $vendor_data=Vendor::where('email', $email)->orWhere('phone_no',$phone_no)->get();

           $vendor_id=$vendor_data[0]->id;

           if($email != ''){


              $checkalready=DB::table('vendor_password_reset')->where('vender_id', $vendor_id)->count();

              if($checkalready){

                    DB::table('vendor_password_reset')->update(['email'=>$email,'token'=>$string,'created_at'=>$created_at,'vender_id'=>$vendor_id]);
                }else{
                   
                    DB::table('vendor_password_reset')->insert(['email'=>$email,'token'=>$string,'created_at'=>$created_at,'vender_id'=>$vendor_id]);

                }
                  
       
                 $meta['FROM_EMAIL']="ditest787@gmail.com";
                 $meta['email']= $email;
                 $meta['subject']="reset password mail";  
                 $meta['id']= $vendor_id;
                 $meta['token']=$string;
           
                 Mail::send('email.vender_resetpassword', $meta, function($m) use($meta){
        
                 $m->from($meta['FROM_EMAIL'],'reset password mail');
                 $m->to($meta['email']);
                 $m->subject($meta['subject']); 
               });        

              return redirect('Partner/vendor_verify_otp_view/'.$vendor_id)->with('success', 'OTP send on your Email address !');

          }else{
 
           // $string=$this->generateRandomString(4);   // use when sms gateway integrate
    
                $string='1234';

                $checkalready=DB::table('vendor_password_reset')->where('vender_id', $vendor_id)->count();

               if($checkalready){

                    DB::table('vendor_password_reset')->where('vender_id', $vendor_id)->update(['phone_no'=>$phone_no,'country_code'=>'+91','token'=>$string,'created_at'=>$created_at,'vender_id'=>$vendor_id]);
                 }else{

                    DB::table('vendor_password_reset')->insert(['phone_no'=>$phone_no,'country_code'=>'+91','token'=>$string,'created_at'=>$created_at,'vender_id'=>$vendor_id]);
                 }
    
                 return redirect('Partner/vendor_verify_otp_view/'.$vendor_id)->with('success', 'OTP send on your Mobile Number !');             
             }

       } else{

        return redirect('Partner/Vendor_forgetpassword')->with('error', 'Partner is not available, Please Complete your Registration !');
        
         }

        }

      }


       public function vendor_verify_otp_view($id){

            $data['id']=$id;

         return view('vendor.verify_otp_view',$data);

      }

      public function Vendor_verify_otp(Request $request, $id){

          $error=$request->validate([

            'otp' => 'required|size:4',

           ]);


           $vendor=Vendor::where('id',$id)->get();

           $reset_pwd_vendor=DB::table('vendor_password_reset')->where('vender_id', $id)->get();

           $create_time=$reset_pwd_vendor[0]->created_at;

           $otp=$reset_pwd_vendor[0]->token;

           $expiry = Carbon::now()->subMinutes(10);

           if($create_time<=$expiry){

             return redirect('Partner/Vendor_forgetpassword')->with('error', 'Your OTP has been expried, Please Try again !');     

           }else{

                $request_otp=$request->input('otp');

                  if($request_otp==$otp){

                   $reset_pwd_vendor=DB::table('vendor_password_reset')->where('vender_id', $id)->delete();

                  return redirect('Partner/Vendor_resetpassword/'.$id);     

                }else{


                  return redirect('Partner/vendor_verify_otp_view/'.$id)->with('error', 'OTP is Invalid !');

                }

           }       

      }

      public function Vendor_resetpassword($id){

            $data['id']=$id;

        return view('vendor.reset_password',$data);

     }

     public function Vendor_updatepassword(Request $request,$id){

         $error=$request->validate([
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
         ]);

         $password1 =$request->input('password');

         $password=Hash::make($password1);


          Vendor::where('id',$id)->update(['password' => $password]);

         return redirect('User/login_registration')->with('success', 'your password has been reset successfully !');


     }
   

     function generateRandomString($length = 4) {
           $characters = '0123456789';
           $charactersLength = strlen($characters);
           $randomString = '';
           for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
           }
         return $randomString;
      }









}

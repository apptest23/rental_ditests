<?php

namespace App\Http\Controllers\API\Partner\Auth;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Vendor;
use App\Models\Vendor_product;
use Hash;
use Auth;
use Validator;
use Carbon\Carbon;
use DB;


class PartnerloginController extends BaseController
{

     protected function guard(){

        return Auth::guard('vendor');

     }

     public function register(Request $request){

    /*    try{
*/
           $validator = Validator::make($request->all(), [

            'name'=>'required',
            'email' => 'required|email|unique:vendors', 
            'password' => 'required|min:6',
            'Confirm_Password' => 'required|same:password',
            'terms_condition' => 'accepted', 
            'phone_no' => 'required|size:10|unique:vendors',
            'address' => 'required', 
           
        ]);


        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());   

          }

             $name=$request->name;
             $email=$request->email;
             $password=$request->password;
             $terms_condition=$request->terms_condition;
             $phone_no=$request->phone_no;
             $address=$request->address;
             $verified=0;
             $country_code='+91';
             $products=$request->products;

          
             $password1=Hash::make($password);

             $vendor=Vendor::insert(['name'=>$name,'email'=>$email,'password'=>$password1,'terms_condition'=>$terms_condition,'address'=>$address,'country_code'=>$country_code,'phone_no'=>$phone_no,'verified'=>$verified,]);

             $vendor_id=Vendor::max('id');
          

           foreach ($products as $key =>$p) {

             Vendor_product::create(['name'=>$p, 'vendor_id'=>$vendor_id]);
        
            }

            $products_name=Vendor_product::where('vendor_id',$vendor_id)->get();

             $meta['FROM_EMAIL']="ditest787@gmail.com";
             $meta['email']="apptest2303@gmail.com";
             $meta['subject']="someone requested to become a partner";  
             $meta['id']= $vendor_id;
             $meta['name1']=$name;
             $meta['email1']=$email;
             $meta['phone_no']=$phone_no;
             $meta['address']=$address;
             $meta['products_name']=$products_name;    
  
             
             Mail::send('email.verification', $meta, function($m) use($meta){
        
               $m->from($meta['FROM_EMAIL'],'someone requested to become a partner');
               $m->to($meta['email']);
               $m->subject($meta['subject']); 
             });

             if($vendor){

                  $responseArray['status']=1;
                  $responseArray['message']='your account go for the verification please wait for some time !!';


               }else{

                  $responseArray['status']=0;
                  $responseArray['message']='Some issue occured !';

                }    

                return $this->sendResponse($responseArray, 'Registartion ');
            

      /*  }catch(\Throwable $th) {

            return $this->sendError('something went wrong.!!! please try again later.');

          }*/

     }

     public function login(Request $request){

        try{

          if($request->phone_no !=null){


           $validator=Validator::make($request->all(),[

              'phone_no'=>'required|size:10',
               'password'=>'required'
          
             ]);
             
               if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
          }

           }else if($request->email !=null){

               $validator=Validator::make($request->all(),[

               'email'=>'required|email',
               'password'=>'required'
          
             ]);
             
               if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
          }


           }else{


             $validator=Validator::make($request->all(),[

               'phone_no'=>'required|size:10',
               'email'=>'required|email',
               'password'=>'required'
          
             ]);
             
               if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
            }


      }

        if($request->email !=''){

         if(Auth::guard('vendor')->attempt(['email'=>$request->email, 'password'=>$request->password])){

              $user=Vendor::where('email',$request->email)->orwhere('phone_no',$request->phone_no)->get();

               $verified=$user[0]->verified;

               if($verified==0){

                   $responseArray['status']=3;

                      return $this->sendResponse($responseArray,'your account is not verified, please wait for some time !!.');


                  }else{

                       $vendor=Auth::guard('vendor')->user();

                       $token= $vendor->createToken('app_token', ['server:update'])->plainTextToken;

                       $responseArray['status']=200;

                       $responseArray=[];
                       $responseArray['token']=$token;
                       $responseArray['name']=$vendor->name;

                       $responseArray['partner']=$vendor;

                       $responseArray['message']='successfully login!!';

                       return $this->sendResponse($responseArray, 'successfully login!!');

                     }

            
                  }else{
/*
                      $responseArray=[];
                      $responseArray['status']=0;*/


                  
                   return response()->json(['error'=>'Unauthenticated'],203);
              }


          }else{


               if(Auth::guard('vendor')->attempt(['phone_no'=>$request->phone_no, 'password'=>$request->password])){

              $user=Vendor::where('email',$request->email)->orwhere('phone_no',$request->phone_no)->get();

               $verified=$user[0]->verified;

               if($verified==0){

                   $responseArray['status']=3;

                      return $this->sendResponse($responseArray,'your account is not verified, please wait for some time !!.');


                  }else{

                       $vendor=Auth::guard('vendor')->user();

                       $token=$vendor->createToken('app_token', ['server:update'])->plainTextToken;

                       $responseArray['status']=200;

                       $responseArray=[];
                       $responseArray['token']=$token;
                       $responseArray['name']=$vendor->name;

                       $responseArray['partner']=$vendor;

                       $responseArray['message']='successfully login!!';

                       return $this->sendResponse($responseArray, 'successfully login!!');

                     }
            
                    }else{

                      $responseArray=[];
                      $responseArray['status']=0;

                  return $this->sendResponse($responseArray, 'Invalidate Credentials');
              }


          }

        }catch(\Throwable $th) {

            return $this->sendError('something went wrong.!!! please try again later.');

          }
      }

             public function forget_password(Request $request){


         try {

          
            $validator = Validator::make($request->all(), [

                  'emailOr_phone_no' => 'required',
               

                ]);

             if($validator->fails()){

              return $this->sendError('Validation Error.', $validator->errors()); 
  
              }else{


                  $email_or_phone =$request->emailOr_phone_no;                   

                  $partner=vendor::where('email', $email_or_phone)->orWhere('phone_no',$email_or_phone)->count(); 

                

                  if($partner){

                     $string=$this->generateRandomString(4);

                     $created_at=Carbon::now();

                     $partner_data=vendor::where('email', $email_or_phone)->orWhere('phone_no',$email_or_phone)->get();

                     $partner_id=$partner_data[0]->id;

                     $is_email=vendor::where('email', $email_or_phone)->count(); 

                     if($is_email){

                         $checkalready=DB::table('vendor_password_reset')->where('vender_id',$partner_id)->count();


                         if($checkalready){

                            DB::table('vendor_password_reset')->update(['email'=>$email_or_phone,'token'=>$string,'created_at'=>$created_at,'vender_id'=>$partner_id]);

                           }else{
                    
                            DB::table('vendor_password_reset')->insert(['email'=>$email_or_phone,'token'=>$string,'created_at'=>$created_at,'vender_id'=>$partner_id]);

                            }
                  
                                 $meta['FROM_EMAIL']="ditest787@gmail.com";
                                 $meta['email']= $email_or_phone;
                                 $meta['subject']="reset password mail";  
                                 $meta['id']= $partner_id;
                                 $meta['token']=$string;
                               
                      
                                 Mail::send('email.resetpassword', $meta, function($m) use($meta){
                            
                                   $m->from($meta['FROM_EMAIL'],'reset password mail');
                                   $m->to($meta['email']);
                                   $m->subject($meta['subject']); 
                                 });

                              $responseArray=[];
                              $responseArray['otp']=$string;
                              $responseArray['partner_id']=$partner_id;
                             
                            return $this->sendResponse($responseArray, 'OTP send on your email address');
                                 

                         }else{


                          $checkalready=DB::table('vendor_password_reset')->where('vender_id',$partner_id)->count();


                          if($checkalready){

                            DB::table('vendor_password_reset')->where('vender_id',$partner_id)->update(['phone_no'=> $email_or_phone,'country_code'=>'+91','token'=>$string,'created_at'=>$created_at,'vender_id'=>$partner_id]);
                           }else{

                            DB::table('vendor_password_reset')->insert(['phone_no'=>$email_or_phone,'country_code'=>'+91','token'=>$string,'created_at'=>$created_at,'vender_id'=>$partner_id]);
                           }

                              $responseArray=[];
                              $responseArray['otp']=$string;
                              $responseArray['partner_id']=$partner_id;
                             
                            return $this->sendResponse($responseArray, 'OTP send on your mobile number');


                       }


                  }else{

                        return response()->json(['error'=>'User is not available, Please Complete your Registration'],203);

                   }

              }



           }catch (\Throwable $th) {

            return $this->sendError('something went wrong.!!! please try again later.');

          } 

      }
      
      public function verify_otp(Request $request)

         {

        try {

            $validator = Validator::make($request->all(), [

                'otp' => 'required',

                'partner_id' => 'required',

                ]);

            if ($validator->fails()) {

                return $this->sendError('Validation Error.', $validator->errors());

            }

              $partner_id = $request->partner_id;

              $partner=vendor::where('id',$partner_id)->count();


             if($partner){


                  $reset_pwd_vendor=DB::table('vendor_password_reset')->where('vender_id', $partner_id)->get();

                  $create_time=$reset_pwd_vendor[0]->created_at;


                  $otp=$reset_pwd_vendor[0]->token;

                  $expiry = Carbon::now()->subMinutes(10);

                
                if($create_time<=$expiry){


                    $responseArray=[];
                    $responseArray['partner_id']=$partner_id;
                    $responseArray['message']='Your OTP has been expried, Please Try again !';

                     return $this->sendResponse($responseArray, 'Your OTP has been expried, Please Try again !');  
     

                }else{


                   $request_otp=$request->input('otp');

                   if($request_otp==$otp){

                    $reset_pwd_partner=DB::table('vendor_password_reset')->where('vender_id',$partner_id)->delete();

                    $responseArray=[];
            
                    $responseArray['partner_id']=$partner_id;
                    $responseArray['message']='OTP verify successfully !!';

                     return $this->sendResponse($responseArray, 'OTP verify successfully !!');  

                     }else{



                      $responseArray=[];
        
                      $responseArray['partner_id']=$partner_id;
                      $responseArray['message']='OTP is incorrect !!';

                     return $this->sendResponse($responseArray, 'OTP is incorrect !!');  


                  }

               }   

           } else{

                    $responseArray=[];
                    $responseArray['partner_id']=$partner_id;
                    $responseArray['message']='User not registered!';

                 return $this->sendResponse($responseArray, 'Partner not registered!');  



           }      

          } catch (\Throwable $th) {

            return $this->sendError('Something went wrong, please try again later.');

        }

    }

       public function resetPassword(Request $request){


         try {

            $validator = Validator::make($request->all(), [

                 'password' => 'required|min:6',

                 'confirm_password' => 'required|same:password',

                 'partner_id' => 'required',

                ]);

            if ($validator->fails()) {

                return $this->sendError('Validation Error.', $validator->errors());

              }

               $partner_id = $request->partner_id;

                $partner_id1=vendor::where('id',$partner_id)->count();


             if($partner_id1){

                 $password1 =$request->password;

                 $password=Hash::make($password1);

                 vendor::where('id',$partner_id)->update(['password' => $password]);

                    $responseArray=[];
                    $responseArray['partner_id']=$partner_id;
                    $responseArray['message']='Password Change successfully !';

                   return $this->sendResponse($responseArray, 'Password Change successfully !');  


                }else{
 

                    $responseArray=[];
                    $responseArray['partner_id']=$partner_id;
                    $responseArray['message']='User not registered!';

                   return $this->sendResponse($responseArray, 'User not registered!');  


                }



            } catch (\Throwable $th) {

            return $this->sendError('Something went wrong, please try again later.');

        }






       }


      public function logout(){          


      $id=Auth::id();
     $token_remove=DB::table('personal_access_tokens')->where('tokenable_id',$id)->delete();
   // $vendor->tokens()->delete();

       $responseArray['partner']=$token_remove;

        $responseArray= [
                 
           'message'=>'logout successfully ',
                
        ];

          return response()->json($responseArray,200);


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

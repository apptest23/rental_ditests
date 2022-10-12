<?php

namespace App\Http\Controllers\API\User\Auth;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Hash;
use Auth;
use Validator;
use Carbon\Carbon;
use DB;


class AuthController extends BaseController
{

       /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'terms_condition' => 'accepted', 
            'phone_no' => 'required|size:10|unique:users',
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input=$request->all();

        $input['password']=bcrypt($input['password']);

        $user=User::create($input);
       
        $token= $user->createToken('app_token', ['server:update'])->plainTextToken;

         $user_arr = $user->toArray();


        $success['name'] = $user->name;


        return $this->sendResponse($success,'User register successfully.');
    }


       /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */

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

               if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){

               $user= Auth::user();

               $token= $user->createToken('app_token', ['server:update'])->plainTextToken;

               $responseArray=[];
               $responseArray['token']=$token;
               $responseArray['name']=$user->name;

               $responseArray['user']=$user;

               $responseArray['message']='successfully login!!';

                return $this->sendResponse($responseArray, 'successfully login!!');
            
                }else{

                   return response()->json(['error'=>'Unauthenticated'],203);
              }


        }else{


               if(Auth::attempt(['phone_no'=>$request->phone_no, 'password'=>$request->password])){

               $user= Auth::user();

               $token= $user->createToken('app_token', ['server:update'])->plainTextToken;

               $responseArray=[];
               $responseArray['token']=$token;
               $responseArray['name']=$user->name;

               $responseArray['user']=$user;

               $responseArray['message']='successfully login!!';

                return $this->sendResponse($responseArray, 'successfully login!!');
            
                }else{

                   return response()->json(['error'=>'Unauthenticated'],203);
              }



        }


        }catch(\Throwable $th) {

            return $this->sendError('something went wrong.!!! please try again later.');

          }
      }

     
     
     

     /* public function login(Request $request){

          $validator = Validator::make($request->all(), [
            
           'email' => 'required_without:phone_no|email',
           'phone_no' => 'required_without:email|size:10',
           'password'=>'required',

         ]);



         if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
          }


        if($request->email !=''){

               if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){

               $user= Auth::user();

               $token= $user->createToken('app_token', ['server:update'])->plainTextToken;

               $responseArray=[];
               $responseArray['token']=$token;
               $responseArray['name']=$user->name;

               $responseArray['user']=$user;

               $responseArray['message']='successfully login!!';

                return $this->sendResponse($responseArray, 'successfully login!!');
            
                }else{

                   return response()->json(['error'=>'Unauthenticated'],203);
              }


        }else{


               if(Auth::attempt(['phone_no'=>$request->phone_no, 'password'=>$request->password])){

               $user= Auth::user();

               $token= $user->createToken('app_token', ['server:update'])->plainTextToken;

               $responseArray=[];
               $responseArray['token']=$token;
               $responseArray['name']=$user->name;

               $responseArray['user']=$user;

               $responseArray['message']='successfully login!!';

                return $this->sendResponse($responseArray, 'successfully login!!');
            
                }else{

                   return response()->json(['error'=>'Unauthenticated'],203);
              }



        }


        
    }*/

      public function logout(){          

        auth()->user()->tokens()->delete();


        $responseArray= [
                 
                 'message'=>'logout successfully ',
                
        ];

          return response()->json($responseArray,200);


   }

     /**
     * forget password api
     *
     * @return \Illuminate\Http\Response
     */

     public function forget_password(Request $request){


         try {

          
            $validator = Validator::make($request->all(), [

                  'emailOr_phone_no' => 'required',
               

                ]);

             if($validator->fails()){

              return $this->sendError('Validation Error.', $validator->errors()); 
  
              }else{


                  $email_or_phone =$request->emailOr_phone_no;                   

                  $user=User::where('email', $email_or_phone)->orWhere('phone_no',$email_or_phone)->count(); 

                

                  if($user){

                     $string=$this->generateRandomString(4);

                     $created_at=Carbon::now();

                     $user_data=User::where('email', $email_or_phone)->orWhere('phone_no',$email_or_phone)->get();

                     $user_id=$user_data[0]->id;

                     $is_email=User::where('email', $email_or_phone)->count(); 

                     if($is_email){

                         $checkalready=DB::table('password_resets')->where('user_id',$user_id)->count();


                         if($checkalready){

                            DB::table('password_resets')->where('user_id',$user_id)->update(['email'=>$email_or_phone,'token'=>$string,'created_at'=>$created_at,'user_id'=>$user_id]);

                           }else{
                    
                            DB::table('password_resets')->insert(['email'=>$email_or_phone,'token'=>$string,'created_at'=>$created_at,'user_id'=>$user_id]);

                            }
                  
                           
                                 $meta['FROM_EMAIL']="ditest787@gmail.com";
                                 $meta['email']= $email_or_phone;
                                 $meta['subject']="reset password mail";  
                                 $meta['id']= $user_id;
                                 $meta['token']=$string;
                               
                      
                                 Mail::send('email.resetpassword', $meta, function($m) use($meta){
                            
                                   $m->from($meta['FROM_EMAIL'],'reset password mail');
                                   $m->to($meta['email']);
                                   $m->subject($meta['subject']); 
                                 });

                              $responseArray=[];
                              $responseArray['otp']=$string;
                              $responseArray['id']=$user_id;
                             
                            return $this->sendResponse($responseArray, 'OTP send on your email address');
                                 

                         }else{


                            $checkalready=DB::table('password_resets')->where('user_id',$user_id)->count();


                          if($checkalready){

                            DB::table('password_resets')->where('user_id',$user_id)->update(['phone_no'=> $email_or_phone,'country_code'=>'+91','token'=>$string,'created_at'=>$created_at,'user_id'=>$user_id]);
                           }else{

                            DB::table('password_resets')->insert(['phone_no'=>$email_or_phone,'country_code'=>'+91','token'=>$string,'created_at'=>$created_at,'user_id'=>$user_id]);
                           }

                              $responseArray=[];
                              $responseArray['otp']=$string;
                              $responseArray['id']=$user_id;
                             
                            return $this->sendResponse($responseArray, 'OTP send on your mobile number');


                       }


                  }else{

                        return response()->json(['error'=>'User is not available, Please Complete your Registration'],203);

                   }

              }

          

           } catch (\Throwable $th) {

            return $this->sendError('something went wrong.!!! please try again later.');

          }


          }




     /**
     * verify otp api
     *
     * @return \Illuminate\Http\Response
     */


      public function verify_otp(Request $request)

         {

        try {

            $validator = Validator::make($request->all(), [

                'otp' => 'required',

                'user_id' => 'required',

                ]);

            if ($validator->fails()) {

                return $this->sendError('Validation Error.', $validator->errors());

            }

              $user_id = $request->user_id;

              $user=User::where('id',$user_id)->count();


             if($user){


                  $reset_pwd_user=DB::table('password_resets')->where('user_id', $user_id)->get();

                  $create_time=$reset_pwd_user[0]->created_at;


                  $otp=$reset_pwd_user[0]->token;

                  $expiry = Carbon::now()->subMinutes(10);

                
                if($create_time<=$expiry){


                    $responseArray=[];
                    $responseArray['user_id']=$user_id;
                    $responseArray['message']='Your OTP has been expried, Please Try again !';

                     return $this->sendResponse($responseArray, 'Your OTP has been expried, Please Try again !');  
     

                }else{


                   $request_otp=$request->input('otp');

                   if($request_otp==$otp){

                    $reset_pwd_user=DB::table('password_resets')->where('user_id',$user_id)->delete();

                    $responseArray=[];
            
                    $responseArray['user_id']=$user_id;
                    $responseArray['message']='OTP verify successfully !!';

                     return $this->sendResponse($responseArray, 'OTP verify successfully !!');  

                     }else{



                      $responseArray=[];
        
                      $responseArray['user_id']=$user_id;
                      $responseArray['message']='OTP is incorrect !!';

                     return $this->sendResponse($responseArray, 'OTP is incorrect !!');  


                  }

               }   

           } else{

                    $responseArray=[];
                    $responseArray['user_id']=$user_id;
                    $responseArray['message']='User not registered!';

                 return $this->sendResponse($responseArray, 'User not registered!');  



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

                 'user_id' => 'required',

                ]);

            if ($validator->fails()) {

                return $this->sendError('Validation Error.', $validator->errors());

              }

               $user_id = $request->user_id;

                $user=User::where('id',$user_id)->count();


             if($user){

                 $password1 =$request->password;

                 $password=Hash::make($password1);

                 User::where('id',$user_id)->update(['password' => $password]);

                    $responseArray=[];
                    $responseArray['user_id']=$user_id;
                    $responseArray['message']='Password Change successfully !';

                   return $this->sendResponse($responseArray, 'Password Change successfully !');  


                }else{
 

                    $responseArray=[];
                    $responseArray['user_id']=$user_id;
                    $responseArray['message']='User not registered!';

                   return $this->sendResponse($responseArray, 'User not registered!');  


                }



            } catch (\Throwable $th) {

            return $this->sendError('Something went wrong, please try again later.');

        }


       }

       public function resend_otp(Request $request){


           try {
  
            $validator = Validator::make($request->all(), [

                  'user_id' => 'required',
               

                ]);

             if($validator->fails()){

              return $this->sendError('Validation Error.', $validator->errors()); 
  
              }else{

                   $user_id=$request->user_id;

                   $user=DB::table('password_resets')->where('user_id',$user_id)->get();

                   $user_email=$user[0]->email;
                   $user_phone=$user[0]->email;


                    $string=$this->generateRandomString(4);

                     $updated_at=Carbon::now();

                    if($user_email !=''){


                       DB::table('password_resets')->where('user_id',$user_id)->update(['email'=>$user_email,'token'=>$string,'created_at'=>$updated_at,'user_id'=>$user_id]);


                         $meta['FROM_EMAIL']="ditest787@gmail.com";
                         $meta['email']= $user_email;
                         $meta['subject']="reset password mail";  
                         $meta['id']= $user_id;
                         $meta['token']=$string;

                         Mail::send('email.resetpassword', $meta, function($m) use($meta){
                    
                           $m->from($meta['FROM_EMAIL'],'reset password mail');
                           $m->to($meta['email']);
                           $m->subject($meta['subject']); 
                         });

                      $responseArray=[];
                      $responseArray['otp']=$string;
                      $responseArray['id']=$user_id;
                     
                    return $this->sendResponse($responseArray, 'OTP send on your email address');

                  }else{

                      $responseArray=[];

                      return $this->sendResponse($responseArray, 'phone not available!');

                    }


              }


       }catch (\Throwable $th) {

            return $this->sendError('Something went wrong, please try again later.');

        }

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

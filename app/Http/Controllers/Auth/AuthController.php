<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;
use Hash;
use DB;

use Carbon\Carbon;

class AuthController extends Controller
{
    

  public function login_registration(){

      $country=DB::table('countries')->get();

      $data['country']=$country;

      $count_id1=DB::table('countries')->where('name','India')->get();

      $data['country_id']=$count_id1[0]->id;

      return view('user_login_registration',$data);
    }

    public function storeuser(Request $request)
    {
       

        $validator=Validator::make($request->all(),[

            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'terms_condition' => 'accepted', 
            'phone_no' => 'required|size:10|unique:users',
          

        ]);

        if($validator->passes()) {

             $name=$request->input('name');
             $email=$request->input('email');
             $password=$request->input('password');
             $terms_condition=$request->input('terms_condition');
             $phone_no=$request->input('phone_no');

             $country_code="+91";

             $password1=Hash::make($password);


           $user = User::insert(['name'=>$name,'email'=>$email, 'password'=>$password1,'terms_condition'=>$terms_condition, 'phone_no'=>$phone_no, 'country_code'=>$country_code]);

            if($user){

              return response()->json(['success'=>'Added new records.']);
          }
      
        }else{

              return response()->json(['error'=>$validator->errors()]);

        }

     
    }


   /* public function login()
    {

        $loginpagedata=DB::table('loginpage')->get();
        $data['title']=$loginpagedata[0]->title;
          $data['image']=$loginpagedata[0]->image;
          $data['description']=$loginpagedata[0]->description;


      return view('login',$data);
    }*/

    public function authenticate(Request $request)
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
 

             if (Auth::attempt($credentials)) {

                    return response()->json(['status'=>1,
                                            'success'=>'Added new records.']);

                }else{


                      $user=User::where('email',$request->email)->orwhere('phone_no',$request->phone_no)->count();
                      
                   

                     if($user!=0){

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

    public function logout() {
      Auth::logout();

      return redirect('User/login_registration');
    }

 /*   public function Changepassword(){
         

       // $id = Auth::user()->id;
       // echo $id;
      return view('auth.Changepassword');
    }*/

  /*  public function creatnewpassword(Changepassword_request $request,$id){


        

        $password=$request->input('password');
        $confirmpassword=$request->input('confirmpassword');

          $data['password']=$password;
          $data['confirmpassword']=$confirmpassword;
        //  $id = Auth::user()->id;
         

          if ($password==$confirmpassword) {

              $this->userService->creatnewpassword($request,$id);
              
            //  $password1=Hash::make($password);
          //  user::where('id', $id)->update(['password'=>$password1]);

             return redirect('login')->with('error', 'your password has been changed!!!!');;
            
          }else {
                   
                       return redirect('Changepassword')->with('error', 'password is not matched!!!!');
                  // return redirect('Changepassword')->with('error', 'password and confirm passwords does not matched!!!!');
          }

    }
*/
    //////////////////////////// forgot password////////////////////////

     public function forget_password()
    {
  
      return view('forgetpassword');
    }
     public function send_resetpassword_url(Request $request){


         $error=$request->validate([

            'email' => 'required_without:phone_no',

            'phone_no' => 'required_without:email',


        ]);


           $email=$request->input('email');
           $phone_no=$request->input('phone_no');


          if($email !='' && $phone_no !=''){

             return redirect('User/forget_password')->with('error', 'please Enter only phone number OR Email address');

             }{

           $users=User::where('email', $email)->orWhere('phone_no',$phone_no)->count(); 

          if($users){

           $string=$this->generateRandomString(4);

           $created_at=Carbon::now();

           $user_data=User::where('email', $email)->orWhere('phone_no',$phone_no)->get();

           $user_id=$user_data[0]->id;

           if($email != ''){


            $checkalready=DB::table('password_resets')->where('user_id', $user_id)->count();

              if($checkalready){

                    DB::table('password_resets')->update(['email'=>$email,'token'=>$string,'created_at'=>$created_at,'user_id'=>$user_id]);
                }else{
                   
                      DB::table('password_resets')->insert(['email'=>$email,'token'=>$string,'created_at'=>$created_at,'user_id'=>$user_id]);

                }
                  
       
             $meta['FROM_EMAIL']="ditest787@gmail.com";
             $meta['email']= $email;
             $meta['subject']="reset password mail";  
             $meta['id']= $user_id;
             $meta['token']=$string;
           
  
             Mail::send('email.resetpassword', $meta, function($m) use($meta){
        
               $m->from($meta['FROM_EMAIL'],'reset password mail');
               $m->to($meta['email']);
               $m->subject($meta['subject']); 
             });

            

          return redirect('User/verify_otp_view/'.$user_id)->with('success', 'OTP send on your Email address !');

       }else{
 
           // $string=$this->generateRandomString(4);   // use when sms gateway integrate
    
                $string='1234';

                $checkalready=DB::table('password_resets')->where('user_id', $user_id)->count();

               if($checkalready){

                    DB::table('password_resets')->where('user_id', $user_id)->update(['phone_no'=>$phone_no,'country_code'=>'+91','token'=>$string,'created_at'=>$created_at,'user_id'=>$user_id]);
                 }else{

                    DB::table('password_resets')->insert(['phone_no'=>$phone_no,'country_code'=>'+91','token'=>$string,'created_at'=>$created_at,'user_id'=>$user_id]);
                 }
    
                 return redirect('User/verify_otp_view/'.$user_id)->with('success', 'OTP send on your Mobile Number !');             
             }

       } else{

        return redirect('User/forget_password')->with('error', 'User is not available, Please Complete your Registration !');
        
         }

        }

      }


       public function verify_otp_view($id){

            $data['id']=$id;

         return view('verify_otp_view',$data);

      }

      public function verify_otp(Request $request, $id){

          $error=$request->validate([

            'otp' => 'required|size:4',

           ]);


           $user=user::where('id',$id)->get();


           $reset_pwd_user=DB::table('password_resets')->where('user_id', $id)->get();


           $create_time=$reset_pwd_user[0]->created_at;

           $otp=$reset_pwd_user[0]->token;

           $expiry = Carbon::now()->subMinutes(10);

           if($create_time<=$expiry){

             return redirect('User/forget_password')->with('error', 'Your OTP has been expried, Please Try again !');     

           }else{

                $request_otp=$request->input('otp');

                  if($request_otp==$otp){

                   $reset_pwd_user=DB::table('password_resets')->where('user_id', $id)->delete();

                  return redirect('User/reset_password_view/'.$id);     

                }else{

                     return redirect('User/verify_otp_view/'.$id)->with('error', 'Your OTP is incorrect!');  
                }

           }       

      }

      public function reset_password_view($id){

            $data['id']=$id;

        return view('reset_password',$data);

     }

     public function reset_password(Request $request,$id){


        $error=$request->validate([
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);


        User::where('id',$id)->update(['password'=>Hash::make($request->password)]);

         return redirect('User/login_registration')->with('success','your password has been update sucessfully');

     
      }


    public function home()
    {
       // echo Auth::user();
      return view('home');
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


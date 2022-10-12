<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\support\facades\Auth;
use App\Models\Admin;
use Illuminate\support\MessageBag;
use Illuminate\Support\Facades\Mail;
use Illuminate\support\facades\Input;
use DB;
use Hash;


class Adminlogincontroller extends Controller
{

	 public function __construct(){

                $this->middleware('guest:admin')->except('logout');
        }

 
     public function index(){

      
       }


   
     public function login(){

      return view('admin.login');   //open login page
     }


    protected function guard(){

    	return Auth::guard('admin');

     }

    // where to redirect users afer login

    protected $redirectTo ='/admin/home';


    public function authenticate(Request $request){

          
         $error=$request->validate([
 
           'email' => 'required|email',
            'password' => 'required|string',
           
        ]);
        
        
    
      $remember=($request->input('remember')) ? true : false;
      $login_atempt=Auth::guard('admin')->attempt([

        'email'=>$request->input('email'),
        'password'=>$request->input('password')



      ],$remember);

     if ($login_atempt) {
     	
     	$request->session()->regenerate();

     	return Redirect::to('admin/home');

     }else{


         return redirect()->route('login')
        ->with('error','Your email or password are invalid.');

     	/*$errors=new MessageBag(['password'=>['Email and / or password invalid.']]);

     	return Redirect::back()->withError($errors);*/
     }

    } 

     


    public function logout(){

         Auth::guard('admin')->logout();

         return redirect('admin/login');
      }


    public function forgetpasswordview(){

        return view('admin.forgetpassword'); 
    }


  public function resetpasswordlink(Request $request)
    {

          $error=$request->validate([

           'email' => 'required|email',
           
        ]);
        
        $admin= DB::table('admins')->where('email', $request->email)->count();
     
             
       if($admin){
         
        /*   $string=$this->generateRandomString(4);
           DB::table('admins')->where('email', $request->email)->update(['token'=>$string]);*/
         
            $adminid= DB::table('admins')->where('email',$request->email)->get();
            $id=$adminid[0]->id;

            $img_url =env('APP_URL')."/image/logo.png";

             
             $meta['FROM_EMAIL']="ditest787@gmail.com";
             $meta['email']=$request->email;
             $meta['subject']="reset password mail";  
             $meta['id']=$id;
      
             $meta['img_url']=$img_url;
      
           Mail::send('email.resetpasswordurl', $meta, function($m) use($meta){
        
               $m->from($meta['FROM_EMAIL'],'reset password mail');
               $m->to($meta['email']);
               $m->subject($meta['subject']); 
                });
    
         return redirect('admin/login')->with('success','your reset password url  send on your email address' );

       } else{
      
         return redirect('admin/forgetpasswordview')->with('error','Enter the valid email address' );
          }
   
     }

    public function resetpasswordview($id){

             $data['id']=$id;
   
            return view('admin.resetpassword',$data);
   }

   public function resetpassword(Request $request,$id){

         $error= $request->validate([
        
            'password' => 'required|string|min:6',
          'confirm_password' => 'required|same:password',
           
        ]);

         DB::table('admins')->where('id',$id)->update(['password'=>Hash::make($request->password)]);

           return redirect('admin/login')->with('success','your password has been update sucessfully');

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

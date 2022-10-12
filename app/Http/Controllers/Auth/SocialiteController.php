<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Models\User;

class SocialiteController extends Controller
{
   
   public function redirectToGoogle(){

        return Socialite::driver('google')->redirect();

    }

   public function handleCallback()
      {
        try {


     
            $user = Socialite::driver('google')->user();

      
            $finduser = User::where('social_id', $user->id)->first();
      
            if($finduser){
      
                Auth::login($finduser);
     
                return redirect('/home');
      
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id'=> $user->id,
                    'social_type'=> 'google',
                    'password' => encrypt('my-google')
                ]);
     
                Auth::login($newUser);
      
                return redirecthom('/');
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}

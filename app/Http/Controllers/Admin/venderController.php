<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Admin;
use Auth;
use DB;
use Mail;

class venderController extends Controller
{
          public function __construct(){

                $this->middleware('auth:admin');
        }

        public function venderlist(){

          $id=Auth::id();
          $admin=Admin::where('id',$id)->get();
          $data['name']=$admin[0]->name;

          $vender=Vendor::orderBy('id','desc')->paginate(10);
          $data['vender']=$vender;

          

          $vendor_product=DB::table('vendor_product')->get();

          $data['product']=$vendor_product;

            return view('admin.vender_list',$data);
         }


          public function verify_account($id){

             $vendor= vendor::where('id', $id)->get();
             
             $email=$vendor[0]->email;

             $vendor= vendor::where('id', $id)->update(['verified'=>1]);


             $meta['FROM_EMAIL']="ditest787@gmail.com";
             $meta['email']=$email;
             $meta['subject']="Account has been verified";  
                      
             Mail::send('email.verified', $meta, function($m) use($meta){
        
               $m->from($meta['FROM_EMAIL'],'Account has been verified');
               $m->to($meta['email']);
               $m->subject($meta['subject']); 
             });

       

           return response()->json([
            'success' => 'Record has been deleted successfully!'
           ]);


        }

}

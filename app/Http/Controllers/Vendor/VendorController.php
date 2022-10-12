<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{

     public function __construct(){

                $this->middleware('vendorauth');
        }


   
       public function vendor_home(){

        
       /* $vendor=Auth::guard('vendor')->user();

       
         $data['vendor']=$vendor;

         $data['site_url']= env('APP_URl');
         $data['metatitle']='home page';

         $id=Auth::id();
         $vendor=vendor::where('id',$id)->get();

         $data['name']=$vendor[0]->name;
*/

         return view('vendor.vendor_home');


        }

       
}

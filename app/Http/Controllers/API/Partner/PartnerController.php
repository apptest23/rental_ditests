<?php

namespace App\Http\Controllers\API\Partner;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\vendor;
use Hash;
use Auth;
use Illuminate\Support\Facades\Validator;

class PartnerController extends BaseController
{
      /* public function __construct(){

                $this->middleware('vendorauth');
        }
*/
       public function logout(){     

        $vendor=Auth::guard('vendor')->user();     

        $responseArray['partner']=$vendor;

        /* $responseArray= [
                 
           'message'=>'logout successfully ',
                
         ];
*/
          return response()->json($responseArray,200);


   }
   
      public function Changepassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            
            'partner_id' => 'required',
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
          
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $partner_id=$request->partner_id;

  
        $partner=vendor::where('id',$partner_id)->get();

          $password=$partner[0]->password;

               $oldpassword=$request->oldpassword;
               $newpassword=$request->newpassword;   

              if(Hash::check($oldpassword,$password)){

                 vendor::where('id', $partner_id)->update(['password'=>Hash::make($newpassword)]);

                 $responseArray=[];
                 $responseArray['status']=1;
             
                 $responseArray['partner_id']=$partner_id;

                 $responseArray['message']='Password Changed successfully !';

                return $this->sendResponse($responseArray,'Password Changed successfully !');
               

               }else{

                 $responseArray=[];

                 $responseArray['status']=0;
             
                 $responseArray['partner_id']=$partner_id;

                 $responseArray['message']='Your Old password is not correct !';

                return $this->sendResponse($responseArray,'Your Old password is not correct !');


            }
       
       }

      public function edit_profile(Request $request){


        /*  try {*/

                $validator = Validator::make($request->all(), [
                    
                    'partner_id' => 'required',
                    'name' => 'required',
                    'email' => 'required',
                    'phone_no' => 'required',
                    'address' => 'required',
                           
                  ]);


                  if($validator->fails()){

                     return $this->sendError('Validation Error.', $validator->errors());  

                   }

                   $partner_id=$request->partner_id;
                   $name=$request->name;
                   $email=$request->email;
                   $phone_no=$request->phone_no;
                   $address=$request->address;

                   $file=$request->image;

                    $imagename='';

                     $partner_data=vendor::where('id', $partner_id)->get();

                     $old_image=$partner_data[0]->image;


                    if($file){

                         if($old_image!=''){

                            unlink(public_path("/uploads/".$old_image));  
                         }


                       $destinationPath='uploads';
                       $imagename=time().'_'.$file->getClientOriginalName();
                    
                       $file->move($destinationPath,$imagename);

                       vendor::where('id', $partner_id)->update(['image'=>$imagename]);
                      
                     }


                vendor::where('id', $partner_id)->update(['name'=>$name,'email'=>$email,'phone_no'=>$phone_no,'address'=>$address]);

                 $partner_data=vendor::where('id', $partner_id)->get();
/*
                 $responseArray=[];

                 $responseArray['partner_data']=$partner_data;

                 $responseArray['message']='Profile data updated successfully !';*/

                 return $this->sendResponse($partner_data, 'Profile data updated successfully !');
                
                 /*}catch(\Throwable $th){

                   return $this->sendError('something went wrong.!!! please try again later.');

                }*/


             }



         public function get_partner_detail(Request $request){

        

              $validator = Validator::make($request->all(), [
                    
                    'partner_id' => 'required',
                
                           
                  ]);

              if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());

           }

           $partner_id=$request->partner_id;


             $vendor_detail=vendor::where('id', $partner_id)->with(['vendor_product'])->get();

                 $responseArray=[];
                 $responseArray['partner_id']=$partner_id;
             
                 $responseArray['vendor_detail']=$vendor_detail;

           

                return $this->sendResponse($responseArray,'Vendor details !');




       }





}

<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Validator;

class UserController extends BaseController
{
       /**
     * Change password
     *
     * @return \Illuminate\Http\Response
     */
    public function Changepassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            
            'user_id' => 'required',
            'oldpassword' => 'required',
            'newpassword' => 'required',
          
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user_id=$request->user_id;

  
        $user=User::where('id',$user_id)->get();

          $password=$user[0]->password;

               $oldpassword=$request->oldpassword;
               $newpassword=$request->newpassword;   

              if(Hash::check($oldpassword,$password)){

                 User::where('id', $user_id)->update(['password'=>Hash::make($newpassword)]);

                 $responseArray=[];
                 $responseArray['status']=1;
             
                 $responseArray['user_id']=$user_id;

                 $responseArray['message']='Password Changed successfully !';

                return $this->sendResponse($responseArray,'Password Changed successfully !');
               

               }else{

                 $responseArray=[];

                 $responseArray['status']=0;
             
                 $responseArray['user_id']=$user_id;

                 $responseArray['message']='Your Old password is not correct !';

                return $this->sendResponse($responseArray,'Your Old password is not correct !');


            }
       
       }
       
           public function edit_profile(Request $request){



        /*  try {*/

                $validator = Validator::make($request->all(), [
                    
                    'user_id' => 'required',
                    'name' => 'required',
                    'email' => 'required',
                    'phone_no' => 'required',
                           
                  ]);


                  if($validator->fails()){

                     return $this->sendError('Validation Error.', $validator->errors());  

                   }

                   $user_id=$request->user_id;
                   $name=$request->name;
                   $email=$request->email;
                   $phone_no=$request->phone_no;

                   $file=$request->image;

                    $imagename='';

                     $user_data=User::where('id', $user_id)->get();

                     $old_image=$user_data[0]->image;


                    if($file){

                         if($old_image!=''){

                            unlink(public_path("/uploads/".$old_image));  
                         }


                       $destinationPath='uploads';
                       $imagename=time().'_'.$file->getClientOriginalName();
                    
                       $file->move($destinationPath,$imagename);

                       User::where('id', $user_id)->update(['image'=>$imagename]);
                      
                     }


                User::where('id', $user_id)->update(['name'=>$name,'email'=>$email,'phone_no'=>$phone_no]);

                 $user_data=User::where('id', $user_id)->get();

                 $responseArray=[];

                 $responseArray['user_data']=$user_data;

                 $responseArray['message']='User data updated successfully !';

                 return $this->sendResponse($responseArray, 'User data updated successfully !');
                

               /*  }catch(\Throwable $th){

                   return $this->sendError('something went wrong.!!! please try again later.');

                }
*/

             }

}

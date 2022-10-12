<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Carbon\carbon;
use DB;
use Hash;
use \Crypt;
use Auth;
use Illuminate\support\facades\Redirect;
use Illuminate\support\facades\validator;

class HomeController extends Controller
{

	  public function __construct(){

                $this->middleware('auth:admin');
        }

        public function home_banner(){

          $id=Auth::id();
          $admin=Admin::where('id',$id)->get();
          $data['name']=$admin[0]->name;

          $banner=DB::table('banner')->paginate(3);
          $data['banner']=$banner;

          $more_maintitle=DB::table('more_maintitle')->get();
          $data['more_maintitle']=$more_maintitle;

            return view('admin.homepagebanner',$data);
         }


          public function add_home_banner(){

          	   $id=Auth::id();
               $admin=Admin::where('id',$id)->get();
               $data['name']=$admin[0]->name;

           return view('admin.add_home_banner',$data);
 
         }

        public function store_home_banner(Request $request){

            $error=$request->validate([

              'title' => 'required',
              'image' => 'required',
               
            ]);
       
                $title=$request->input('title'); 
                $file=$request->file('image');
                $maintitle=$request->input('short_description');
                $maintitles=$request->input('short_descriptions');

                 $imagename='';
        
           if ($file){
          
               $destinationPath='uploads';
               $imagename=time().'_'.$file->getClientOriginalName();
               $file->move($destinationPath,$imagename);
       
              }

            DB::table('banner')->insert(['title'=>$title ,'image'=>$imagename]);

            $last_id = DB::table('banner')->max('id'); 

            $maintitle=$request->input('short_description');

            if($maintitle!=""){

              DB::table('more_maintitle')->insert(['more_maintitle'=>$maintitle,'banner_id'=>$last_id]);

              }

           $maintitles=$request->input('short_descriptions');

            if($maintitles!=null){
            
              for($i=0; $i<count($maintitles); $i++){

                   $maintitles_info=$maintitles[$i];

                   if($maintitles_info!=""){

                   DB::table('more_maintitle')->insert(['more_maintitle'=>$maintitles_info,'banner_id'=>$last_id]);
                }
  
              }
           }
           return redirect('admin/home_banner')->with('error',' update banner data succcesfully!!!!');

         }

         public function update_home_banner($id){


                 $id1=Auth::id();
                 $admin=Admin::where('id',$id1)->get();
                 $data['name']=$admin[0]->name;

                 $banner= DB::table('banner')->where('id', $id)->get();
    
                 $data['id']=$banner[0]->id;
                 $data['title']=$banner[0]->title;
                 $data['image']=$banner[0]->image;

                 $more_maintitle=DB::table('more_maintitle')->where('banner_id', $id)->get();
                 $data['more_maintitle']=$more_maintitle;
   
           return view('admin.update_home_banner',$data);

        }

       public function deletemaintitle($id){

          DB::table('more_maintitle')->where('id',$id)->delete();

         return response()->json(['success'=>'maintitle data deleted successfully!!!',]);

        }    

       public function store_update_home_banner(Request $request ,$id){

           $request->validate([

             'title' => 'required',
               
           ]);
       
           $title=$request->input('title');
           $file=$request->file('image');

           $maintitle=$request->input('short_description');
           $maintitles=$request->input('short_descriptions') ;
  
           $imagename='';

            if($file){
         
               $destinationPath='uploads';
               $imagename=time().'_'.$file->getClientOriginalName();
               $file->move($destinationPath,$imagename);

               DB::table('banner')->where('id', $id)->update(['image'=>$imagename]);

              if($request->input('oldimage')!='') {

                    unlink(public_path("/uploads/".$request->input('oldimage')));  
                 }
              }

            DB::table('banner')->where('id', $id)->update(['title'=>$title ]);

           if($maintitle!=''){
   
              DB::table('more_maintitle')->insert(['more_maintitle'=>$maintitle,'banner_id'=>$id]);

             }

            if($maintitles!=null){
            
              for($i=0; $i<count($maintitles); $i++){

                    $maintitles_info=$maintitles[$i];

                   DB::table('more_maintitle')->insert(['more_maintitle'=>$maintitles_info,'banner_id'=>$id]);
  
                }
            }

           return redirect('admin/home_banner')->with('error',' update banner data succcesfully!!!!');
 
          }

       public function delete_home_banner($id){

           $banner= DB::table('banner')->where('id', $id)->get();

           if($banner[0]->image!='') {

               unlink(public_path("/uploads/".$banner[0]->image));

               }

           DB::table('banner')->where('id', $id)->delete();

           DB::table('more_maintitle')->where('banner_id', $id)->delete();

           return response()->json([
            'success' => 'Record has been deleted successfully!'
           ]);

        }

       


       /*********************  Delete  selected all banner ************************/

           public function  delete_all_home_banner(Request $request){

                $ids = $request->ids;
                foreach($ids as $id){

                 DB::table('banner')->where('id',$id)->delete();

                  DB::table('more_maintitle')->where('banner_id', $id)->delete();

                }
  
                return response()->json(['status'=>200]);


               }










}

<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\User\Auth\AuthController;
use App\Http\Controllers\API\User\UserController;
use App\Http\Controllers\API\User\ProductController;
use App\Http\Controllers\API\Partner\Auth\PartnerloginController;
use App\Http\Controllers\API\Partner\PartnerController;
use App\Http\Controllers\API\Partner\ProductdataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/



     Route::get('/getCategory',[ProductController::class,'getCategory']);
     Route::post('/getSubCategory',[ProductController::class,'getSubCategory']);
     Route::post('/Category/SubCategory/Product',[ProductController::class,'getProductbySubcategory']);
     Route::post('/Category/Product',[ProductController::class,'getProductbyCategory']);
     Route::post('/product_detail',[ProductController::class,'getproduct_detail']);
     Route::post('/get_total_days',[ProductController::class,'get_total_days']);
    
     Route::get('/get_product',[ProductController::class,'get_product']);
     Route::get('/getCategoryProduct',[ProductController::class,'getCategoryProduct']);
     Route::get('/getTrandingProduct',[ProductController::class,'getTrandingProduct']);
     Route::post('/search_product',[ProductController::class,'search_product']);
     Route::post('/getSubCategoryproduct',[ProductController::class,'getSearchProduct']);
     Route::post('/get_partner_detail',[PartnerController::class,'get_partner_detail']);




   Route::group(['prefix' => 'User'], function () {

     Route::post('/register',[AuthController::class,'register']);
     Route::post('/login',[AuthController::class,'login']);
     Route::post('/forget_password',[AuthController::class,'forget_password']);
     Route::post('/verify_otp',[AuthController::class,'verify_otp']);
     Route::post('/resetPassword', [AuthController::class, 'resetPassword']);
     Route::post('/resend_otp',[AuthController::class,'resend_otp']); 

  });
  
   Route::group(['prefix' => 'User', 'middleware' => ['auth:sanctum']], function () {

      Route::post('/logout',[AuthController::class,'logout']);
      Route::post('/Changepassword',[UserController::class,'Changepassword']);
      Route::post('/edit_profile',[UserController::class,'edit_profile']);

   });





     Route::group(['prefix' => 'Partner'], function () {

     Route::post('/register',[PartnerloginController::class,'register']);
     Route::post('/login',[PartnerloginController::class,'login']);
     Route::post('/forget_password',[PartnerloginController::class,'forget_password']);
     Route::post('/verify_otp',[PartnerloginController::class,'verify_otp']);
     Route::post('/resetPassword', [PartnerloginController::class, 'resetPassword']);

  });

      Route::group(['prefix' => 'Partner', 'middleware' => ['auth:sanctum']], function () {
      Route::post('/Changepassword',[PartnerController::class,'Changepassword']);
      Route::post('/edit_profile',[PartnerController::class,'edit_profile']);
      
        Route::get('/getCategorylist',[ProductdataController::class,'getCategorylist']);
        Route::post('/addproduct',[ProductdataController::class,'addproduct']);
        Route::post('/getProductlist',[ProductdataController::class,'getProductlist']);
        
        Route::post('/delete_product',[ProductdataController::class,'delete_product']);
        Route::post('/viewproductdetail',[ProductdataController::class,'viewproductdetail']);
        Route::post('/delete_multiple_product',[ProductdataController::class,'delete_multiple_product']);
        
        
     Route::post('/delete_product_image',[ProductdataController::class,'delete_product_image']);
     Route::post('/edit_product',[ProductdataController::class,'edit_product']);
      Route::post('/get_item',[ProductdataController::class,'get_item']);
      Route::post('/get_single_productdata',[ProductdataController::class,'get_single_productdata']);
     Route::get('/get_size',[ProductdataController::class,'get_size']);

        
      Route::post('/logout',[PartnerloginController::class,'logout']);

   });



 
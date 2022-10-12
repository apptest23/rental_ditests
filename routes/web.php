<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Admincontroller;
use App\Http\Controllers\Auth\Adminlogincontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VendorloginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Vandor\VendorController;
use App\Http\Controllers\Admin\venderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\Vendor\Vendor_Productcontroller;
use App\Http\Controllers\Auth\SocialiteController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[UserController::class, 'index']);
Route::get('/all_category',[UserController::class, 'all_category']);
Route::get('/product/{id}',[UserController::class, 'product']);
Route::get('/product_detail/{id}',[UserController::class, 'product_detail']);
Route::get('/category_product/{id}',[UserController::class, 'category_product']);
Route::get('/tranding_product',[UserController::class, 'tranding_product']);
Route::get('/search',[UserController::class, 'search']);
Route::get('/search_product/{id}',[UserController::class, 'search_product']);

Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialiteController::class, 'handleCallback']);

Route::get('/privacy_policy', [UserController::class, 'privacy_policy']);
Route::get('/terms_condition', [UserController::class, 'terms_condition']);
Route::get('/partner_profile/{id}', [UserController::class, 'partner_profile']);





Route::prefix('User')->group(function(){
Route::get('/login_registration',[AuthController::class, 'login_registration'])->name('User_login');
Route::post('/storeuser',[AuthController::class, 'storeuser'])->name('register');;
Route::post('/authenticate',[AuthController::class, 'authenticate']);
Route::get('/forget_password',[AuthController::class, 'forget_password']);
Route::post('/send_resetpassword_url',[AuthController::class, 'send_resetpassword_url']);

Route::post('/call_vendor',[UserController::class, 'call_vendor'])->middleware('auth');
Route::post('/store_beg_item',[UserController::class, 'store_beg_item'])->middleware('auth');
Route::get('/profile',[UserController::class, 'profile']);
Route::post('/update_profile',[UserController::class, 'update_profile']);

Route::get('/beg_item',[UserController::class, 'beg_item']);
Route::post('/minus_qty',[UserController::class, 'minus_qty']);



Route::get('/change_password',[UserController::class, 'change_password']);

Route::post('/update_password',[UserController::class, 'update_password']);


Route::get('/verify_otp_view/{id}',[AuthController::class, 'verify_otp_view']);
Route::post('/verify_otp/{id}',[AuthController::class, 'verify_otp']);

Route::get('/reset_password_view/{id}',[AuthController::class, 'reset_password_view']);
Route::post('/reset_password/{id}',[AuthController::class, 'reset_password']);
Route::get('/logout',[AuthController::class, 'logout']);

});

Route::prefix('Partner')->group(function(){

Route::get('/registration',[VendorloginController::class, 'registration']);
Route::get('/vendor_home',[PartnerController::class, 'vendor_home']);
Route::post('/store_vendor',[VendorloginController::class, 'store_vendor'])->name('Partner_registration');
Route::post('/Partner_authenticate',[VendorloginController::class, 'Partner_authenticate'])->name('login_authenticate');

Route::get('/Vendor_forgetpassword',[VendorloginController::class, 'Vendor_forgetpassword']);
Route::post('/Vendor_send_otp',[VendorloginController::class, 'Vendor_send_otp']);


Route::get('/vendor_verify_otp_view/{id}',[VendorloginController::class, 'vendor_verify_otp_view']);


Route::post('/Vendor_verify_otp/{id}',[VendorloginController::class, 'Vendor_verify_otp']);

Route::get('/Vendor_resetpassword/{id}',[VendorloginController::class, 'Vendor_resetpassword']);
Route::post('/Vendor_updatepassword/{id}',[VendorloginController::class, 'Vendor_updatepassword']);


Route::get('/get_product_subcategory/{id}',[Vendor_Productcontroller::class, 'get_product_subcategory']);

Route::get('/vender_product',[Vendor_Productcontroller::class, 'vender_product']);
Route::post('/store_vender_product',[Vendor_Productcontroller::class, 'store_vender_product']);
Route::get('/vendor_logout',[VendorloginController::class, 'vendor_logout']);
Route::get('/add_vender_product',[Vendor_Productcontroller::class, 'add_vender_product']);
Route::get('/view_product_detail/{id}',[Vendor_Productcontroller::class, 'view_product_detail']);
Route::get('/update_vendor_product/{id}',[Vendor_Productcontroller::class, 'update_vendor_product']);
Route::post('/store_update_vendor_product/{id}',[Vendor_Productcontroller::class, 'store_update_vendor_product']);

Route::get('/get_cloth_item/{id}',[Vendor_Productcontroller::class,'get_cloth_item']);

Route::get('/delete_vendor_product/{id}',[Vendor_Productcontroller::class, 'delete_vendor_product']);
Route::get('/delete_vendor_product_image/{id}',[Vendor_Productcontroller::class, 'delete_vendor_product_image']);
Route::get('/update_vendor_product_image/{id}',[Vendor_Productcontroller::class, 'update_vendor_product_image']);
Route::post('/store_update_vendor_product_image/{id}',[Vendor_Productcontroller::class, 'store_update_vendor_product_image']);

Route::post('/delete_all_vendor_product',[Vendor_Productcontroller::class, 'delete_all_vendor_product']);

Route::get('/update_status/{id}',[Vendor_Productcontroller::class,'update_status']);
Route::post('/update_status_1/{id}',[Vendor_Productcontroller::class,'update_status_1']);


Route::get('/search_vendor_product',[Vendor_Productcontroller::class, 'search_vendor_product']);

Route::get('/profile',[PartnerController::class, 'profile']);
Route::post('/edit_profile',[PartnerController::class, 'edit_profile']);

Route::get('/changepassword',[PartnerController::class, 'changepassword']);
Route::post('/updatepassword',[PartnerController::class, 'updatepassword']);



});







Route::prefix('admin')->group(function(){

Route::get('/login',[Adminlogincontroller::class, 'login']);
Route::post('/login',[Adminlogincontroller::class, 'authenticate'])->name('login');
Route::get('/logout',[Adminlogincontroller::class, 'logout'])->name('adminlogout');

Route::get('/forgetpasswordview',[Adminlogincontroller::class, 'forgetpasswordview'])->name('forgetpasswordview');
Route::post('/resetpasswordlink',[Adminlogincontroller::class, 'resetpasswordlink'])->name('resetpasswordlink');

Route::get('/resetpasswordview/{id}',[Adminlogincontroller::class, 'resetpasswordview'])->name('resetpasswordview');
Route::post('/resetpassword/{id}',[Adminlogincontroller::class, 'resetpassword'])->name('resetpassword');

Route::get('/changepassword',[Admincontroller::class, 'changepassword']);
Route::post('/updatepassword/{id}',[Admincontroller::class, 'updatepassword']);

Route::get('/home',[Admincontroller::class, 'home']);


Route::get('/category',[Admincontroller::class, 'category']);
Route::get('/add_category',[Admincontroller::class, 'add_category']);
Route::post('/store_category',[Admincontroller::class, 'store_category']);
Route::get('/update_category/{id}',[Admincontroller::class, 'update_category']);
Route::post('/store_update_category/{id}',[Admincontroller::class, 'store_update_category']);
Route::get('/delete_category/{id}',[Admincontroller::class, 'delete_category']);
Route::post('/delete_all_category',[Admincontroller::class, 'delete_all_category']);


Route::get('/subcategory',[Admincontroller::class, 'subcategory']);
Route::get('/add_subcategory',[Admincontroller::class, 'add_subcategory']);
Route::post('/store_subcategory',[Admincontroller::class, 'store_subcategory']);
Route::get('/update_subcategory/{id}',[Admincontroller::class, 'update_subcategory']);
Route::post('/store_update_subcategory/{id}',[Admincontroller::class, 'store_update_subcategory']);
Route::get('/delete_subcategory/{id}',[Admincontroller::class, 'delete_subcategory']);
Route::post('/delete_all_subcategory',[Admincontroller::class, 'delete_all_subcategory']);


Route::get('/home_banner',[HomeController::class, 'home_banner']);
Route::get('/add_home_banner',[HomeController::class, 'add_home_banner']);
Route::post('/store_home_banner',[HomeController::class, 'store_home_banner']);
Route::get('/update_home_banner/{id}',[HomeController::class, 'update_home_banner']);
Route::post('/store_update_home_banner/{id}',[HomeController::class, 'store_update_home_banner']);
Route::get('/delete_home_banner/{id}',[HomeController::class, 'delete_home_banner']);
Route::get('/deletemaintitle/{id}',[HomeController::class,'deletemaintitle']);
Route::post('/delete_all_home_banner',[HomeController::class, 'delete_all_home_banner']);



Route::get('/adminprofile',[Admincontroller::class, 'adminprofile']);
Route::get('/update_adminprofile/{id}',[Admincontroller::class, 'update_adminprofile']);
Route::post('/store_update_adminprofile/{id}',[Admincontroller::class, 'store_update_adminprofile']);
Route::get('/delete_mobileno/{id}',[Admincontroller::class, 'delete_mobileno']);

Route::get('/venderlist',[venderController::class, 'venderlist']);
Route::get('/verify_account/{id}',[venderController::class, 'verify_account']);

Route::get('/product',[ProductController::class, 'productlist']);
Route::get('/add_product',[ProductController::class, 'add_product']);
Route::post('/store_product',[ProductController::class, 'store_product']);
Route::get('/update_product/{id}',[ProductController::class, 'update_product']);
Route::post('/store_update_product/{id}',[ProductController::class, 'store_update_product']);
Route::get('/delete_product/{id}',[ProductController::class, 'delete_product']);
Route::get('/delete_product_image/{id}',[ProductController::class, 'delete_product_image']);
Route::get('/update_product_image/{id}',[ProductController::class, 'update_product_image']);
Route::post('/store_update_product_image/{id}',[ProductController::class, 'store_update_product_image']);

Route::post('/delete_all_product',[ProductController::class, 'delete_all_product']);

Route::get('/view_product/{id}',[ProductController::class, 'view_product']);

Route::get('/getsubcategory/{id}',[ProductController::class, 'getsubcategory']);
Route::get('/get_item/{id}',[ProductController::class,'get_item']);


Route::get('/search_product',[ProductController::class, 'search_product']);







 }); 


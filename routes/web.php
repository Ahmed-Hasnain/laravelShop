<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeBannerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\productReviews;



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

//Frontend Routes
Route::get('/',[FrontEndController::class,'index']);
Route::get('product/{slug}',[FrontEndController::class,'product']);
Route::get('category/{slug}',[FrontEndController::class,'category']);
Route::post('add_to_cart',[FrontEndController::class,'add_to_cart']);
Route::get('cart',[FrontEndController::class,'cart']);
Route::get('search/{str}',[FrontEndController::class,'search']);
Route::get('registration',[FrontEndController::class,'registration']);
Route::post('registration_process',[FrontEndController::class,'registration_process'])->name('registration.registration_process');
Route::post('login_process',[FrontEndController::class,'login_process'])->name('login.login_process');
Route::get('logout', function () {
		session()->forget('FRONT_USER_LOGIN');
        session()->forget('FRONT_USER_ID');
        session()->forget('FRONT_USER_NAME');
        session()->forget('USER_TEMP_ID');
        session()->flash('error','Logout Successful');
        return redirect('/');
	});
Route::get('/verification/{id}',[FrontEndController::class,'email_verification']);
Route::post('forgot_password',[FrontEndController::class,'forgot_password']);
Route::get('/password_change/{id}',[FrontEndController::class,'password_change']);
Route::post('forgot_password_change_process',[FrontEndController::class,'forgot_password_change_process']);
Route::get('/checkout',[FrontEndController::class,'checkout']);
Route::post('apply_coupon_code',[FrontEndController::class,'apply_coupon_code']);
Route::post('remove_coupon',[FrontEndController::class,'remove_coupon']);
Route::post('place_order',[FrontEndController::class,'place_order']);
Route::get('/order_placed',[FrontEndController::class,'order_placed']);
Route::post('/product_review_process',[FrontEndController::class,'product_review_process']);
   //User Middleware
Route::group(['middleware'=>'user_auth'],function()
{
	Route::get('/order',[FrontEndController::class,'order']);
	Route::get('/order_detail/{id}',[FrontEndController::class,'order_detail']);

});



//Backend Routes
Route::get('admin',[AdminController::class,'index']);
Route::post('admin/auth',[AdminController::class,'auth']);

Route::group(['middleware'=>'admin_auth'],function()
{
	Route::get('admin/dashboard',[AdminController::class,'dashboard']);

	// Category Routes starts

	Route::get('admin/category',[CategoryController::class,'index']);
	Route::get('admin/category/manage_category',[CategoryController::class,'manage_category']);
	Route::get('admin/category/manage_category/{id}',[CategoryController::class,'manage_category']);
	Route::get('admin/category/delete/{id}',[CategoryController::class,'delete']);
	Route::post('admin/category/manage_category_process',[CategoryController::class,'manage_category_process'])->name('category.manage_category_process');
	Route::get('admin/category/status/{status}/{id}',[CategoryController::class,'status']);

	// category Routes ends

	// Coupon Routes starts

	Route::get('admin/coupon',[CouponController::class,'index']);
	Route::get('admin/coupon/manage_coupon',[CouponController::class,'manage_coupon']);
	Route::get('admin/coupon/manage_coupon/{id}',[CouponController::class,'manage_coupon']);
	Route::get('admin/coupon/delete/{id}',[CouponController::class,'delete']);
	Route::post('admin/coupon/manage_coupon_process',[CouponController::class,'manage_coupon_process'])->name('coupon.manage_coupon_process');
	Route::get('admin/coupon/status/{status}/{id}',[CouponController::class,'status']);

	// Coupon Routes ends


	// Size Routes starts

	Route::get('admin/size',[SizeController::class,'index']);
	Route::get('admin/size/manage_size',[SizeController::class,'manage_size']);
	Route::get('admin/size/manage_size/{id}',[SizeController::class,'manage_size']);
	Route::get('admin/size/delete/{id}',[SizeController::class,'delete']);
	Route::post('admin/size/manage_size_process',[SizeController::class,'manage_size_process'])->name('size.manage_size_process');
	Route::get('admin/size/status/{status}/{id}',[SizeController::class,'status']);

	// Size Routes ends

	// Color Routes starts

	Route::get('admin/color',[ColorController::class,'index']);
	Route::get('admin/color/manage_color',[ColorController::class,'manage_color']);
	Route::get('admin/color/manage_color/{id}',[ColorController::class,'manage_color']);
	Route::get('admin/color/delete/{id}',[ColorController::class,'delete']);
	Route::post('admin/color/manage_color_process',[ColorController::class,'manage_color_process'])->name('color.manage_color_process');
	Route::get('admin/color/status/{status}/{id}',[ColorController::class,'status']);

	// color Routes ends

	// Brand Routes starts

	Route::get('admin/brand',[BrandController::class,'index']);
	Route::get('admin/brand/manage_brand',[BrandController::class,'manage_brand']);
	Route::get('admin/brand/manage_brand/{id}',[BrandController::class,'manage_brand']);
	Route::get('admin/brand/delete/{id}',[BrandController::class,'delete']);
	Route::post('admin/brand/manage_brand_process',[BrandController::class,'manage_brand_process'])->name('brand.manage_brand_process');
	Route::get('admin/brand/status/{status}/{id}',[BrandController::class,'status']);

	// Brand Routes ends


	// Product Routes starts

	Route::get('admin/product',[ProductController::class,'index']);
	Route::get('admin/product/manage_product',[ProductController::class,'manage_product']);
	Route::get('admin/product/manage_product/{id}',[ProductController::class,'manage_product']);
	Route::get('admin/product/delete/{id}',[ProductController::class,'delete']);
	Route::get('admin/product/product_attr_delete/{paid}/{pid}',[ProductController::class,'product_attr_delete']);
	Route::get('admin/product/product_images_delete/{piid}/{pid}',[ProductController::class,'product_images_delete']);
	Route::post('admin/product/manage_product_process',[ProductController::class,'manage_product_process'])->name('product.manage_product_process');
	Route::get('admin/product/status/{status}/{id}',[ProductController::class,'status']);

	// Product Routes ends

	// Tax Routes starts

	Route::get('admin/tax',[TaxController::class,'index']);
	Route::get('admin/tax/manage_tax',[TaxController::class,'manage_tax']);
	Route::get('admin/tax/manage_tax/{id}',[TaxController::class,'manage_tax']);
	Route::get('admin/tax/delete/{id}',[TaxController::class,'delete']);
	Route::post('admin/tax/manage_tax_process',[TaxController::class,'manage_tax_process'])->name('tax.manage_tax_process');
	Route::get('admin/tax/status/{status}/{id}',[TaxController::class,'status']);

	// Tax Routes ends

	// Customer Routes starts

	Route::get('admin/customer',[CustomerController::class,'index']);
	Route::get('admin/customer/show/{id}',[CustomerController::class,'show']);
	Route::get('admin/customer/status/{status}/{id}',[CustomerController::class,'status']);

	// Customer Routes ends


	// Home banner Routes starts

	Route::get('admin/home_banner',[HomeBannerController::class,'index']);
	Route::get('admin/home_banner/manage_home_banner',[HomeBannerController::class,'manage_home_banner']);
	Route::get('admin/home_banner/manage_home_banner/{id}',[HomeBannerController::class,'manage_home_banner']);
	Route::get('admin/home_banner/delete/{id}',[HomeBannerController::class,'delete']);
	Route::post('admin/home_banner/manage_home_banner_process',[HomeBannerController::class,'manage_home_banner_process'])->name('home_banner.manage_home_banner_process');
	Route::get('admin/home_banner/status/{status}/{id}',[HomeBannerController::class,'status']);

	// Home banner Routes ends


	// Order Routes start
	Route::get('admin/order',[OrderController::class,'index']);
	Route::get('admin/order_detail/{id}',[OrderController::class,'order_detail']);
	Route::get('/admin/update_payment_status/{status}/{id}',[OrderController::class,'update_payment_status']);
	Route::get('/admin/update_order_status/{status}/{id}',[OrderController::class,'update_order_status']);
	Route::post('/admin/order_detail/{id}',[OrderController::class,'update_track_status']);
	// Order Routes Ends


	// Product reviews starts
	Route::get('admin/product_reviews',[productReviews::class,'index']);
	Route::get('/admin/product_reviews/{status}/{id}',[productReviews::class,'update_product_review_status']);
	// Product reviews Ends



	//Logout routes starts 

	Route::get('admin/logout', function () {
		session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('error','Logout Successful');
        return redirect('admin');
	});

	// Logout Routes Ends


});   // backend Middleware ends



//1234
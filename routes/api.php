<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SaveForLaterController;
use App\Http\Controllers\ShopController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/',[HomeController::class,'index'])->name('index');//index page controller

Route::get('shop',[ShopController::class,'index'])->name('shop.index');

Route::get('shop/{product}',[ShopController::class,'show'])->name('shop.show');

//cart Page 

//main cart page
Route::get('cart',[CartController::class,'index'])->name('cart.index');
//add to cart page using to package nameis(composer require bumbummen99/shoppingcart)
Route::post('cart',[CartController::class,'store'])->name('cart.store');
//Change Quantitye
Route::patch('cart/{product}', [CartController::class,'update'])->name('cart.update');
//delete form cart page
Route::delete('cart/{product}',[CartController::class,'destroy'])->name('cart.destroy');
// switch to save for Laters
Route::post('cart/switchToSaveForLater/{product}',[CartController::class,'switchToSaveForLater'])->name('cart.switchToSaveForLater');

//Save For Later
//cart remove from save for Later
Route::delete('saveForLater/{product}',[SaveForLaterController::class,'destroy'])->name('saveForLater.destroy');
// Add to Cart page 
Route::post('saveForLater/switchToSaveForLater/{product}',[SaveForLaterController::class,'switchToCart'])->name('saveForLater.switchToCart'); 

//view checkout page
Route::get('checkout',[CheckoutController::class,'index'])->name('checkout.index')->middleware('auth');
// Route::post('/checkout', [CheckoutController::class,'store'])->name('checkout.store');
//checkout details are store
Route::post('checkout',[CheckoutController::class,'store'])->name('checkout.store');

//add to coupons
Route::post('coupon', [CouponsController::class,'store'])->name('coupon.stroe');
//remove  to coupons
Route::delete('coupon', [CouponsController::class,'destroy'])->name('coupon.destroy');


//serach page
Route::get('serach',[ShopController::class,'search'])->name('search');

//all cart session destroys
Route::get('empty', function(){
    Cart::instance('saveForLater')->destroy();
});//destroy all

//remove  from cart
Route::delete('cart/{product}',[CartController::class,'destroy'])->name('cart.destroy'); //remove the cart

//if your order is complete to your 
Route::get('thankyou', [ConfirmationController::class,'index'])->name('confirmation.index');
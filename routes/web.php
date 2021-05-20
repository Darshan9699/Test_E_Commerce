<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\SaveForLaterController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

use Gloudemans\Shoppingcart\Facades\Cart;


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

// Route::get('/', function () {
//     return view('index');
// });

//Home Page
Route::get('/',[HomeController::class,'index'])->name('index');//index page controller


//Shop and product-details page
Route::get('/shop',[ShopController::class,'index'])->name('shop.index');//shop page
Route::get('/shop/{product}',[ShopController::class,'show'])->name('shop.show');//productdetails page

//cart Page 

Route::get('/cart',[CartController::class,'index'])->name('cart.index');//main cart page
Route::post('/cart',[CartController::class,'store'])->name('cart.store');//add to cart page using to package nameis(composer require bumbummen99/shoppingcart)
Route::patch('/cart/{product}', [CartController::class,'update'])->name('cart.update');//Change Quantitye
Route::delete('/cart/{product}',[CartController::class,'destroy'])->name('cart.destroy');//delete form cart page
Route::post('/cart/switchToSaveForLater/{product}',[CartController::class,'switchToSaveForLater'])->name('cart.switchToSaveForLater');// awitch to save 

//Save For Later
Route::delete('/saveForLater/{product}',[SaveForLaterController::class,'destroy'])->name('saveForLater.destroy');//delete form cart page
Route::post('/saveForLater/switchToSaveForLater/{product}',[SaveForLaterController::class,'switchToCart'])->name('saveForLater.switchToCart');// awitch to save 


Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout.index')->middleware('auth');
// Route::post('/checkout', [CheckoutController::class,'store'])->name('checkout.store');
Route::post('/checkout',[CheckoutController::class,'store'])->name('checkout.store');

Route::post('/coupon', [CouponsController::class,'store'])->name('coupon.stroe');
Route::delete('/coupon', [CouponsController::class,'destroy'])->name('coupon.destroy');


//serach page
Route::get('/serach',[ShopController::class,'search'])->name('search');

Route::get('empty', function(){
    Cart::instance('saveForLater')->destroy();
});//destroy all

Route::delete('/cart/{product}',[CartController::class,'destroy'])->name('cart.destroy'); //remove the cart

Route::get('/thankyou', [ConfirmationController::class,'index'])->name('confirmation.index');
Auth::routes();

//check mailable

Route::get('/mailable', function(){
    $order = App\Models\Order::find(11);
    return new App\Mail\OrderPlaced($order);
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix'=>'admin'], function(){
    Route::group(['middleware' => 'admin.guest'], function(){
        Route::view('login','admin.login')->name('admin.login');
        Route::post('login',[AdminController::class,'login'])->name('admin.auth');
    });
    Route::group(['middleware' => 'admin.auth'], function(){
        Route::view('dashboards','admin.home')->name('admin.home');
        Route::post('logout', [AdminController::class,'logout'])->name('admin.logout');

        // Manage Products

        //View Products
        Route::get('products',[AdminProductController::class,'index'])->name('admin.products');
        Route::get('view/{id}',[AdminProductController::class,'show'])->name('admin.view');
        // Create Products
        Route::get('product/create',[AdminProductController::class,'create'])->name('admin.create');
        Route::post('product/create',[AdminProductController::class,'store'])->name('admin.store');
        // Edit Products
        Route::get('edit/{id}',[AdminProductController::class,'edit'])->name('admin.edit');
        Route::post('edit/{id}',[AdminProductController::class,'update'])->name('admin.update');
        //Delete Products
        Route::delete('product/delete/{id}',[AdminProductController::class,'destroy'])->name('admin.destroy');

        //Products change status
        Route::get('products/changeStatus', [AdminProductController::class,'changeStatus']);

        Route::get('users',[AdminUserController::class,'index'])->name('admin.users');
        Route::get('users/changeStatus',[AdminUserController::class,'userChangeStatus']);
    });
});
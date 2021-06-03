<?php

use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\AdminCategoryProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminOrderProductController;
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
//shop page
Route::get('/shop',[ShopController::class,'index'])->name('shop.index');
//productdetails page
Route::get('/shop/{product}',[ShopController::class,'show'])->name('shop.show');

//cart Page

//main cart page
Route::get('/cart',[CartController::class,'index'])->name('cart.index');
//add to cart page using to package nameis(composer require bumbummen99/shoppingcart)
Route::post('/cart',[CartController::class,'store'])->name('cart.store');
//Change Quantitye
Route::patch('/cart/{product}', [CartController::class,'update'])->name('cart.update');
//delete form cart page
Route::delete('/cart/{product}',[CartController::class,'destroy'])->name('cart.destroy');
// switch to save for Laters
Route::post('/cart/switchToSaveForLater/{product}',[CartController::class,'switchToSaveForLater'])->name('cart.switchToSaveForLater');

//Save For Later
//cart remove from save for Later
Route::delete('/saveForLater/{product}',[SaveForLaterController::class,'destroy'])->name('saveForLater.destroy');
// Add to Cart page
Route::post('/saveForLater/switchToSaveForLater/{product}',[SaveForLaterController::class,'switchToCart'])->name('saveForLater.switchToCart');

//view checkout page
Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout.index')->middleware('auth');
// Route::post('/checkout', [CheckoutController::class,'store'])->name('checkout.store');
//checkout details are store
Route::post('/checkout',[CheckoutController::class,'store'])->name('checkout.store');

//add to coupons
Route::post('/coupon', [CouponsController::class,'store'])->name('coupon.stroe');
//remove  to coupons
Route::delete('/coupon', [CouponsController::class,'destroy'])->name('coupon.destroy');


//serach page
Route::get('/serach',[ShopController::class,'search'])->name('search');

//all cart session destroys
Route::get('empty', function(){
    Cart::instance('saveForLater')->destroy();
});//destroy all

//remove  from cart
Route::delete('/cart/{product}',[CartController::class,'destroy'])->name('cart.destroy'); //remove the cart

//if your order is complete to your
Route::get('/thankyou', [ConfirmationController::class,'index'])->name('confirmation.index');
Auth::routes();

//check mailable

//check to send mail to orders details view mail format
Route::get('/mailable', function(){
    $order = App\Models\Order::find(11);
    return new App\Mail\OrderPlaced($order);
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//check only admin can login
Route::group(['prefix'=>'admin'], function(){
    Route::group(['middleware' => 'admin.guest'], function(){
        Route::view('login','admin.login')->name('admin.login');// admin login
        Route::post('login',[AdminController::class,'login'])->name('admin.auth');// authinicate to user
    });
    Route::group(['middleware' => 'admin.auth'], function(){
        //admin dashborad
        Route::view('dashbord','admin.home')->name('admin.home');
        //admin logout
        Route::post('logout', [AdminController::class,'logout'])->name('admin.logout');

        // Manage Products

        //View Products
        Route::get('products',[AdminProductController::class,'index'])->name('admin.products');
        Route::get('products/filter/{id}',[AdminProductController::class,'filterProduct'])->name('admin.products.filter');
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

        // show all users
        Route::get('users',[AdminUserController::class,'index'])->name('admin.users');
        //user is create
        Route::get('users/create',[AdminUserController::class,'create'])->name('admin.users.create');
        Route::post('users/create',[AdminUserController::class,'store'])->name('admin.users.store');
        //singleuser is view
        Route::get('users/view/{id}',[AdminUserController::class,'show'])->name('admin.users.view');
        //change status active and inactive
        Route::get('users/changeStatus',[AdminUserController::class,'userChangeStatus']);
        //delete products
        Route::delete('users/destory/{id}',[AdminUserController::class,'destroy'])->name('admin.users.destroy');

        // Order to get to al
        //show all orders
        Route::get('orders',[AdminOrderController::class,'index'])->name('admin.orders');
        // change shipped status are changes
        Route::get('orders/changeStatus',[AdminOrderController::class,'changeShipped']);
        // single order view
        Route::get('orders/view/{id}',[AdminOrderController::class,'show'])->name('admin.orders.view');
        //delete to orders
        Route::delete('orders/destory/{id}',[AdminOrderController::class,'destroy'])->name('admin.orders.destroy');

        //Show All information to Order Products
        Route::get('orderProducts',[AdminOrderProductController::class,'index'])->name('admin.orderproduct'); // all show all product id
        //view Order Products details
        Route::get('orderProducts/view/{id}',[AdminOrderProductController::class,'show'])->name('admin.orderproduct.view'); //

        // all to get Categories
        Route::get('categories',[AdminCategoriesController::class,'index'])->name('admin.categories');
        //Category is Create
        Route::get('categories/create',[AdminCategoriesController::class,'create'])->name('admin.categories.create');
        Route::post('categories/create',[AdminCategoriesController::class,'store'])->name('admin.categories.store');
        //view single Categories
        Route::get('categories/view/{id}',[AdminCategoriesController::class,'show'])->name('admin.categories.view');
        //Edit and update Category
        Route::get('categories/edit/{id}',[AdminCategoriesController::class,'edit'])->name('admin.categories.edit');
        Route::post('categories/edit/{id}',[AdminCategoriesController::class,'update'])->name('admin.categories.update');
        //delete Categorys
        Route::delete('categories/destory/{id}',[AdminCategoriesController::class,'destroy'])->name('admin.categories.destroy');

        //all to get Categories Products
        Route::get('categoriesProducts',[AdminCategoryProductController::class,'index'])->name('admin.categoriesProducts');
        //view to get Categories Products
        Route::get('categoriesProducts/view/{id}',[AdminCategoryProductController::class,'show'])->name('admin.categoriesProducts.view');
        //create to Categories Peoducts
        Route::get('categoriesProducts/create',[AdminCategoryProductController::class,'create'])->name('admin.categoriesProducts.create');
        Route::post('categoriesProducts/create',[AdminCategoryProductController::class,'store'])->name('admin.categoriesProducts.store');

        // Edit to Categories PRoducts
        Route::get('categoriesProducts/edit/{id}',[AdminCategoryProductController::class,'edit'])->name('admin.categoriesProducts.edit');
        Route::post('categoriesProducts/edit/{id}',[AdminCategoryProductController::class,'update'])->name('admin.categoriesProducts.update');

        // delete Category PRoducts
        Route::delete('categoriesProducts/destory/{id}',[AdminCategoryProductController::class,'destroy'])->name('admin.categoriesProducts.destroy');


    });
});

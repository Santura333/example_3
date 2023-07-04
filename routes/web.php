<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontendUserProfileController;
use App\Http\Controllers\Frontend\FrontendPageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\StripeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CartPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// user 
// user middlware to group route request????
Route::middleware(['auth:web'])->group(function () {

    // muon dung class FrontendUserProfileController ?? import Controller FrontendUserProfileController
    Route::middleware(['auth:sanctum, web', 'verified'])->get('/dashboard', [FrontendUserProfileController::class, 'userdashboard'])->name('dashboard');

    Route::prefix('/user')->group(function () {
        Route::get('/logout', [FrontendUserProfileController::class, 'userlogout'])->name('user.logout');
        Route::get('/profile', [FrontendUserProfileController::class, 'userprofile'])->name('user.profile');
        Route::post('/profile', [FrontendUserProfileController::class, 'userprofileupdate'])->name('user.profile');
        Route::get('/password/change', [FrontendUserProfileController::class, 'userpasswordchange'])->name('user.change.password');
        Route::post('/password/update', [FrontendUserProfileController::class, 'userpasswordupdate'])->name('user.update.password');

    });

});

//Wishlist routes
Route::group(['prefix' => 'user'], function () {
    // // add to wishlist route
    // Route::post('/add/product/to-wishlist/{product_id}', [WishlistController::class, 'addToWishlist'])->name('addtoWishlist');
    // // list wishlist route
    // Route::get('/list/wishlists', [WishlistController::class, 'listWishList'])->name('listWishlist');
    // // remove from wishlist
    // Route::get('/remove/from-wishlist/{wish_id}', [WishlistController::class, 'removefromWishList'])->name('removefromWishList');

    //stripe payment route
    Route::post('/stripe/v1/payment', [StripeController::class, 'stripeOrder'])->name('stripe.order');


});

// Add to cart Product route
Route::get('/product/{id}', [FrontendPageController::class, 'productDeatil'])->name('frontend-product-details');
Route::get('/product/addToCart/{id}', [CartController::class, 'addToCart'])->name('frontend.product.addToCart');
// Route::delete('/product/delete-cart-product', [CartController::class, 'deleteProduct'])->name('delete.cart.product');
// Route::patch('/product/update-shopping-cart', [CartController::class, 'updateCart'])->name('update.cart.product');



// Cart page routes
Route::get('/my-cart', [CartPageController::class, 'myCartView'])->name('myCartView');
Route::get('/my-cart/list', [CartPageController::class, 'showmyCartList'])->name('showmyCartList');
Route::get('/remove/from-cart/{rowId}', [CartPageController::class, 'removeFromCart'])->name('removeFromCart');
Route::get('/add/in-cart/{rowId}', [CartPageController::class, 'addQtyToCart'])->name('addQtyToCart');
Route::get('/reduce/from-cart/{rowId}', [CartPageController::class, 'reduceQtyFromCart'])->name('reduceQtyFromCart');

//Checkout page routes
Route::get('/checkout-page', [CheckoutController::class, 'checkoutPage'])->name('checkout-page');
Route::post('/checkout-store', [CheckoutController::class, 'checkoutStore'])->name('checkout.store');

//admin
// route dành khi đã xác thực là role admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('baker_ntd/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

// route dành khi đã xác thực là role admin
Route::middleware(['auth:admin'])->group(function () {

    // Admin Logout/password change and profile routes
    Route::prefix('/admin')->group(function () {
        Route::get('/logout', [AdminController::class, 'destroy'])->name('admin.logout');
        Route::resource('/profile', AdminProfileController::class);
        Route::get('/edit/profile', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
        Route::get('/change/password', [AdminProfileController::class, 'AdminPasswordChange'])->name('admin.change.password');
        Route::post('/change/password', [AdminProfileController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
    });

    // Admin Dashboard routes
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    // Admin Dashboard all functionality/features routes
    Route::prefix('/admin')->group(function () {
        Route::resource('/user', UserController::class);
        // Route::get('/edit', [UserController::class, 'userEdit'])->name('user.edit');
        // Route::get('/destroy', [UserController::class, 'destroy'])->name('user.destroy');
        // Route::get('/update', [UserController::class, 'update'])->name('user.update');
    });

});
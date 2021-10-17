<?php

use App\Http\Controllers\_AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/cart', [HomepageController::class, 'cart'])->name('cart');
Route::get('/product_detail/{product_id}', [HomepageController::class, 'product_detail'])->name('product-detail');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

    Route::prefix('dashboard')->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('admin-dashboard');
    });

    Route::prefix('product')->group(function() {

        Route::get('/', [ProductController::class, 'index'])->name('admin-product');
        Route::get('/create', [ProductController::class, 'create'])->name('admin-product-create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin-product-store');
        Route::get('/show/{product_id}', [ProductController::class, 'show'])->name('admin-product-show');
        Route::get('/destroy/{product_id}', [ProductController::class, 'destroy'])->name('admin-product-destroy');
        Route::post('/update/{product_id}', [ProductController::class, 'update'])->name('admin-product-update');

        // Remove selected photo
        Route::get('/photo/{product_photo_id}', [ProductController::class, 'remove_photo'])->name('admin-product-remove-photo');

        // Add Photos
        Route::post('/photo/store/{product_id}', [ProductController::class, 'add_photos'])->name('admin-product-add-photos');

        // Add Session cart
        Route::get('/cart/{product_id}', [ProductController::class, 'add_to_cart'])->name('add-to-cart');
    });

    Route::prefix('profile')->group(function() {

    });

    Route::prefix('shipping')->group(function() {
        Route::get('/', [ShippingController::class, 'index'])->name('admin-shipping');
    });

});

Route::get('/login', [_AuthController::class, 'getlogin'])->middleware('guest')->name('login');
Route::post('/login', [_AuthController::class, 'postlogin']);

Route::get('/register', [UserController::class, 'index']);
Route::post('/register', [UserController::class, 'register']);

Route::get('/logout', [_AuthController::class, 'logout']);

// forget cart
Route::get('/forget', function() {
    session()->forget('cart');
    return redirect('/');
});
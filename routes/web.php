<?php

use App\Http\Controllers\_AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\TransactionController;
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
Route::get('/categories', [HomepageController::class, 'categories'])->name('categories');
Route::get('/cart', [HomepageController::class, 'cart'])->name('cart')->middleware('auth');
Route::post('/checkout', [ HomepageController::class, 'checkout_item'])->name('checkout');
Route::get('/product_detail/{product_id}', [HomepageController::class, 'product_detail'])->name('product-detail');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

    Route::prefix('dashboard')->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('admin-dashboard');
    });

    Route::prefix('transaction')->group(function() {
        Route::get('/', [TransactionController::class, 'index'])->name('admin-transaction');

        // Buy Product
        Route::get('detail/buy/{order_id}', [TransactionController::class, 'detail_buy'])->name('admin-transaction-detail-buy');

        // Sell Product
        Route::get('/sell', [TransactionController::class, 'sell'])->name('admin-transaction-sell');
        Route::get('detail/sell/{order_id}', [TransactionController::class, 'detail_sell'])->name('admin-transaction-detail-sell');

        // Transaction accepted
        Route::get('/sell/accepted/{order_id}', [TransactionController::class, 'accepted_order'])->name('admin-transaction-sell-acepted');
        Route::get('/sell/deny/{order_id}', [TransactionController::class, 'deny_order'])->name('admin-transaction-sell-deny');

        // Input tracking number
        Route::post('/tracking_code/{order_id}', [TransactionController::class, 'input_tracking_code'])->name('admin-transaction-input-tracking-code');

        // Set order is completed
        Route::get('/completed/{order_id}', [TransactionController::class, 'completed_order'])->name('admin-transaction-completed-order');

        // Set review product
        Route::post('/review/{product_id}', [TransactionController::class, 'review_product'])->name('admin-transaction-product-review');
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

        // Remove product on cart
        Route::get('/cart/{product_id}/delete', [ProductController::class, 'delete_items_on_cart'])->name('delete-item');
    });

    Route::prefix('profile')->group(function() {
        Route::get('/', [ProfileController::class, 'index'])->name('admin-profile');
        Route::post('/update', [ProfileController::class, 'update'])->name('admin-profile-update');
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

// Ajax get City
Route::get('/getcity/{province_code}', [HomepageController::class, 'getCity']);
//

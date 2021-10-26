<?php

namespace App\Http\Controllers;

use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;

class HomepageController extends Controller
{
    public function index() {
        $products = Product::orderByDesc('created_at')->take(8)->get();
        // dd($products->toArray());
        return view('public.pages.index', [
            'products' => $products
        ]);
    }

    public function checkout_item(Request $request) {
        // $table->foreignId('user_id')->constrained();
        // $table->foreignId('customer_id')->constrained('users');

        // $table->foreignId('product_id')->constrained();
        // $table->integer('amount');

        // // 0: cancelled, 1: pending, 2: Success
        // $table->enum('payment_status', [0, 1, 2]);
        // // 0: pending, 1: shipping, 2: Received
        // $table->enum('shipping_status', [0, 1, 2]);
        foreach (session('cart') as $key => $value) {
            $product = Product::find($value);
            $seller_id = $product->user_id;

            $order_code = str_pad(mt_rand(1000,9999).date('dmY'), 10, '0', STR_PAD_LEFT);

            $order = Order::create([
                'order_code' => $order_code,
                'user_id' => $seller_id,
                'customer_id' => auth()->user()->id,
                'product_id' => $value,
                'amount' => $product->price,
                'payment_status' => '1',
                'shipping_status' => '0',
            ]);

            // $table->string('address');
            // $table->char('province_code');
            // $table->char('city_code');
            // $table->char('zip_code');
            // $table->string('country');
            // $table->char('phone');
            // $table->foreignId('user_id')->constrained();

            CustomerAddress::create([
                'address' => $request->address,
                'province_code' => $request->province,
                'city_code' => $request->city,
                'zip_code' => $request->zip,
                'country' => $request->country,
                'phone' => $request->phone,
                'order_id' => $order->id,
            ]);
        }
        session()->forget('cart');
        return redirect()->route('admin-transaction')->withSuccess('Order created');
    }

    public function product_detail($product_id) {
        $product = Product::find($product_id);
        return view('public.pages.product.detail', [
            'product' => $product
        ]);
    }

    public function cart() {
        $provinces = Province::all();
        return view('public.pages.cart', [
            'provinces' => $provinces
        ]);
    }

    public function getCity($province_code) {
        $cities = City::where('province_code', $province_code)->get();
        return response()->json($cities);
    }
}

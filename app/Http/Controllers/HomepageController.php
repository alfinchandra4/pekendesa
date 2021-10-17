<?php

namespace App\Http\Controllers;

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

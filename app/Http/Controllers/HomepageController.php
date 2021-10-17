<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
        return view('public.pages.cart');
    }
}

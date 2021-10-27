<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderByDesc('created_at')->where('user_id', auth()->user()->id)->get();
        return view('admin.pages.product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->merge(["user_id" => auth()->user()->id]);
        $input = $request->except('images');
        $product = Product::create($input);
        foreach ($request->images as $key => $image) {
            // $file = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imgname = $key . date('dmyHis') . '.' . $ext;
            Storage::disk('local')->putFileAs('public/product_photos/', $image, $imgname);

            ProductPhoto::create([
                'product_id' => $product->id,
                'photo_path' => $imgname,
            ]);
        }

        return back()->withSuccess('Product added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $product = Product::find($product_id);
        return view('admin.pages.product.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {
        $input = $request->except('images');
        Product::find($product_id)->update($input);
        return back()->withSuccess('Product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function remove_photo($product_photo_id)
    {
        $productPhoto = ProductPhoto::find($product_photo_id);
        Storage::delete('public/product_photos/' . $productPhoto->photo_path);
        $productPhoto->delete();
        return back()->withSuccess('Photo deleted');
    }

    public function add_photos(Request $request, $product_id)
    {
        $totalPhotos = ProductPhoto::where('product_id', $product_id)->count();
        $totalUploadPhotos = count($request->images);
        if (($totalPhotos + $totalUploadPhotos) <= 3) {
            foreach ($request->images as $key => $image) {
                // $file = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $imgname = $key . date('dmyHis') . '.' . $ext;
                Storage::disk('local')->putFileAs('public/product_photos/', $image, $imgname);

                ProductPhoto::create([
                    'product_id' => $product_id,
                    'photo_path' => $imgname,
                ]);
            }
            return back()->withSuccess('Photos added');
        }
        return back()->withError('Maximum limit photos is 3');

    }

    public function delete_items_on_cart($product_id)
    {
        $cart = session()->get('cart');
        foreach ($cart as $key => $value) {
            if ($value == $product_id) {
                unset($cart[$key]);
            }
        }
        session()->put('cart', $cart);
        return back();
    }

    public function add_to_cart($product_id)
    {
        if (!auth()->check()) {
            return back()->withError('Error! You must login first');
        }
        $cart = session()->get('cart');
        // If cart still empty
        if (!$cart) {
            $cart[] = $product_id;
            session()->put('cart', $cart);
            return back()->withSuccess('Success! Product added to cart');
        } else {
            // Checking if selected item existed on array
            if (in_array($product_id, $cart)) {
                return back()->withError('Error! Product existed on cart');
            } else {
                $cart[] = $product_id;
                session()->put('cart', $cart);
                return back()->withSuccess('Product added to cart');
            }
        }
    }
}

@extends('public.layouts.app')

@section('css')
<style>
    .trend_categories .card {
        background: #F4F4F4;
    }
    .new_products img:hover {
        transition: .3s;
        -webkit-filter: brightness(50%);
    }

</style>
@endsection

@section('content')
<div class="trend_categories container mb-4 mt-4">
    <h4 class="fw-bold float-left">More Categories </h4>
    <div class="row">
        <div class="col-4 col-md-2 mb-4">
            <div class="card border-0">
                <div class="card-body">
                    <div class="ps-4 pt-4 pe-4 pb-3">
                        <img src="{{ asset('public_/category/gadget.png') }}" alt="" class="img-fluid">
                    </div>
                    <h5 class="text-center">Gadgets</h5>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-2 mb-4">
            <div class="card border-0">
                <div class="card-body">
                    <div class="ps-4 pt-4 pe-4 pb-3">
                        <img src="{{ asset('public_/category/furniture.png') }}" alt="" class="img-fluid">
                    </div>
                    <h5 class="text-center">Furniture</h5>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-2 mb-4">
            <div class="card border-0">
                <div class="card-body">
                    <div class="ps-4 pt-4 pe-4 pb-3">
                        <img src="{{ asset('public_/category/makeup.png') }}" alt="" class="img-fluid">
                    </div>
                    <h5 class="text-center">Make up</h5>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-2 mb-4">
            <div class="card border-0">
                <div class="card-body">
                    <div class="ps-4 pt-4 pe-4 pb-3">
                        <img src="{{ asset('public_/category/vegetable.png') }}" alt="" class="img-fluid">
                    </div>
                    <h5 class="text-center">Vegetable</h5>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-2 mb-4">
            <div class="card border-0">
                <div class="card-body">
                    <div class="ps-4 pt-4 pe-4 pb-3">
                        <img src="{{ asset('public_/category/tools.png') }}" alt="" class="img-fluid">
                    </div>
                    <h5 class="text-center">Tools</h5>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-2 mb-4">
            <div class="card border-0">
                <div class="card-body">
                    <div class="ps-4 pt-4 pe-4 pb-3">
                        <img src="{{ asset('public_/category/diy.png') }}" alt="" class="img-fluid">
                    </div>
                    <h5 class="text-center">Hand Made</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="new_products container mb-5">
    <h4 class="fw-bold">More Products</h4>
    <div class="row">
        {{-- {{dd($products)}} --}}
        @foreach ($products as $product)
        @php
        $productPhoto = App\Models\ProductPhoto::where('product_id', $product->id)->first();
        @endphp
        <div class="col-md-2 col-4 mb-3">
            <div class="card border-0">
                <div class="card-body p-0">
                    <a href="{{ route('product-detail', $product->id) }}">
                        <img src="{{ asset('storage/product_photos/'.$productPhoto->photo_path) }}" alt=""
                            class="img-fluid rounded-1" style="height: 200px; object-fit:cover">
                    </a>
                    <div style="font-size: 10pt" class="pt-2 mb-1">{{ $product->product_name }}</div>
                    <h6 class="text-danger fw-bold">Rp. {{ number_format($product->price) }}</h6>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
{{--  --}}

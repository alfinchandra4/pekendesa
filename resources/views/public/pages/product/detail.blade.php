@extends('public.layouts.app')

@section('css')
<style>
    .img-primary {
        width: 100%;
        height: 500px;
        object-fit: cover;
    }

</style>
@endsection

@section('content')
<div class="container mb-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('homepage') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Details</li>
        </ol>
    </nav>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle" aria-hidden="true"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="product_photos">
        <div class="row">
            <div class="col-md-7">
                @php
                $photo = App\Models\ProductPhoto::where('product_id', $product->id)->orderBy('created_at',
                'ASC')->first();
                @endphp
                <img src="{{ asset('storage/product_photos/'.$photo->photo_path) }}" alt=""
                    class="rounded-1 img-primary">
            </div>
            <div class="col-md-2">
                @php
                $photos = App\Models\ProductPhoto::where('product_id', $product->id)->orderBy('created_at',
                'ASC')->skip(1)->take(2)->get();
                @endphp
                @foreach ($photos as $photo)
                <img src="{{ asset('storage/product_photos/'.$photo->photo_path) }}" alt=""
                    class="img-fluid rounded-1 mb-4">
                @endforeach
            </div>
        </div>
        <div class="product_info mt-2">
            <div class="row">
                <div class="col-md-7">
                    <div class="product_title h5 mt-3">{{ $product->product_name }}</div>
                    <small class="seller_name" class="text-muted">By {{ $product->seller->name }}</small>
                    <p class="product_price text-danger fw-bold">Rp. {{ number_format($product->price) }}</p>
                </div>
                <div class="col-md-4 mt-2">
                    @php
                        if (auth()->check()) {
                            $p = App\Models\Product::where('id', $product->id)->where('user_id', auth()->user()->id)->count();
                        } else {
                            $p = 0;
                        }
                    @endphp
                    @if ($p == 0 || auth()->check() == 0)
                        <div style="background: #29A867; width:45%" class="p-1 text-center rounded">
                            <a href="{{ route('add-to-cart', $product->id) }}" class="text-decoration-none text-white">Add
                                To Cart</a>
                        </div>
                    @else
                        <div style="background: gray; width:45%" class="p-1 text-center rounded">
                            <a href="{{ route('admin-product-show', $product->id) }}" class="text-decoration-none text-white">Edit Product</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="description col-md-7 mb-3">
                {{ $product->description }}
            </div>
            <div class="customers_review">
                <h6 class="mb-3">Customers Review ({{count($reviews)}})</h6>
                <div class="customer_list">
                    <div class="customer_review mb-3">
                        <div class="row">
                            @foreach ($reviews as $data)
                            <div class="col-md-8 mb-3">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{ asset('public_/samples/faces/1.jpg') }}" alt=""
                                            class="img-fluid rounded-circle">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="customer_name fw-bold mb-1">
                                            {{ $data->buyer->name }}
                                        </div>
                                        <div class="review_text" style="font-size: 11pt">
                                            {{ $data->review }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function() {
    // show the alert
    setTimeout(function() {
        $(".alert").alert('close');
    }, 2500);
});
</script>
@endsection
{{--  --}}

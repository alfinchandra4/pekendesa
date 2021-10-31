@extends('admin.layouts.app');

@section('title', 'My Products')

@section('subtitle', 'Manage my products');

@section('content')
<a href="{{ route('admin-product-create') }}" class="btn btn-success">Add New Product</a>

<div class="row">
    @foreach ($products as $prod)
    @php
    $photo = App\Models\ProductPhoto::where('product_id', $prod->id)->first();
    // dd($photo->photo_path);
    @endphp
    <div class="card col-md-3 mt-3 m-4">
        <div style="padding: 10 5 0 5" style="position: relative">
            @if ($photo == null)
            <img class="card-img-top" src="{{ asset('admin_/assets/images/samples/default_photo.jpg') }}" height="200px"
                style="object-fit: cover">
            @else
            <img class="card-img-top" src="{{ asset('storage/product_photos/'. $photo->photo_path) }}" height="200px"
                style="object-fit: cover">
            @endif
            <a href="{{ route('admin-product-destroy', $prod->id) }}" class="btn btn-sm btn-danger"
                style="position: absolute; right:30px; top:20px">
                <i class="fa fa-sm fa-trash" aria-hidden="true"></i>
            </a>
        </div>
        {{-- <div class="card-body"> --}}
        <div class="pt-1 ps-2 pb-3 mt-2">
            <h5><a href="{{ route('admin-product-show', $prod->id) }}">{{ $prod->product_name }}</a></h5>
            <span class="text-small">{{ $prod->product_category->name }}</span>
        </div>
        {{-- </div> --}}
    </div>
    @endforeach
</div>
@endsection
{{--  --}}

@extends('admin.layouts.app');

@section('title')
{{ $product->product_name }}
@endsection

@section('subtitle', 'Product Details');

@section('content')
<div class="card">
    <div class="card-body">
        <form class="row g-3" method="POST" action="{{ route('admin-product-update', $product->id) }}">
            @csrf
            <div class="col-md-6">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required value="{{ $product->product_name }}">
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}">
            </div>
            <div class="col-12">
                <label for="category" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select">
                    @php
                        $categories = App\Models\ProductCategory::all();
                    @endphp
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Description</label>
                <textarea name="description" id="description" cols=10" rows="3" class="form-control">{{ $product->description }}</textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Update Product</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @php
            $photos = App\Models\ProductPhoto::where('product_id', $product->id)->get();
        @endphp
        <div class="row mb-3">
            @foreach ($photos as $photo)
                <div class="col-md-4" style="position: relative">
                    <img class="" src="{{ asset('storage/product_photos/'. $photo->photo_path) }}" height="200px" style="object-fit: cover" width="100%">
                        <a href="{{ route('admin-product-remove-photo', $photo->id) }}" style="position:absolute; top:5; right:20" class="btn btn-danger btn-sm">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                </div>
            @endforeach
        </div>
        <form action="{{ route('admin-product-add-photos', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <input type="file" class="form-control" id="images[]" accept="image/*" name="images[]" multiple required>
            </div>
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary btn-block">Add Photo</button>
            </div>
        </form>
    </div>
</div>
@endsection

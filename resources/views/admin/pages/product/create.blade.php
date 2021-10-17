@extends('admin.layouts.app');

@section('title', 'Create New Product')

@section('subtitle', 'Create your own product');

@section('content')
<div class="card">
    <div class="card-body">
        <form class="row g-3" method="POST" enctype="multipart/form-data" action="{{ route('admin-product-store') }}">
            @csrf
            <div class="col-md-6">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price">
            </div>
            <div class="col-12">
                <label for="category" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select">
                    @php
                        $categories = App\Models\ProductCategory::all();
                    @endphp
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Description</label>
                <textarea name="description" id="description" cols=10" rows="3" class="form-control"></textarea>
            </div>
            <div class="input-group">
                <input type="file" class="form-control" id="images[]" accept="image/*" name="images[]" multiple required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Create Product</button>
            </div>
        </form>
    </div>
</div>
@endsection
{{--  --}}

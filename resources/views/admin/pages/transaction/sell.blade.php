@extends('admin.layouts.app');

@section('title', 'Transaction')

@section('subtitle', 'Big result start from small one');

@section('content')
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="{{ route('admin-transaction') }}">Buy Products</a>
    </li>
    <li class="nav-item fw-bold">
        <a class="nav-link active" href="{{ route('admin-transaction-sell') }}">Sell Product</a>
    </li>
</ul>
<div class="mt-3">
    @foreach ($orders as $order)
    <div class="card mb-3">
        <div class="card-body p-2">
            <div class="row">
                <div class="col-md-3">
                    @php
                    $productPhoto = App\Models\ProductPhoto::where('product_id', $order->product_id)->first();
                    @endphp
                    <div class="row m-0">
                        <div class="col-md-4"><img
                                src="{{ asset('storage/product_photos/'.$productPhoto->photo_path) }}" alt=""
                                class="img-fluid rounded-1" style="height: 60px"></div>
                        <div class="col-md-8">
                            <span style="font-size: 10pt">{{ $order->product->product_name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-muted" style="font-size: 10pt">Store:</div>
                    @php
                    $seller = App\Models\User::find($order->user_id);
                    $store_name = $seller->store_name
                    @endphp
                    {{ $store_name }}
                </div>
                <div class="col-md-2">
                    <div class="text-muted" style="font-size: 10pt">Order created:</div>
                    {{ date('d F Y', strtotime($order->created_at)) }}
                </div>
                <div class="col-md-2">
                    <div class="text-muted" style="font-size: 10pt">Payment Status:</div>
                    @switch($order->payment_status)
                        @case(0)
                                <span class="fw-bold text-secondary">Cancelled</span>
                            @break
                        @case(1)
                                <span class="fw-bold text-danger">Pending</span>
                            @break
                        @case(2)
                                <span class="fw-bold text-success">Confirmed</span>
                            @break;
                        @default
                    @endswitch
                </div>
                <div class="col-md-2">
                    <div class="text-muted" style="font-size: 10pt">Ship Status:</div>
                    @switch($order->shipping_status)
                        @case(0)
                            <span class="fw-bold text-danger">Pending</span>
                            @break
                        @case(1)
                            <span class="fw-bold text-primary">On Shipping</span>
                            @break
                        @case(2)
                            <span class="fw-bold text-success">Received</span>
                            @break
                        @default
                    @endswitch
                </div>
                <div class="col-md-1">
                    <a href="{{ route('admin-transaction-detail-sell', $order->id) }}">
                        <i class="fas fa-file-invoice"></i> Detail
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
{{--  --}}

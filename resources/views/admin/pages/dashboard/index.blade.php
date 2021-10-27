@extends('admin.layouts.app');

@section('title', 'Dashboard')

@section('subtitle', 'Look what you have made today!')

@section('content')
<section class="row">
    <div class="row">
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon purple">
                                <i class="iconly-boldShow"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Total produk</h6>
                            @php
                                $products = App\Models\Product::where('user_id', auth()->user()->id)->count();
                            @endphp
                            <h6 class="font-extrabold mb-0">{{ $products }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon blue">
                                <i class="iconly-boldProfile"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Total Penjualan</h6>
                            <h6 class="font-extrabold mb-0">
                                @php
                                    $data = App\Models\Order::where('user_id', auth()->user()->id)->where('shipping_status', 2)->count();
                                @endphp
                                {{ $data }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon green">
                                <i class="iconly-boldAdd-User"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Total Pembelian</h6>
                            <h6 class="font-extrabold mb-0">
                                @php
                                    $totalPembelian = App\Models\Order::where('shipping_status', 2)->where('customer_id', auth()->user()->id)->geT();
                                @endphp
                                {{ $totalPembelian->count() }}
                                {{ auth()->user()->id }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon red">
                                <i class="iconly-boldBookmark"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Saved Post</h6>
                            <h6 class="font-extrabold mb-0">112</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</section>
@endsection
{{--  --}}

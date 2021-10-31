@extends('admin.layouts.app');

@section('title', '#INV'.$order->order_code)

@section('subtitle')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin-transaction') }}">Buy Transaction</a></li>
        <li class="breadcrumb-item active" aria-current="page">Details</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card p-0">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-4">
                @php
                $productPhoto = App\Models\ProductPhoto::where('product_id', $order->product_id)->first();
                @endphp
                <img src="{{ asset('storage/product_photos/'.$productPhoto->photo_path) }}" alt=""
                    class="img-fluid rounded-1" style="height: 250px">
            </div>
            <div class="col-md-4">
                <div class="customer">
                    <div class="text-muted mb-2">Store Name</div>
                    <div class="fw-bold">
                        @php
                        $seller = App\Models\User::find($order->user_id);
                        $store_name = $seller->store_name
                        @endphp
                        {{ $store_name }}
                    </div>
                </div>

                <div class="order_date mt-4">
                    <div class="text-muted mb-2">Date of Transaction</div>
                    <div class="fw-bold">
                        {{ date('d F Y', strtotime($order->created_at)) }}
                    </div>
                </div>

                <div class="order_date mt-4">
                    <div class="text-muted mb-2">Total Amount</div>
                    <div class="fw-bold">
                        IDR {{ number_format($order->product->price) }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div>
                    <div class="text-muted mb-2">Product Name</div>
                    <div class="fw-bold">
                        {{ $order->product->product_name }}
                    </div>
                </div>

                <div class="mt-4">
                    <div class="text-muted mb-2">Payment Status</div>
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

                <div class="mt-4">
                    <div class="text-muted mb-2">Store Phone Number</div>
                    <div class="fw-bold">
                        {{ $seller->phone }}
                    </div>
                </div>
            </div>
        </div>
        <h4>Shipping Information</h4>
        <div class="row">
            <div class="col-md-4">
                <div>
                    <div class="text-muted mb-2">Address</div>
                    <div class="fw-bold">
                        @php
                        $address = App\Models\CustomerAddress::where('order_id', $order->id)->first();
                        @endphp
                        {{ $address->address }}
                    </div>
                </div>

                <div class="mt-4">
                    <div class="text-muted mb-2">Country</div>
                    <div class="fw-bold">
                        {{ $address->country }}
                    </div>
                </div>

                <div class="mt-4">
                    <div class="text-muted mb-2">Store Phone Number</div>
                    <div class="fw-bold">
                        {{ $address->phone }}
                    </div>
                </div>

                <div class="mt-4">
                    <div class="text-muted mb-2">Shipping Status</div>
                    @switch($order->shipping_status)
                    @case(0)
                    <span class="fw-bold text-danger">Pending</span>
                    @break
                    @case(1)
                    <span class="fw-bold text-primary">On Shipping</span>
                    <span><i>[ {{ $order->shipping_description }} ]</i></span>
                    @break
                    @case(2)
                    <span class="fw-bold text-success">Received</span>
                    @break
                    @default
                    @endswitch
                </div>

            </div>
            <div class="col-md-4">
                <div>
                    <div class="text-muted mb-2">Province</div>
                    <div class="fw-bold">
                        {{ Laravolt\Indonesia\Models\Province::where('code', $address->province_code)->first()['name'] }}
                    </div>
                </div>

                <div class="mt-4">
                    <div class="text-muted mb-2">City</div>
                    <div class="fw-bold">
                        {{ Laravolt\Indonesia\Models\City::where('code', $address->city_code)->first()['name'] }}
                    </div>
                </div>

                <div class="mt-4">
                    <div class="text-muted mb-2">Postal Code</div>
                    <div class="fw-bold">
                        {{ $address->zip_code }}
                    </div>
                </div>
            </div>
        </div>

        @if ($order->shipping_status == 1)
        <a href="{{ route('admin-transaction-completed-order', $order->id ) }}"
            onclick="return confirm('Apakah pesanan sudah sesuai?')" style="float: right"
            class="btn btn-primary btn-lg">Selesaikan pesanan</a>
        @endif

        @if ($order->shipping_status == 2 && $order->payment_status == 2 && $review == 0)
        <button style="float: right" type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
            data-bs-target="#exampleModal">Beri ulasan</button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Berikan ulasan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin-transaction-product-review', $order->product_id) }}" method="post">
                            @csrf
                            <div class="form-group">
                              <label for="review"></label>
                              <input type="text" name="review" id="review" class="form-control" placeholder="Produknya bagus, pengiriman cepat.">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
{{--  --}}

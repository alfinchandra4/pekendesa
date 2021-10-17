@extends('public.layouts.app')

@section('content')
<div class="container mb-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('homepage') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>
    </nav>
    <div class="row pb-4 pt-3 fw-bold">
        <div class="col-md-2">Image</div>
        <div class="col-md-4">Name & Seller</div>
        <div class="col-md-3">Price</div>
        <div class="col-md-3">Menu</div>
    </div>
    @foreach (session('cart') as $cart)
    @php
    $product = App\Models\Product::find($cart);
    $productFirstPhoto = App\Models\ProductPhoto::where('product_id', $cart)->orderBy('created_at', 'ASC')->first();
    @endphp
    <div class="row mb-3">
        <div class="col-md-2">
            <img src="{{ asset('storage/product_photos/'.$productFirstPhoto->photo_path) }}" alt="" class="rounded"
                height="80px" width="140px" style="object-fit: cover">
        </div>
        <div class="col-md-4">
            <div class="h6">{{ $product->product_name }}</div>
            <span class="text-muted">By Paul Allen</span>
        </div>
        <div class="col-md-3">
            <div class="h6">Rp. 25,000</div>
            <span class="text-muted">IDR</span>
        </div>
        <div class="col-md-3">
            <a href="" class="btn btn-danger">Remove</a>
        </div>
    </div>
    @endforeach
    <hr class="col-md-10">
    <h5 class="fw-bold">Shipping Details</h5>
    <form class="row g-3 col-md-10" method="POST" action="#">
        @csrf
        <div class="col-12">
            <label for="inputAddress" class="form-label">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="address" required>
        </div>
        <div class="col-md-6">
            <label for="province" class="form-label">Province</label>
            <select id="province" class="form-select" name="province">
                <option value="0">== Select Province ==</option>
                @foreach ($provinces as $key => $value)
                <option value="{{ $value['code'] }}">{{ $value['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="city" class="form-label">City</label>
            <select id="city" class="form-select" name="city">
                <option selected>Choose...</option>
                <option>...</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="inputZip" class="form-label">Postal Code</label>
            <input type="text" class="form-control" id="inputZip" required name="zip">
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label">Country</label>
            <input type="text" class="form-control" id="inputCity" required name="country">
        </div>
        <div class="col-md-6">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" required name="phone">
        </div>
        {{-- <div class="col-12">
          <button type="submit" class="btn btn-primary">Sign in</button>
        </div> --}}
    </form>

    <h5 class="fw-bold mt-4 mb-3">Payment Informations</h5>
    <div class="amount">
        <div class="row">
            <div class="col-md-2">
                <div class="h6">Rp. 0</div>
                <span class="text-muted">Country Tax</span>
            </div>
            <div class="col-md-2">
                <div class="h6">Rp. 12,500</div>
                <span class="text-muted">Shipping Fee</span>
            </div>
            <div class="col-md-2">
                <div class="h6">Rp. 102,500</div>
                <span class="text-muted">Subtotal</span>
            </div>
            <div class="col-md-2">
                <div class="h6 text-success">Rp. 123,000</div>
                <span class="text-muted">Total</span>
            </div>
            <div class="col-md-4">
                <a href="#" class="btn btn-lg btn-success">Checkout Now</a>
            </div>
        </div>
    </div>


</div>
<script>
    $(function () {
        $('#province').on('change', function () {
            var province_id = this.value;
            $.ajax({
                url: "/getcity/" + province_id,
                type: "GET",
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function (result) {
                    // $("#city-dropdown").html(result);
                    if (result.length == 0) {
                        $('#city').empty();
                        $("#city").append("<option value='#'>Not Found</option>");
                    } else {
                        $('#city').empty();
                        var html = "";
                        result.forEach(element => {
                            html += "<option value=" + element.code + ">" + element
                                .name + "</option>";
                        });
                        $("#city").append(html);
                    }

                }
            });
        });
    });

</script>

@endsection

{{--  --}}

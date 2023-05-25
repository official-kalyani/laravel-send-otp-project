@extends('product.layout.template')

@section('body')
    <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">2</span>
        </h4>
        <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0">First Product</h6>
                    <small class="text-muted">Brief description</small>
                </div>
                <span class="text-muted">$12</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0">Second Product</h6>
                    <small class="text-muted">Brief description</small>
                </div>
                <span class="text-muted">$8</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (USD)</span>
                <strong>$20</strong>
            </li>
        </ul>

        <form class="card p-2">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Coupon Code">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-secondary">Redeem</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Product Purchase</h4>
        <form class="needs-validation" action="{{route('requestForOtp')}}" method="post" novalidate>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="John" value="" required>
                    <div class="invalid-feedback">
                        Valid name is required.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Mobile</label>
                    <input type="number" class="form-control" name="number" id="number" placeholder="+8801xxxxxxxx"
                           value="" required>
                    <div class="invalid-feedback">
                        Valid number is required.
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="email">Email <span class="text-muted">(Optional)</span></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" required>
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
            </div>

            <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" placeholder="1234 Main St">
                <div class="invalid-feedback">
                    Please enter your shipping address.
                </div>
            </div>

            <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                    <label class="custom-control-label" for="credit">Cash On Delivery</label>
                </div>
            </div>
            <hr class="mb-4">
            {!! csrf_field() !!}
            <input id="purchase-type" name="purchase_type" type="hidden" value="buy-product">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Request Security Code</button>
        </form>
    </div>
@endsection
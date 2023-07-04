@extends('frontend.frontend_master')

@section('title')
Checkout Page
@endsection

@section('frontend_content')
<div class="checkout-box ">
    <div class="row">
        <div class="col-md-8">
            <div class="panel-group checkout-steps" id="accordion">
                <!-- checkout-step-01  -->
                <div class="panel panel-default checkout-step-01">

                    <div id="collapseOne" class="">
                        <!-- panel-body  -->
                        <div class="panel-body">
                            <div class="row">

                                <!-- guest-login -->
                                <div class="col-md-6 col-sm-6 already-registered-login">
                                    <h4 class="checkout-subtitle"><b>Shipping Address</b></h4>

                                    <form class="shipping-form" method="POST" action="{{ route('checkout.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="info-title" for="shippingName">Shipping
                                                Name<span>*</span></label>
                                            <input type="text" class="form-control unicase-form-control text-input"
                                                id="shippingName" placeholder="Enter your name here"
                                                name="shipping_name" value="{{ Auth::user()->name }}">
                                            @error('shipping_name')
                                            <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="info-title" for="shippingEmail">Shipping email
                                                <span>*</span></label>
                                            <input type="email" class="form-control unicase-form-control text-input"
                                                id="shippingEmail" placeholder="Enter your email here"
                                                name="shipping_email" value="{{ Auth::user()->email }}">
                                            @error('shipping_email')
                                            <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="info-title" for="shippingPhone">Shipping
                                                Phone<span>*</span></label>
                                            <input type="phone" class="form-control unicase-form-control text-input"
                                                id="shippingPhone" placeholder="Enter your phone number"
                                                name="shipping_phone" value="{{ Auth::user()->phone_number }}">
                                            @error('shipping_phone')
                                            <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                </div>
                                <!-- guest-login -->

                            </div>
                        </div>
                        <!-- panel-body  -->

                    </div><!-- row -->
                </div>
                <!-- checkout-step-01  -->

            </div><!-- /.checkout-steps -->
        </div>
        <div class="col-md-4">
            <!-- checkout-progress-sidebar -->
            <div class="checkout-progress-sidebar ">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                        </div>
                        <div class="___class_+?71___">
                            <ul class="nav nav-checkout-progress list-unstyled">
                                @foreach(session('cart') as $carts => $item)
                                {{-- @foreach ($carts as $item) --}}

                                <li>
                                    <strong>Qty:</strong>
                                    {{ $item['quantity'] }}
                                </li>
                                @endforeach
                                <hr>
                                <li>
                                    <strong>Grand Total: </strong> ${{ $cartTotal }}
                                    <hr>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- checkout-progress-sidebar -->

            <div class="checkout-progress-sidebar ">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="unicase-checkout-title">Select Payment Method</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Stripe</label>
                                <input type="radio" name="payment_method" id="" value="stripe">

                            </div>
                            <div class="col-md-4">
                                <label for="">Card</label>
                                <input type="radio" name="payment_method" id="" value="card">

                            </div>
                            <div class="col-md-4">
                                <label for="">COD</label>
                                <input type="radio" name="payment_method" id="" value="cod">

                            </div>
                            @error('payment_method')
                            <span class="alert text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary checkout-page-button">Order
            Confirm</button>
        </form>
    </div><!-- /.row -->
</div>
@section('frontend_script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection
@endsection
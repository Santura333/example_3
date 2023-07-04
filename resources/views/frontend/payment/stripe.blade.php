@extends('frontend.frontend_master')

@section('title')
Stripe Page
@endsection

@section('frontend_style')

<style>
  /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
  .StripeElement {
    box-sizing: border-box;
    height: 40px;
    padding: 10px 12px;
    border: 1px solid transparent;
    border-radius: 4px;
    background-color: white;
    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
  }

  .StripeElement--focus {
    box-shadow: 0 1px 3px 0 #cfd7df;
  }

  .StripeElement--invalid {
    border-color: #fa755a;
  }

  .StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
  }
</style>
@endsection

@section('frontend_content')
<div class="checkout-box ">
  <div class="row">
    <div class="col-md-6">
      <!-- checkout-progress-sidebar -->
      <div class="checkout-progress-sidebar ">
        <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="unicase-checkout-title">Your Shopping Amount</h4>
            </div>
            <div class="">
              <ul class="nav nav-checkout-progress list-unstyled">
                <hr>
                <li>
                  <strong>Grand Total: </strong> ${{ $cartTotal }}

                </li>

              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- checkout-progress-sidebar -->
    </div>
    <div class="col-md-6">
      <div class="checkout-progress-sidebar ">
        <div class="panel-group">
          <form action="{{route('stripe.order')}}" method="post" id="payment-form">
            @csrf
            <div class="form-row">
              <label for="card-element">

                <input type="hidden" name="shipping_name" value="{{ $data['shipping_name'] }}">
                <input type="hidden" name="shipping_email" value="{{ $data['shipping_email'] }}">
                <input type="hidden" name="shipping_phone" value="{{ $data['shipping_phone'] }}">
                Credit or debit card
              </label>
              <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
              </div>

              <!-- Used to display Element errors. -->
              <div id="card-errors" role="alert"></div>
            </div>
            <br>
            <button class="btn btn-primary">Submit Payment</button>
          </form>
        </div>
      </div>
    </div>
  </div><!-- /.row -->
  <hr>
</div>
</div>
@endsection
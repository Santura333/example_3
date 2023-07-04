@extends('frontend.frontend_master')


@section('frontend_content')
<div class="body-content">
    <div class="container">

        <div class="product-info">
            <h1 class="name" id="pname">
                {{ $product->product_name }}
            </h1>
            <div class="rating-reviews m-t-20">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="reviews">
                            <a href="#" class="lnk">(13 Reviews)</a>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.rating-reviews -->

            <!-- /.stock-container -->
            <div class=" m-t-10">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="stock-box">
                            <span class="label">Availability :</span>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="stock-box">
                            @if ($product->product_qty<1) <span class="value">Out of Stock</span>
                                @else
                                <span class="value">In Stock</span>
                                @endif
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- END stock-container -->


            <div class="price-container info-container m-t-20">
                <div class="row">
                    <div class="col-sm-2">
                        <span>Purchase Price: </span>
                    </div>
                    <div class="col-sm-9">
                        <div class="price-box">
                            <span class="price">${{ $product->purchase_price }}</span>
                        </div>
                    </div>

                </div><!-- /.row -->
            </div><!-- /.price-container -->

            <!-- /.Quantity-container -->
            <div class="quantity-container info-container">
                <div class="row">
                    <div class="col-sm-2">
                        <span class="label">Quantity :</span>
                    </div>

                    <div class="col-sm-2">
                        <div class="cart-quantity">
                            <div class="quant-input">
                                <input type="number" id="qty" value="1" min="1">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-7">
                        <input type="hidden" name="" id="product_id" value="{{ $product->id }}" min="1">
                        <a href="{{ route('frontend.product.addToCart', $product->id)}}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                        </a>

                    </div>


                </div><!-- /.row -->
            </div><!-- /.quantity-container -->
        </div><!-- /.product-info -->



    </div>
    <!-- /.container -->

</div>
@endsection
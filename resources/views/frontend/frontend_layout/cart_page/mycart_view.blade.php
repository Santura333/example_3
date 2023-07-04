@extends('frontend.frontend_master')

@section('title')
Bakerz Bite - Cart Page
@endsection

@section('frontend_content')
<div class="body-content">
    <div class="container">

        <div class="my-wishlist-page">
            <div class="row">
                <div class="col-md-12 shopping-cart-table">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Remove</th>
                                </tr>
                                {{-- @if(session('cart'))
                                @foreach(session('cart') as $id => $details)

                                <tr rowId="{{ $id }}">
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price">${{ $details['price'] }}</td>
                                    <td data-th="Quantity">{{$details['quantity']}}</td>
                                    <td class="actions">
                                        <a class="btn btn-outline-danger btn-sm delete-product">Delete<i
                                                class="fa fa-trash-o"></i></a>
                                        <a class="btn btn-outline-danger btn-sm update-product">Update<i
                                                class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif --}}
                            </thead>

                            <tbody id="cartPage">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div>
                    <div>Total: <span id="total_bill"></span></div>
                </div>
                <div class="col-md-4 col-sm-12 ">
                    <table class="table">
                        <thead id="">
                        </thead><!-- /thead -->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="cart-checkout-btn pull-right">
                                        <a href="{{ route('checkout-page') }}" type="submit"
                                            class="btn btn-primary checkout-btn">PROCCED TO
                                            CHEKOUT</a>
                                        {{-- <span class="">Checkout with multiples address!</span> --}}
                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div>


            </div><!-- /.row -->
        </div>
    </div>
</div>
@endsection

{{-- goi o frontend.frontend_layout.body.script --}}
@section('frontend_script')
{{-- <script>
    $(".delete-product").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Do you really want to delete?")) {
            $.ajax({
                url: '{{ route('delete.cart.product') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("rowId")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

    $(".update-product").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ route('update.cart.product') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("rowId"), 
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

</script> --}}


<script>
    function cart() {
            $.ajax({
                type: 'GET',
                url: '/my-cart/list',
                dataType: 'json',
                success: function(response) {
                    var rows = ""
                    $.each(response.carts, function(key, value) {
                        var rowId = key; // Tạo id riêng cho mỗi hàng
                        // id="${rowId}-decrement"
                        rows += `<tr>
                               
                                <td class="col-md-2">
                                    <div class="product-name"><a href="#">${value.name}</a></div>                                    
                                </td>
                                <td><div class="price">$${value.price}</div></td>
                                
                                <td class="col-md-2">
                                ${value.quantity > 1
                                ? `<button type="submit" class="btn btn-danger btn-sm" id="${rowId}" onclick="cartDecrement(this.id)">-</button>`
                                :
                                `<button type="submit" class="btn btn-danger btn-sm" disabled>-</button>`
                                }
                                <input type="text" value="${value.quantity}" min="1" max="100" disabled="" style="width:25px;">
                                <button type="submit" class="btn btn-success btn-sm" id="${rowId}" onclick="cartIncrement(this.id)">+</button>
                                </td>
                                

                                <td class="col-md-1 close-btn">
                                    <button type="submit" class="" id="${rowId}" onclick="cartRemove(this.id)"><i class="fa fa-times"></i>Remove</button>
                                </td>
                            </tr>
                            `
                    });
                    //thay đổi nội dung của phần tử có id là cartPage. Cụ thể, nội dung mới sẽ được gán là giá trị của biến rows, được xây dựng trong quá trình lặp qua các mục trong phản hồi JSON (response.carts)
                    $('#cartPage').html(rows);
                    $('#total_bill').text(response.cart_total)
                }
            });
        }
        cart();
</script>

<script>
    // START product remove from my cart
            function cartRemove(id) {
            $.ajax({
                type: 'GET',
                url: '/remove/from-cart/' + id,
                dataType: 'json',
                success: function(data) {
                    cart();
                    // miniCart();
                    // couponCalField();
                    // $('#applyCouponField').show();
                    // $('#coupon_name').val('');
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            });
        }
        // END product remove from my cart
    // START product qty increment from my cart
            function cartIncrement(id) {
            $.ajax({
                type: 'GET',
                url: '/add/in-cart/' + id,
                dataType: 'json',
                success: function(data) {
                    cart();
                    // miniCart();
                    // couponCalField();
                    // Start Message
                    // Swal. la dung thu vien SweetAlert
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            });
        }
        //End product qty increment from my cart

        // START product qty Decrement from my cart
        function cartDecrement(id) {
            $.ajax({
                type: 'GET',
                url: '/reduce/from-cart/' + id,
                dataType: 'json',
                success: function(data) {
                    cart();
                    // miniCart();
                    // couponCalField();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            });
        }
        //End product qty Decrement from my cart
</script>


@endsection
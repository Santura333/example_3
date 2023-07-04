<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CheckoutStoreRequest;

class CheckoutController extends Controller
{
    //

    public function checkoutPage()
    {
        if (Auth::check()) {
            $cartItems = session()->get('cart', []);

            if ($cartItems && count($cartItems) > 0) {
                $cartQty = count($cartItems);
                $cartTotal = 0;
                foreach ($cartItems as $item) {
                    $cartTotal += $item['price'] * $item['quantity'];
                }

                return view('frontend.checkout_page.checkout_page', compact('cartItems', 'cartQty', 'cartTotal'));
            } else {
                $notification = [
                    'message' => 'Your shopping cart is empty!!',
                    'alert-type' => 'error'
                ];
                return redirect()->route('user.profile')->with($notification);
            }
        } else {
            $notification = [
                'message' => 'You need to Login First for Checkout',
                'alert-type' => 'error'
            ];
            return redirect()->route('login')->with($notification);
        }
    }

    public function checkoutStore(CheckoutStoreRequest $request)
    {

        $data = [];
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;

        $cartItems = session()->get('cart', []); // Lưu danh sách sản phẩm trong giỏ hàng
        $cartQty = 0; // Lưu tổng số lượng sản phẩm trong giỏ hàng
        $cartTotal = 0; // Lưu tổng giá trị của giỏ hàng

        if (Session::has('cart')) {
            $cartItems = Session::get('cart', []);
            $cartQty = count($cartItems);
            // sua lai cartTotal chi tinh 1 lan khi o cart-page , k can tinh toan moi lan goi cart
            foreach ($cartItems as $item) {
                $cartTotal += $item['price'] * $item['quantity'];
            }
        }

        if ($request->payment_method == 'stripe') {
            return view('frontend.payment.stripe', compact('cartTotal', 'data'));
        } elseif ($request->payment_method == 'card') {
            return "card";
        } else {
            return view('frontend.payment.cod', compact('cartTotal', 'data'));
        }

    }


}
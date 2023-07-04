<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartPageController extends Controller
{

    public function myCartView()
    {

        return view('frontend.frontend_layout.cart_page.mycart_view');
    }

    // public function showmyCartList()
// {

    //     $carts = Cart::content();
//     $cart_qty = Cart::count();
//     $cart_total = Cart::total();

    //     return response()->json([
//         'carts' => $carts,
//         'cart_qty' => $cart_qty,
//         'cart_total' => round($cart_total),
//     ], 200);
// }

    public function showmyCartList()
    {
        // $cartItems = session('cart.items', []); sua lai nhu duoi 
        $cartItems = session()->get('cart', []);
        $cartQty = count($cartItems);
        $cartTotal = 0;

        foreach ($cartItems as $item) {
            $cartTotal += $item['price'] * $item['quantity'];
        }

        return response()->json([
            'carts' => $cartItems,
            'cart_qty' => $cartQty,
            'cart_total' => round($cartTotal),
        ], 200);
    }

    public function addQtyToCart($rowId)
    {
        $cartItems = session()->get('cart', []);
        if (array_key_exists($rowId, $cartItems)) {
            $cartItems[$rowId]['quantity'] += 1;
            session(['cart' => $cartItems]);


            return response()->json(['success' => 'Product Qty Incremented'], 200);
        }

        return response()->json(['error' => 'Invalid Cart Item'], 400);
    }

    public function reduceQtyFromCart($rowId)
    {
        $cartItems = session()->get('cart', []);
        if (array_key_exists($rowId, $cartItems)) {
            $cartItems[$rowId]['quantity'] -= 1;
            session(['cart' => $cartItems]);

            return response()->json(['success' => 'Product Qty Decremented'], 200);
        }

        return response()->json(['error' => 'Invalid Cart Item', 400]);

    }

    private function calculateTotal()
    {
        $cartItems = session('cart.items', []);
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['qty'] * $item['price'];
        }
        return $total;
    }

    public function removeFromCart($rowId)
    {
        $cartItems = session()->get('cart', []);

        if (array_key_exists($rowId, $cartItems)) {
            unset($cartItems[$rowId]);

            session()->put('cart.items', $cartItems);

            return response()->json(['success' => 'Product Remove from Cart'], 200);
        }

        return response()->json(['error' => 'Product not found in Cart'], 404);
    }



}
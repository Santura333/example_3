<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Cart;

class CartController extends Controller
{
    //
// public function addToCart(Request $request, $id)
// {
//     $product = Product::findOrFail($id);


    //     if ($product->discount_price == NULL) {
//         Cart::add([
//             'id' => $id,
//             'name' => $request->product_name,
//             'qty' => $request->qty,
//             'price' => $product->purchase_price,
//         ]);

    //         return response()->json(['success' => 'Successfully added on your cart'], 200);
//     } else {
//         Cart::add([
//             'id' => $id,
//             'name' => $request->product_name,
//             'qty' => $request->qty,
//             'price' => $product->purchase_price,
//         ]);
//         return response()->json(['success' => 'Successfully added on your cart'], 200);
//     }
// } // END addTocart

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->product_name,
                "quantity" => $product->product_qty,
                "price" => $product->purchase_price,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->route('myCartView')->with('success', 'Product has been added to cart!');
    }

// public function deleteProduct(Request $request)
// {
//     if ($request->id) {
//         $cart = session()->get('cart');
//         if (isset($cart[$request->id])) {
//             unset($cart[$request->id]);
//             session()->put('cart', $cart);
//         }
//         session()->flash('success', 'Products successfully deleted.');
//     }
// }

// public function updateCart(Request $request)
// {
//     if ($request->id && $request->quantity) {
//         $cart = session()->get('cart');
//         $cart[$request->id]["quantity"] = $request->quantity;
//         session()->put('cart', $cart);
//         session()->flash('success', 'Product added to cart.');
//     }
// }




}
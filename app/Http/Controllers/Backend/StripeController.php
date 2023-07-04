<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderMail;

class StripeController extends Controller
{
    //
    public function stripeOrder(Request $request)
    {
        // Session Coupon check
        $total_amount = 0;
        // Order Service Area
        $order = new Order();
        $order->user_id = Auth::id();

        $order->name = $request->input('shipping_name');
        $order->email = $request->input('shipping_email');
        $order->phone = $request->input('shipping_phone');

        $order->payment_type = 'Stripe';
        $order->payment_method = 'Stripe';
        $order->amount = $total_amount;
        $order->order_number = uniqid();
        $order->order_date = Carbon::now()->format('d F Y');
        $order->order_month = Carbon::now()->format('F');
        $order->order_year = Carbon::now()->format('Y');

        $order->save();
        $order_id = $order->id;

        // Start Send Email
        $data = [
            'amount' => $total_amount,
            'name' => $order->name,
            'email' => $order->email,
        ];
        Mail::to($order->email)->send(new OrderMail($data));
        // End Send Email

        // Cart Service Area
        $carts = session()->get('cart');
        foreach ($carts as $key => $cart) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order_id;
            $orderItem->product_id = $cart['product_id'];
            $orderItem->color = $cart['color'];
            $orderItem->size = $cart['size'];
            $orderItem->qty = $cart['quantity'];
            $orderItem->unit_price = $cart['price'];
            $orderItem->save();
        }

        // Then Destroy cart
        session()->forget('cart');

        $notification = [
            'message' => 'Your Order Place Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('dashboard')->with($notification);
    }
}
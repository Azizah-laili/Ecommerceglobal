<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    //01 checkout
    public function checkout()
    {
        $user_id=Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();

        if($carts==null)
        {
            return Redirect::back();
        }

        $order = Order::create([
            'user_id'=>$user_id
        ]);
        foreach($carts as $cart){
            Transaction::create([
                'amount' => $cart->amount,
                'order_id' => $order->id,
                'product_id' => $cart->product_id
            ]);
        }
        return Redirect::back();
    }
}

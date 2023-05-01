<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    //01 Show cart, construct berguna semua fungsi di bawah dapat diakses dengan user di auntentikasi dulu lanjut ke bawah (show_cart)
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    //01 cart ini bisa menerima 2 paramter yaitu product dan request
    public function add_to_cart(Product $product,Request $request)
    {
                //3 akses user yg telah login
                $user_id = Auth::id();
                $product_id = $product->id;
        
        //1 refactor add to cart, agar tidak redudant data
        $existing_cart = Cart::where ('product_id',$product_id)
        ->where('user_id',$user_id)
        ->first();

        if($existing_cart ==null)

        {
        //2buat validasi tentang apakah amount lebih besar dari 0 (grather than)gte
        $request->validate([
            'amount'=>'required|gte:1|lte:'.$product->stock,
        ]);


        //4buat object cart, lalu lanjut ke web.php 
        Cart::create([
            'user_id' => $user_id,
            'product_id'=>$product_id,
            'amount'=>$request->amount,
        ]);
    }else
    {
        $request->validate([
            'amount'=>'required|gte:1|lte:'.($product->stock - $existing_cart->amount)
        ]);
        
        $existing_cart->update([
            'amount'=>$existing_cart->amount + $request->amount
        ]);
    }
        /* return redirect()->back(); */
       return Redirect::route('show_cart');
       
    }

    //02 show_cart lanjut ke view show_cart
    public function show_cart()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();
        return view('show_carts', compact('carts'));
    }

    //01.update Cart, lanjut ke web.php
    public function update_cart(Cart $cart, Request $request)
    {
        $request-> validate([
            'amount'=>'required|gte:1|lte:'.$cart->product->stock
        ]);
        $cart->update([
            'amount'=>$request->amount
        ]);
        return Redirect::route('show_cart');
    }

    //01 delete cart, lanjut ke web.php
    public function delete_cart(Cart $cart)
    {
        $cart->delete();
        return Redirect::back();
    }
}

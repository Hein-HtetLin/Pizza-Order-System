<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function list(){
        $cart = Cart::select('carts.*','products.name as product_name','products.image as product_image','products.price as product_price')
        ->leftJoin('products','products.id','carts.product_id')
        ->get();

        $totalPrice = 0;
        foreach($cart as $c){
            $price = $c->product_price*$c->qty;
            $totalPrice += $price;
        }

       return view('user.Cart.list',compact('cart','totalPrice'));
    }

    public function orderList(){
        $order = Order::where('user_id',Auth::user()->id)->get();
        return view('user.Cart.orderList',compact('order'));
    }


    public function mail(){
        return view('user.Cart.mail');
    }
}

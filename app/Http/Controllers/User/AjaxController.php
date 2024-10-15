<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //
    public function sorting(Request $request){

        $products = Product::orderBy('created_at',$request->status)->get();
        return response()->json(
            ['data'=>$products]
        );
    }
    public function addCart(Request $request){
        // logger($request->productId);
        Cart::create([
            'product_id' => $request->productId,
            'user_id' =>$request->userId,
            'qty' => $request->qty
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function order(Request $request){
        $totalPrice = 0;
        $orderCode = '';
        forEach($request->all() as $i){
            OrderList::create($i);
            $totalPrice += $i['total'];
            $orderCode = $i['order_code'];
        }
        Cart::where('user_id',Auth::user()->id)->delete();
        Order::create([
            'total_price'=>$totalPrice+3000,
            'order_code'=>$orderCode,
            'user_id' =>Auth::user()->id
        ]);
        return response()->json([
            'success'=>'order success'
        ]);
    }

    public function cartDelete(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    public function mail(Request $request){
        $user = User::where('id',$request->userId)->first();
        Contact::create([
            'name' => $user->name,
            'email' => $user->email,
            'order_code' => $request->orderCode,
            'message' => $request->message
        ]);
        return response()->json([
            'message' => 'success'
        ]);

    }

    public function view(Request $request){
        $product = Product::where('id',$request->id)->first();
        $view = $product->view_count;
        // logger($view+1);
        Product::where('id' ,$request->id)->update([
            'view_count' => $view+1,
        ]);
        return response()->json([
            'message' => 'success'
        ]);

    }


}

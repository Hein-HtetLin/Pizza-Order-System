<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function order(Request $request){
        logger($request);
        // dd(request('status'));
        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id');
        if($request->status == 'NULL'){
                $order = $order->get();}
        else{
            $order = $order->where('status',$request->status)->get();
        }
        return view('admin.order.order',compact('order'));
    }

    public function changeStatus(Request $request){
        Order::where('id',$request->order_id)->update(
            ['status'=>$request->status]
        );
        return response()->json([
            'message'=>'success change status'
        ]);
    }

    public function detail($orderCode){
        $order = Order::where('order_code',$orderCode)->first();
        $data = OrderList::select('order_lists.*','products.name as product_name','products.image as product_image','users.name as user_name')
        ->leftJoin('products','products.id','order_lists.product_id')
        ->leftJoin('users','users.id','order_lists.user_id')
        ->where('order_code',$orderCode)
        ->get();
        // dd($data->toArray());
        return view('admin.order.orderList',compact('data','order'));
    }
}

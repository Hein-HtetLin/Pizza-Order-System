@extends('admin.layouts.index')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order Detail</h2>

                        </div>
                    </div>
                </div>
                <button class="btn btn-outline-dark mb-3" onclick="history.back()">
                    <i class="fas fa-arrow-left cursor-pointer"></i> back

                </button>
                <div class="card col-6">
                    <div class="card-body fs-3"><i class="fas fa-clipboard"></i> Order</div>
                    <div class="card-body">
                        <p>Name - {{$data[0]->user_name}}</p>
                        <p>Order-Code - {{$data[0]->order_code}}</p>
                        <p>Total-Price(Include Delivery Fees) - {{$order->total_price}} kyats</p>
                        <p>Order-Date - {{$order->created_at->format('j-F-Y')}}</p>
                        <p>Order-Status - @if ($order->status == 0)
                            <small class="text-warning block-email">Pending</small>
                        @elseif($order->status == 1)
                        <small class="text-success block-email">Success</small>
                        @elseif($order->status == 2)
                        <small class="text-danger block-email">Reject</small>
                        @endif</p>

                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>

                            </tr>
                            <tr class="spacer"></tr>
                        </thead>
                        @foreach ($data as $d)
                        <tbody class="data">
                            <tr>
                                <td><img src="{{asset('storage/'.$d->product_image)}}" width='70px' alt=""></td>
                                <td>{{$d->product_name}}</td>
                                <td>{{$d->qty}}</td>
                                <td>{{$d->total}} kyats</td>

                            </tr>
                            <tr class="spacer"></tr>
                        </tbody>
                         @endforeach
                    </table>
                </div>
                <!-- END DATA TABLE -->
            </div>
            <div>
                {{-- {{$order->links()}} --}}

            </div>
        </div>
    </div>
</div>
@endsection

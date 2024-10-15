@extends('admin.layouts.index')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap d-flex justify-content-between">
                            <h2 class="title-1">Order Lists</h2>
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        {{-- <label for="" class="form-label"> choose status </label> --}}
                        <form action="{{route('order#list')}}" method="get" id="form">
                            @csrf
                            <select class="form-control" name="status" id="status">

                                <option>Choose Status</option>
                                <option value="NULL">All</option>
                                <option value='0'>Pending</option>
                                <option value="1">success</option>
                                <option value="2">cancle</option>
                            </select>
                            {{-- <button type='submit' id='hiddenBtn' class="d-none"></button> --}}
                        </form>

                    </div>
                </div>

                {{-- <div class="d-flex justify-content-end mb-3">

                    <form class="form-header" action="{{ route('product#list') }}" method="GET">
                        @csrf
                        <input class="au-input au-input--lg" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div> --}}
                @if (count($order) > 0)

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Order Code</th>
                                <th>Status</th>
                                {{-- <th></th> --}}
                            </tr>
                            <tr class="spacer"></tr>
                        </thead>
                        @foreach ($order as $o)
                        <tbody class="data">
                            <tr class="tr-shadow">
                                <td>
                                    <input type="hidden" value='{{$o->id}}' class="order">
                                    <span class="block-email">{{$o->user_name}}</span>
                                </td>
                                <td>{{$o->total_price}} kyats</td>
                                <td>{{$o->created_at->format('j-F-Y')}}</td>
                                <td><a href="{{route('order#detail',$o->order_code)}}" class="text-primary">{{$o->order_code}}</a></td>
                                <td class="d-flex gap-2">

                                    <div class="table-data-feature">
                                        <div id="penBtn" class="btn btn-sm @if($o->status == 0) btn-warning @else btn-outline-warning @endif">pending...</div>
                                    </div>
                                    <div class="table-data-feature">

                                        <div id="sucBtn" class="btn btn-sm @if($o->status == 1) btn-success @else btn-outline-success @endif">success...</div>
                                    </div>

                                    <div class="table-data-feature">

                                        <div id="canBtn" class="btn btn-sm @if($o->status == 2) btn-danger @else btn-outline-danger @endif">cancle....</div>
                                    </div>

                                </td>
                                {{-- <td>
                                    <div class="table-data-feature">
                                        <a href="{{route('product#detail',$product->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href={{route('product#edit',$product->id)}} class="mx-2">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('product#delete',$product->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td> --}}
                            </tr>
                            <tr class="spacer"></tr>
                        </tbody>
                         @endforeach
                    </table>
                </div>
                @else
                <h3>There is no Products data to show</h3>
                @endif
                <!-- END DATA TABLE -->
            </div>
            <div>
                {{-- {{$order->links()}} --}}

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#status').change(function(){
            $('#form').submit()
        })


        $('.data tr').each(function(index,row){
            $(row).find('#penBtn').click(function(){
                $orderId = $(row).find('.order').val();
                $(row).find('#penBtn').attr('class','btn-warning btn btn-sm')
                $(row).find('#canBtn').attr('class','btn-outline-danger btn btn-sm')
                $(row).find('#sucBtn').attr('class','btn-outline-success btn btn-sm')

                $.ajax({
                    type:'get',
                    url:'http://localhost:8000/adminOrder/change/status',
                    data:{
                        'order_id':$orderId,
                        'status':0
                    },
                    dataType:'json',
                    success:function(res){
                        console.log(res.message)
                    }
                })
        })
        $(row).find('#canBtn').click(function(){
            $orderId = $(row).find('.order').val();
                $(row).find('#canBtn').attr('class','btn-danger btn btn-sm')
                $(row).find('#penBtn').attr('class','btn-outline-warning btn btn-sm')
                $(row).find('#sucBtn').attr('class','btn-outline-success btn btn-sm')

                $.ajax({
                    type:'get',
                    url:'http://localhost:8000/adminOrder/change/status',
                    data:{
                        'order_id':$orderId,
                        'status':2
                    },
                    dataType:'json',
                    success:function(res){
                        console.log(res.message)
                    }
                })
        })
        $(row).find('#sucBtn').click(function(){
            $orderId = $(row).find('.order').val();
                $(row).find('#sucBtn').attr('class','btn-success btn btn-sm')
                $(row).find('#canBtn').attr('class','btn-outline-danger btn btn-sm')
                $(row).find('#penBtn').attr('class','btn-outline-warning btn btn-sm')

                $.ajax({
                    type:'get',
                    url:'http://localhost:8000/adminOrder/change/status',
                    data:{
                        'order_id':$orderId,
                        'status':1
                    },
                    dataType:'json',
                    success:function(res){
                        console.log(res.message)
                    }
                })
        })
        })
        // $('#canBtn').click(function(){
        //     $('#canBtn').attr('class','btn-danger btn btn-sm')
        // })
        // $('#sucBtn').click(function(){
        //     $('#sucBtn').attr('class','btn-success btn btn-sm')
        // })
    })
</script>
@endsection


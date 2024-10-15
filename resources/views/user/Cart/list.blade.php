@extends('user.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5" id='row'>
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle" id="data">
                    @foreach ($cart as $c)
                    <tr>
                        <td><img src="{{asset('storage/'.$c->product_image)}}" style="width: 50px;"></td>
                        <td class="align-middle">{{$c->product_name}}</td>
                        <input type="hidden"  class="productId" value="{{$c->product_id}}">
                        <input type="hidden" class="userId" value="{{Auth::user()->id}}">
                        <td class="align-middle price">{{$c->product_price}} kyats</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" id='qty' value="{{$c->qty}}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle" id='price'>{{$c->product_price * $c->qty}} kyats</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="orderPrice">{{$totalPrice}} kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">delivery Fees</h6>
                        <h6 class="font-weight-medium">3000 Kyats</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="finalPrice">{{$totalPrice + 3000}} kyats</h5>
                    </div>
                    <button id='cartBtn' class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    <button  id='clearBtn' class="btn btn-block btn-danger font-weight-bold my-3 py-3">Clear Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        // qty change price change
        $('.btn-plus').click(function(){
            $parentNode = $(this).parents('tr')
            $price = $parentNode.find('.price').text().replace('kyats','');
            console.log($price)
            $qty = $parentNode.find('#qty').val()
            // $total price = $parentNode.find('#price').text()
            $total = $price * $qty

            $parentNode.find('#price').text(`${$total} kyats`)
            $totalPrice = 0;
            $('#data tr').each(function(index,row){
                $totalPrice +=($(row).find('#price').text().replace('kyats',''))*1
            })
            $('#orderPrice').text(`${$totalPrice} Kyats`);
            $('#finalPrice').text(`${$totalPrice+3000} Kyats`);

        })
        $('.btn-minus').click(function(){
            $parentNode = $(this).parents('tr')
            $price = $parentNode.find('.price').text().replace('kyats','');
            $qty = $parentNode.find('#qty').val()
            // $total price = $parentNode.find('#price').text()
            $total = $price * $qty
            $parentNode.find('#price').text(`${$total} kyats`)
            $totalPrice = 0;
            $('#data tr').each(function(index,row){
                $totalPrice +=($(row).find('#price').text().replace('kyats',''))*1
            })
            $('#orderPrice').text(`${$totalPrice} Kyats`);
            $('#finalPrice').text(`${$totalPrice+3000} Kyats`);

        })
        $('.btn-danger').click(function(){
            $parentNode = $(this).parents('tr')
            $parentNode.remove()
            $totalPrice = 0;
            $('#data tr').each(function(index,row){
                $totalPrice +=($(row).find('#price').text().replace('kyats',''))*1
            })
            $('#orderPrice').text(`${$totalPrice} Kyats`);
            $('#finalPrice').text(`${$totalPrice+3000} Kyats`);
        })

        $('#cartBtn').click(function(){
            $orderList = [];
            $orderCode = Math.floor(Math.random()*1005000)
            $('#data tr').each(function(index,row){
                $total = $(row).find('#price').text().replace('kyats','')
                $orderList.push({
                    'user_id': ($(row).find('.userId').val())*1 ,
                    'product_id':($(row).find('.productId').val())*1,
                    'total': $total*1,
                    'qty' :($(row).find('#qty').val())*1,
                    'order_code': `POS0000${$orderCode}`
                })
            })
            // $.ajax()
            // console.log(Object.assign({},$orderList))
            $.ajax({
                type:'get',
                url:'http://localhost:8000/user/order',
                data:Object.assign({},$orderList),
                dataType:'json',
                success:function(res){
                    window.location.href = 'http://localhost:8000/user/home'
                }
            })
        })

        $('#clearBtn').click(function(){
            $('#data').remove()
            $totalPrice = 0;
            $('#data tr').each(function(index,row){
                $totalPrice +=($(row).find('#price').text())*1
            })
            $('#orderPrice').text(`${$totalPrice} Kyats`);
            $('#finalPrice').text(`${$totalPrice+3000} Kyats`);

            $.ajax({
                type:'get',
                url:'http://localhost:8000/user/cart/delete',
                dataTyp:'json'
            })
        })







    // $productId = $('#product').val();
    // $userId = $('#user').val();

    // $('#goCart').click(function(){
    //     $count = $('#count').val()
    //     $data = {
    //         'productId' : $productId,
    //         'userId' :$userId,
    //         'qty' : $count
    //     }
    //     console.log($data)

        // $.ajax({
        //     type:'get',
        //     url:'http://localhost:8000/user/addCart',
        //     data:$data,
        //     dataType:'json',
        //     success:function(res){
        //         if(res.status == 'success'){
        //             window.location.href = 'http://localhost:8000/user/home'

        //         }
        //     }
        // })
    // })
})

</script>
@endsection

@extends('user.layouts.master')


@section('content')
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <img class="w-100 h-100" src="{{asset('storage/'.$product->image)}}" alt="Image">
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{$product->name}}</h3>
                <div class="d-flex mb-3">
                    {{-- <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div> --}}
                    <small class="pt-1"><i class="fas fa-eye mx-2"></i>{{$product->view_count}} views</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">{{$product->price}} Kyats</h3>
                <p class="mb-4">{{$product->description}}</p>
                <div class="d-flex align-items-center mb-4 pt-2" id='addCart'>
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus" id="minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" id="count" class="form-control bg-secondary border-0 text-center" value="1">

                        <input type="hidden" id='product' value="{{$product->id}}">
                        <input type="hidden" id='user' value='{{Auth::user()->id}}'>
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus" id="plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button id="goCart" type="button" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                        Cart</button>
                </div>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">Share on:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel" id="slide">
                @foreach ($products as $p)
                <div class="product-item bg-light" id='data'>
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{asset('storage/'.$p->image)}}" alt="">
                        <div class="product-action">
                            {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-info"></i></a> --}}
                            {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a> --}}
                            <a class="btn btn-outline-dark btn-square" id='count' href="{{route('user#productDetail',$p->id)}}"><i class="fa fa-info"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                        <input type="hidden" id='product' value="{{$p->id}}">
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>{{$p->price}}</h5>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="pt-1"><i class="fas fa-eye mx-2"></i>{{$p->view_count}} views</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#slide #data').each(function(index,row){
            $(row).find('#count').click(function(){
                $productId = $(row).find('#product').val()
                // console.log($productId)
                $.ajax({
                        type:'get',
                        url:'http://localhost:8000/user/product/view',
                        data : {
                            'id' : $productId
                        },
                        dataType:'json',
                })
            })
        })





    $productId = $('#product').val();
    $userId = $('#user').val();

    $('#goCart').click(function(){
        $count = $('#count').val()
        $data = {
            'productId' : $productId,
            'userId' :$userId,
            'qty' : $count
        }
        console.log($data)

        $.ajax({
            type:'get',
            url:'http://localhost:8000/user/addCart',
            data:$data,
            dataType:'json',
            success:function(res){
                if(res.status == 'success'){
                    window.location.href = 'http://localhost:8000/user/home'

                }
            }
        })
    })
})

</script>
@endsection

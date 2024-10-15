@extends('user.layouts.master')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Category</span></h5>
                <div class="bg-light mb-30 py-2 navbar-nav text-center text-secondary">
                    <form class="bg-light" style="width: 100%" action="{{route('user#home')}}" method="get">
                        <input type="hidden" name="cate" value="">
                        <button class="w-full btn btn-secondary" style="width: 100%" type="submit">
                                All
                        </button>
                    </form>
                    @foreach ($categories as $c)
                    <form class="bg-light" style="width: 100%" action="{{route('user#home')}}" method="get">
                        <input type="hidden" name="cate" value="{{$c->id}}">
                        <button class="w-full btn bg-white" style="width: 100%" type="submit">
                                {{$c->name}}
                        </button>
                    </form>

                    @endforeach


                </div>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="">
                                <a href="{{route('user#cartList')}}">

                                    <button type="button" class="btn btn-dark rounded position-relative">
                                        <i class="fas fa-shopping-cart text-primary"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{count($cart)}}
                                            {{-- <span class="visually-hidden">unread messages</span> --}}
                                        </span>
                                    </button>
                                </a>
                                <a href="{{route('user#orderList')}}">
                                    <button type="button" class="btn btn-dark text-white position-relative mx-3 rounded">
                                        Notification
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{count($order)}}
                                            {{-- <span class="visually-hidden">unread messages</span> --}}
                                        </span>
                                    </button>
                                </a>
                                </div>
                            {{-- <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div> --}}
                            <div class="ml-2">
                                <div class="btn-group">
                                    {{-- <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" id="ASC" href="#">ASC</a>
                                        <a class="dropdown-item" href="#">DESC</a>
                                    </div> --}}
                                    <select id="option" class="form-control">
                                        <option value="">Sorting</option>
                                        <option value="asc">ASC</option>
                                        <option value="desc">DESC</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row sort">
                        @if (count($products) == 0 )
                            <p class="h1">There is No Data</p>
                        @endif
                        @foreach ($products as $p)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="data">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('storage/'.$p->image)}}" alt="">
                                     <div class="product-action">
                                        {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a> --}}
                                        {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a> --}}
                                        <a class="btn btn-outline-dark btn-square" id='count' href="{{route('user#productDetail',$p->id)}}"><i class="fa fa-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <input type="hidden" id='product' value="{{$p->id}}">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{$p->price}} kyats</h5>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="pt-1"><i class="fas fa-eye mx-2"></i>{{$p->view_count}} views</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('.sort #data').each(function(index,row){
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


    $('#option').change(function(){
        $option = $('#option').val()

        if($option == 'asc'){
            $.ajax({
                type:'get',
                url:'http://localhost:8000/user/sort',
                data:{'status':'asc'},
                dataType:'json',
                success:function(res){
                    // $id = res.data[$i].id;
                    $list = '';
                    for($i=0;$i < res.data.length;$i++){
                        $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('storage/${res.data[$i].image}')}}" alt="">
                                     <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a> --}}
                                        <a class="btn btn-outline-dark btn-square" href='http://localhost:8000/user/product/detail/${res.data[$i].id}'><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${res.data[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${res.data[$i].price} kyats</h5>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                            </div>

                        `
                    }
                    $('.sort').html($list)
                }
            })
        }

        if($option == 'desc'){
            $.ajax({
                type:'get',
                url:'http://localhost:8000/user/sort',
                data:{'status':'desc'},
                dataType:'json',
                success:function(res){
                    $list = '';
                    for($i=0;$i < res.data.length;$i++){
                    // $id = res.data[$i].id;
                        $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('storage/${res.data[$i].image}')}}" alt="">
                                     <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a> --}}
                                        <a class="btn btn-outline-dark btn-square" href='http://localhost:8000/user/product/detail/${res.data[$i].id}'><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${res.data[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${res.data[$i].price} kyats</h5>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                            </div>

                        `
                    }
                    $('.sort').html($list)
                }
            })
        }
    })

})
</script>
@endsection

@extends('admin.layouts.index')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            {{-- <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div> --}}
            <div class="col-lg-6 offset-3">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Product Detail</h3>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <a href="{{route('product#edit',$product->id)}}">
                                <button class="btn btn-outline-dark rounded" data-toggle="tooltip" title="edit"><i class="fas fa-edit"></i></button>

                            </a>
                        </div>
                        <div class="d-flex p-5 justify-content-center">
                            <div class="">
                                <img class="shadow object-fit" style="width:130px;height:130px" src="{{asset('storage/'.$product->image)}}">
                            </div>
                            <div class="mx-3">
                                <h3>{{$product->name}}</h3>
                                <div class="d-flex gap-1 my-2">

                                    <p class="bg-dark text-white px-1 rounded"><i class="fas fa-menu mx-1"></i>{{$product->category_id}}</p>
                                    <p class="bg-dark text-white px-1 rounded"><i class="fas fa-clock mx-1"></i>{{$product->waiting_time}}</p>
                                    <p class="bg-dark text-white px-1 rounded"><i class="fas fa-price mx-1"></i>{{$product->price}}</p>
                                    <p class="bg-dark text-white px-1 rounded"><i class="fas fa-eye mx-1"></i>{{$product->view_count}}</p>


                                </div>
                                <small>{{$product->description}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
                            <h3 class="text-center title-2">Product Edit</h3>
                        </div>
                        <hr>
                        <button class="btn btn-outline-dark" onclick="history.back()">
                            <i class="fas fa-arrow-left cursor-pointer"></i> back

                        </button>
                        {{-- <div class="d-flex justify-content-end">
                            <a href="{{route('admin#edit')}}">
                                <button class="btn btn-warning"></button>

                            </a>
                        </div> --}}
                        <form action="{{route('product#update',$product->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="d-flex p-5 justify-content-center align-items-center">
                            <div class="text-center">
                                <img class="shadow object-fit" style="width:200px;height:200px" src="{{asset('storage/'.$product->image)}}">
                                <input type="file"name='image'  class="form-control my-3">
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount"><i class="fas fa-arrow-alt-circle-right mx-2"></i>Create</span>
                                        <span id="payment-button-sending" style="display:none;"><i class="fas fa-arrow-alt-circle-right"></i>Sending…</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mx-3">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="name" value="{{old('name',$product->name)}}" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="product name">
                                    @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <input type="hidden" value="{{$product->id}}" name='productId'>
                                <div class="form-group">
                                    {{-- <label for="inputEmail" class="col-sm-2 col-form-label">Category</label> --}}
                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                    {{-- <div class=""> --}}
                                        <select name="category"  class="form-control">

                                                <option value={{Null}}>Choose Category</option>
                                                @foreach ($categories as $cate)
                                                @if ($product->category_id == $cate->id)

                                                <option selected value={{$cate->id}}>{{$cate->name}}</option>
                                                @else
                                                <option value={{$cate->id}}>{{$cate->name}}</option>
                                                @endif

                                                @endforeach
                                        </select>
                                      {{-- <input type="email" class="form-control" id="inputEmail" placeholder="Email"> --}}
                                    {{-- </div> --}}
                                    @error('category')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                    <input id="cc-pament" value="{{old('description',$product->description)}}" name="description" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="product description">
                                    @error('description')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                    <input id="cc-pament" name="price" value="{{old('price',$product->price)}}" type="number" class="form-control" aria-required="true" aria-invalid="false" placeholder="Price">
                                    @error('price')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                    <input id="cc-pament" name="time" type="number" value="{{old('time',$product->waiting_time)}}" class="form-control" aria-required="true" aria-invalid="false" placeholder="Waiting time">
                                    @error('time')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

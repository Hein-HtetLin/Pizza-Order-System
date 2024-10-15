@extends('admin.layouts.index')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Product Form</h3>
                        </div>
                        <hr>
                        <form action="{{route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="product name">
                                @error('name')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Category</label>
                                <div class="">
                                    <select name="category"  class="form-control">
                                            <option value={{Null}}>Choose Category</option>
                                            @foreach ($categories as $cate)
                                            <option value={{$cate->id}}>{{$cate->name}}</option>

                                            @endforeach
                                    </select>
                                  {{-- <input type="email" class="form-control" id="inputEmail" placeholder="Email"> --}}
                                </div>
                                @error('category')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                <input id="cc-pament" name="description" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="product description">
                                @error('description')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="price" type="number" class="form-control" aria-required="true" aria-invalid="false" placeholder="Price">
                                @error('price')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                <input id="cc-pament" name="time" type="number" class="form-control" aria-required="true" aria-invalid="false" placeholder="Waiting time">
                                @error('time')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">IMAGE</label>
                                <input name="image" type="file" class="form-control">
                                @error('image')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>


                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

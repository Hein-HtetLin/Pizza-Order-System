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
                            <h3 class="text-center title-2">Profile Edit</h3>
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
                        <form action="{{route('admin#edit',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="d-flex p-5 justify-content-center align-items-center">
                            <div class="text-center">
                                @if (Auth::user()->image == null && Auth::user()->gender == 'male')
                                <img class="rounded-circle shadow object-fit-cover" style="width:130px;height:130px" src="{{asset('admin/images/default-male.png')}}" alt="">
                                @elseif (Auth::user()->image == null && Auth::user()->gender == 'female')
                                <img class="rounded-circle shadow" style="width:130px;height:130px"  src="{{asset('admin/images/default-female.jpg')}}" alt="">
                                @else
                                <img class="rounded-circle shadow object-fit" style="width:150px;height:150px" src="{{asset('storage/'.Auth::user()->image)}}">
                                @endif
                                <input type="file"name='image'  class="form-control my-3">
                                @error('image')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
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
                                        <input id="cc-pament" value="{{old('name',Auth::user()->name)}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter your Name">
                                        @error('name')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">E-Mail</label>
                                        <input id="cc-pament" value="{{old('name',Auth::user()->email)}}"  name="email" type="email" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Email">
                                        @error('email')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" value="{{old('name',Auth::user()->phone)}}"  name="phone" type="number" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter your Phone">
                                        @error('phone')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Address</label>
                                        <textarea id="cc-pament"  name="address" type="text" class="form-control" aria-required="true" aria-invalid="false">{{old('name',Auth::user()->address)}}</textarea>
                                        @error('address')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control" id="">
                                            @if(Auth::user()->gender == 'male')
                                            <option>Select Your Gender</option>
                                            <option value="male" selected>Male</option>
                                            <option value="female">Female</option>
                                            @endif
                                            @if(Auth::user()->gender == 'female')
                                            <option>Select Your Gender</option>
                                            <option value="male" >Male</option>
                                            <option value="female" selected>Female</option>
                                            @endif
                                        </select>
                                        @error('gender')
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

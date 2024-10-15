@extends('user.layouts.master')
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
                            <h3 class="text-center title-2">Profile</h3>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <a href="{{route('user#edit')}}">
                                <button class="btn btn-outline-dark rounded" data-toggle="tooltip" title="edit"><i class="fas fa-edit"></i></button>

                            </a>
                        </div>
                        <div class="d-flex p-5 justify-content-center align-items-center">
                            <div class="">
                                @if (Auth::user()->image == null && Auth::user()->gender == 'male')
                                <img class="rounded-circle shadow object-fit-cover" style="width:130px;height:130px" src="{{asset('admin/images/default-male.png')}}" alt="">
                                @elseif (Auth::user()->image == null && Auth::user()->gender == 'female')
                                <img class="rounded-circle shadow" style="width:130px;height:130px"  src="{{asset('admin/images/default-female.jpg')}}" alt="">
                                @else
                                <img class="rounded-circle shadow object-fit" style="width:150px;height:150px" src="{{asset('storage/'.Auth::user()->image)}}">
                                @endif
                            </div>
                            <div class="mx-3">
                                <h5>{{Auth::user()->name}} - <small class="mx-2 text-success">{{Auth::user()->role}}</small></h5>
                                <p>{{Auth::user()->email}}</p>
                                <p>{{Auth::user()->phone}}</p>
                                <p>{{Auth::user()->address}}</p>
                                <p>{{Auth::user()->gender}}</p>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


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
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">

                    <form class="form-header" action="{{ route('admin#list') }}" method="GET">
                        @csrf
                        <input class="au-input au-input--lg" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>
                @if (count($admin) > 0)

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                {{-- <th></th> --}}
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone-Number</th>
                                <th>Gender</th>
                                <th>Role</th>
                                <th></th>
                                {{-- <th>views</th> --}}
                                {{-- <th></th> --}}
                            </tr>
                            <tr class="spacer"></tr>
                        </thead>
                        @foreach ($admin as $a)
                        <tbody class="data">
                            <tr class="tr-shadow">
                                {{-- <td></td> --}}
                                <input type="hidden" id="userId" value="{{$a->id}}">

                                <td>
                                    @if ($a->image == null && $a->gender == 'male')
                                                    <img style="width: 60px; height:60px"  class="rounded-circle shadow object-fit-cover"  src="{{asset('admin/images/default-male.png')}}" alt="">
                                                    @elseif ($a->image == null && $a->gender == 'female')
                                                    <img style="width: 60px; height:60px"  class="rounded-circle shadow"  src="{{asset('admin/images/default-female.jpg')}}" alt="">
                                                    @else
                                    <img style="width: 60px; height:60px" class="rounded-circle shadow object-fill" src="{{asset('storage/'.$a->image)}}">
                                    @endif
                                </td>
                                <td>
                                    <span class="block-email">{{$a->name}}</span>
                                </td>
                                <td>{{$a->email}}</td>
                                <td>{{$a->address}}</td>
                                <td>{{$a->phone}}</td>
                                <td>{{$a->gender}}</td>
                                <td>{{$a->role}}</td>
                                <td><button class="btn btn-outline-warning btn-sm @if ($a->id == Auth::user()->id)
                                    disabled
                                @endif" id="role"><small>Click To Change User</small> </button ></td>
                                {{-- <td>{{$product->view_count}}</td> --}}
                                {{-- <td>
                                    <div class="table-data-feature">
                                        <a href="{{route('product#detail',$a->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href={{route('product#edit',$a->id)}} class="mx-2">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('product#delete',$a->id)}}">
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
                {{-- {{$a->links()}} --}}

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $userId = ''
            $('.data tr').each(function(index,row){
                $(row).find('#role').click(function(){
                    $userId = $(row).find('#userId').val()
                    $(row).find('#role').parents('tr').remove()
                    // console.log($userId)

                    $.ajax({
                    type:'get',
                    url:'http://localhost:8000/admin/changeRole',
                    data:{
                        'role' : "user",
                        'userId':$userId
                    },
                    dataType:'json',
                    success:function(res){
                        console.log(res.message)
                    }

                })
                })

            })
        })
    </script>
@endsection

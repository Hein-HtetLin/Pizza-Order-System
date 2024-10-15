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
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('product#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Product
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">

                    <form class="form-header" action="{{ route('product#list') }}" method="GET">
                        @csrf
                        <input class="au-input au-input--lg" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>
                @if (count($products) > 0)

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Wating Time</th>
                                <th>Category</th>
                                <th>price</th>
                                <th>views</th>
                                <th></th>
                            </tr>
                            <tr class="spacer"></tr>
                        </thead>
                        @foreach ($products as $product)
                        <tbody>
                            <tr class="tr-shadow">
                                <td><img width="100px" src="{{asset('storage/'.$product->image)}}"></td>
                                <td>
                                    <span class="block-email">{{$product->name}}</span>
                                </td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->waiting_time}}</td>
                                <td>{{$product->category_name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->view_count}}</td>
                                <td>
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
                                </td>
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
                {{$products->links()}}

            </div>
        </div>
    </div>
</div>
@endsection

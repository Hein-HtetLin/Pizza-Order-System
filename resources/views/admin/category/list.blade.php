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
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('category#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">

                    <form class="form-header" action="{{ route('category#list') }}" method="get">
                        @csrf
                        <input class="au-input au-input--lg" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>
                @if (count($categories) > 0)

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th></th>
                            </tr>
                            <tr class="spacer"></tr>

                        </thead>
                        @foreach ($categories as $category)
                        <tbody>
                            <tr class="tr-shadow">
                                <td>{{$category->id}}</td>
                                <td>
                                    <span class="block-email">{{$category->name}}</span>
                                </td>
                                <td>{{$category->created_at->format('j-F-Y')}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href={{route('category#edit',$category->id)}} class="mx-2">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('category#delete',$category->id)}}">
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
                <h3>There is no categories data to show</h3>
                @endif
                <!-- END DATA TABLE -->
            </div>
            <div>
                {{$categories->links()}}

            </div>
        </div>
    </div>
</div>
@endsection

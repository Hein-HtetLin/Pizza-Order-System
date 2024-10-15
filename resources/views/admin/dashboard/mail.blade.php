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
                            <h2 class="title-1">Contact Mails</h2>

                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">

                    <form class="form-header" action="{{ route('admin#mail') }}" method="GET">
                        @csrf
                        <input class="au-input au-input--lg" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>
                @if (count($mails) > 0)

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Order-Code</th>
                                <th>Message</th>

                            </tr>
                            <tr class="spacer"></tr>
                        </thead>
                        @foreach ($mails as $mail)
                        <tbody class="data">
                            <tr class="tr-shadow">
                                <td></td>
                                 <td style="height: full" class="d-flex align-items-center">
                                    <span class="block-email">{{$mail->name}}</span>
                                </td>
                                <td>{{$mail->email}}</td>
                                <td><a href="{{route('order#detail',$mail->order_code)}}" class="text-primary">{{$mail->order_code}}</a></td>
                                <td>{{$mail->message}}</td>
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
                {{$mails->links()}}

            </div>
        </div>
    </div>
</div>
@endsection

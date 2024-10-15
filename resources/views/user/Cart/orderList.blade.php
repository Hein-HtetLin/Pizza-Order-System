@extends('user.layouts.master')
@section('content')
<div class="container mx-auto">
    <div class="row" id='row'>
        <div class="col table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th>User Id</th>
                        <th>Price</th>
                        <th>Order Code</th>
                        <th>Order-Date</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="align-middle" id="data">
                    @foreach ($order as $o)
                    <tr>
                        <td></td>
                        <td class="">{{Auth::user()->name}}</td>
                        <td>{{$o->total_price}} Kyats</td>
                        <td>{{$o->order_code}}</td>
                        <td>{{$o->created_at->format('j-F-Y')}}</td>
                        @if ($o->status == 0)
                        <td>
                            <span class="text-warning"><i class="fas fa-spinner mx-2"></i>Processed</span>
                        </td>
                        @elseif ($o->status == 1)
                        <td>
                            <span class="text-success"><i class="fas fa-check mx-2"></i>Successed</span>
                        </td>
                        @elseif ($o->status == 2)
                        <td>
                            <span class="text-danger"><i class="fas fa-exclamation-triangle mx-2"></i>Denied</span>
                        </td>

                        @endif
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                             <i class='fas fa-message'></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    {{-- <h1 class="modal-title fs-5" id="exampleModalLabel">Message</h1> --}}
                                    <p class="modal-title fs-5" id="exampleModalLabel">Order-Code : {{$o->order_code}}</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form>
                                        {{-- @csrf --}}
                                        <div class="" id='alert'>
                                            {{-- <div class="alert alert-dismissible fade show alert-success" role="alert">
                                                <small>Message Send Successed</small>
                                                <div class="btn-close" data-bs-dismiss="alert" aria-label="close"></div>
                                            </div> --}}

                                        </div>
                                        <input type="hidden" id="userId" value="{{$o->user_id}}">
                                        <input type="hidden" id="orderCode" value="{{$o->order_code}}">
                                        <label for="">Enter Message</label>
                                        <textarea type="text"  name="" class="form-control" id="message"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="send">Send Message</button>
                                    </div>
                                </form>
                                </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function(){
        $('#data tr').each(function(index,row){

            $(row).find('#send').click(function(){
                $data = {
                    'userId' : $(row).find('#userId').val(),
                    'orderCode' : $(row).find('#orderCode').val(),
                    'message' : $(row).find('#message').val()

                }
                $.ajax({
                type:'get',
                url:'http://localhost:8000/user/create/mail',
                data:$data,
                dataTyp:'json',
                success:function(res){
                    $alert = ''
                    $alert += `<div class="alert alert-dismissible fade show alert-success" role="alert">
                                                <small>Message Send Successed</small>
                                                <div class="btn-close" data-bs-dismiss="alert" aria-label="close"></div>
                                            </div>`
                    $(row).find('#message').val('')
                    $(row).find('#alert').html($alert)
                    }
            })

            })
            })
        // $('#clearBtn').click(function(){
        //     $('#data').remove()
        //     $totalPrice = 0;
        //     $('#data tr').each(function(index,row){
        //         $totalPrice +=($(row).find('#price').text())*1
        //     })
        //     $('#orderPrice').text(`${$totalPrice} Kyats`);
        //     $('#finalPrice').text(`${$totalPrice+3000} Kyats`);

        //     $.ajax({
        //         type:'get',
        //         url:'http://localhost:8000/user/cart/delete',
        //         dataTyp:'json'
        //     })
        // })

})

</script>
@endsection

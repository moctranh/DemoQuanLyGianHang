@extends('customer::layouts.customer')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lịch sủ đơn hàng</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('errorMessage'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{session('errorMessage') }}</li>
                            </ul>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                    
                            <caption>Danh sách đơn hàng</caption>
                            <thead>
                                <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Mã hóa đơn</th>
                                <th scope="col">Price</th>
                                <th scope="col">Trạng thái</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($listOrdered as $index => $order)
                                    <tr>
                                        <td>{{$index}}</td>
                                        <td>#{{$order['order_id']}}</td>
                                        <td>{{$order['total']}}</td>
                                        @if ($order['cancel'])
                                            <td><a href="{{route('customer.history.show',['order' => $order['order_id']])}}" class="text-danger">Đã hủy đơn</a></td>
                                        @else
                                            @if ($order['confirm'])
                                                <td><a href="{{route('customer.history.show',['order' => $order['order_id']])}}" class="text-primary">Đã xác nhận</a></td>
                                            @else
                                                <td><a href="{{route('customer.history.show',['order' => $order['order_id']])}}" class="text-success">Chờ xác nhận...</a></td>
                                            @endif
                                        @endif
                                        
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

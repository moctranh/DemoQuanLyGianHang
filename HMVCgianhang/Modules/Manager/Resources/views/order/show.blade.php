@extends('manager::layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quản lý đơn hàng #{{$data['order']['id']}} của khách hàng {{$data['user']['name']}}</div>

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
                    
                            <caption>Danh sách của đơn hàng #{{$data['order']['id']}}</caption>
                            <thead>
                                <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">Thành tiền</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($data['products'] as $key => $product)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td><img src="{{asset('uploads/img/product/'.$product['image'])}}" 
                                            style="width: 50px; height: 80px"
                                            alt="" >
                                        </td>
                                        <td>{{$product['product']}}</td>
                                        <td>{{$product['quantity']}}</td>
                                        <td>{{$product['price']}}</td>
                                        <td>{{$product['total']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
                
                <div class="card-footer">
                    
                    <span class = "float-start">Tổng tiền: {{$data['total']}} Đồng</span>
                    
                    @if ($data['products'][0]['cancel'])
                        <p class="text-danger float-end"> Đơn hàng đã hủy</p>
                    @else
                        @if ($data['products'][0]['confirm'])
                            <p class="text-primary float-end">Đơn hàng đã xác nhận</p>
                        @else
                            <form action="" method="POST" class="d-inline float-end">
                                @csrf
                                <input type="range" hidden min=0 max=1 value=1 name="confirmed">
                                <button type="submit" class="btn btn-success">Xác nhận</button>
                            </form>

                            <form action="" method="POST" class="d-inline float-end me-2">
                                @csrf
                                <input type="range" hidden min=0 max=1 value=0 name="confirmed">
                                <button type="submit" class="btn btn-danger">Từ chối</button>
                            </form>
                        @endif
                    @endif

                            
                    
                </div>

                <div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

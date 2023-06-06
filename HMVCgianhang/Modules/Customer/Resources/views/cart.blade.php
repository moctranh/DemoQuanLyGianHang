@extends('customer::layouts.customer')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Chi tiết giỏ hàng</div>

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

                    @if ($products == NULL)
                        <div class="alert alert-primary" role="alert">
                            Giỏ hàng trống
                        </div>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá tiền</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $index => $product)
                                
                            <tr>

                                <th scope="row">{{$index+1}}</th>
                                <td><a href="">{{$product->product}}</a></td>
                                <td>{{$product->pivot->quantity}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->pivot->totalPrice}}</td>
                                <td scope="column">
                                    <a href="" class="btn btn-success ">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{
                                        route('customer.deleteCart',[
                                            'order'=>$product->pivot->order_id,
                                            'product'=>$product->pivot->product_id
                                        ])
                                    }}" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>                                
                                </td>                            
                            </tr>

                                @endforeach
                            
                            </tbody>

                        </table>                    
                    @endif
                </div>
                <div class="card-footer">
                    @if ($products)
                        <span class = "float-start">Tổng tiền: {{$products->total}} Đồng</span>
                        <form action="{{route('order.buy')}}" method="POST" class="d-inline float-end">
                            @csrf
                            <input type="text" hidden value="{{$products[0]->pivot->order_id}}" name="order_id">
                            <button type="submit" class="btn btn-primary">Mua hàng</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

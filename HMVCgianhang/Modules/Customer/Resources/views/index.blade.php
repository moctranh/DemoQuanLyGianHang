@extends('customer::layouts.customer')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Danh sách sản phẩm</div>

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
                    
                    @foreach($products as $key => $product)

                        <div class="card float-start m-3 " style="width: 20%;" >
                            <img src="{{asset('/uploads/img/product/'.$product->image)}}" class="card-img-top" style="height: 200px">
                            <div class="card-body">
                                @if (strlen($product->product)>10)
                                <p class="card-text">{{substr($product->product,0,10).'...'}}</p>
                                @else
                                <p class="card-text">{{$product->product,0,10}}</p>
                                @endif
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">{{$product->price}} Đ</li>
                                <a class="list-group-item" href="{{route('customer.detailProduct',['product' => $product->id])}}">Chi tiết sản phẩm</a>
                            </ul>
                        </div>

                    @endforeach
                    
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

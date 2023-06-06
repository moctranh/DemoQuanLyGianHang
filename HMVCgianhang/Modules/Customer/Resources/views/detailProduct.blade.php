@extends('customer::layouts.customer')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sản phẩm 

                    {{-- <form action="{{route('product.destroy', ['product'=>$product->id] )}}" class="d-inline float-end" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form> --}}

                    <form action="{{route('customer.addCart', ['product'=>$product->id])}}" class="d-inline float-end" method="POST">
                        @csrf
                        <label for="quantity">Số lượng: </label>
                        <input type="number" min="1" name="quantity" id="quantity" value="1">
                        <button type="submit" class="btn btn-success">Add</button>
                    </form>

                  
                   
                </div>

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
                    
                    <div class="d-flex">
                        <div class="col-5 me-2">
                            <img src="{{asset('uploads/img/product/'.$product->image)}}" alt="" style="width: 100%; height: 400px;">
                        </div>

                        <div class="col-6 ms-2">
                            <p class="fw-bolder"> Tên sản phẩm: {{$product->product}}</p>
                            <p class="fw-normal"> Giá sản phẩm: {{$product->price}}</p>
                            <p class="fw-normal"> Hàng tồn kho: {{$product->store}}</p>
                            <p class="fw-normal"> Đã bán: {{$product->sold}}</p>
                            <p class="fst-italic"> Mô tả sản phẩm: {{$product->description}}</p>
                        </div>

                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

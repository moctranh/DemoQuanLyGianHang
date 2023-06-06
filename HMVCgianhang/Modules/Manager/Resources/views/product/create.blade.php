@extends('manager::layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Quản lý sản phẩm</div>

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

                    <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="ProductName" class="form-label">Tên sản phẩm</label>
                          <input type="text" class="form-control" id="ProductName" name="product" value="{{old('product')}}">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Ảnh sản phẩm</label>
                            <input class="form-control" type="file" accept="image/*" id="image" name="image">
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Thể loại</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="category_id">
                                @foreach ($categories as $key => $category)
                                    @if ( ($loop->first && old('category_id') == NULL ) || (old('category_id') == $category->id) )
                                        {{-- This is the first iteration --}}
                                        <option selected value="{{$category->id}}">{{$category->category}}</option>
                                    @else
                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                    @endif
                                    

                                @endforeach
                            </select>

                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="description" placeholder="Nhập mô tả sản phẩm" id="description" style="height: 300px">{{old('description')}}</textarea>
                            <label for="description">Mô tả</label>
                        </div>

                        <div class="mb-3">
                            <label for="store" class="form-label">Kho hàng</label>
                            <input type="number" class="form-control" id="store" name="store" value="{{old('store')}}">
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Giá</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{old('price')}}">
                        </div>

                        <button type="submit" class="btn btn-success">Thêm Sản phẩm</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
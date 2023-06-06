@extends('manager::layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Quản lý danh mục</div>

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

                    <form method="POST" action="{{route('category.update', ['category'=> $category->id ] )}}">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                          <label for="CategoryName" class="form-label">Tên danh mục</label>
                          <input type="text" class="form-control" id="CategoryName" name="category" value="{{$category->category}}">
                        </div>

                        <div class="mb-3">
                            <label for="Description" class="form-label">Mô tả</label>
                            <input type="text" class="form-control" id="Description" name="description" value="{{$category->description}}">
                        </div>

                        <button type="submit" class="btn btn-success">Cập nhật thể loại</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
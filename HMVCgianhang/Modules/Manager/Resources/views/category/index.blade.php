@extends('manager::layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Danh sách thể loại</div>

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

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Thể loại</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Doanh thu</th>
                            <th scope="col">Quản lý</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $index => $category)

                          <tr>

                            <th scope="row">{{$index+1}}</th>
                            <td><a href="">{{$category->category}}</a></td>
                            <td>{{$category->product->sum('store')}}</td>
                            <td>{{$category->turnover}}</td>
                            <td scope="column">
                                <a href="{{route('category.edit',[
                                    'category' => $category->id
                                ])}}" class="btn btn-success ">
                                    Edit
                                </a>
                                <form method="POST" action="{{route('category.destroy', ['category' => $category->id] )}}" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>                                
                            </td>
                            
                          </tr>

                            @endforeach

                        </tbody>
                      </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

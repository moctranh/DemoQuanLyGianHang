@extends('manager::layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-footer">
                    <h3>Biểu đồ thống kê doanh thu tháng {{$month}} năm {{$year}}</h3>
                    <form action="{{route('manager.statistical.show')}}" method="POST">
                        @csrf
                        <input type="number" name="month" min="1" max="12" value="{{ intval($month) }}">
                        <input type="number" name="year" min="2015"  value="{{ intval($year) }}">
                        <button type="submit" class="btn btn-success">Xem thống kê</button>
                    </form>
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
                </div>

                <div class="card-body d-flex flex-column flex-md-row">

                    <div id="monthly" class="col-12 col-md-6"></div>
                    <div id="yearly" class="col-12 col-md-6"></div>
                    <script>
                        var yArray = @json($statistical['monthly']['turn_over']);
                        var xArray = @json($statistical['monthly']['day']);
                        // Define Data
                        var data = [{
                        x: xArray,
                        y: yArray,
                        mode:"lines"
                        }];
        
                        // Define Layout
                        var layout = {
                        xaxis: { title: "Ngày"},
                        yaxis: {title: "Doanh thu"},  
                        title: "Doanh thu trong tháng"
                        };
        
                        // Display using Plotly
                        Plotly.newPlot("monthly", data, layout);

                        var dataYear = [{
                            x: @json($statistical['yearly']['day']),
                            y: @json($statistical['yearly']['turn_over']),
                            type: "bar"
                        }]
                        var layout = {
                            xaxis: {title: "Tháng"},
                            yaxis: {title: "Doanh Thu"},
                            title: "Doanh thu trong năm"
                        };
                        Plotly.newPlot("yearly", dataYear, layout);
                    </script>
                </div>
                

                
            </div>
        </div>
    </div>
</div>

@endsection


@extends('layout.dashboard')

<!-- Content Header (Page header) -->
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Traffic Page</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row flex-column">
                <!-- /.col-md-6 -->
                <div class="col">
                    <div class="card card-primary card-outline">
                        <div class="card-header d-flex align-items-center">
                            <h5 class="m-0">{{ 'Gallery Uploads during ' . $year }}</h5>
                            <div class="btn-group ml-auto">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Monthly Traffic
                                </button>
                                <ul class="dropdown-menu overflow-auto" style="max-height: 200px">
                                    @foreach ($years as $year)
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.traffic', $year) }}">{{ $year }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- content -->
                            <div id="chart"></div>
                            {{-- {!! $trafficChart->container() !!} --}}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <!-- /.card -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{ 'Gallery Uploads during ' . $year }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Total Upload</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->month }}</td>
                                            <td>{{ $item->total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Total Upload</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
@section('plugins')
    <script src="{{ asset('dist/bs-5/bootstrap.bundle.min.js') }}"></script>


    {{-- <script src="{{ $trafficChart->cdn() }}"></script>

    {{ $trafficChart->script() }} --}}
    <script src="{{ asset('plugins/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script>
        var options = {
            series: [{
                name: "series1",
                data: @json($total),
                // data: [31, 40, 28, 51, 42, 109, 100],

            }, ],
            chart: {
                height: 350,
                type: "area",
                export: {
                    csv: {
                        filename: @json($year),
                        columnDelimiter: ',',
                    },
                    svg: {
                        filename: @json($year),
                    },
                    png: {
                        filename: @json($year),
                    }
                },
            },

            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
            },
            xaxis: {
                categories: @json($month),
                // categories: [
                //     "February",
                // ],
            },

        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endsection

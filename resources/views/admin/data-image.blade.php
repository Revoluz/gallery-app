@extends('layout.dashboard')

<!-- Content Header (Page header) -->
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Image</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Image</li>
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
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col">
                    <!-- /.card -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data Image</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Image Name</th>
                                        <th>Image</th>
                                        <th>Status Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($images as $image)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $image->user->username }}</td>
                                            <td>{{ $image->name }}</td>
                                            <td>
                                                <img class="w-25" src="{{ $image->images() }}" alt="" />
                                            </td>
                                            <td class="d-flex gap-2">
                                                <form action="{{ route('admin.image.status', $image->id) }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    @if ($image->status)
                                                        <button type="submit" class="btn btn-success">
                                                            Active
                                                        </button>
                                                    @else
                                                        <button type="submit" class="btn btn-danger">
                                                            Banned
                                                        </button>
                                                    @endif
                                                </form>
                                                <a href="{{ route('images.show', $image->id) }}"
                                                    class="btn btn-primary ml-1">
                                                    Show
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Image Name</th>
                                        <th>Image</th>
                                        <th>Status Image</th>
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
@endsection

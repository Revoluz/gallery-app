<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AdminLTE 3 | Starter</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    {{-- alert --}}
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/dist/css/adminlte.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/bs-5/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}" />
</head>

<body class="row w-100 container-fluid flex-row mx-0 px-0 vh-100">
    @include('Component.alert')

    <!-- image login welcome -->
    <div class="col-5 px-0 vh-100 welcome d-none d-lg-block"></div>

    <div class="col-lg-7 col d-flex flex-column align-items-center justify-content-center gap-4">
        <img src= "{{ asset('/dist/img/logo-img.png') }} " style="width: 200px" alt="" />
        <div class="row col-12 align-items-center">
            <h1 class="text-center">Register</h1>
            {{-- if (Route::is('register')) --}}
            <form action="" method="POST" class="d-flex flex-column align-items-center">
                {{-- @else --}}
                {{-- store admin --}}
                {{-- <form action="" method="POST"
                        class="d-flex flex-column align-items-center"> --}}
                {{-- @endif --}}
                @csrf
                <div class="form-group col-lg-8 col-12 px-0">
                    <label for="name">Name</label>
                    <input type="text" style="height: 56px" class="form-control border-black rounded-1"
                        id="name" value="{{ @old('name') }}" placeholder="Name" name="name" />
                    @error('name')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-lg-8 col-12 px-0">
                    <label for="Username">Username</label>
                    <input type="text" style="height: 56px" class="form-control border-black rounded-1"
                        id="username" value="{{ @old('username') }}" placeholder="Username" name="username" />
                    @error('username')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-lg-8 col-12 px-0">
                    <label for="email">Email</label>
                    <input type="email" style="height: 56px" class="form-control border-black rounded-1"
                        id="email" value="{{ old('email') }}" placeholder="example@gmail.com" name="email" />
                    @error('email')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-lg-8 col-12 px-0">
                    <label for="password">Password</label>
                    <input type="password" style="height: 56px" class="form-control border-black rounded-1"
                        id="password" placeholder="Password" name="password" />
                    @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark btn-lg col-8 fw-bold">
                    Register
                </button>
            </form>
        </div>
        <p>
            Alerdy Have an Account?
            <a href="" class="fw-bold">Login</a>
        </p>
    </div>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    {{-- alert --}}
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('dist/bs-5/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <!-- <script src="dist/js/adminlte.min.js"></script> -->
</body>

</html>

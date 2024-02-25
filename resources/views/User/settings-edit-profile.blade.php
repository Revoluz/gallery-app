@extends('layout.main')
@section('head')
@endsection
@section('content')
    <!-- gallery container -->
    <div class="col-12 mt-156 " style="margin-bottom: 128px">
        <div class="container d-flex gap-3">
            @include('Component.User.sidebar-setting')
            <form action="{{ route('user.update', $user->slug) }}" method="POST" class="col-md-8 col-12 px-0">
                @csrf
                @method('put')
                <div class="bg-white setting-container rounded-40 px-4">
                    <h3 class="fw-bold">Edit Profile</h3>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Name">Name</label>
                            <input type="text" name="name" class="form-control border-dark" id="Name"
                                value="{{ $user->name }}" placeholder="Enter name" />
                            @error('name')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="form-group col-md-6">
                            <label for="Username">Username</label>
                            <input type="text" class="form-control border-dark" id="Username" name="username"
                                value="{{ $user->username }}" placeholder="Enter username" />
                            @error('username')
                                <div class=" invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control border-dark" id="email" placeholder="Enter email"
                                name="email" value="{{ $user->email }}" />
                            @error('email')
                                <div class=" d-block invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control border-dark" id="password" name="password"
                                min="8" placeholder="Enter email" />
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('profile.index',auth()->user()->slug) }}" class=" text-decoration-none btn btn-secondary btn px-5 py-2">
                        Back
                    </a>
                    <button class="btn btn-dark px-5 py-2" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('plugins')
@endsection

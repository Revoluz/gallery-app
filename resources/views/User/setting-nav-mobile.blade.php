@extends('layout.main')
@section('head')
@endsection
@section('content')
    <!-- gallery container -->
    <div class="col-12 my-auto">
        <div class="container d-flex gap-3">
            <div class="bg-white container-fluid setting-container rounded-40 px-4 h-100 d-flex flex-column"
                style="height: fit-content">
                <a href="{{ route('user.show', auth()->user()) }}" class="text-black mt-2 d-block text-decoration-none">
                    <h5 class="my-1">
                        Profile <i class="fas fa-arrow-right mx-2"></i>
                    </h5>
                </a>
                <a href="{{ route('user.edit', auth()->user()) }}" class="text-black d-block text-decoration-none">
                    <h5 class="my-1">
                        Edit Profile <i class="fas fa-arrow-right mx-2"></i>
                    </h5>
                </a>
                <a href="{{ route('settings.account-management', auth()->user()) }}"
                    class="text-black  d-block text-decoration-none">
                    <h5>
                        Account Management
                        <i class="fas fa-arrow-right mx-2"></i>
                    </h5>
                </a>
            </div>
        </div>
    </div>
@endsection
@section('plugins')
@endsection

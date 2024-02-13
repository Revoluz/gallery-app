@extends('layout.main')
@section('head')
@endsection
@section('content')
    <!-- gallery container -->
    <div class="col-12 mt-156 mb-3">
        <div class="container d-flex gap-3">
            @include('Component.User.sidebar-setting')
            <div class="col-md-8 col-12">
                <div class="bg-white setting-container rounded-40 px-4">
                    <h3 class="fw-bold">Profile</h3>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Name">Name</label>
                            <h6 class="m-0"></h6>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Username">Username</label>
                            <h6 class="m-0"></h6>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email address</label>
                            <h6 class="m-0"></h6>
                        </div>
                    </div>
                </div>
                <div class="bg-white setting-container rounded-40 px-4 mt-4">
                    <h3 class="fw-bold">Account Management</h3>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <div class="form-group">
                                <label>Description</label>
                                <h6 class="m-0 fw-normal">

                                </h6>
                            </div>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="formFile" class="form-label">Photo Profile</label>
                            <img src=""
                                class="rounded-circle profile-img border-1 border-black border-width-2 border d-none d-md-block"
                                alt="" />

                        </div>
                    </div>
                </div>
                <div class="bg-white setting-container rounded-40 px-4 mt-4">
                    <h3 class="fw-bold">Link Account</h3>
                    <div class="d-flex flex-row flex-wrap gap-2">
                        <a href="" class=" col btn btn-dark">
                            <img class=" filter" src="{{ asset('dist/img/social-icon/mdi_instagram.svg') }}" alt=""
                                style="filter: brightness(0) invert(1);" />
                        </a>
                        <a href="" class=" col btn btn-dark">
                            <img src="{{ asset('dist/img/social-icon/pajamas_twitter.svg') }}"
                                alt=""style="filter: brightness(0) invert(1);" />
                        </a>

                        <a href="" class=" col btn btn-dark">
                            <img src="{{ asset('dist/img/social-icon/iconoir_facebook.svg') }} "
                                alt=""style="filter: brightness(0) invert(1);" />
                        </a>

                    </div>
                </div>
                <div class="bg-white setting-container rounded-40 px-4 mt-4">
                    <h3 class="fw-bold">Delete Account</h3>
                    <h4 class="text-danger">Warning</h4>
                    <h6 class="fw-bold">
                        Deleting your account is permanent. all of your data will be
                        deleted.
                    </h6>
                    <form action="" method="POST">
                        @csrf
                        @method('delete')
                        <div class="form-check my-2">
                            <input class="form-check-input border-1 border-black" type="checkbox" value=""
                                id="flexCheckDefault" required>
                            <label class="form-check-label" for="flexCheckDefault" class="fw-bold">
                                I agree with the Terms & Conditions and want to delete my account permanently.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-danger btn-sm px-5 py-2 fw-bold">Delete</button>
                    </form>
                </div>
                <div class="mt-4">
                    <a href="">
                        <button class="btn btn-secondary btn-lg px-5 py-2">Back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('plugins')
@endsection

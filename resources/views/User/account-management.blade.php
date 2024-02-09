@extends('layout.main')
@section('head')
@endsection
@section('content')
    <!-- gallery container -->
    <div class="col-12 mt-156 mb-3">
        <div class="container d-flex gap-3">
            @include('Component.User.sidebar-setting')
            <form action="" method="POST" enctype="multipart/form-data" class="col-md-8 col-12 px-0">
                @csrf
                @method('put')
                <div class="bg-white setting-container rounded-40 px-4">
                    <h3 class="fw-bold">Account Management</h3>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="3" maxlength="300" placeholder="Enter ..."></textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="formFile" class="form-label">Photo Profile</label>
                            <input class="form-control" type="file" name="photo" id="formFile" />
                            @error('photo')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-white setting-container rounded-40 px-4 mt-4">
                    <h3 class="fw-bold">Link Account</h3>
                    <div class="row">
                        <div class="form-group col-md-12 d-flex flex-row">
                            <div class="d-flex align-items-center col-md-6">
                                <img src="{{ asset('dist/img/social-icon/mdi_instagram.svg') }} " alt="" />
                                <p class="m-0 ms-2 text-gray">Instagram</p>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="instagram" id="ig-account" value=""
                                    placeholder="Input account" />
                                @error('instagram')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-12 d-flex flex-row">
                            <div class="d-flex align-items-center col-md-6">
                                <img src="{{ asset('dist/img/social-icon/pajamas_twitter.svg') }} " alt="" />
                                <p class="m-0 ms-2 text-gray">X / Twitter</p>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="twitter" id="x-account"
                                    placeholder="Input account" value="" />
                                @error('twitter')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-12 d-flex flex-row">
                            <div class="d-flex align-items-center col-md-6">
                                <img src="{{ asset('dist/img/social-icon/iconoir_facebook.svg') }} " alt="" />
                                <p class="m-0 ms-2 text-gray">Facebook</p>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="fb-account" name="facebook"
                                    placeholder="Input account" value="" />
                                @error('facebook')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="">
                        <button type="button" class="btn btn-secondary px-5 py-2">Back</button>
                    </a>
                    <button class="btn btn-dark px-5 py-2" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('plugins')
@endsection

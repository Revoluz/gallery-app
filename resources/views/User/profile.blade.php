@extends('layout.main')
@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/imagehover.css/css/imagehover.min.css/imagehover.css') }}">
@endsection
@section('content')
    <div class="setting-container mt-156 col-md-6  col-lg-4 rounded-4 container  mx-md-0 row flex-column align-items-center">
        <img src="{{ $user->avatar() }}" class="profile-img border-1 border-black border-width-2 border p-0"
            style="border-radius: 50%; width: 100px; height: 100px" alt="User Image" />
        <h3 class="text-center"> {{ $user->name }}
        </h3>
        <p class="fs-6 text-secondary text-center mb-0">
            {{ $user->profile->description ?? '' }}
        </p>
        <div class="d-flex my-2 justify-content-center gap-1">
            @if ($user->profile->instagram)
            <a href="{{ $user->profile->instagram }}">
                <img src="{{ asset('/dist/img/social-icon-color/instagram.svg') }}" alt="" class="" />
            </a>
            @endif
            @if ($user->profile->twitter)
            <a href="{{ $user->profile->twitter }}">
                <img src="{{ asset('/dist/img/social-icon-color/twitter.svg') }}" alt="" class="" />
            </a>
            @endif
            @if ($user->profile->facebook)
            <a href="{{ $user->profile->facebook }}">
                <img src="{{ asset('/dist/img/social-icon-color/facebook.svg') }}" alt="" class="" />
            </a>
            @endif
        </div>
        @can('auth.guard', $user)
            <div class="d-flex flex-column flex-wrap">
                <div class="d-flex gap-2 flex-column flex-md-row w-100">
                    <a href="{{ route('user.show', $user->slug) }}"
                        class="btn btn-lg btn-outline-dark bg-secondary-subtle col">
                        Settings
                    </a>
                    @can('admin.guard')
                        <a href="{{ route('admin.traffic', $year) }}" class="btn btn-lg btn-dark col"> Dashboard </a>
                    @endcan
                </div>
                <form action="{{ route('logout') }}" method="POST" class="d-flex">
                    @csrf
                    <button type="submit" class="btn btn-lg btn-danger col-12 mt-2"> Logout </button>
                </form>
            </div>
        @endcan
    </div>
    <!-- gallery container -->
    <div class="container col-12 gallery-rounded h-100 mt-5 mb-5">
        <div class="mx-md-4 mx-2">
            <div class="flex-row d-flex align-items-center justify-content-between">
                <h1 class="fw-bold">Explore</h1>
                <div class="d-flex gap-4">
                    @can('auth.guard', $user)
                        <button type="button" class="btn btn-lg bg-secondary-subtle rounded-5 fw-bold" data-toggle="modal"
                            data-target="#modal-lg">
                            <i class="fas fa-plus"></i>
                            Add Image
                        </button>
                    @endcan
                </div>
            </div>
            <div class="mt-4 gallery">
                @foreach ($images as $image)
                    <a href="{{ route('profile.showImage', ['id' => $image->id, 'user' => auth()->user()]) }}"
                        class="d-block images">
                        <figure class="imghvr-fade">
                            <img class="w-100 shadow-sm" src="{{ $image->images() }}" alt=""  />
                            <figcaption id="cover-title" class="h-100 d-md-flex align-items-end d-none">
                                {{ $image->name }}
                            </figcaption>
                        </figure>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    @can('auth.guard', $user)
        <div class="modal fade" id="modal-lg">
            <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Image</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                    placeholder="Image Name" value="{{ @old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="description">{{ @old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formFile" class="form-label">Photo </label>
                                <input class="form-control" name="image" type="file" id="formFile" />
                                @error('image')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-outline-dark" data-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
            </form>
            <!-- /.modal-content -->
        </div>
    @endcan
    <!-- /.modal-dialog -->
    </div>
@endsection
@section('plugins')
    <!-- Bootstrap 4 -->
    <script src="{{ asset('dist/js/macy/dist/macy.js') }}"></script>
    <script>
        const msnry = new Macy({
            container: ".gallery",
            mobileFirst: true,
            columns: 1,
            breakAt: {
                200: 2,
                700: 4,
                1100: 4,
            },
            margin: {
                x: 8,
                y: 8,
            },
        });
    </script>
@endsection

@extends('layout.main')
@section('head')
@endsection
@section('content')
    <div class="col-lg-8 col-md-10 align-content-start mb-3 mt-5">

        <a href="" class="btn col-md-2 bg-white rounded-4 fw-bold btn-lg shadow py-3">
            <h5 class="m-0">
                <i class="fas fa-arrow-left" style="margin-right: 8px"></i> Back
            </h5>
        </a>

    </div>
    <div
        class="container d-flex col-lg-8 col-md-10 flex-column flex-md-row gallery-rounded rounded-5 h-100 p-0 overflow-hidden row flex-row mb-5 gap-2 mt-0" style="margin-bottom: 128px">
        <div class="col p-0 image">
            {{-- for image --}}
            <img class="w-100 " src="" alt="" />
        </div>
        <div class="col py-4 d-flex flex-column gap-2 mb-1">
            <div class="h-100 overflow-auto detail-image">
                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-3 g-4 align-items-center">
                        <a href="">
                            <img src=""
                                class="rounded-circle profile-img border-1 border-black border-width-2 border"
                                alt="User Image" />
                        </a>
                        <p class="lead m-0"></p>
                    </div>
                    {{-- can('auth.guard', $image->user) --}}
                    <button type="button" class="btn btn-lg bg-secondary-subtle rounded-5 fw-bold m-2" data-toggle="modal"
                        data-target="#modal-lg">
                        <i class="fas fa-edit"></i>
                        Edit Image
                    </button>
                    <button type="button" class="btn btn-danger btn-lg m-2" data-toggle="modal"
                        data-target="#modal-lg">Banned
                    </button>
                    {{-- @endcan --}}
                </div>
                {{-- <div class="d-flex gap-3 g-4 align-items-center">
                    <a href="">
                        <img src="{{ asset($image->user->avatar()) }}"
                            class="rounded-circle profile-img border-1 border-black border-width-2 border"
                            alt="User Image" />
                    </a>
                    <p class="lead m-0"> {{ $image->user->username }}</p>
                </div> --}}
                <div class="description mt-4">
                    <h6 class="fw-bold">Description</h6>
                    <p class="mb-1">
                        descritpiton
                    </p>
                </div>
                <div class="comment mt-4 w-100" style="height: 50px">
                    <h6 class="fw-bold">Comments</h6>
                    {{-- forelse ($comments as $comment) --}}
                    <div class="d-flex gap-2 mt-1">
                        <a href="">
                            <img src=""
                                class="rounded-circle profile-img border-1 border-black border-width-2 border"
                                alt="User Image" />
                        </a>
                        <div class="">
                            <div class="m-2 mb-0 d-flex gap-2 ms-0">
                                <p class="fw-bold mb-0">
                                    {{-- username  --}}
                                </p>
                                <p class="mt-1 mb-0" style="font-size: 12px">
                                    {{-- create comment --}}
                                </p>
                            </div>
                            <div>
                                <p class="mb-1">
                                    {{-- comment --}}
                                </p>
                                {{-- can('auth.guard', $comment->user) --}}
                                <form action="" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-danger bg-white border-0 p-0 fw-bold">
                                        Delete
                                    </button>
                                </form>
                                {{-- @endcan --}}
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="mt-3">
                            <p class="text-center text-secondary">Add a comment!</p>
                        </div>
                        @endforelse

                    </div>
                </div>
                <hr class="mt-1 m-0" />
                <div>
                    <div class="d-flex justify-content-between">
                        <div class="align-content-center d-flex gap-2">
                            {{-- <i class="far fa-heart fs-3"></i> --}}

                            <form action="" method="POST">
                                @csrf
                                <button type="submit" class="fw-light nav-link fs-6"> <span class="fas fa-heart fs-3 me-1">
                                    </span>
                                </button>
                            </form>
                            {{-- like --}}
                            <form action="" method="POST">
                                @csrf
                                <button type="submit" class="fw-light nav-link fs-6"> <span class="far fa-heart fs-3 me-1">
                                    </span>
                                </button>
                            </form>
                        </div>
                        <div>
                            {{-- download image --}}
                            <form action="" method="post">
                                @csrf
                                <button type="submit" class="bg-white border-0">
                                    <i class="fas fa-download fs-3"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <form action="" method="post" class="mb-3 mt-2">
                        @csrf
                        <div class="input-group  mt-3">
                            <input type="text" class="form-control bg-body-secondary border-black"
                                placeholder="Input a comment" aria-label="Input a comment" name="comment"
                                aria-describedby="button-addon2" value="{{ @old('comment') }}" />
                            <button class="btn bg-warning border-black" type="submit" id="button-addon2">
                                Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- modal edit image --}}
        {{-- can('auth.guard', $image->user) --}}
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Image</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" value="{{ @old('name') }}"
                                    placeholder="Image Name" name="name" />
                                @error('name')
                                    <div class=" invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="3" name="description" placeholder="Enter ...">{{ @old('description') }}</textarea>
                                    @error('description')
                                        <div class=" invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <form action="" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete Image</button>
                        </form>
                        <button type="button" class="btn btn-default btn-outline-dark" data-dismiss="modal">
                            Close
                        </button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        {{-- @endcan --}}
    @endsection
    @section('plugins')
       <script>
        // responsive image
        // Get the image element
        const image = document.querySelector('.image img');
        // Get the container element
        const container = document.querySelector('.container');
        const detailImage = document.querySelector('.detail-image');
        // Add an event listener to the image's load event
        // console.log(image.height);
            // Get the image height
            const imageHeight = image.height;
            // Check if the image height is less than 300px
            if (imageHeight < 300) {
                // Add the class to the container
                container.classList.add('flex-column');
                container.classList.remove('flex-md-row');
                detailImage.classList.remove('h-100');
                detailImage.style.height="480px";
            } else {
                // Remove the class if it exists (for cases where the image height changes dynamically)
                container.classList.remove('flex-column');
            }
    </script>
    @endsection

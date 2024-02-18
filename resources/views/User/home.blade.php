@extends('layout.main')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('plugins/imagehover.css/css/imagehover.min.css/imagehover.css') }}">
@endsection
@section('content')
    <div class=" col-12 gallery-rounded h-100">
        <div class="mx-md-4 mx-2">
            <div class="flex-row d-flex align-items-center justify-content-between">
                <h1 class="fw-bold">Explore</h1>
                @auth
                    <div class="d-flex gap-4">
                        <a href="{{ route('home.index') }}"
                            class="btn btn-lg  {{ Route::is('home.index') ? '' : 'bg-opacity-25' }} rounded-4 fw-bold bg-warning d-none d-md-block">
                            Latest
                        </a>
                        <a href="{{ route('home.popular') }}"
                            class="btn btn-lg  {{ Route::is('home.popular') ? '' : 'bg-opacity-25' }} rounded-4 fw-bold bg-warning  d-none d-md-block">
                            Popular
                        </a>
                        <a href="{{ route('home.random') }}"
                            class="btn btn-lg {{ Route::is('home.random') ? '' : 'bg-opacity-25' }} rounded-4 fw-bold bg-warning   d-none d-md-block">
                            Random
                        </a>
                        <div class="btn-group d-md-none">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            </button>

                            <ul class="dropdown-menu dropdown-menu-left"
                                style=" position: absolute; transform: translate3d(-5px, 37px, 0px); top: 0px; will-change: transform; ">
                                <li class="{{ Route::is('home') ? 'bg-warning' : '' }} ">
                                    <a href="{{ route('home.index') }} " class="dropdown-item"> Latest </a>
                                </li>
                                <li class="{{ Route::is('home.popular') ? 'bg-warning' : '' }}">
                                    <a href="{{ route('home.popular') }}" class="dropdown-item"> Popular </a>
                                </li>
                                <li class="{{ Route::is('home.random') ? 'bg-warning' : '' }}">
                                    <a href="{{ route('home.random') }}" class="dropdown-item"> Random </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endauth
            </div>
            {{-- gallery image container --}}
            <div class="mt-4 gallery" id="gallery">
                @include('User.gallery')
            </div>
            @if (!$images->count())
                <div class="alert alert-danger text-center">
                    No Images Found.
                </div>
            @else
                @if ($images->count() > 15)
                <div class="loader text-center mb-5">
                    <div class="d-flex justify-content-center">
                        <div class="page-load-status">
                            <div class="spinner-border infinite-scroll-request" role="status"></div>
                            {{-- <p class="infinite-scroll-request">Loading...</p> --}}
                            <p class="infinite-scroll-last">End of content</p>
                            <p class="infinite-scroll-error">No more pages to load</p>
                        </div>
                    </div>
                </div>
                @endif
            @endif
        </div>
    </div>
@endsection
@section('plugins')
    <script src="{{ asset('dist/js/macy/dist/macy.js') }}"></script>
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    {{-- <link rel="stylesheet" href="{{ asset('plugins/infinite-scroll/script.js') }}"> --}}
    <script src="{{ asset('plugins/infinite-scroll/script.js') }}"></script>
    @if (Route::is('home.index'))
        <script>
            var endpoint = "{{ route('home.index') }}";
        </script>
    @elseif(Route::is('home.popular'))
        <script>
            var endpoint = "{{ route('home.popular') }}";
        </script>
    @elseif (Route::is('home.random'))
        <script>
            var endpoint = "{{ route('home.random') }}";
        </script>
    @elseif (Route::is('search'))
        <script>
            var endpoint = "{{ route('search') }}";
        </script>
    @endif
    @if ( $images->count() > 14)
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
            waitForImages: false,
            margin: {
                x: 8,
                y: 8,
            },

        });
        console.log(endpoint);

        var elem = document.querySelector('.gallery')
        var infiniteScroll = new InfiniteScroll(elem, {
            path: '?page=@{{#}}',
            status: '.page-load-status',
            history: false,
            append: '.images',
            // debug: true, // Optional: Enable debugging messages

        });
        infiniteScroll.on('append', function(body, path, items, response) {
            msnry.runOnImageLoad(function() {
                // console.log('I only get called when all images are loaded');
                msnry.recalculate(true);
            }, true);
        });
    </script>
    @endif
@endsection

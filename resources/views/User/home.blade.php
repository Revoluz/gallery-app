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
            <div class="loader text-center mb-5" style="display: none;">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            @if (!$images->count())
                <div class="alert alert-danger text-center">
                    No Images Found.
                </div>
            @endif
        </div>
    </div>
@endsection
@section('plugins')
    <!-- Bootstrap 4 -->
    @if (Route::is('home.index'))
        <script>
            var ENDPOINT = "{{ route('home.index') }}";
            var page = 1;
            var loading = false;
            var delayTimeout;


            // setTimeout(() => {
            $(window).scroll(function() {


                clearTimeout(delayTimeout);

                if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
                    delayTimeout = setTimeout(function() {
                        page++;
                        LoadMore(page);
                    }, 600);
                    $('.loader').show()

                }
            });
            // }, 3000);

            function LoadMore(page) {
                // alert("Page : " + page);
                $.ajax({
                        url: ENDPOINT + "?page=" + page,
                        datatype: "html",
                        type: "get",
                        beforeSend: function() {
                            $('.loader').show();
                        }
                    })
                    .done(function(response) {
                        if (response.html == '') {
                            $('.loader').html("End");
                            return;
                        }
                        console.log(response.html);
                        $('.loader').hide();
                        $(".gallery").append(response.html);
                        // msnry.recalculate();
                        msnry.runOnImageLoad(function() {
                            // console.log('I only get called when all images are loaded');
                            msnry.recalculate(true);
                        }, true);


                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        console.log('Server error occured');
                    });
            }
        </script>
    @endif
    @if (Route::is('home.popular'))
        <script>
            var ENDPOINT = "{{ route('home.popular') }}";
            var page = 1;
            var loading = false;
            var delayTimeout;


            // setTimeout(() => {
            $(window).scroll(function() {


                clearTimeout(delayTimeout);

                if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
                    delayTimeout = setTimeout(function() {
                        page++;
                        LoadMore(page);
                    }, 600);
                    $('.loader').show()

                }
            });
            // }, 3000);

            function LoadMore(page) {
                // alert("Page : " + page);
                $.ajax({
                        url: ENDPOINT + "?page=" + page,
                        datatype: "html",
                        type: "get",
                        beforeSend: function() {
                            $('.loader').show();
                        }
                    })
                    .done(function(response) {
                        if (response.html == '') {
                            $('.loader').html("End");
                            return;
                        }
                        console.log(response.html);
                        $('.loader').hide();
                        $(".gallery").append(response.html);
                        // msnry.recalculate();
                        msnry.runOnImageLoad(function() {
                            // console.log('I only get called when all images are loaded');
                            msnry.recalculate(true, true);
                        });


                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        console.log('Server error occured');
                    });
            }
        </script>
    @endif
    @if (Route::is('home.random'))
        <script>
            var ENDPOINT = "{{ route('home.random') }}";
            var page = 1;
            var loading = false;
            var delayTimeout;


            // setTimeout(() => {
            $(window).scroll(function() {


                clearTimeout(delayTimeout);

                if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
                    delayTimeout = setTimeout(function() {
                        page++;
                        LoadMore(page);
                    }, 600);
                    $('.loader').show()

                }
            });
            // }, 3000);

            function LoadMore(page) {
                // alert("Page : " + page);
                $.ajax({
                        url: ENDPOINT + "?page=" + page,
                        datatype: "html",
                        type: "get",
                        beforeSend: function() {
                            $('.loader').show();
                        }
                    })
                    .done(function(response) {
                        if (response.html == '') {
                            $('.loader').html("End");
                            return;
                        }
                        console.log(response.html);
                        $('.loader').hide();
                        $(".gallery").append(response.html);
                        // msnry.recalculate();
                        msnry.runOnImageLoad(function() {
                            // console.log('I only get called when all images are loaded');
                            msnry.recalculate(true, true);
                        });


                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        console.log('Server error occured');
                    });
            }
        </script>
    @endif
    @if (Route::is('search'))
        <script>
            var ENDPOINT = "{{ route('search') }}";
            var page = 1;
            var loading = false;
            var delayTimeout;


            // setTimeout(() => {
            $(window).scroll(function() {


                clearTimeout(delayTimeout);

                if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
                    delayTimeout = setTimeout(function() {
                        page++;
                        LoadMore(page);
                    }, 600);
                    $('.loader').show()

                }
            });
            // }, 3000);

            function LoadMore(page) {
                // alert("Page : " + page);
                $.ajax({
                        url: ENDPOINT + "?page=" + page,
                        datatype: "html",
                        type: "get",
                        beforeSend: function() {
                            $('.loader').show();
                        }
                    })
                    .done(function(response) {
                        if (response.html == '') {
                            $('.loader').html("End");
                            return;
                        }
                        console.log(response.html);
                        $('.loader').hide();
                        $(".gallery").append(response.html);
                        // msnry.recalculate();
                        msnry.runOnImageLoad(function() {
                            // console.log('I only get called when all images are loaded');
                            msnry.recalculate(true, true);
                        });


                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        console.log('Server error occured');
                    });
            }
        </script>
    @endif


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

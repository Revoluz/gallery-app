<nav
    class="mt-4 col-md-10 mx-2 bg-white px-4 py-3 rounded-4 shadow d-flex justify-content-between align-items-center {{ Route::is('images.show', 'profile.showImage') ? '' : 'position-fixed' }}  z-3 gap-md-4 gap-1">
    <a href="{{ route('home.index') }}">
        <img src="/dist/img/logo-img.png" class="h-100 d-sm-block d-none" alt="" />
    </a>

    @guest
        <div class="d-flex gap-2">
            <a href="{{ route('login') }}" class="btn btn-dark btn-md">Login</a>
            <a href="" class="btn btn-outline-dark btn-md">Register</a>
        </div>
    @endguest
    @auth
        <form action="{{ route('search') }}" method="get" class="w-100">
            <div class="input-group d-flex gap-2">
                @csrf
                <input type="text" name="keyword" class="form-control rounded border-black bg-body-secondary"
                    placeholder="Search" aria-label="Search" aria-describedby="button-addon2" required
                    value="{{ request('keyword', '') }}" />
                <button class="btn bg-warning rounded-3 bg-opacity-75" type="submit">
                    Search
                </button>
            </div>
        </form>
        <a href="{{ route('profile.index', ['user' => auth()->user()->slug]) }}" class="d-none d-md-block">
            <img src="{{ auth()->user()->avatar() }}"
                class="rounded-circle profile-img border-1 border-black border-width-2 border d-none d-md-block"
                alt="User Image" />
        </a>
    @endauth
</nav>
{{-- @endif --}}

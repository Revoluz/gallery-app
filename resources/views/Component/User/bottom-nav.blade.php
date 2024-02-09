    <div class="bottom-nav bg-white row position-fixed bottom-0 p-2 d-flex d-md-none">
        <div class="col d-flex justify-content-center align-items-center">
            <a href="{{ route('home.index') }}" class="text-warning">
                <i class="fas fa-home" style="font-size: 36px"></i>
            </a>
        </div>
        <div class="col d-flex justify-content-center align-items-center">
            <a href="{{ route('user.index') }}" class="text-secondary">
                <i class="fas fa-cog" style="font-size: 36px"></i>
            </a>
        </div>
        <div class="col d-flex justify-content-center align-items-center">
            <a href="{{ route('profile.index', auth()->user()) }}" class="d-inline d-md-none">
                <img src="{{ auth()->user()->avatar() }}"
                    class="rounded-circle  border-3 border-warning border-secondary border-width-3 border  d-md-none"
                    alt="User Image" style="width: 48px" />
            </a>
        </div>
    </div>

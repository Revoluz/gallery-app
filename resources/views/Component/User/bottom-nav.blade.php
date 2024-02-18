    <div class="bottom-nav bg-white row position-fixed bottom-0 p-2 d-flex d-md-none">
        <div class="col d-flex justify-content-center align-items-center">
            <a href="{{ route('home.index') }}"
                class="{{ Route::is('home.index', 'search') ? 'text-warning' : 'text-gray' }} ">
                <i class="fas fa-home" style="font-size: 36px"></i>
            </a>
        </div>
        <div class="col d-flex justify-content-center align-items-center">
            <a data-toggle="modal" data-target="#modal-setting"
                class="text-secondary {{ Request::is('settings/*') ? 'text-warning' : 'text-gray' }}">
                <i class="fas fa-cog" style="font-size: 36px"></i>
            </a>
        </div>
        <div class="col d-flex justify-content-center align-items-center">
            <a href="{{ route('profile.index', auth()->user()) }}" class="d-inline d-md-none">
                <img src="{{ auth()->user()->avatar() }}"
                    class="rounded-circle    border-2 border  d-md-none {{ Route::is('profile.index') ? 'border-warning' : 'border-black' }}"
                    alt="User Image" style="width: 48px" />
            </a>
        </div>
    </div>
    {{-- modal alert --}}
    <div class="modal fade my-auto" id="modal-setting">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <a href="{{ route('user.show', auth()->user()) }}"
                        class="text-black mt-2 d-block text-decoration-none">
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
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-outline-dark" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>

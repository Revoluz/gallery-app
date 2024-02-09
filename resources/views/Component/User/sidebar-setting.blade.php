            <div class="bg-white col-4 setting-container rounded-40 px-4 d-none d-md-block" style="height: fit-content">
                <a href="{{ route('user.show', $user->slug) }}"
                    class="text-black mt-2 d-block  {{ Route::is('user.show') ? '' : 'text-decoration-none' }}">
                    <h5>Profile</h5>
                </a>
                <a href="{{ route('user.edit', $user->slug) }}"
                    class="text-black d-block {{ Route::is('user.edit') ? '' : 'text-decoration-none' }}">
                    <h5>Edit Profile</h5>
                </a>
                <a href="{{ route('settings.account-management', $user->slug) }}"
                    class="text-black mt-2 d-block {{ Route::is('settings.account-management') ? '' : 'text-decoration-none' }}">
                    <h5>Account Management</h5>
                </a>
            </div>

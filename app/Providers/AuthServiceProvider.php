<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('auth.guard', function (User $user, User $user_page) {
            // dd($user);
            // $user == user auth
            if ($user->slug != $user_page->slug) {
                return false;
            } else {
                return true;
            }
        });
        Gate::define('admin.guard', function (User $user) {
            // dd($user);
            if ($user->level != 'admin') {
                return false;
            } else {
                return true;
            }
        });
    }
}

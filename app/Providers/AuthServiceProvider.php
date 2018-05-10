<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('dev-access', function ($user) {
            return $user->userroles->role_name == 'developer';
        });
		
        Gate::define('super-access', function ($user) {
            return $user->userroles->role_name == 'super';
        });

        Gate::define('admin-access', function ($user) {
            return $user->userroles->role_name == 'admin';
        });

        Gate::define('room-access', function ($user) {
            return $user->userroles->role_name == 'room';
        });

        Gate::define('front-access', function ($user) {
            return $user->userroles->role_name == 'front';
        });

        Gate::define('super-user', function ($user) {
            return $user->userroles->role_name == 'super user';
        });

        Gate::define('super-admin', function ($user) {
            return $user->userroles->role_name == 'super admin';
        });

        Gate::define('financial-admin', function ($user) {
            return $user->userroles->role_name == 'financial admin';
        });

        Gate::define('operation-admin', function ($user) {
            return $user->userroles->role_name == 'operation admin';
        });

        Gate::define('user', function ($user) {
            return $user->userroles->role_name == 'user';
        });
    }
}

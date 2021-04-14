<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isSuper', function ($user) {
            return $user->roles->first()->slug == 'superadmin'; 
        });

        Gate::define('isAdmin', function ($user) {
            return $user->roles->first()->slug == 'admin'; 
        });

        Gate::define('isEncargado', function ($user) {
            return $user->roles->first()->slug == 'encargado'; 
        });
    }
}

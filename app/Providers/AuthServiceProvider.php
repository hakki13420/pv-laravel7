<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('superAdmin', function(){
            return Auth::user()->role=="SuperAdmin";
        });

        Gate::define('isAdmin',function(){
            return Auth::user()->role=="Admin";
        });

        Gate::define('isAgent',function(){
            return Auth::user()->role=="Agent";
        });

        Gate::define('isChef',function(){
            return Auth::user()->role=="Chef";
        });

        Gate::define('isInvite', function(){
            return Auth::user()->role=="Invite";
        });
    }
}

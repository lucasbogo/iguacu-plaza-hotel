<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        //
    ];


    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('customer', function ($user) {
            // Your logic here to determine if the user is a customer
            // For example, if Customer model has an isAdmin() method
            return $user->isAdmin();
        });
    }
}

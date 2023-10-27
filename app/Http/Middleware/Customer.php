<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Customer
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('customer_login');
        }
    }
}
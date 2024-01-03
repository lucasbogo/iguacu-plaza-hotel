<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema; // Import the Schema facade
use Illuminate\Support\ServiceProvider;
use App\Models\Page;
use App\Models\Room;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // Check if the 'pages' table exists in the database
        if (Schema::hasTable('pages')) {
            $page = Page::where('id', 1)->first();
        } else {
            // Set default values or handle the absence of the 'pages' table
            $page = null;
        }

        // Check if the 'rooms' table exists in the database
        if (Schema::hasTable('rooms')) {
            $room = Room::where('status', true)->get();
        } else {
            // Set default values or handle the absence of the 'rooms' table
            $room = null;
        }

        // Check if the 'settings' table exists in the database
        if (Schema::hasTable('settings')) {
            $setting = Setting::where('id', 1)->first();
        } else {
            // Set default values or handle the absence of the 'settings' table
            $setting = null;
        }

        view()->share('global_page', $page);
        view()->share('global_room', $room);
        view()->share('global_setting', $setting);
    }
}

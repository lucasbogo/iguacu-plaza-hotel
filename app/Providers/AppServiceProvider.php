<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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

        $page = Page::where('id', 1)->first();
        $room = Room::where('status', true)->get();
        $setting = Setting::where('id', 1)->first();

        view()->share('global_page', $page);
        view()->share('global_room', $room);
        view()->share('global_setting', $setting);
    }
}

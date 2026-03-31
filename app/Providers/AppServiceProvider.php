<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Service;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (Schema::hasTable('settings')) {
            $settings = Setting::first() ?? new Setting(); 
            View::share('settings', $settings);
        }

        // Add this block to share active services with the Navbar globally
        if (Schema::hasTable('services')) {
            // We use select() to only grab what we need for the menu (faster performance)
            $navServices = Service::where('is_active', true)->select('id', 'title')->get();
            View::share('navServices', $navServices);
        }
    }
}
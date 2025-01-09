<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ThongTinWebsite;

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
        // Chia sẻ dữ liệu logo tới tất cả view
        View::composer('*', function ($view) {
            $websiteInfo = ThongTinWebsite::first(); 
            $view->with('websiteInfo', $websiteInfo);
        });
    }
}
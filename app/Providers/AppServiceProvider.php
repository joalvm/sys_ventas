<?php

namespace App\Providers;

use App\View\Components\Breadcrumb;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        DB::enableQueryLog();

        Blade::component('breadcrumb', Breadcrumb::class);
    }
}

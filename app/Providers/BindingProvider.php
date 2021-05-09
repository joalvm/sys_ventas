<?php

namespace App\Providers;

use App\Contracts\PersonsContract;
use App\Repositories\PersonsRepository;
use Illuminate\Support\ServiceProvider;

class BindingProvider extends ServiceProvider
{
    public $bindings = [
        PersonsContract::class => PersonsRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

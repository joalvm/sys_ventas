<?php

namespace App\Providers;

use App\Contracts\PersonsContract;
use App\Contracts\UsersContract;
use App\Repositories\PersonsRepository;
use App\Repositories\UsersRepository;
use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    public $bindings = [
        PersonsContract::class => PersonsRepository::class,
        UsersContract::class => UsersRepository::class,
    ];

    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Authentication\DatabaseSessionHandler;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class SessionServiceProvider extends ServiceProvider
{
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
        Session::extend('database2', function ($app) {
            return new DatabaseSessionHandler(
                $app->get('db')->connection(),
                $app->get('config')->get('session')['table'],
                $app->get('config')->get('session')['lifetime'],
                $app
            );
        });
    }
}

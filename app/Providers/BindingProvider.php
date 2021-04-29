<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\TipoDocumentoContract;
use App\Repositories\TipoDocumentoRepository;

class BindingProvider extends ServiceProvider
{
    public $bindings = [
        TipoDocumentoContract::class => TipoDocumentoRepository::class,
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

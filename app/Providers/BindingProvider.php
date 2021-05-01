<?php

namespace App\Providers;

use App\Contracts\UnidadMedidaContract;
use Illuminate\Support\ServiceProvider;
use App\Contracts\TipoDocumentoContract;
use App\Repositories\UnidadMedidaRepository;
use App\Repositories\TipoDocumentoRepository;

class BindingProvider extends ServiceProvider
{
    public $bindings = [
        TipoDocumentoContract::class => TipoDocumentoRepository::class,
        UnidadMedidaContract::class => UnidadMedidaRepository::class,
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

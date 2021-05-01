<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UnidadMedidaController;
use App\Http\Controllers\Api\TipoDocumentoController;

Route::apiResources([
    'tipo_documento' => TipoDocumentoController::class,
    'unidad_medida' => UnidadMedidaController::class,
]);

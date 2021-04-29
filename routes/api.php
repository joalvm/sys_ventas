<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TipoDocumentoController;

Route::apiResource('tipo_documento', TipoDocumentoController::class);

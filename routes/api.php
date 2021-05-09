<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonsController;

Route::apiResources([
    'persons' => PersonsController::class,
]);

<?php

use App\Http\Controllers\Api\PersonsController;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'persons' => PersonsController::class,
]);

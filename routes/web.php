<?php

use App\Http\Controllers\Views\AdminController;
use App\Http\Controllers\Views\RegisterController;
use App\Http\Controllers\Views\SessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::apiResource('register', RegisterController::class)
    ->middleware('guest')
    ->only(['index', 'store'])
;

Route::get('login', [SessionController::class, 'login'])
    ->middleware('guest')
    ->name('login')
;

Route::post('login', [SessionController::class, 'authenticate'])
    ->middleware('guest')
    ->name('login.store')
;

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('logout', [SessionController::class, 'logout'])->name('logout');

        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    })
;

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Views\AdminController;
use App\Http\Controllers\Views\SessionController;

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

Route::get('register', [SessionController::class, 'register']);
Route::get('login', [SessionController::class, 'login']);
Route::post('login', [SessionController::class, 'authenticate']);

Route::prefix('admin')
->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard']);
    Route::get('profile', [AdminController::class, 'profile']);
});

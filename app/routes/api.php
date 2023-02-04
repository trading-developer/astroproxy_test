<?php

use App\Http\Controllers\ServicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::group(['middleware' => 'jwt.verify', 'prefix' => 'auth'], static function ($router) {
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('auth.refresh');
});

Route::group(['middleware' => ['jwt.verify'], 'throttle:20,1'], static function () {
    Route::delete('user/{user}', [UserController::class, 'delete'])->name('user.delete');
    Route::post('users/create', [UserController::class, 'store'])->name('user.store');
    Route::patch('user/{user}', [UserController::class, 'update'])->name('user.update');

    Route::get('users', [UserController::class, 'index'])->name('user.index');
    Route::get('user/{user}/payments', [UserController::class, 'payments'])->name('user.payments');
    Route::get('user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::post('user/{user}/attach-service/{service}', [UserController::class, 'attachService'])->name('user.attach-service');
});

Route::group(['middleware' => 'jwt.verify', 'prefix' => 'services'], static function ($router) {
    Route::get('/', [ServicesController::class, 'index'])->name('services.index');
});

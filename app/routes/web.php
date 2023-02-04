<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
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

Route::get('/admin', [HomeController::class, 'admin']);
Route::get('/admin/{any}', [HomeController::class, 'admin'])->where('any', '.*');

//Route::get('/{any?}', [HomeController::class, 'index'])->where('any', '^(?!api\/)[\/\w\.-]*');
Route::get('/{any}', [HomeController::class, 'index'])->where('any', '.*');

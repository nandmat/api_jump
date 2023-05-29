<?php

use App\Http\Controllers\ServiceOrderController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group(function(){
    Route::get('/index', [UserController::class, 'index'])->name('api.users.index');
    Route::post('/store', [UserController::class, 'store'])->name('api.users.store');
});

Route::prefix('service_order')->group(function(){
    Route::get('/index', [ServiceOrderController::class, 'index'])->name('api.service.order.index');
    Route::post('/store', [ServiceOrderController::class, 'store'])->name('api.service.order.store');
    Route::post('/filter', [ServiceOrderController::class, 'filter'])->name('api.service.order.filter');
});

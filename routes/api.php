<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UmkmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthenticatedSessionController::class, 'loginApi']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('products', [MenuController::class, "products"]);
    Route::get('shops', [UmkmController::class, "allDataUmkm"]);
    Route::post('shopData', [UmkmController::class, "shopData"]);
});

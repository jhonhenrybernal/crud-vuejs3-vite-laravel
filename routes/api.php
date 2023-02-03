<?php

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

Route::post('/login', [App\Http\Controllers\UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () 
{
    Route::post('/logout', [App\Http\Controllers\UserController::class, 'logout']);
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::resource('client', App\Http\Controllers\ClientController::class);
    Route::resource('role', App\Http\Controllers\RoleController::class);
    Route::resource('product', App\Http\Controllers\ProductController::class);
    Route::resource('purchase-order', App\Http\Controllers\PurchaseOrderController::class);
});
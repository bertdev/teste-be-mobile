<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ProductsController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});

Route::controller(ProductsController::class)->group(function () {
    Route::get('products', 'index');
    Route::get('products/{id}', 'show');
    Route::post('products', 'store');
    Route::patch('products/{id}', 'update');
    Route::delete('products/{id}', 'delete');
});


Route::controller(CustomersController::class)->group(function () {
    Route::get('customers', 'index');
    Route::get('customers/{id}', 'show');
    Route::post('customers', 'store');
    Route::patch('customers/{id}', 'update');
    Route::delete('customers/{id}', 'delete');
    Route::post('customers/orders', 'createOrder');
});

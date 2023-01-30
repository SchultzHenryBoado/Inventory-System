<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ReceivingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'index'])->middleware('guest');

Route::controller(UserController::class)->group(function () {
    Route::get('/home', 'dashboard')->middleware('auth');
    Route::get('/user', 'user');
    Route::get('/company', 'company');
    Route::get('/stock', 'stock');
    Route::get('/receiving', 'receive');

    Route::post('/user/store', 'store');
    Route::post('/login/process', 'process');
    Route::get('/logout', 'logout');
    Route::put('/user/{user}', 'updateUser');
});

Route::controller(CompanyController::class)->group(function () {
    Route::get('/company/{company}', 'storeId');

    Route::post('/company/store', 'store');
    Route::put('/company/{company}', 'update');
    Route::delete('/company/{company}', 'destroy');
});

Route::controller(StockController::class)->group(function () {
    Route::get('/stock/{stock}', 'show');

    Route::post('/stock/store', 'store');
    Route::put('/stock/{stock}', 'update');
    Route::delete('/stock/{stock}', 'destroy');
});


Route::controller(ReceivingController::class)->group(function () {

    Route::get('/receiving/{receive}', 'storeId');

    Route::post('/receiving/store', 'store');
    Route::put('/receiving/{receive}', 'update');
});

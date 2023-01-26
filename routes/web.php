<?php

use App\Http\Controllers\CompanyController;
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

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::get('/dashboard', 'dashboard')->middleware('auth');
    Route::get('/user', 'user');
    Route::get('/company', 'company');
    Route::get('/stock_profiles', 'stock_profile');

    Route::post('/user/store', 'store');
    Route::post('/login/process', 'process');
    Route::get('/logout', 'logout');
});

Route::controller(CompanyController::class)->group(function () {
    Route::get('/company/{company}', 'storeId');

    Route::post('/company/store', 'store');
    Route::put('/company/{company}', 'update');
    Route::delete('/company/{company}', 'destroy');
});

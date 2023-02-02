<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ReceivingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransferInController;
use App\Http\Controllers\TransferOutController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/login', [UserController::class, 'index'])->middleware('guest')->name('login');

Route::controller(ReceivingController::class)->group(function () {
    Route::get('/receiving', 'receive')->middleware('auth');
    Route::get('receiving/export', 'export');

    Route::put('/receiving/export', 'export_excel');
    Route::post('/receiving/store', 'store');
    Route::put('/receiving/{receiving}', 'update');
    Route::delete('/receiving/{receiving}', 'destroy');
});

Route::controller(TransferInController::class)->group(function () {
    Route::get('/transfer_in', 'transferIn')->middleware('auth');
    Route::get('/transfer_in/export', 'export_excel');

    Route::post('/transfer_in/store', 'store');
    Route::put('/transfer_in/{transfer_in}', 'update');
    Route::delete('/transfer_in/{transfer_in}', 'delete');
});

Route::controller(TransferOutController::class)->group(function () {
    Route::get('/transfer_out', 'transferOut')->middleware('auth');
    Route::get('/transfer_out/export', 'export');

    Route::post('/transfer_out/store', 'store');
    Route::put('/transfer_out/{transfer_out}', 'update');
    Route::delete('/transfer_out/{transfer_out}', 'destroy');
});


Route::controller(UserController::class)->group(function () {
    Route::get('/dashboard', 'dashboard');
    Route::get('/user', 'user');
    Route::get('/stock', 'stock');

    Route::post('/user/store', 'store');
    Route::post('/login/process', 'process');
    Route::get('/logout', 'logout');
    Route::put('/user/{user}', 'updateUser');
});

Route::controller(CompanyController::class)->group(function () {
    Route::get('/company', 'company')->middleware('auth');
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

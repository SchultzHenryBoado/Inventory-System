<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ReceivingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransferInController;
use App\Http\Controllers\TransferOutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
use App\Models\TransferOut;
use App\Models\WarehouseMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;

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


Auth::routes();

Route::middleware(['auth', 'admin_access'])->group(function () {

  Route::controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'dashboard');
    Route::get('/user', 'user');
    Route::get('/user_profiles', 'index');

    Route::post('/user_profiles/store', 'store');
    Route::put('/user_profiles/{user}', 'update');
  });

  Route::controller(CompanyController::class)->group(function() {
    Route::get('/company', 'company');
    
    Route::post('/company/store', 'store');
    Route::put('/company/{company}', 'update');
    Route::delete('/company/{company}', 'destroy');
  });

  Route::controller(StockController::class)->group(function() {
    Route::get('/stock', 'stocks');

    Route::post('/stock/store', 'store');
    Route::put('/stock/{stock}', 'update');
    Route::delete('/stock/{stock}', 'destroy');
  });

  Route::controller(WarehouseController::class)->group(function() {
    Route::get('/warehouse', 'index');

    Route::post('/warehouse/store', 'store');
    Route::put('/warehouse/{warehouse}', 'update');
    Route::delete('/warehouse/{warehouse}', 'destroy');
  });
  
});

Route::controller(UserController::class)->group(function () {
  Route::get('/logout', 'logout');
  Route::get('/forgot_password', 'forgot');
  Route::get('/reset_password/{token}', 'reset')->name('reset_password_link');
  Route::get('/change_password', 'changePass');
  
  Route::post('/process', 'process');
  Route::post('/forgot_password/submit', 'submit');
  Route::post('/reset_password', 'submit_reset_password');
  Route::put('/change_password/update', 'update_password');
});

Route::controller(ReceivingController::class)->group(function () {
  Route::get('/receiving', 'index')->middleware('auth');
  Route::get('/receiving/export', 'export');

  Route::post('/receiving/store', 'store');
  Route::put('/receiving/{receiving}', 'update');
  Route::delete('/receiving/{receiving}', 'destroy');
  Route::post('/import', 'import');
});

Route::controller(IssueController::class)->group(function () {
  Route::get('/issuance', 'index')->middleware('auth');

  Route::post('/issuance/store', 'store');
  Route::put('/issuance/{issue}', 'update');
  Route::delete('/issuance/{issue}', 'destroy');
});

Route::controller(TransferInController::class)->group(function () {
  Route::get('/transfer_in', 'index')->middleware('auth');

  Route::post('/transfer_in/store', 'store');
  Route::put('/transfer_in/{transfer_in}', 'update');
  Route::delete('/transfer_in/{transfer_in}', 'destroy');
});

Route::controller(TransferOutController::class)->group(function () {
  Route::get('/transfer_out', 'index')->middleware('auth');

  Route::post('/transfer_out/store', 'store');
  Route::put('/transfer_out/{transfer_out}', 'update');
  Route::delete('/transfer_out/{transfer_out}', 'destroy');
});
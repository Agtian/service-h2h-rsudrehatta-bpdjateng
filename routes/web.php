<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TableLogPaymentController;
use App\Http\Controllers\TableUserAccountController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboardHome');
Route::get('table-log-payment', [TableLogPaymentController::class, 'index'])->name('tableLogPayment');
Route::get('table-user-account', [TableUserAccountController::class, 'index'])->name('tableUserAccount');

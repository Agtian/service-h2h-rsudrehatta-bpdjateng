<?php

use App\Http\Controllers\ApiEventHistoriesController;
use App\Http\Controllers\Authentication\LoginController as AuthenticationLoginController;
use App\Http\Controllers\Authentication\RedirectController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\RegisterAPIKeysController;
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

// Auth::routes();

// Route::prefix('/dashboard')->middleware(['auth', 'checkrole:2'])->group(function () {
//     Route::controller(DashboardAdminController::class)->group(function () {
//         Route::get('/', 'index');
//     });
// });

// Route::prefix('/home')->middleware(['auth', 'checkrole:1'])->group(function () {

//     Route::controller(DashboardUserController::class)->group(function () {
//         Route::get('/', 'index')->name('dashboardUser');
//     });

//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboardHome');
//     Route::get('/table-log-payment', [TableLogPaymentController::class, 'index'])->name('tableLogPayment');
//     Route::get('/table-user-account', [TableUserAccountController::class, 'index'])->name('tableUserAccount');
//     Route::get('/register-api-keys', [RegisterAPIKeysController::class, 'index'])->name('registerAPIKeys');
//     Route::post('/register-api-keys/store', [RegisterAPIKeysController::class, 'store'])->name('storeRegisterApiKeys');

//     Route::get('api-event-histories', [ApiEventHistoriesController::class, 'index'])->name('apiEventHistories');
// });

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthenticationLoginController::class, 'index'])->name('login');
    Route::get('/login', [AuthenticationLoginController::class, 'index'])->name('login');
    Route::post('/login', [AuthenticationLoginController::class, 'doLogin']);
    Route::get('/register', [AuthenticationLoginController::class, 'register'])->name('register');
    Route::post('/register', [AuthenticationLoginController::class, 'registerProses']);
});


Route::post('/logout', [AuthenticationLoginController::class, 'logout']);

// Route::controller(DashboardUserController::class)->group(function () {
//     Route::get('/home', 'index')->name('dashboardUser');
// })->middleware(['auth', 'checkrole:1']);

Route::prefix('home')->middleware(['auth', 'checkrole:1'])->group(function () {
    Route::controller(DashboardUserController::class)->group(function () {
        Route::get('/', 'index')->name('dashboardUser');
    });
});

Route::prefix('dashboard')->middleware(['auth', 'checkrole:2'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboardHome');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboardHome');
    Route::get('/table-log-payment', [TableLogPaymentController::class, 'index'])->name('tableLogPayment');
    Route::get('/table-user-account', [TableUserAccountController::class, 'index'])->name('tableUserAccount');
    Route::get('/register-api-keys', [RegisterAPIKeysController::class, 'index'])->name('registerAPIKeys');
    Route::post('/register-api-keys/store', [RegisterAPIKeysController::class, 'store'])->name('storeRegisterApiKeys');
});

Route::get('api-event-histories', [ApiEventHistoriesController::class, 'index'])->name('apiEventHistories');

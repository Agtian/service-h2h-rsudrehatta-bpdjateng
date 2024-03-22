<?php

use App\Http\Controllers\Admin\DataApiKeyController;
use App\Http\Controllers\Admin\DataLogPaymentController;
use App\Http\Controllers\Admin\DataLogServiceController;
use App\Http\Controllers\Admin\DataUserController;
use App\Http\Controllers\ApiEventHistoriesController;
use App\Http\Controllers\Authentication\LoginController as AuthenticationLoginController;
use App\Http\Controllers\Authentication\RedirectController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\Dashboard\UserDashboardController;
use App\Http\Controllers\User\KatalogServiceController;
use App\Http\Controllers\User\LogServiceController;
use App\Http\Controllers\User\ApiKeyController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\BlankController;
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

Route::post('/logout', [AuthenticationLoginController::class, 'logout']);

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthenticationLoginController::class, 'index'])->name('login');
    Route::get('/login', [AuthenticationLoginController::class, 'index'])->name('login');
    Route::post('/login', [AuthenticationLoginController::class, 'doLogin']);
    Route::get('/register', [AuthenticationLoginController::class, 'register'])->name('register');
    Route::post('/register', [AuthenticationLoginController::class, 'registerProses']);
});

Route::prefix('account')->middleware(['auth', 'checkrole:0, 3, 4 ,5'])->group(function () {
    Route::get('/', [ProfileController::class, 'index']);
    Route::post('/activate-account', [ProfileController::class, 'activateAccount']);
    Route::post('/verification-code', [ProfileController::class, 'verificationCode']);
});

Route::prefix('home')->middleware(['auth', 'checkrole:1'])->group(function () {
    // Route::controller(DashboardUserController::class)->group(function () {
    //     Route::get('/', 'index')->name('dashboardUser');
    // });
    Route::get('/accounts', [BlankController::class, 'index'])->name('blankPage');

    Route::get('/', [UserDashboardController::class, 'index']);
    Route::get('/katalog-service', [KatalogServiceController::class, 'index']);
    Route::get('/log-service', [LogServiceController::class, 'index']);
    Route::get('/api-key', [ApiKeyController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'index']);
});

Route::prefix('dashboard')->middleware(['auth', 'checkrole:2'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index']);
    Route::get('activating-user/{id}/user', [AdminDashboardController::class, 'activatingUser']);
    Route::get('/katalog-service', [KatalogServiceController::class, 'index']);
    Route::get('/data-log-service', [DataLogServiceController::class, 'index']);
    Route::get('/data-log-payment', [DataLogPaymentController::class, 'index']);
    Route::get('/data-api-key', [DataApiKeyController::class, 'index']);
    Route::get('/data-user', [DataUserController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'index']);
});

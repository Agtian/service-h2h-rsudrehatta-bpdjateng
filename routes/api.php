<?php

use App\Http\Controllers\Api\TagihanPasienController as ApiTagihanPasienController;
use App\Http\Controllers\TagihanPasienController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json([
        'status'    => false,
        'message'   => 'Akses tidak diperbolehkan'
    ], 401);
})->name('login');

Route::post('register-user', [AuthController::class, 'registerUser']);
Route::post('login-user', [AuthController::class, 'loginUser']);

Route::get('data-tagihan/{nomedis_or_notagihan}', [TagihanPasienController::class, 'tagihanPasien'])->middleware('auth:sanctum');
Route::post('response-payment', [TagihanPasienController::class, 'storeResponsePayment'])->middleware('auth:sanctum');

Route::get('all-tagihan-pasien', [TagihanPasienController::class, 'allTagihan']);
Route::get('tagihan-pasien/{nomedis_or_notagihan}', [TagihanPasienController::class, 'tagihanPasienUnlock']);
Route::post('response-flag', [TagihanPasienController::class, 'storeResponsePaymentUnlock']);
Route::post('response-reversal', [TagihanPasienController::class, 'storeResponseReversalUnlock']);

Route::middleware('api_key')->group(function () {
    Route::get('patient-bills', [ApiTagihanPasienController::class, 'patientBill']);
    Route::get('payment-patient-bill', [ApiTagihanPasienController::class, 'patientBillById']);
    Route::post('response-payment', [ApiTagihanPasienController::class, 'storeResponseFlag']);
    Route::post('response-reversal', [ApiTagihanPasienController::class, 'storeResponseReversal']);
});

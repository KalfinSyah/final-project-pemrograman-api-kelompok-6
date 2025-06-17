<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\VendorController;
use App\Http\Controllers\Api\CashflowController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Auth\AuthTokenController;
use App\Models\Cashflow;

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

// Route untuk testing saja
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['auth:sanctum', 'is_admin']], function () {
    //Routes khusus admin
    Route::get('/admin-only', function () {
        return response()->json(['message' => 'Welcome Admin!']);
    });
});

// Route activities dilengkapi middleware di dalam controller
Route::apiResource('activities', ActivityController::class);
Route::get('/all-activities', [ActivityController::class, 'all']);

Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::apiResource('reservations', ReservationController::class);
    Route::get('/reservations/{id}/cashflows', [ReservationController::class, 'cashflows']);

    Route::apiResource('vendors', VendorController::class);

    Route::apiResource('reservations', ReservationController::class);
    Route::get('/nearestReservation', [ReservationController::class, 'showClosest']);

    Route::apiResource('cashflows', CashflowController::class);
    Route::get('/recentCashflows', [CashflowController::class, 'recentCashflows']);
});

Route::get('/', function () {
    return ['API'];
});

// Route::post('/register', [AuthTokenController::class, 'register']);
Route::post('/login', [AuthTokenController::class, 'login']);
Route::post('/logout', [AuthTokenController::class, 'logout'])->middleware('auth:sanctum');

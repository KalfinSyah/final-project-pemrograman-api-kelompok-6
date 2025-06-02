<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\Auth\AuthTokenController;

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

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/calenders', [CalenderController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::get('/calenders/{calender}', [CalenderController::class, 'show']);
    Route::post('/calenders', [CalenderController::class, 'store']);
    Route::put('/calenders/{calender}', [CalenderController::class, 'update']);
    Route::delete('/calenders/{calender}', [CalenderController::class, 'destroy']);
});


Route::group(['middleware' => ['auth:sanctum', 'is_admin']], function () {
    //Routes khusus admin
    Route::get('/admin-only', function () {
        return response()->json(['message' => 'Welcome Admin!']);
    });
});

Route::get('/', function () {
    return ['API'];
});

Route::post('/register', [AuthTokenController::class, 'register']);
Route::post('/login', [AuthTokenController::class, 'login']);
Route::post('/logout', [AuthTokenController::class, 'logout'])->middleware('auth:sanctum');

<?php

use App\Http\Controllers\SensorDataController;
use App\Http\Controllers\WifiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommandController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::get('/sensor-data', [SensorDataController::class, 'index']);
Route::post('/sensor-data', [SensorDataController::class, 'store']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::post('/wifi/find-full', [WifiController::class, 'findBySsidTypeAndPassword']);
Route::post('/wifi', [WifiController::class, 'store']);
Route::get('/command', [CommandController::class, 'getLatestCommand']);
Route::post('/command', [CommandController::class, 'store']);

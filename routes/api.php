<?php

use App\Http\Controllers\Api\ApiAuthorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiChismeController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/chismes', [ApiChismeController::class, 'index']);
    Route::post('/chismes', [ApiChismeController::class, 'store']);
    Route::get('/chismes/{id}', [ApiChismeController::class, 'show']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/authors', [ApiAuthorController::class, 'index']);
    Route::get('/authors/{id}', [ApiAuthorController::class, 'show']);
});

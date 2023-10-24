<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\ItemController;
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
// Route::post('/login', [AuthController::class, 'auth']);
// Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
// Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
// Route::apiResource('/items', \App\Http\Controllers\Api\ItemController::class);
// //para rotas que necessitam de autenticação
// Route::middleware(['auth:sanctum'])->group(function () {
//
//    //endereço fica assim? /api/items
//    //Route::apiResource('/items', \App\Http\Controllers\Api\ItemController::class);
// });
Route::prefix('v1')->group(function () {
    // Route::get('/items', [\App\Http\Controllers\Api\V1\ItemController::class, 'index']);
    // Route::get('/items/{item}', [\App\Http\Controllers\Api\V1\ItemController::class, 'show']);
    // Route::post('/items', [\App\Http\Controllers\Api\V1\ItemController::class, 'store']);
    // Route::put('/items/{item}', [\App\Http\Controllers\Api\V1\ItemController::class, 'update']);
    // Route::delete('/items/{item}', [\App\Http\Controllers\Api\V1\ItemController::class, 'destroy']);
    Route::apiResource('items', ItemController::class);
});

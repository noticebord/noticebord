<?php

use App\Http\Controllers\Api\{NoticeController, TokenController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('notices')->group(function () {
    Route::get('', [NoticeController::class, 'index']);
    Route::get('/{id}', [NoticeController::class, 'show']);

    // Must be logged in to create, update or delete a notice.
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::post('', [NoticeController::class, 'store']);
        Route::prefix('{id}')->group(function () {
            Route::put('', [NoticeController::class, 'update']);
            Route::delete('', [NoticeController::class, 'destroy']);
        });
    });
});

Route::prefix('tokens')->group(function () {
    Route::post('', [TokenController::class, 'create']);
});

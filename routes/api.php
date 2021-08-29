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
    Route::post('', [NoticeController::class, 'store']);

    Route::get('/{id}', [NoticeController::class, 'show']);

    // Must be logged in to update or delete a notice.
    Route::middleware(['auth:sanctum', 'verified'])
        ->prefix('{id}')
        ->group(function () {
            Route::patch('', [NoticeController::class, 'update']);
            Route::delete('', [NoticeController::class, 'destroy']);
        });
});

Route::post('/tokens', [TokenController::class, 'create']);

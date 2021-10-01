<?php

use App\Http\Controllers\Api\{
    NoticeController,
    TeamController,
    TeamNoticeController,
    TokenController,
    TopicController
};
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
            Route::put('', [NoticeController::class, 'update']);
            Route::delete('', [NoticeController::class, 'destroy']);
        });
});

Route::prefix('topics')->group(function () {
    Route::get('', [TopicController::class, 'index']);
    Route::get('/{topic}', [TopicController::class, 'show']);
    Route::get('/{topic}/notices', [TopicController::class, 'notices']);
});

// Team actions always require login
Route::middleware(['auth:sanctum', 'verified'])
    ->prefix('teams')
    ->group(function () {
        Route::get('', [TeamController::class, 'index']);

        Route::prefix("{team}")->group(function () {
            Route::get('', [TeamController::class, 'show']);

            Route::prefix("notices", function () {
                Route::get('', [TeamNoticeController::class, 'index']);
                Route::post('', [TeamNoticeController::class, 'store']);

                Route::prefix('{id}')->group(function () {
                    Route::get('', [TeamNoticeController::class, 'show']);
                    Route::put('', [TeamNoticeController::class, 'update']);
                    Route::delete('', [TeamNoticeController::class, 'destroy']);
                });
            });
        });
    });

Route::post('/tokens', [TokenController::class, 'create']);

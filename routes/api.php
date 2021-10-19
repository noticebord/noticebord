<?php

use App\Http\Controllers\Api\{
    NoticeController,
    UserController,
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

// /api/notices
Route::prefix('notices')->group(function () {
    Route::get('', [NoticeController::class, 'index']);
    Route::post('', [NoticeController::class, 'store']);

    Route::get('/{notice}', [NoticeController::class, 'show']);

    // /api/notices/{notice}
    Route::middleware(['auth:sanctum', 'verified'])
        ->prefix('{notice}')
        ->group(function () {
            Route::put('', [NoticeController::class, 'update']);
            Route::delete('', [NoticeController::class, 'destroy']);
        });
});

// /api/teams
Route::middleware(['auth:sanctum', 'verified'])->prefix('teams')->group(function () {
    Route::get('', [TeamController::class, 'index']);

    // /api/teams/{team}
    Route::prefix('{team}')->group(function () {
        Route::get('', [TeamController::class, 'show']);

        // /api/teams/{team}/notices
        Route::prefix('notices')->group(function () {
            Route::get('', [TeamNoticeController::class, 'index']);
            Route::post('', [TeamNoticeController::class, 'store']);

            // /api/teams/{team}/notices/{notice}
            Route::prefix('{notice}')->group(function () {
                Route::get('', [TeamNoticeController::class, 'show']);
                Route::put('', [TeamNoticeController::class, 'update']);
                Route::delete('', [TeamNoticeController::class, 'destroy']);
            });
        });
    });
});

// /api/topics
Route::prefix('topics')->group(function () {
    Route::get('', [TopicController::class, 'index']);

    // /api/topics/{topic}
    Route::prefix('{topic}')->group(function () {
        Route::get('', [TopicController::class, 'show']);
        Route::get('/notices', [TopicController::class, 'notices']);
    });
});

// /api/users
Route::prefix('users')->group(function () {
    // TODO: Is this a good idea?
    Route::get('', [UserController::class, 'index']);

    // /api/users/{user}
    Route::prefix('{user}')->group(function () {
        Route::get('', [UserController::class, 'show']);
        Route::get('/notices', [UserController::class, 'notices']);
        Route::get('/notes', [UserController::class, 'notes'])
            ->middleware(['auth:sanctum', 'verified']);
    });
});

// /api/tokens
Route::post('/tokens', [TokenController::class, 'create']);

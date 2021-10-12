<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::inertia('/', 'Home')->name('home');

Route::prefix('notices')->name('notices.')->group(function () {
    Route::inertia('', 'Notices/Index')
        ->name('index');
    Route::get('/{notice}', fn ($notice) => Inertia::render('Notices/Show', [
        'id' => (int)$notice
    ]))
        ->name('show');
    Route::inertia('/create', 'Notices/Entry')
        ->name('create');

    // Must be logged in to update or delete a notice
    Route::prefix('{notice}')->middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/edit', fn ($notice) => Inertia::render('Notices/Entry', [
            'id' => (int)$notice
        ]))
            ->name('edit');
        Route::get('/delete', fn ($notice) => Inertia::render('Notices/Delete', [
            'id' => (int)$notice
        ]))
            ->name('delete');
    });
});

Route::prefix('topics')->name('topics.')->group(function () {
    Route::inertia('', 'Topics/Index')
        ->name('index');
    Route::get('/{topic}', fn ($topic) => Inertia::render('Topics/Show', [
        'id' => (int)$topic
    ]))
        ->name('show');
});

// Must be logged in to perform any team operations
Route::prefix('team')->middleware(['auth:sanctum', 'verified'])->name('team-notices.')->group(function () {
    Route::inertia('', 'TeamNotices/Index')
        ->name('index');
    Route::get('/{notice}', fn ($notice) => Inertia::render('TeamNotices/Show', [
        'id' => (int)$notice
    ]))
        ->name('show');
    Route::inertia('/create', 'TeamNotices/Entry')
        ->name('create');

    Route::prefix('{notice}')->group(function () {
        Route::get('/edit', fn ($notice) => Inertia::render('TeamNotices/Entry', [
            'id' => (int)$notice
        ]))
            ->name('edit');
        Route::get('/delete', fn ($notice) => Inertia::render('TeamNotices/Delete', [
            'id' => (int)$notice
        ]))
            ->name('delete');
    });
});

Route::inertia('/apps', 'Apps')->name('apps');

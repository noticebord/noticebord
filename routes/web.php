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
    Route::get('/{id}', fn ($id) => Inertia::render('Notices/Show', [
        'id' => (int)$id
    ]))
        ->name('show');
    Route::inertia('/create', 'Notices/Entry')
        ->name('create');

    // Must be logged in to update or delete a notice
    Route::prefix('{id}')->middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/edit', fn ($id) => Inertia::render('Notices/Entry', [
            'id' => (int)$id
        ]))
            ->name('edit');
        Route::get('/delete', fn ($id) => Inertia::render('Notices/Delete', [
            'id' => (int)$id
        ]))
            ->name('delete');
    });
});

Route::prefix('team')->name('team-notices.')->group(function () {
    Route::inertia('', 'TeamNotices/Index')
        ->name('index');
    Route::get('/{id}', fn ($id) => Inertia::render('TeamNotices/Show', [
        'id' => (int)$id
    ]))
        ->name('show');
    Route::inertia('/create', 'TeamNotices/Entry')
        ->name('create');

    // Must be logged in to update or delete a notice
    Route::prefix('{id}')->middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/edit', fn ($id) => Inertia::render('TeamNotices/Entry', [
            'id' => (int)$id
        ]))
            ->name('edit');
        Route::get('/delete', fn ($id) => Inertia::render('TeamNotices/Delete', [
            'id' => (int)$id
        ]))
            ->name('delete');
    });
});

Route::inertia('/apps', 'Apps')->name('apps');

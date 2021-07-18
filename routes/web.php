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
    Route::get('/{id}', fn ($id) => Inertia::render('Notices/Show', ['id' => $id]))
        ->name('show');

    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::inertia('/create', 'Notices/Details')
            ->name('create');
        Route::get('edit/{id}', fn ($id) => Inertia::render('Notices/Details', ['id' => $id]))
            ->name('edit');
    });
});

<?php

use Illuminate\Foundation\Application;
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
    Route::inertia('', 'Notices/Index')->name('index');
    Route::get('/{noticeId}', fn ($id) => Inertia::render('Notices/Show', ['id' => $id]))->name('show');
});

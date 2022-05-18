<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function () {
    Route::name('blog.')->namespace('Blog')->group(function () {
        Route::get('/', IndexController::class)->name('index');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

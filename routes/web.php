<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function () {
    Route::name('blog.')->namespace('Blog')->group(function () {
        Route::get('/', IndexController::class)->name('index');

        Route::name('post.')->prefix('post')->group(function () {
            Route::get('post/{post}', 'PostController@show')->name('show');
            Route::get('search', 'PostController@search')->name('search');
        });

        Route::post('comment/{post}', 'CommentController@store')->name('comment.store');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

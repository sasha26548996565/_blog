<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function () {
    Route::name('blog.')->namespace('Blog')->group(function () {
        Route::get('/', IndexController::class)->name('index');

        Route::name('post.')->prefix('post')->group(function () {
            Route::get('post/{post}', 'PostController@show')->name('show');
            Route::get('search', 'PostController@search')->name('search');
            Route::get('tag/{tag}', 'PostController@postsByTag')->name('tag');
            Route::get('category/{category}', 'PostController@postsByCategory')->name('category');
            Route::post('post/like/{post}', 'PostController@like')->name('like');
        });

        Route::post('comment/{post}', 'CommentController@store')->name('comment.store');

        Route::name('personal.')->prefix('personal')->namespace('Personal')->group(function () {
            Route::get('/', IndexController::class)->name('index');

            Route::name('likedPosts.')->prefix('liked-posts')->group(function () {
                Route::get('', 'LikedPostsController@index')->name('index');
            });

            Route::name('comment.')->prefix('comment')->group(function () {
                Route::get('/', 'CommentController@index')->name('index');
            });
        });
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

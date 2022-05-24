<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function () {
    Route::name('blog.')->namespace('Blog')->group(function () {
        Route::get('/', IndexController::class)->name('index');

        Route::name('post.')->prefix('post')->group(function () {
            Route::get('/post/{post}', 'PostController@show')->name('show');
            Route::get('/search', 'PostController@search')->name('search');
            Route::get('/tag/{tag}', 'PostController@postsByTag')->name('tag');
            Route::get('/category/{category}', 'PostController@postsByCategory')->name('category');
            Route::post('/post/like/{post}', 'PostController@like')->name('like');
            Route::get('/create', 'PostController@create')->name('create');
            Route::post('/store', 'PostController@store')->name('store');
        });

        Route::post('/comment/{post}', 'CommentController@store')->name('comment.store');

        Route::name('personal.')->prefix('personal')->namespace('Personal')->group(function () {
            Route::get('/', IndexController::class)->name('index');

            Route::name('likedPosts.')->prefix('liked-posts')->group(function () {
                Route::get('/', 'LikedPostsController@index')->name('index');
            });

            Route::name('comment.')->prefix('comment')->group(function () {
                Route::get('/', 'CommentController@index')->name('index');
                Route::get('/edit/{comment}', 'CommentController@edit')->name('edit');
                Route::patch('/{comment}', 'CommentController@update')->name('update');
                Route::delete('/{comment}', 'CommentController@destroy')->name('destroy');
                Route::post('/{comment}', 'CommentController@restore')->name('restore');
            });
        });
    });

    Route::middleware('role:admin')->name('admin.')->prefix('admin')->namespace('Admin')->group(function () {
        Route::get('/', IndexController::class)->name('index');

        Route::prefix('post')->name('post.')->group(function () {
            Route::get('/', 'PostController@index')->name('index');
            Route::get('/create', 'PostController@create')->name('create');
            Route::post('/store', 'PostController@store')->name('store');
            Route::get('/{post}', 'PostController@edit')->name('edit');
            Route::patch('/{post}', 'PostController@update')->name('update');
            Route::delete('/destroy/{post}', 'PostController@destroy')->name('destroy');
            Route::post('/restore/{post}', 'PostController@restore')->name('restore');
        });
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

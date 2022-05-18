<?php

namespace App\Providers;

use App\ViewComposers\TagComposer;
use Illuminate\Support\Facades\View;
use App\ViewComposers\CategoryComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function register()
    {
        View::composer('blog.includes.header', TagComposer::class);
        View::composer('blog.includes.header', CategoryComposer::class);
    }
}
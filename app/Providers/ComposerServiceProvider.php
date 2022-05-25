<?php

namespace App\Providers;

use App\ViewComposers\TagComposer;
use Illuminate\Support\Facades\View;
use App\ViewComposers\CategoryComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    private array $bladeFiles = ['blog.includes.header', 'blog.post.create', 'admin.post.edit', 'admin.post.create', 'admin.post.index'];

    public function register()
    {
        foreach ($this->bladeFiles as $file)
        {
            View::composer($file, TagComposer::class);
            View::composer($file, CategoryComposer::class);
        }
    }
}

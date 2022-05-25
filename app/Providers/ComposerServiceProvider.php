<?php

namespace App\Providers;

use App\ViewComposers\TagComposer;
use App\ViewComposers\RoleComposer;
use Illuminate\Support\Facades\View;
use App\ViewComposers\CategoryComposer;
use Illuminate\Support\ServiceProvider;
use App\ViewComposers\PermissionComposer;

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

        View::composer('admin.user.create', RoleComposer::class);
        View::composer('admin.user.create', PermissionComposer::class);
    }
}

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
    private array $bladeFilesForTagAndCategories = ['blog.includes.header', 'blog.post.create', 'admin.post.edit',
        'admin.post.create', 'admin.post.index'];
    private array $bladeFilesForRolesAndPermissions = ['admin.user.create', 'admin.user.index'];

    public function register()
    {
        foreach ($this->bladeFilesForTagAndCategories as $file)
        {
            View::composer($file, TagComposer::class);
            View::composer($file, CategoryComposer::class);
        }

        foreach ($this->bladeFilesForRolesAndPermissions as $file)
        {
            View::composer($file, RoleComposer::class);
            View::composer($file, PermissionComposer::class);
        }
    }
}

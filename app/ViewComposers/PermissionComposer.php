<?php

namespace App\ViewComposers;

use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Permission;

class PermissionComposer implements ComposerContract
{
    public function compose(View $view): View
    {
        return $view->with('permissions', Permission::latest()->get());
    }
}

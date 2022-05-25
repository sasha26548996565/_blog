<?php

namespace App\ViewComposers;

use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Role;

class RoleComposer implements ComposerContract
{
    public function compose(View $view): View
    {
        return $view->with('roles', Role::latest()->get());
    }
}

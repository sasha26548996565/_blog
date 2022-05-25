<?php

namespace App\ViewComposers;

use Illuminate\Contracts\View\View;

interface ComposerContract
{
    public function compose(View $view): View;
}

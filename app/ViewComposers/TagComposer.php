<?php

namespace App\ViewComposers;

use App\Models\Tag;
use Illuminate\Contracts\View\View;
use App\Contracts\ComposerContract;

class TagComposer implements ComposerContract
{
    public function compose(View $view): View
    {
        return $view->with('tags', Tag::latest()->get());
    }
}

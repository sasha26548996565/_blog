<?php

namespace App\ViewComposers;

use App\Models\Tag;
use Illuminate\Contracts\View\View;

class TagComposer implements ComposerContract
{
    public function compose(View $view): View
    {
        return $view->with('tags', Tag::latest()->get());
    }
}

<?php

namespace App\ViewComposers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use App\Contracts\ComposerContract;

class CategoryComposer implements ComposerContract
{
    public function compose(View $view): View
    {
        return $view->with('categories', Category::latest()->get());
    }
}

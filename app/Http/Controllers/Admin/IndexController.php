<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $data = collect(['countPosts' => Post::count(), 'countCategories' => Category::count(),
            'countUsers' => User::count(), 'countTags' => Tag::count()]);

        return view('admin.index', compact(nameof($data)));
    }
}

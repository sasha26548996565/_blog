<?php

declare(strict_types=1);

namespace App\Http\Controllers\Blog;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $posts = Post::latest()->paginate(10);

        return view('blog.index', compact(nameof($posts)));
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::latest()->paginate(10);

        return view('admin.post.index', compact(nameof($posts)));
    }
}

<?php

namespace App\Http\Controllers\Blog;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function show(Post $post): View
    {
        return view('blog.post.show', compact(nameof($post)));
    }

    public function search(Request $request): View
    {
        $search = $request->input('search');

        $posts = Post::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('text', 'LIKE', "%{$search}%")
            ->paginate(10);

        return view('blog.search', compact(nameof($posts)));
    }
}

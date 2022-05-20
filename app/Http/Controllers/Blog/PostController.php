<?php

namespace App\Http\Controllers\Blog;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function show(Post $post): View
    {
        return view('blog.post.show', compact(nameof($post)));
    }
}

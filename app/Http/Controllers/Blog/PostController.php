<?php

namespace App\Http\Controllers\Blog;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Category;

class PostController extends Controller
{
    private int $paginateCount = 10;

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

    public function postsByTag(Tag $tag): View
    {
        $posts = $tag->posts()->paginate($this->paginateCount);

        return view('blog.post.tag', ['posts' => $posts, 'tagName' => $tag->title]);
    }

    public function postsByCategory(Category $category): View
    {
        $posts = $category->posts()->paginate($this->paginateCount);

        return view('blog.post.category', ['posts' => $posts, 'categoryName' => $category->title]);
    }
}

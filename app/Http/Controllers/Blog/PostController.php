<?php

namespace App\Http\Controllers\Blog;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Blog\Post\StoreRequest;
use App\Actions\Blog\Post\StoreAction;

class PostController extends Controller
{
    private int $paginateCount = 10;
    private StoreAction $storeAction;

    public function __construct(StoreAction $storeAction)
    {
        $this->storeAction = $storeAction;
    }

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

    public function like(Post $post): RedirectResponse
    {
        Auth::user()->likedPosts()->toggle($post->id);

        return to_route('blog.post.show', $post->id);
    }

    public function create(): View
    {
        return view('blog.post.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {

        $this->storeAction->store($request->validated());

        return to_route('blog.index');
    }
}

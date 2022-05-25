<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Post\StoreAction;
use App\Models\Post;
use App\Actions\Post\UpdateAction;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Blog\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Http\Requests\Post\FilterRequest;

class PostController extends Controller
{
    private const PAGINATION_COUNT = 10;
    private StoreAction $storeAction;
    private UpdateAction $updateAction;

    public function __construct(StoreAction $storeAction, UpdateAction $updateAction)
    {
        $this->storeAction = $storeAction;
        $this->updateAction = $updateAction;
    }

    public function index(FilterRequest $request): View
    {
        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($request->validated())]);

        $posts = Post::withTrashed()->filter($filter)->latest()->paginate(self::PAGINATION_COUNT);

        return view('admin.post.index', compact(nameof($posts)));
    }

    public function create(): View
    {
        return view('admin.post.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $this->storeAction->handle($request->validated());

        return to_route('admin.post.index');
    }

    public function edit(Post $post): View
    {
        return view('admin.post.edit', compact(nameof($post)));
    }

    public function update(UpdateRequest $request, Post $post): RedirectResponse
    {
        $this->updateAction->handle($request->validated(), $post);

        return to_route('admin.post.index');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return to_route('admin.post.index');
    }

    public function restore(int $postId): RedirectResponse
    {
        Post::withTrashed()->findOrFail($postId)->restore();

        return to_route('admin.post.index');
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Actions\Admin\Post\UpdateAction;
use App\Http\Requests\Admin\Post\UpdateRequest;

class PostController extends Controller
{
    private UpdateAction $updateAction;

    public function __construct(UpdateAction $updateAction)
    {
        $this->updateAction = $updateAction;
    }

    public function index(): View
    {
        $posts = Post::latest()->paginate(10);

        return view('admin.post.index', compact(nameof($posts)));
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
}

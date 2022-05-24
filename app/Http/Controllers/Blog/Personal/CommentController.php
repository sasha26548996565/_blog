<?php

declare(strict_types=1);

namespace App\Http\Controllers\Blog\Personal;

use App\Models\Comment;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Blog\Personal\Comment\UpdateRequest;

class CommentController extends Controller
{
    public function index(): View
    {
        $comments = Auth::user()->comments()->withTrashed()->paginate(10);

        return view('blog.personal.comment.index', compact(nameof($comments)));
    }

    public function edit(Comment $comment): View
    {
        return view('blog.personal.comment.edit', compact(nameof($comment)));
    }

    public function update(UpdateRequest $request, Comment $comment): RedirectResponse
    {
        $comment->update($request->validated());

        return to_route('blog.personal.comment.index');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        return to_route('blog.personal.comment.index');
    }

    public function restore(int $commentId): RedirectResponse
    {
        Comment::withTrashed()->findOrFail($commentId)->restore();

        return to_route('blog.personal.comment.index');
    }
}

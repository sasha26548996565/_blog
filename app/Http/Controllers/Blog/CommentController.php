<?php

namespace App\Http\Controllers\Blog;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Blog\Comment\StoreRequest;

class CommentController extends Controller
{
    public function store(StoreRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();

        $data['user_id'] = Auth::user()->id;
        $data['post_id'] = $post->id;

        Comment::create($data);

        return to_route('blog.post.show', $post->id);
    }
}

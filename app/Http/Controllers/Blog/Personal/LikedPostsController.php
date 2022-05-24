<?php

declare(strict_types=1);

namespace App\Http\Controllers\Blog\Personal;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikedPostsController extends Controller
{
    public function index(): View
    {
        $posts = Auth::user()->likedPosts()->paginate(10);

        return view('blog.personal.liked_posts', compact(nameof($posts)));
    }
}

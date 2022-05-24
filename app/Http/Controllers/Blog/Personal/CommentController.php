<?php

declare(strict_types=1);

namespace App\Http\Controllers\Blog\Personal;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(): View
    {
        $comments = Auth::user()->comments()->paginate(10);

        return view('blog.personal.comment', compact(nameof($comments)));
    }
}

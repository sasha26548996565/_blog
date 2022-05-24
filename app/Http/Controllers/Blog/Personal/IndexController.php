<?php

declare(strict_types=1);

namespace App\Http\Controllers\Blog\Personal;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $data = [];
        $data['countLikedPosts'] = Auth::user()->likedPosts()->count();
        $data['countComments'] = Auth::user()->comments()->count();

        return view('blog.personal.index', compact(nameof($data)));
    }
}

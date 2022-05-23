<?php

namespace App\Actions\Blog\Post;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreAction
{
    public function store(array $data): void
    {


            $data['image'] = Storage::disk('public')->put('/images', $data['image']);

            $tags = $data['tags'];
            unset($data['tags']);

            $post = Post::create($data);
            $post->tags()->attach($tags);


    }
}

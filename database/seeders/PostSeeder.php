<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = Post::factory(150)->create();

        $this->attachTags($posts);
    }

    private function attachTags(Collection $posts): void
    {
        foreach ($posts as $post)
        {
            $tagsIds = Tag::get()->random(10)->pluck('id');
            $post->tags()->attach($tagsIds);
        }
    }
}

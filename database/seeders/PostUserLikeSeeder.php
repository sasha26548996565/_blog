<?php

namespace Database\Seeders;

use App\Models\PostUserLike;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostUserLikeSeeder extends Seeder
{
    public function run(): void
    {
        PostUserLike::factory(1000)->create();
    }
}

<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostUserLike>
 */
class PostUserLikeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'post_id' => Post::get()->random()->id,
            'user_id' => User::get()->random()->id
        ];
    }
}

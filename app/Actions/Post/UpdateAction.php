<?php

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateAction
{
    public function handle(array $data, Post $post): void
    {
        try
        {
            DB::beginTransaction();

            if (isset($data['image']))
            {
                $data['image'] = Storage::disk('public')->put('/images', $data['image']);
            }

            $tags = $data['tags'];
            unset($data['tags']);

            $post->update($data);
            $post->tags()->sync($tags);

            DB::commit();
        } catch (\Exception $exception)
        {
            DB::rollback();
            abort(500);
        }
    }
}

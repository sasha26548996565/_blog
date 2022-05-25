<?php

namespace App\Http\Filters;

use App\Models\PostTag;
use Illuminate\Database\Eloquent\Builder;

class PostFilter extends AbstractFilter
{
    public const CATEGORY_ID = 'category_id';
    public const TAGS = 'tags';
    public const SEARCH = 'search';

    protected function getCallbacks(): array
    {
        return [
            self::CATEGORY_ID => [$this, 'categoryId'],
            self::TAGS => [$this, 'tags'],
            self::SEARCH => [$this, 'search']
        ];
    }

    public function categoryId(Builder $builder, $value)
    {
        $builder->where('category_id', $value);
    }

    public function tags(Builder $builder, $value)
    {
        $postIds = PostTag::whereIn('tag_id', $value)->get()->pluck('post_id');
        $builder->whereIn('id', $postIds);
    }

    public function search(Builder $builder, $value): void
    {
        $builder->where('title', 'LIKE', "%{$value}%")->orWhere('text', 'LIKE', "%{$value}%");
    }
}

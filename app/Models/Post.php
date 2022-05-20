<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function category(): Relation
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function tags(): Relation
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function comments(): Relation
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->orderBy('id', 'DESC');
    }

    public function user(): Relation
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

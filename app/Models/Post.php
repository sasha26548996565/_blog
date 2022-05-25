<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    use Filterable;

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

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function ($post) {
            $post->user_id = Auth::user()->id;
        });
    }

    public function isDeleted(): bool
    {
        return $this->deleted_at == null ? false : true;
    }
}

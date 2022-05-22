<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user(): Relation
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function post(): Relation
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function ($comment) {
            $comment->user_id = Auth::user()->id;
        });
    }
}

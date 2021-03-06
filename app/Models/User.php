<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\Filterable;
use App\Notifications\SendVerifyNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles, SoftDeletes, Filterable;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';

    public const EDIT_PERMISSION = 'edit-permission';
    public const DELETE_PERMISSION = 'delete-permission';

    public function likedPosts(): Relation
    {
        return $this->belongsToMany(Post::class, 'post_user_likes', 'user_id', 'post_id');
    }

    public function posts(): Relation
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function comments(): Relation
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new SendVerifyNotification());
    }

    public function checkLike(int $postId): bool
    {
        return $this->likedPosts->contains($postId);
    }

    public function isDeleted(): bool
    {
        return $this->deleted_at == null ? false : true;
    }
}

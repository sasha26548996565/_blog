<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

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
}

<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAdmin(User $user): bool
    {
        return $user->hasRole(User::ROLE_ADMIN);
    }

    public function updatePost(User $user): bool
    {
        return $user->hasPermissionTo(User::EDIT_PERMISSION);
    }
}
